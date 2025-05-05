# Post Management

A minimal Laravel project for managing posts.

## Description
This project is a **post-ms** built with **Laravel 12**. It allows users to perform **CRUD operations** (Create, Read, Update, Delete) on Posts with the ability to search them by **post title**.

### Key Features:
- **CRUD Operations**: Create, read, update, and delete posts.
- **Filtering**: Filter posts by title.
- **Form Requests**: Validation is handled by custom form request classes.
- **API Response Service**: Unified responses for API endpoints.
- **Pagination**: Results are paginated for better performance and usability.
- **Resources**: API responses are formatted using Laravel resources for a consistent structure.

### Technologies Used:
- **Laravel 12**
- **PHP**
- **MySQL**
- **XAMPP** (for local development environment)
- **Composer** (PHP dependency manager)
- **Postman Collection**: Contains all API requests for easy testing and interaction with the API.

## Installation

### Prerequisites

Ensure you have the following installed on your machine:
- **XAMPP**: For running MySQL and Apache servers locally.
- **Composer**: For PHP dependency management.
- **PHP**: Required for running Laravel.
- **MySQL**: Database for the project
- **Postman**: Required for testing the requestes.

### Steps to Run the Project

1. Clone the repository:
   ```bash
   git clone https://github.com/BsHeR4/post-management
   cd post-management
   ```

2. Navigate to the Project Directory
   ```bash
   cd post-management
   ```


3. Install dependencies:
   ```bash
   composer install
   ```

4. Set up your environment file:
   ```bash
   cp .env.example .env
   ```

5. Generate Application Key
   ```bash
   php artisan key:generate
   ```

6. Run the migrations:
   ```bash
   php artisan migrate
   ```

7. Run the Application:
   ```bash
   php artisan serve
   ```
8. Interact with the API and test the various endpoints via Postman collection.
   Get the collection from [here](https://documenter.getpostman.com/view/33882685/2sB2j6AB83)

