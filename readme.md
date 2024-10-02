# PHP Native Project

## Prerequisites

1. **PHP**: Ensure PHP is installed on your system.
2. **Composer**: Make sure Composer is installed.
3. **XAMPP**: Install XAMPP for managing the local database server.

## Installation and Setup

Follow these steps to set up the project:

1. **Clone the Repository**

   ```bash
   git clone https://github.com/stefanuspet/phpnative.git
   cd phpnative

   ```

2. **Install Dependencies**

   Install the required PHP dependencies using Composer:

   ```bash
   composer install
   ```

3. **Set Up Environment**

   Copy the example environment file to create your own .env file:

   ```bash
   cp .env.example .env
   ```

4. **Create the Database**

- Open XAMPP Control Panel.
- Start the MySQL service.
- Open phpMyAdmin (http://localhost/phpmyadmin).
- Create a new database for the project.

5. **Run Migration**

   Run the database migrations to set up the database schema:

   ```bash
   composer migrate
   ```

6. **Seed the Database**

   Populate the database with initial data:

   ```bash
   composer seed
   ```

7. **Start the Development Server**

   Start the PHP built-in server to run the application:

   ```bash
   composer start
   ```

   The application will be accessible at http://localhost:8000 (or another port if configured differently).

## Notes

- Ensure that XAMPP is running and the MySQL service is active before performing database operations.
- Make sure to adjust the .env file to match your local database settings.
