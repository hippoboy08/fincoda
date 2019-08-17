# Laravel PHP Framework

[![Build Status](https://travis-ci.org/laravel/framework.svg)](https://travis-ci.org/laravel/framework)
[![Total Downloads](https://poser.pugx.org/laravel/framework/d/total.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Stable Version](https://poser.pugx.org/laravel/framework/v/stable.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Unstable Version](https://poser.pugx.org/laravel/framework/v/unstable.svg)](https://packagist.org/packages/laravel/framework)
[![License](https://poser.pugx.org/laravel/framework/license.svg)](https://packagist.org/packages/laravel/framework)

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Laravel attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as authentication, routing, sessions, queueing, and caching.

Laravel is accessible, yet powerful, providing tools needed for large, robust applications. A superb inversion of control container, expressive migration system, and tightly integrated unit testing support give you the tools you need to build any application with which you are tasked.

## Official Documentation

Documentation for the framework can be found on the [Laravel website](http://laravel.com/docs).

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](http://laravel.com/docs/contributions).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell at taylor@laravel.com. All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).

# FinnCoda


### How to install the project

**1. Cloning the repository.**
* Note the destination path before you click on clone. This is where your local copy will be stored.
If you are using XAMP or WAMP you will want to clone the repo into your htdocs folder or www folder.

**2. Managing dependencies.**
* Download and install [Composer](https://getcomposer.org/download/).
    * Composer will be used as a php package manger. It is responsible for pulling in the php dependencies of
    this project.
    * Note: If you are using Windows there's a Windows installer.
* Download and install [Node.js](https://nodejs.org/en/).

**3. Setting up the database.**
* If you are using XAMPP or WAMP launch your local server in your browser open up phpmyadmin usually found at
http://localhost/phpmyadmin
    *Create a new database call it [DATABASE NAME]

**4. Editing your project config files.**
* In the root of the project folder there is a file called ".env.example"
    * Rename that file to ".env"
    * Edit the file to look something like this. In here you will store all your passwords and
    any configs you need.
```
APP_ENV=local
APP_DEBUG=true
APP_KEY=base64:Ec3OPTlZeTzR8RY9NawHHKgkLI8F0bSUyQqTPkFd9lk=
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=[DATABASE NAME]
DB_USERNAME=root
DB_PASSWORD=

CACHE_DRIVER=array
SESSION_DRIVER=file
QUEUE_DRIVER=sync

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_DRIVER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=[GMAIL]
MAIL_PASSWORD=[EMAIL PASSWORD]
MAIL_ENCRYPTION=tls
```

**5. Almost done. Installing all the dependencies.**
* In a command shell "cd" into your project or a neat trick you can do if your in windows is browse
to the folder and if you hold shift on your keyboard and right-click on some open space. (NOT on a file)
You should see this option.
It will open up a command prompt at the folder path.
* Now type in the command
``` composer install ```
    * it will take a few mins to pull in all the files it need but what it will do is
        1. install all the php dependencies
        2. install all the node 
* Now serve your project in your browser by:
``` php artisan serve ```

### For Linux users
In Linux systems it is also necessary to make a few more steps **before installing composer**:
* correct reference to Application Service Providers. Go to website folder */config/app.php* and in Application Service Providers change line from *Laracasts\Utilities\JavaScript\JavaScriptServiceProvider::class,* to *'Laracasts\Utilities\JavaScript\JavaScriptServiceProvider',*.

* set full permissions for website folder with command and root privilege 

      *chmod -R 777 <your folder name>*

* change directory name */app/Http/Controllers/Admin* to */app/Http/Controllers/admin* 

**The project should be up and running now.**
