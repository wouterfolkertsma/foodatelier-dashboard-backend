<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

#### contributors

* Wouter Folkertsma (wo.folkertsma@st.hanze.nl)

## Prerequisites

* Composer
* Node
* NPM
* Mysql

## Setup

Run the following commands

```shell script
cd YOUR PROJECT ROOT
```
```shell script
composer install
```
```shell script
cp .env.example .env
```
(on Windows:)
```shell script
copy .env.example .env
```

You should now create a database in mysql and add the correct information in the .env file. 

```shell script
php artisan key:generate
```

```shell script
php artisan migrate
```

```shell script
php artisan db:seed
```

```shell script
npm install
```

```shell script
php artisan serve
```

### Frontend Development
We are using sass (css pre-processor) to develop the front-end of the application. The files are located in:

* resources/sass
* resources/js

In the file /resources/sass/vendor/scss is the UIKIT library loaded. This enabled development of compenent from the UIKIT library.
The documentation for that can be found here: 
https://getuikit.com/docs/

To see changes in your project, you can run the following commands:

```shell script
npm run dev
```
The above command compiles the assets once

```shell script
npm run watch
```
The command above does the same as the first command, and checks if there any changes made in the code.
The watcher looks at files in the resources/sass and resources/js, if you change something it will automatically compile again.

```shell script
npm run production
```
The last command above will compile the assets in a way that the total package is a lot smaller in size, which is 
something you want for production environments. This commando should only be run on the produciton server.

### Tools

Sometimes edits to the database are needed, and you need to reset your database. The following .sh command runs everythin needed for that. It wipes the db, migrates, seeds and creates a new admin account.

If are running this command for the first time, make sure the the file is executable:
```shell script
chmod +x reseed.sh 
```
Now you can run:
```shell script
./reseed.sh
```
