# Transaction system for the pharmacy

# Features

1. Medications
2. Medications categories
3. Sales
4. Reports
5. Access Control (roles and permissions)
6. Users
7. User Profile
8. Customer Profile
9. Settings (Application settings)
10. Application backup
11. Dashboard

# Installation

Follow these steps to install the application.

1. Clone the Repository

```
git clone https://github.com/Mohamed55088/transaction-system-pharmacy-deals.git

```

2. Go to project directory

```
cd transaction-system-pharmacy

```

3. Install packages with composer

```
composer install

```

4. Install npm packages with

```
npm install && npm run dev


```

5. Create your database

6. Rename .env.example to .env Or copy it and paste at project root directory and name the file .env.You can also use this command.

```
cp .env.example ./.env

```

7. Generate app key with this command

```
php artisan key:generate

```

8. Set database connection to your database in the .env file.

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=transaction
DB_USERNAME=root
DB_PASSWORD=

```

9. Import full database sql file in the database folder, or run migrations
   Use this command to run migrations

```
php artisan migrate --seed

```

10. Start the local server and browser to your app.
    This command will start the development server

```
php artisan serve

```

11. Open the address in the terminal in your browser.Usually address is usually like this:

```
http://127.0.0.1:8000

```

12. Enjoy and make sure to star the repo :).Report bugs,features and also send your pull requests.

# admin login credentials

```
 email: admin@admin.com
 password: fulladmin
```

# Usage

-   Profile =>
    Each user has a profile of their own.
    You can update your profile credentials from this page by clicking on the edit button.
    You can also change your password by clicking on the password tab
    and choosing your new password.Also make sure you type your old password correctly

-   Users =>
    list of all users in the system.
    You can add new user by clicking on the add user button on the users page.
    You can also edit user details by clicking on the edit button on the users page.
    You can easily delete a user by clicking on the delete button.
    You can export or print all the users data by clicking on the export data button dropdown.

-   Access Control =>
    User roles and permissions are here.
    Every user in the system has a role and each role has some number of permissions in the system.
    You can create new roles and choose their permissions.
    Click the add role button, and write the role name and choose some number of permissions you want
    the user holding this role to have and submit.
    you can edit or delete roles by clicking on either the edit button or delete button.

-   Suppliers =>
    The suppliers page has a list of all your product suppliers.
    You can add new suppliers by clicking on add supplier button on the page or from the sidebar.
    You can also edit supplier details by clicking on the edit button on the suppliers page.
    You can also delete by clicking on the delete button.

-   Sales =>

    The sales page has list of all the sales that has ever been made on the system.
    You can add sales by clicking on the sales button on the sales page.
    You can also delete sales by clicking on the delete button.

    You can export or print the sales data by clicking on the export data dropdown menu at the top of the list
    and choosing which option you want.

-   Products =>
    The products page contains all products that you are selling.
    You can add product by clicking on the add product from the sidebar or add new button the products page.

    You can edit the product details by clicking on the edit button on the products page
    Or you can also delete product by clicking on the delete button on the products page.

    ->Modification => Any modification that occurs is recorded by the person who made this modification

-   Categories =>
    The categories page contains your products categories.
    You can add product category by clicking on the add category button on the categories page.
    You can also edit by clicking on the edit button on the categories page.
    You can delete categories by clicking on the delete button.

# How to add product and sell It

1. First add the category of product.

2. Add medications and specify the type of medication, whether local or imported.
3. Add the mg of each customer and specify the type of mg to determine the type of medicine to purchase.
4. You can start selling the product.

5. Any modification that occurs is recorded by the person who made this modification.

![db](screenshots/db.png?raw=true "sitting page")

![ScreenShot](screenshots/login.png?raw=true "Login page")

![Dashboard](screenshots/dashboard.png?raw=true "Dashbaord page")

![emplyee](screenshots/emplyee.png?raw=true "emplyee page")

![customer](screenshots/customer.png?raw=true "customer page")

![have](screenshots/have.png?raw=true "have page")

![medicine](screenshots/medicine.png?raw=true "medicine page")

![profile-customer](screenshots/profile-customer.png?raw=true "profile-customer page")

![sales](screenshots/sales.png?raw=true "sales page")

![sitting](screenshots/sitting.png?raw=true "sitting page")

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

-   [Simple, fast routing engine](https://laravel.com/docs/routing).
-   [Powerful dependency injection container](https://laravel.com/docs/container).
-   Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
-   Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
-   Database agnostic [schema migrations](https://laravel.com/docs/migrations).
-   [Robust background job processing](https://laravel.com/docs/queues).
-   [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1500 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

# transaction-system-pharmacy-deals

# transaction-system-pharmacy-deals
