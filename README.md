DB_to_Fixtures
================================

YAML/XML Dataset Generator from your current DB for PHPUnit DB Test

You need fixtures to execute DB related tests.  
Sometimes FW might support you, but in other cases you have to create them manually.  
DB_to_Fixtures generates yaml fixture files from your current database.

Output file types
----------------------------------------------------------------------
* YAML Dataset for PHPUnit DB test
* XML Dataset for PHPUnit DB test(not fully tested)

Supported Database
----------------------------------------------------------------------
* PostgreSQL
* MySQL
* sqlite


Recomended environment
----------------------------------------------------------------------
* PHP 5.3 or higher
* PHPUnit 3.7 or higher with DBUnit and Symfony/YAML
* And one or more of DBMS below
    * PostgreSQL 8.4 or higher
    * MySQL 5.0 or higher
    * SQLite 3.7 or higher

How to use
----------------------------------------------------------------------

1. Setup db.config.php suitable to your environment.
2. Type the command line as below  
  ```$ php main.php --table=your_table_name```
3. Now you get "your_table_name.yml" under "outfiles" directory.  
   (You need an appropriate privilege, of course.)
4. Enjoy your DB test with PHPUnit  
  See http://www.phpunit.de/manual/3.7/en/database.html

How to test this DB_to_Fixtures
----------------------------------------------------------------------
* Basic Test  
    ```$ phpunit ymlTest.php```  
    ```$ phpunit UtilTest.php```  
    ```$ phpunit sqliteTest.php``` (with sqlite installed)  

* Other DBs  
 If you are using MySQL/PostgreSQL, create database "test" first.  
 Modify test/resources/mysql.config.php(pgsql.config.php) depending on your environment.  
    ```$ phpunit mysqlTest.php```  
    ```$ phpunit pgsqlTest.php```

Contributor
----------------------------------------------------------------------
- untidy-hair

Feel free to report me anything!
Forking the repository is welcome.

License
----------------------------------------------------------------------
Copyright (c) 2012-2013 Yukio Mizuta  
MIT License http://www.opensource.org/licenses/mit-license
