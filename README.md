# Astro Tech Store

Astro Tech Store is a full-featured e-commerce web application for technology products built with Laravel 12. It provides a customer-facing storefront with product browsing, filtering, reviews, favorites, shopping cart with discount codes, and a complete admin panel for managing the store. The application supports English and Spanish localization.

## Technology Stack

- **Backend:** Laravel 12 (PHP 8.2+)
- **Frontend:** Bootstrap 5.3, Bootstrap Icons, SCSS
- **Database:** MySQL
- **Authentication:** Laravel Auth with role-based access (client/admin)
- **Code Quality:** Laravel Pint (PSR-12)
- **CI/CD:** GitHub Actions with deployment to GCP

## Prerequisites

- PHP >= 8.2
- Composer
- XAMPP (Apache + MySQL)

## Installation and Setup

### 1. Clone the repository

```bash
git clone <repository-url>
cd astro-tech-store
```

### 2. Start Apache and MySQL services in XAMPP

- Open the XAMPP control panel.
- Click **Start** for **Apache** and **MySQL**.

### 3. Create the database

- Open your browser and go to `http://localhost/phpmyadmin`.
- Click **New** to create a new database.
- Enter the database name: `workshop1_onlinestore`.
- Click **Create**.

### 4. Install dependencies

```bash
composer install
```

### 5. Configure the environment file

Copy the example environment file and generate the application key:

```bash
cp .env.example .env
php artisan key:generate
```

Then open the `.env` file and update the database configuration:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=astro_tech_db
DB_USERNAME=root
DB_PASSWORD=
```

If your MySQL uses a different port, user, or password, update those values accordingly.

### 6. Run migrations and seed the database

```bash
php artisan migrate
```

To populate the database with sample data (10 users, 1 admin, 30 products, reviews, and orders), you have two options:

**Option A: Using the seeder (recommended for development)**

```bash
php artisan db:seed
```

**Option B: Using the SQL file**

Import the SQL file located at `database/astro_tech_db_seed.sql` after running the migrations. You can do this through phpMyAdmin:

1. Open `http://localhost/phpmyadmin`.
2. Select the `astro_tech_db` database.
3. Go to the **Import** tab.
4. Choose the file `astro_tech_db_seed.sql`.
5. Click **Go**.

### 7. Create the storage symlink

```bash
php artisan storage:link
```

This is required for product images to display correctly.

### 8. Start the development server

```bash
php artisan serve
```

## Accessing the Application

The main entry point is `http://localhost:8000`.

| URL | Description |
|-----|-------------|
| `http://localhost:8000` | Home page with product carousel, top sellers, and recent reviews |
| `http://localhost:8000/products` | Product listing with search, price, and rating filters |
| `http://localhost:8000/products/{id}` | Product detail page with reviews |
| `http://localhost:8000/cart` | Shopping cart with discount code support |
| `http://localhost:8000/orders` | Order history (requires login) |
| `http://localhost:8000/admin` | Admin dashboard (requires admin role) |
| `http://localhost:8000/login` | Login page |
| `http://localhost:8000/register` | Registration page |

## Features

### Customer Features

- **Product Browsing:** View all products with pagination and image carousel on the home page.
- **Product Filtering:** Search by name/description, filter by price range, and filter by minimum rating.
- **Favorites:** Mark products as favorites to display them at the top of the product listing.
- **Reviews & Ratings:** Authenticated users can create, edit, and delete product reviews (1-5 stars).
- **Shopping Cart:** Session-based cart to add/remove products before purchasing.
- **Discount Codes:** Apply discount codes at checkout for percentage-based discounts.
- **Order Management:** View order history, order details, and cancel pending orders.
- **Top Sellers:** The 3 most purchased products are highlighted on the home and products pages.
- **Bilingual Support:** Switch between English and Spanish from the navigation bar.

### Admin Panel

- **Dashboard:** Overview with total users, products, orders, reviews, and income.
- **Product Management:** Create, edit, and delete products with image upload and stock control.
- **User Management:** Create, edit, and delete users; assign roles (client/admin) and manage balance.
- **Order Management:** View all orders and update their status (pending/completed/cancelled).
- **Review Management:** View and delete reviews.

