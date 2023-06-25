# simple-authentication-api

# Pre-requisites
`php.8.1^` 
`composer 2.5.0^`
`mysql`
<br>
<br>
### Environment configuration for the application


Laravel comes with an example configuration for the `environment variables` located on `.env.example` on the project's root directory. Open the contents of the `.env.example` and paste it on a new file named `.env`. 
<br>
<br>
A console command is also available to copy the contents of the `.env.example` to `.env`

```
cp .env.example .env
```
<br>
<br>
After setting up the intial environment variables it's already good to go. The `.env` file can be altered to cater some configurations later on.
<br>
<br>

### Database Setup

Create a database for the project's data storage through the `phymyadmin interface`
see the indicated link below for reference.

https://phppot.com/mysql/phpmyadmin-create-database/

or create the database via `mysql cli`

<br>
<br>
1. Login to a mysql user

``` 
mysql -u root -p
```
<br>
<br>

2. create the databases by running the following command and specifying the name of the database

```
CREATE DATABASE your_database_name;
```
<br>
<br>

3. The database will be created and ready for use. Exit the mysql cli right after.
```
exit
````
<br>
<br>

4. On the `.env` that was created initially. Configure the variables to bind the application to a database for record storage, variable values should be something similar.
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_mysql_user
DB_PASSWORD=your_mysql_user_password
```
<br>
Since mysql is the database management system that will be used it's the value of the `DB_CONNECTION`. The value of `DB_CONNECTION` should always related to the database management system you're intending to use. `DB_HOST` value is set to the ip address of the machine's localhost since it is where the development will run. `DB_PORT` is set to `3306` since it is the default port that MySQL listens to. The rest of the configuration is pretty much self explanatory.
<br>
<br>

### Installing dependencies

To install the dependencies or pakakges that the application needs. We need to download it from the composer repository by running the command on the console.
```
composer i
```

The console will take a while before it finishes downloading the dependencies, but once it finishes the application is pretty much good to go. 
<br>
<br>
### Database migration and seeding
<br>
Run this command to create the tables into the database as defined. The `fresh` command will drop all the tables in the database (if there's any) to ensure that there's no duplicates in configuration that may result in an error — the `--seed` flag is also added to simulataneously inject preloaded values on some database tables, which will be in use later on.
<br>
```
php artisan migrate:fresh --seed

```
<br>
<br>

### Laravel Passport


Laravel passport is a package that uses Open Authorization 2.0 server implementation for authenticating APIs using Laravel. This is how users 
will be granted access to the application.


To generate secure access tokens for your application, Passport requires some encryption keys and two clients known as Laravel Personal Access Client and Laravel Password Grant Client. To create these keys and encryption clients, run the following command:

```
php artisan passport:install
```

After installing the passport the application is already good for usage.

<br>
<br>

### Running the application


Since the app is already configured, it's now ready for access in our local server. To run the app run the command

```
php artisan serve

```
<br>

By default the application will run on `localhost:8000`. If you want to run it on a different port just add the `--port` flag and type the port desired.

```
php artisan serve --port=9000
```

<br>
<br>
### Final notes

The application comes with a default system administrator account that was loaded after seeding. The account cannot be deleted by any case. Credentials are as follows

```
email: system@system.com
password: system@secret
```
