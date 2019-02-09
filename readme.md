# test
Simple Blog system which will provide user interface to browse and
explore blog posts. Also it will contains admin dashboard to add, edit, delete, and update
posts and categories.

## Getting Started
These instructions will get you a copy of the project up and running on your local machine for development and testing purposes.

## Prerequisites
Please check the official laravel installation guide for server requirements before you start. [Official Documentation](https://laravel.com/docs/5.4/installation#installation)

## Installation
Use the package manager [composer](https://getcomposer.org/download/) to install Blog.

Clone the repository
```bash
    git clone https://github.com/eslam-mamdouh/Blog.git
```
    Switch to the repo folder
```bash
    cd Blog
```
    Install all the dependencies using composer

```bash
    composer update
```
    Generate a new application key

```bash
    php artisan key:generate
```
Run the database migrations (Set the database connection in .env before migrating)
```bash
    php artisan migrate
```
Start the local development server
```bash
    php artisan serve
```

## License
Open source.
