# Products CRUD

## Installation

Please check the official laravel installation guide for server requirements before you start.
[Official Documentation](https://laravel.com/docs/8.x)

Clone the repository
```
git clone https://github.com/HsuMonLynn/products_categories_relation.git
```
Switch to the repo folder
```
cd products_categories_relation
```
Install all the dependencies using composer
```
composer install
```
Copy the example env file and make the required configuration changes in the .env file
```
cp .env.example .env
```
Run the database migrations (Set the database connection in .env before migrating)
```
php artisan migrate
```
Start the local development server
```
php artisan serve
```
You can now access the server at http://localhost:8000/products

