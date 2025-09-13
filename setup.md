Key features

Admin: manage employees, products, view all customers & purchases.

Employee: manage own customers, create purchases.

Phone-based auth, secure password hashing, RBAC middleware, full CRUD.

Quick setup

create db name = employee_management

Prereqs: PHP ≥8.2, Composer, MySQL, XAMPP (local).
Commands:

git clone repo
cd employee-management-system
composer install
cp .env.example .env        # update DB_ settings
php artisan key:generate
php artisan migrate
php artisan serve

DB (core tables)

user_master (admins/employees)

customer_master (customers, linked to employee)

product_master

purchase_master (links customers & products)

Usage (brief)

Register first account → Admin.

Admin creates employees & products.

Employees login to manage their customers and purchases. Admin can view everything.