<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects.

## How to Use This Code

To use thsi code please follow the steps below ;)

### Prerequisites

- Make sure you have [Composer](https://getcomposer.org/) installed.
- Ensure you have a compatible version of PHP installed (check Laravel documentation for requirements).
- Ensure that you have [Xamp](https://www.apachefriends.org/download.html) installed
- If you are using Mac OS check the documentation for it and after you are set for Laravel you can start with Step 4

## Getting Started

After installing composer you can learn below how to run the this project :

## First install node 
You can use this website [node](https://nodejs.org/en/download) .

Or you can use the following command :
```
npm install -g npm
```
## Checking your version of npm and Node.js
To see if you already have Node.js and npm installed and check the installed version, run the following commands:
```
node -v
npm -v
```
## Step 2: Install Laravel
Using Composer, you can install Laravel by running the following command in your terminal:
```
composer global require laravel/installer
```
## Step 3: Open your IDE and create a new laravel project

To create a new laravel project using composer run the following command:
```
composer create-project --prefer-dist laravel/laravel <project-name>
```
## Step 4: 

- Copy the views folder of this project into your local views.
- Copy the routes/Web.php file inside your local Web.php

### Create the migrations 

Run the following command

```
php artisan make:migration create_bookings_table
```
After creating the migration successfully copy the migration table from database/migrations/create_bookings_table to the corresponding file in your project.

Then run the following command:
```
php artisan migrate
```
This will create all your tables in the database.

### Create the controller 

Run the following command

```
php artisan make:controller CalendarController
```
After creating the controller successfully copy its functions from app/HTTPS/Controllers/CalendarControler.php to the corresponding file in your project

### Create the model 

Run the following command

```
php artisan make:model Booking
```
After creating the model successfully copy the model fillables from app/Models/Booking.php to the corresponding file in your project

### Runing the code

# Open three terminales
make sure you are in the directory of your laravel project
# On the first one run :
```
composer update
```
then
```
npm i vite
```
finally 
```
npm run dev
```
Leave it open 
# Run on the second one:
```
php artisan migrate:refresh
```
if you notice that your tables disappeared from the database then run it a second time.

On the third terminal run this command :
```
php artisan serve
```
You will get a url like that looks like this http://127.0.0.1:8000/ 
Click on the URL you see in your terminal to view your project 
Remember taht you can only view your routes so in this case add calendar/index to that URL to enter the view of the calendar

## Built With

* [Dropwizard](http://www.dropwizard.io/1.0.2/docs/) - The web framework used
* [Maven](https://maven.apache.org/) - Dependency Management
* [ROME](https://rometools.github.io/rome/) - Used to generate RSS Feeds

## Contributing

Please read [CONTRIBUTING.md](https://gist.github.com/PurpleBooth/b24679402957c63ec426) for details on our code of conduct, and the process for submitting pull requests to us.

## Versioning

We use [SemVer](http://semver.org/) for versioning. For the versions available, see the [tags on this repository](https://github.com/your/project/tags). 

## Authors

* **Billie Thompson** - *Initial work* - [PurpleBooth](https://github.com/PurpleBooth)

See also the list of [contributors](https://github.com/your/project/contributors) who participated in this project.

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details

## Acknowledgments

* Hat tip to anyone whose code was used
* Inspiration
* etc
