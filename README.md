# Database_6620 2019 Fall Semester Project Source Code
The repository contains the source code and datasets for building Chicago lobbyist database as well as for designing the web portal.

# Team member
Name | CU user account 
------ | ------------- 
Jun Wang| jwang9
Ha Young Kim| hayounk

# Structure of code
Source code scripts for designing the web portal are stored as .php.

**A. login module**
```
config.php     # connect to the database
register.php   # new user sign up page
login.php      # login page
logout.php     # logout, return to login.php
```
**B. welcome module**
```
welcome.php        # welcome page for normal user type
welcome_admin.php  # welcome page for admin account
```
**C. user account management module**
```
profile.php         # users can view their personal information
editProfile.php     # users can edit/update their personal information
resetPassword.php   # users can reset their password
```
**D. data management module**
```
viewTables.php     # users can select one table to view information
index.php          # split results into pages for convinient view of table information

queryPage.php      # users can select one table to query the database
queryTables.php    # after select one table to quey, users can select attributes of interest and order result by one attribute
queryIndex.php     # display the result of one query with split pages
```
**E. database administration**
```
backup.php       # admin account can select table to backup
backTables.php   # backup the selected table and stored as .csv file to the ~/Download/

recover.php      # users can select one .csv file to restore the database
recover2.php     # upload the file as a table into database, and insert into the values
```


