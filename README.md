
# API CRUD Operations

This project implements CRUD (Create, Read, Update, Delete) operations via an API.

## Features

- **User Registration:** Users can register an account with the system.
- **User Authentication:** Registered users can log in securely.
- **Create User:** Admins or authenticated users can add new users to the system.
- **Read User:** Users can retrieve information about existing users.
- **Update User:** Admins or authenticated users can modify user details.
- **Delete User:** Admins or authenticated users can delete user accounts.
- **Search User:** Users can search for specific users by providing a search string.
- **Upload Image:**  Admins or authenticated users can upload Images.

## Code Style

We maintain a consistent code style following Laravel conventions for this project.


# How to Use?
## Steps
 
In order to develop API endpoints in Laravel , there are certain steps to be followed , for API development we need Migration , Model , Controllers , Routes and Database connection. Steps to create resources are given below:
 
```shell
# Commands :
 
## Create a new Laravel project :
 
Laravel new laravelapi1
 
## Create Migration  :
 
PHP artisan make:migration create_images_table
 
## After creating migration , add all the columns in migration and migrate the table by executing following command:
 
PHP artisan migrate
 
## Create Model:
 
PHP artisan make:model Image
 
After creating function add all the columns in fillable property.
 
## Create Controller:
 
PHP artisan make:controller ImageController
 
```
## Dependencies

- PHP (8.1)
- Laravel (10.10)

## API reference

For detailed information about Laravel's API, including classes, methods, and interfaces, please refer to the [official Laravel API documentation](https://laravel.com/api/8.x/).

## Test API Endpoints:
 
- Use tools like Postman to test API endpoints.
- Test each endpoint with various input data to ensure proper functioning.
