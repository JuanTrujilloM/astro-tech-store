# Project Rules

The following programming rules define the development practices that must be followed during the implementation of the project. These rules are based on clean code principles and Laravel best practices to maintain a well-structured, maintainable, and scalable system.

If a team member pushes code that does not follow these rules, the code must be corrected according to the guidelines defined in this documentation.

---

# 1. Controllers

Controllers must act as intermediaries between the application's logic and the views.

Rules:

- Controllers must not contain presentation logic.
- Controllers must not generate HTML output.
- Never use `echo`, `print`, or similar output functions inside controllers.
- Controllers must receive the request, coordinate the necessary operations, and return a response.
- Controllers must pass data to views using associative arrays.

Example:

```php
return view('products.index')->with('viewData', $viewData);
```

---

# 2. Models

Models represent the domain entities and manage the interaction with the database.

Rules:

- Models must contain the data logic related to the entity.
- Access to model attributes should be handled through getter and setter methods whenever necessary.
- Database operations should be performed through Eloquent.
- Models should not contain presentation logic.
- Model attributes must be documented in comments at the beginning of the model to clearly describe the structure of the entity and the type of each attribute.

Example:

```php
/**
 * REVIEW ATTRIBUTES
 * $this->attributes['id'] - int - contains the review primary key (id)
 * $this->attributes['description'] - string - contains the description of the review
 * $this->attributes['rating'] - int - contains the rating of the review
 */
```

- Form and request validations must be implemented using Laravel Form Request classes located in:

```
app/Http/Requests
```

Example of validation rules inside a Form Request:

```php
public function rules(): array
{
    return [
        'description' => 'required|string',
        'rating' => 'required|integer|min:0|max:5',
    ];
}
```

---

# 3. Views

Views are responsible only for presenting information to the user.

Rules:

- All views must be written using Laravel Blade.
- All views must extend the main layout `app`.
- Views must not contain raw PHP code.
- Never open and close PHP tags (`<?php ?>`) inside views.
- Business logic must never be placed in views.
- Only simple display logic should be handled in Blade.

Example:

```blade
@extends('layouts.app')

@section('content')
<h1>Welcome to the application</h1>
@endsection
```

---

# 4. Routes

Routes define how requests are directed within the application.

Rules:

- Every route must be associated with a controller.
- Routes must not contain business logic.
- Routes should only define the endpoint and delegate the request to a controller method.

- Routes must always reference controllers using the full controller path in the following format:

Example:

```php
Route::get('/contact', 'App\Http\Controllers\HomeController@contact')->name('home.contact');
```

This format ensures that all routes explicitly define the controller responsible for handling the request.

---

## Resource Controllers

When implementing CRUD operations, resource controllers should be used whenever possible. Laravel provides a standardized structure for these controllers.

The following table describes the typical actions handled by a resource controller.

Verb | URL | Controller method | Route name | Description
--- | --- | --- | --- | ---
GET | /tasks | index() | tasks.index | Show all tasks
GET | /tasks/create | create() | tasks.create | Show the create task form
POST | /tasks | store() | tasks.store | Accept form submission from the create task form
GET | /tasks/{task} | show() | tasks.show | Show one task
GET | /tasks/{task}/edit | edit() | tasks.edit | Show the edit task form
PUT/PATCH | /tasks/{task} | update() | tasks.update | Accept form submission from the edit task form
DELETE | /tasks/{task} | destroy() | tasks.destroy | Delete one task

---

# 5. Database and Migrations

The database structure must be managed using Laravel tools.

Rules:

- The database must never be modified manually.
- All structural changes must be implemented using migrations.
- Migrations must be version controlled within the repository.
- Each change to the database schema must have a corresponding migration file.

## Creating a Migration

To create a migration, use the following Artisan command:

```bash
php artisan make:migration create_reviews_table
```

This command will generate a migration file inside:

```
database/migrations
```

Inside the migration file, the structure of the table is defined using Laravel's Schema Builder.

Example:

```php
Schema::create('reviews', function (Blueprint $table) {
    $table->id();
    $table->text('description');
    $table->integer('rating');
    $table->timestamps();
});
```

## Running Migrations

To apply the migrations and update the database structure, run:

```bash
php artisan migrate
```

This command executes all pending migrations and updates the database schema accordingly.

---

# 6. Code Formatting

To maintain consistency in the codebase, formatting tools must be used.

Rules:

- Code must follow the project's style guide.
- Laravel Pint must be used to enforce coding standards.
- Developers should format their code before committing changes.

---

# 7. Project Documentation

The project must maintain clear documentation describing the architecture and development rules.

Rules:

- The team must maintain updated documentation in the project Wiki.
- Programming rules and style guidelines must be followed by all team members.
- Any code that does not follow the documented rules must be corrected before being merged into the main branches.

---

# Style Guide

This guide defines the formatting and style rules that must be followed during the development of the project. The goal is to maintain clean, consistent, and maintainable code across the entire team.

---

## 1. Formatting Tools

### Blade Templates Formatting

To maintain consistent formatting for Laravel Blade templates (`.blade.php`), install the following VS Code extension:

- shufo.vscode-blade-formatter – Automatically formats Blade files to improve readability and maintain consistency.

> After installing, VS Code will format Blade files on save if you have `Format On Save` enabled.

---

### Laravel Pint

The project will use Laravel Pint to automatically apply the recommended style conventions for Laravel and PHP projects.

Laravel Pint is based on PHP-CS-Fixer and mainly follows the PSR-12 standard.

#### Running Pint

To format the code, run:

```bash
./vendor/bin/pint
```

This will automatically fix style issues in PHP files.

#### Recommendation

Before making a commit, it is recommended to run Pint to ensure that the code follows the project style.

---

### Prettier – Code Formatter

All team members must install the Prettier – Code Formatter extension in Visual Studio Code.

Prettier will be used to maintain consistent formatting for:

- HTML
- JavaScript
- CSS

But in our project we only will use prettier to format CSS.

---

## 2. Naming Conventions

To maintain consistency in the code, the following rules must be followed.

### Classes

Use PascalCase

Example:

```
ProductController
OrderService
UserController
```

### Methods and Functions

Use camelCase

Example:

```
getProducts()
calculateTotal()
generateInvoice()
```

### Variables

Use camelCase

Example:

```
$totalPrice
$userName
$productList
```

### Constants

Use UPPER_CASE

Example:

```
DB_CONNECTION
DB_HOST
```

---

## 3. Code Organization

Laravel conventions must be respected.

### Controllers

Location

```
app/Http/Controllers
```

### Models

Location

```
app/Models
```

### Views

Location

```
resources/views
```

Rules

- Use Blade
- Avoid complex logic inside views
- Use layouts to reuse structure

---

## 4. Comments and Documentation

Each file must include an initial comment with the author of the code.

Example:

```php
/**
 * Author: Student Name
 * Description: Controller responsible for managing products
 */
```

It is also recommended to document:

- important functions
- complex logic
- design decisions

---

## 5. Indentation Rules

The project follows these indentation rules:

- 4 spaces per indentation level
- Spaces instead of tabs
- Consistent alignment of blocks

Example:

```php
public function about()
{
    return view('home.about');
}
```

---

## 6. Import Rules (Use Statements)

All PHP imports should be declared at the top of the file using `use`.

Example:

```php
use App\Models\Product;
use App\Services\OrderService;
use Illuminate\Http\Request;
```

Rules:

- Avoid unnecessary imports
- Group imports logically
- Do not use fully qualified class names inside the code if imports are defined

---

## 7. Development Principles

During development the following principles should be applied.

### DRY (Don't Repeat Yourself)

Avoid duplicating code.
If a functionality is repeated, it should be reused through functions or classes.

### ETC (Easier To Change)

Code should be written in a way that makes it easy to modify in the future.

### Dependency Inversion

High-level modules should not depend directly on low-level modules.
Instead, both should depend on abstractions (e.g., interfaces).

---

## 8. Commit Best Practices

Commits should clearly describe the changes made so that anyone reading the history can understand what was done and why.

### Recommended Commit Types

- feat: A new feature
- fix: A bug fix
- docs: Documentation changes

### Examples

```
feat: add product search functionality to the catalog page
fix: prevent empty orders in OrderController validation logic
docs: update README with new installation instructions
feat: implement pagination in the product listing page
fix: correct calculation of total price in OrderService
docs: add code style guidelines for controllers and models
```

---

# Branching Strategy

The project follows a branching strategy based on two main branches and feature branches.

---

## Main Branches

### main

The `main` branch contains the stable version of the project.

Rules for this branch:

- The branch must not be modified directly.
- Direct commits to `main` are not allowed.
- A rule set has been created in the repository to protect this branch.
- Changes can only be integrated through a Pull Request.

The `main` branch is used for:

- Stable versions of the system
- Project deliveries
- Official releases

---

### develop

The `develop` branch is the main integration branch where new features are combined.

Characteristics of this branch:

- Developers merge their completed features into `develop`.
- It contains the most recent version of the system under development.
- It is used to test and integrate multiple features before releasing a new version.

---

## Feature Branches

All new implementations must be developed in feature branches.

Feature branches are created from the `develop` branch.

Naming convention:

```
feature/feature-name
```

Examples:

```
feature/product-crud
feature/user-authentication
feature/shopping-cart
feature/order-history
```

---

## Development Workflow

The development process follows these steps:

1. Create a new branch from `develop`.

```bash
git checkout develop
git checkout -b feature/feature-name
```

2. Implement the new feature in the feature branch.

3. Commit changes following the commit guidelines defined in the project.

4. Push the branch to the remote repository.

```bash
git push origin feature/feature-name
```

5. Create a Pull Request to merge the feature branch into `develop`.

6. After review and testing, the feature is merged into `develop`.

---

## Release Process

When the team decides to create a stable version or make a project delivery:

1. A Pull Request is created from `develop` to `main`.
2. The changes are reviewed.
3. Once approved, `develop` is merged into `main`.
