# Astro Tech Store

## Local Setup Guide

1. Prerequisites
    - PHP >= 8.0
    - Composer
    - XAMPP

2. Start Apache and MySQL services in XAMPP
    - Open the XAMPP control panel.
    - Click Start for Apache and MySQL.

3. Create the database
    - Open your browser and go to http://localhost/phpmyadmin.
    - Click New to create a new database.
    - Enter the database name: workshop1_onlinestore.
    - Click Create.

4. Configure the environment file
    - Open the .env file in the project root.
    - Make sure these values are set correctly:

        DB_CONNECTION=mysql
        DB_HOST=127.0.0.1
        DB_PORT=3306
        DB_DATABASE=workshop1_onlinestore
        DB_USERNAME=root
        DB_PASSWORD=

    - If your MySQL uses a different port, user, or password, update those values.

5. Run migrations
    - Open a terminal in the project root.
    - Run:

        php artisan migrate

6. Start the development server
    - In the same terminal, run:

        php artisan serve

7. Access the application
    - Open your browser and go to http://localhost:8000.
    - You should see the Astro Tech Store homepage.
