# Employee Management System

A Laravel 12 application for managing employees, customers, products, and purchases with role-based access control.

## Features

- **Admin Role**: Can register, manage employees, view all customers, manage products, and view all purchases
- **Employee Role**: Can manage their own customers and create purchases for their customers
- **Authentication**: Phone-based login system with secure password hashing
- **Role-based Access Control**: Middleware protection for different user roles
- **CRUD Operations**: Full Create, Read, Update, Delete functionality for all entities

## Database Schema

### Tables
- `user_master`: Stores admin and employee accounts
- `customer_master`: Stores customer information with employee association
- `product_master`: Stores product information
- `purchase_master`: Stores purchase records linking customers and products

## Setup Instructions

### Prerequisites
- PHP 8.2 or higher
- Composer
- MySQL/MariaDB
- XAMPP (for local development)

### Installation

1. **Clone/Download the project**
   ```bash
   cd employee-management-system
   ```

2. **Install dependencies**
   ```bash
   composer install
   ```

3. **Configure environment**
   - Copy `.env.example` to `.env`
   - Update database configuration in `.env`:
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=employee_management
   DB_USERNAME=root
   DB_PASSWORD=
   ```

4. **Create database**
   - Start XAMPP
   - Open phpMyAdmin
   - Create database named `employee_management`

5. **Generate application key**
   ```bash
   php artisan key:generate
   ```

6. **Run migrations**
   ```bash
   php artisan migrate
   ```

7. **Start the development server**
   ```bash
   php artisan serve
   ```

## Getting Started

1. **Admin Registration**: First, register an account at `/register` (automatically becomes Admin)
2. **Admin Login**: Use your registered credentials to login
3. **Create Employees**: Admin can then create employee accounts
4. **Employee Login**: Employees can login and start managing customers

## Usage Flow

### 1. Admin Registration/Login
- **First Step**: Register an account at `/register` (automatically becomes Admin)
- Admin can then login and access admin dashboard

### 2. Employee Management
- Admin can create new employees
- Admin can edit/delete employee accounts
- Employees are created with role "Employee"

### 3. Employee Login
- Employees login with their phone and password
- Employees access employee dashboard

### 4. Customer Management
- Employees can create customers (linked to the employee)
- Employees can edit/delete their own customers
- Admin can view all customers

### 5. Product Management
- Admin can create/edit/delete products
- Employees can view products when creating purchases

### 6. Purchase Management
- Employees can create purchases for their customers
- Employees can edit/delete their own purchases
- Admin can view all purchases

## File Structure

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── AdminController.php
│   │   ├── AuthController.php
│   │   ├── EmployeeController.php
│   │   └── ...
│   └── Middleware/
│       └── RoleMiddleware.php
├── Models/
│   ├── UserMaster.php
│   ├── CustomerMaster.php
│   ├── ProductMaster.php
│   └── PurchaseMaster.php
resources/
└── views/
    ├── auth/
    ├── admin/
    ├── employee/
    └── layouts/
```

## Security Features

- Password hashing using Laravel's Hash facade
- Role-based middleware protection
- CSRF protection on all forms
- Input validation and sanitization
- Soft delete for customers (is_deleted flag)

## Technologies Used

- Laravel 12
- PHP 8.2+
- MySQL
- Bootstrap-inspired CSS (custom styling)
- Blade templating engine

## API Endpoints

### Authentication
- `GET /login` - Login form
- `POST /login` - Process login
- `GET /register` - Registration form
- `POST /register` - Process registration
- `POST /logout` - Logout

### Admin Routes (protected by role:Admin)
- `GET /admin/dashboard` - Admin dashboard
- `GET /admin/employees` - Employee management
- `POST /admin/employees` - Create employee
- `GET /admin/customers` - View all customers
- `GET /admin/products` - Product management
- `GET /admin/purchases` - View all purchases

### Employee Routes (protected by role:Employee)
- `GET /employee/dashboard` - Employee dashboard
- `GET /employee/customers` - Manage own customers
- `GET /employee/purchases` - Manage own purchases

## Troubleshooting

### Common Issues

1. **Database Connection Error**
   - Ensure MySQL is running in XAMPP
   - Check database credentials in `.env`
   - Verify database exists

2. **Permission Denied**
   - Check file permissions on storage and bootstrap/cache directories
   - Run: `chmod -R 775 storage bootstrap/cache`

3. **Class Not Found**
   - Run: `composer dump-autoload`

4. **Migration Errors**
   - Ensure database is empty or drop existing tables
   - Run: `php artisan migrate:fresh --seed`

## Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Test thoroughly
5. Submit a pull request

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).