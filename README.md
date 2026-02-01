Inventory and Stock Management System
Login Credentials

- Username: kashif
-  Password: kashif123

Setup Instructions

1. Import `inventory.sql` into your MySQL database.
2. Update `config/db.php` with your database credentials.
3. Open project in your browser via localhost.
4. Access pages:
   - Welcome page: `welcome.php`
   - Login page: `login.php`
   - Dashboard: `dashboard.php`
   - Product management: `index.php`, `add.php`, `edit.php`, `delete.php`

Features Implemented

- User authentication (register/login/logout)
- CSRF protection
- Product CRUD (Create, Read, Update, Delete)
- Supplier management
- Dashboard with statistics:
  - Total products
  - Total suppliers
  - Low stock alerts
  - Recently added products
- Ajax live search for products
- User-specific inventory (each user sees only their own products)
- Client-side and server-side form validation
- Clean, responsive UI

Known Issues
- Password complexity is minimal (only 8 characters + number)
- No email verification
- No PWA or offline functionality
