import os
import csv
import numpy as np
import pandas as pd
import pymysql

def get_data(my_file):
    '''

    This function takes the file path provided by the Administrator of Technical Support Staff, opens and reads the file
    into a Pandas DataFrame. It returns the DataFrame.

    :param my_file:
    :return: DataFrame of inventory data
    '''

    df = pd.read_csv(my_file)
    #changes loaded data into BOOLEAN values so that they are able to be loaded into the DB
    df.loc[df["ADD_ON_NEEDED"] == "Y", "ADD_ON_NEEDED"] = True #for ADD_ON_NEEDED column
    df.loc[df["ADD_ON_NEEDED"] == "N", "ADD_ON_NEEDED"] = False
    df.loc[df["CHECKED_OUT"] == "Y", "CHECKED_OUT"] = True #for CHECKED_OUT column
    df.loc[df["CHECKED_OUT"] == "N", "CHECKED_OUT"] = False
    df1 = df.astype(object).replace(np.nan, 'None')
    return(df1)


def connect():
    '''
    This function connects to the Cloud DB.
    :return: DB Connection
    '''
    try:
        connector = pymysql.connect(host="aims-demo1.cjiww4oiz41u.us-east-1.rds.amazonaws.com",
                                    user="admin", password="Tiff1tre2maddy3")
        print("Successfully connected to database!")
        return connector

    except Exception as conn_error:
            print("Exception occured: ", conn_error)

def create_database(connection):
    '''
    Creates the SQL database and corresponding tables. This function should only be used in the following cases:
    1. The instructor is using the initial inventory data set to run the program.
    2. Technical support staff is demo-ing the python script
    3. Technical support staff is creating a new webpage and database

    :param connection:
    :return: none
    '''
    cursor = connection.cursor()
    try:
        #Creating the database
        cursor.execute("DROP DATABASE IF EXISTS aims;")
        cursor.execute("CREATE DATABASE aims;")
        cursor.execute("USE aims;")
        #Creating tables
        cursor.execute("DROP TABLE IF EXISTS backend;")
        cursor.execute("CREATE TABLE backend (PID int primary key,FNAME varchar(255) NOT NULL,LNAME varchar(255) NOT NULL,EMAIL varchar(255) NOT NULL,PASS varchar(255) NOT NULL, ADMIN BOOLEAN);")

        cursor.execute("DROP TABLE IF EXISTS items;")
        cursor.execute("CREATE TABLE items (IID int primary key, ITEM_NAME varchar(50) NOT NULL, ITEM_CATEGORY varchar(50), ITEM_COLOR varchar(50) NOT NULL, QUANTITY int NOT NULL, "
                       "ADD_ON_NEEDED boolean DEFAULT false, PURCHASE_ITEM varchar(255), CHECKED_OUT boolean DEFAULT false);")

        cursor.execute("DROP TABLE IF EXISTS renter;")
        cursor.execute("CREATE TABLE renter (RID int PRIMARY KEY AUTO_INCREMENT, FNAME varchar(50) NOT NULL,"
                       "LNAME varchar(50) NOT NULL, PICKUP date,"
                       "EMAIL varchar(50) NOT NULL,"
                       "DROPOFF date, ITEM_COLOR varchar(50), ITEM_NAME varchar(50),"
                       "IID int, PID int,"
                       "FOREIGN KEY (IID) REFERENCES items(IID),"
                       "FOREIGN KEY (PID) REFERENCES backend(PID),"
                       "CHECK (PICKUP < DROPOFF));")
        cursor.execute("ALTER TABLE renter AUTO_INCREMENT=1000;")
        cursor.execute("DROP TABLE IF EXISTS manages;")
        cursor.execute("CREATE TABLE manages (EID int primary key, "
                       "UPDATED DATE, IID int, PID int,"
                       "FOREIGN KEY (IID) REFERENCES items(IID),"
                       "FOREIGN KEY (PID) REFERENCES backend(PID));")

        #Printing created tables
        cursor.execute("SHOW Tables;")
        tables = cursor.fetchall()
        for table in tables:
            print(table)

        #Commiting changes
        connection.commit()

        #Raise exception if connection fails
    except Exception as err:
        print("Failed because ", err)

def fill_items(df, connection):
    '''
    This function takes the dataframe from get_data() and the connection from connect() to fill the
    items table.

    :param df: DataFrame from get_data() function
    :param connection: Connection from connect() function
    :return: None
    '''
    cursor = connection.cursor()
    cursor.execute("USE aims;")
    for index, row in df.iterrows():
        sql = ("INSERT INTO items (IID,ITEM_NAME,ITEM_CATEGORY,ITEM_COLOR,QUANTITY,ADD_ON_NEEDED,PURCHASE_ITEM,CHECKED_OUT) " \
              "values(%s,%s,%s,%s,%s,%s,%s,%s)")
        values = (row.IID, row.ITEM_NAME, row.ITEM_CATEGORY, row.ITEM_COLOR, row.QUANTITY,
                  row.ADD_ON_NEEDED, row.PURCHASE_ITEM, row.CHECKED_OUT)
        cursor.execute(sql, values)
    connection.commit()
    print("Successfully loaded!.")
    cursor.execute("SELECT * FROM items;")
    items_data = (cursor.fetchall())
    for row in items_data:
        print(row)

def fill_backend(my_file, connection):
    '''
        This function takes the data from the manually made Technical Support Staff file and the connection from
        the connect() function to pass into the tech_staff table.

        :param my_file: Technical Support Staff manual data
        :param connection: Connector from connect() function
        :return: None
        '''
    df = pd.read_csv(my_file)

    cursor = connection.cursor()
    cursor.execute("USE aims;")

    for index, row in df.iterrows():
        if row.PASS.startswith("A"):
            admin_check = True
            sql =("INSERT INTO backend (PID,FNAME,LNAME,EMAIL,PASS, ADMIN) values(%s,%s,%s,%s,%s, %s);")
            values = (row.PID, row.FIRST_NAME, row.LAST_NAME, row.EMAIL, row.PASS, admin_check)
            cursor.execute(sql, values)
        else:
            sql = ("INSERT INTO backend (PID,FNAME,LNAME,EMAIL,PASS) values(%s,%s,%s,%s,%s);")
            values = (row.PID, row.FIRST_NAME, row.LAST_NAME, row.EMAIL, row.PASS)
            cursor.execute(sql, values)
    connection.commit()

def fill_renter(my_file, connection):
    df = pd.read_csv(my_file)
    cursor = connection.cursor()
    cursor.execute("USE aims;")
    for index, row in df.iterrows():
        sql = ("INSERT INTO renter (RID, FNAME, LNAME, EMAIL, PICKUP, DROPOFF, IID) values(%s, %s, %s, %s, %s, %s, %s);")
        values = (row.RID, row.FNAME, row.LNAME, row.EMAIL, row.PICKUP, row.DROPOFF, row.IID)
        cursor.execute(sql, values)
        selected_IID = row.IID
        sql2 = ("SELECT * FROM items WHERE IID= %s;" % row.IID)
        cursor.execute(sql2)
        items_data = (cursor.fetchall())
        for row in items_data:
            if row[0] == selected_IID:
                sql3 = ("UPDATE renter SET ITEM_NAME = '%s' WHERE IID = '%s';" % (row[1],selected_IID))
                cursor.execute(sql3)
                sql4 = ("UPDATE renter SET ITEM_COLOR = '%s' WHERE IID = '%s';" % (row[3],selected_IID))
                cursor.execute(sql4)
                sql5 = ("UPDATE items SET CHECKED_OUT = 1")
    connection.commit()

if __name__ == "__main__":

    #Create connection with the Cloud SQL Database
    print("Making connection with database:")
    connection = connect()

    #Organizes data into a DataFrame, then prints the DataFrame
    print("----------------------------")
    print("Organizing data...")
    data_set = get_data("data/Inventory1.csv")
    print("The data that is being loaded is:\n", data_set)

    #Create the database & tables
    print("----------------------------")
    print("Creating database and tables...")
    create_database(connection)

    #Populated the items table
    print("----------------------------")
    print("Loading inventory data...")
    fill_items(data_set, connection)

    #Populating the backend tables
    print("----------------------------")
    print("Populating Backend table...")
    fill_backend("data/backend.csv", connection)
    print("Successfully populated!")

    #Populating the renter table
    print("----------------------------")
    print("Populating Renter table...")
    fill_renter("data/renter.csv", connection)
    print("Succesfully populated!")


    #Closes the SQL Connection
    connection.close()



