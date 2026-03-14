# Property Management System (Laravel)

## Overview

This project is a **Property Management System** built using Laravel.
It allows users to manage property records with authentication and role-based access control. The application follows a clean structure and demonstrates backend development practices such as CRUD operations, validation, and structured architecture.

## Tech Stack

* PHP 8.2
* Laravel 12
* PostgreSQL
* Blade (Laravel templating)
* Bootstrap / CSS

## Features

* User authentication (Login / Register)
* Role-based access control
* Property CRUD operations (Create, Read, Update, Delete)
* Form validation
* Clean UI using Blade templates
* Organized and maintainable project structure


## Architecture
The project follows Repository Pattern to maintain separation of concerns and keep the code clean and scalable.

Controller
↓
Repository Interface
↓
Repository Implementation
↓
Model / Database

Additionally, the application maintains separation of concerns through structured controllers, models, and views.
## Modules

### Authentication
    Secure user authentication using Laravel's built-in authentication system.
### Setup Instructions

1. Clone the repository
2. Install dependencies
3. Configure .env file
4. Run database migrations
5. Start the development server

## Modules

### 1. Authentication
Users can register and login securely using Laravel authentication.

### 2. Property Management
Users can perform CRUD operations on property records including:
* Add new property
* View property list
* Edit property details
* Delete property

### 3. Role-Based Access

Role-based permission is implemented to control access to certain features.

## Setup Instructions
1. Clone the repository
2. Install dependencies
3. Configure environment file
4. Run migrations
5. Start the development server

Example commands:

composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve

## Author
Prathamesh Chavan
