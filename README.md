# README #

This README would normally document whatever steps are necessary to get your application up and running.

### What is this repository for? ###

* Quick summary
* Version
* [Learn Markdown](https://bitbucket.org/tutorials/markdowndemo)

### How do I get set up? ###

* Summary of set up
  * Install LAMP Stack (Linux machines) or XAMP stack (Windows machines) 
    * Install Apache 
      * ex for ubuntu: ```sudo apt install apache2```
    * Install MySQL
      * example for ubuntu: ```sudo apt install mysql-server-5.7```
      * Follow instruction to create one root account. Check configuration steps later.
    * Install PHP
      * ex for ubuntu: ```sudo apt install php7.2 php7.2-mysql php7.0-common php7.2 php7.2-json php7.2-curl```
  
* Configuration
  * DB configuration
    * Create a user apart from root user, provide all privilages to the user to create database etc., [See Reference](https://www.hostinger.in/tutorials/mysql/how-create-mysql-user-and-grant-permissions-command-line)
    * Create database in mysql ex: ```CREATE DATABASE victamdb;```
    * Now you can use the file: victamdbdata.sql to import data.
      * ```mysql -u username -p database_name < file.sql``` [See Reference](https://stackoverflow.com/questions/17666249/how-do-i-import-an-sql-file-using-the-command-line-in-mysql)
  * Code base configuration:
    * Locate ```var/www/html/``` in the machine.
    * Copy the project folder from Bitbucket, create a symlink for the same in other repository.
    * Locate the file ```database.php``` it should be present in ```victamweb/application/config/database.php```
      * Edit the DB configuration to local settngs, things to edit will be ```username | password | database name (if different DB name is used)```.
      * Locate ```.gitignore``` file and add ```application/config/database.php``` so that local changes are not uploaded to bitbucket when code is being pushed.
    * Once the setup is done try to open the application in web-browser ```http://localhost/victamweb/```.
  
* Dependencies
  * None as of now
* How to run tests
  * To be updated
* Deployment instructions
  * To be updated

### Contribution guidelines ###

* Writing tests
  * To be updated
* Code review
  * To be updated
* Case Styles guidelines
  * camelCase -  Define variable
  * PascalCase - Define class
  * snake_case - Create file/folder
  * snake_case  - Create function/method
* Other guidelines
  * Never use any Type. 
  * Type everything. 
  * Don't nest styles. 
  * Don't use inline style. 
  * Don't use unnecessary tag, use empty tag.
  * Follow case in function, variable name.
  * Follow proper file name and folder structure.
  * Split component as much as possible.
  * Predicably down merge from master.
  * Always follow your PR until merge and fix conflicts and comments
  * Never ever add/install/upgrade any packages and dont change any settings files.

## Important Link 
 * Event calender 
 https://www.jqueryscript.net/time-clock/animated-event-calendar.html
 * Google recaptcha form validation
 https://www.itsolutionstuff.com/post/php-codeigniter-3-google-recaptcha-form-validation-exampleexample.html

### Who do I talk to? ###

* Repo owner or admin
  * Connexis Tech Team or [Ameya Deshpande](ameya.deshpande@connexistech.com)
