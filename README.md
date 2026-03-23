# FreshMart – Phase 3: PHP & Database Integration

An online grocery e-commerce application built with PHP, MySQL, Bootstrap 5, and vanilla JavaScript.

---

## 📁 Project Structure

```
freshmart/
├── index.php                  # Home page
├── products.php               # Products listing with filter
├── categories.php             # Browse by category
├── contact.php                # Contact form (stores to DB)
├── checkout.php               # Checkout (cart → DB order for logged-in users)
├── orders.php                 # My Orders (DB-backed or localStorage guest)
├── order-success.php          # Order confirmation page
├── dashboard.php              # Logged-in user dashboard + stats
├── process_order.php          # AJAX endpoint: save order to DB
├── cancel_order.php           # AJAX endpoint: cancel an order
├── app.js                     # Frontend JS (cart, checkout, orders)
├── style.css                  # All custom styles
├── database.sql               # MySQL dump – import this first
├── README.md                  # This file
│
├── includes/
│   ├── db.php                 # PDO connection (update credentials here)
│   └── functions.php         # isLoggedIn(), renderNav(), CSRF, flash msgs, etc.
│
└── auth/
    ├── register.php           # User registration
    ├── login.php              # User login + session start
    └── logout.php             # Session destroy + redirect
```

---

## ⚙️ Setup Instructions

### 1. Prerequisites
- XAMPP or WAMP installed and running (Apache + MySQL)
- PHP 8.0+ recommended

### 2. Copy project files
Place the entire `freshmart/` folder inside:
- **XAMPP**: `C:/xampp/htdocs/freshmart/`
- **WAMP**: `C:/wamp64/www/freshmart/`

### 3. Import the database

**Option A – phpMyAdmin (recommended)**
1. Open `http://localhost/phpmyadmin`
2. Click **New** → create database named `freshmart_db`
3. Select `freshmart_db` → click **Import** tab
4. Choose `database.sql` → click **Go**

**Option B – Command line**
```bash
mysql -u root -p < database.sql
```

### 4. Configure database credentials

Open `includes/db.php` and update if needed:
```php
define('DB_HOST', 'localhost');
define('DB_NAME', 'freshmart_db');
define('DB_USER', 'root');
define('DB_PASS', '');   // XAMPP default is empty; WAMP may differ
```

### 5. Run the project

Open your browser and navigate to:
```
http://localhost/freshmart/index.php
```

---

## 🔐 Default Login (Demo Account)

| Field    | Value                |
|----------|----------------------|
| Email    | demo@freshmart.lk    |
| Password | Demo@1234            |

> You can register new accounts at `http://localhost/freshmart/auth/register.php`

---

## ✨ Features Implemented

### User Authentication
- **Register** (`auth/register.php`) – username, email, password (bcrypt hashed)
- **Login** (`auth/login.php`) – session-based with `session_regenerate_id()`
- **Logout** (`auth/logout.php`) – destroys session
- Navigation bar dynamically shows Login/Register for guests, or Hi [username] + Logout for logged-in users

### Contact Form
- Stores `name`, `email`, `phone`, `subject`, `message` in `messages` table
- AJAX submission with live success/error feedback – no page reload
- Falls back to normal POST if JS disabled

### Order Management (Database-backed)
- **Checkout** (`checkout.php`) – existing JS validation + AJAX POST to `process_order.php`
- **process_order.php** – inserts into `orders` + `order_items` tables using PDO transactions
- **Orders page** (`orders.php`) – logged-in users see DB orders; guests see localStorage orders
- **Cancel orders** via `cancel_order.php` (AJAX, only owner can cancel)
- **Dashboard** (`dashboard.php`) – order stats (total orders, total spent, active, delivered) + recent 5 orders table

### Security
- Prepared statements (PDO) throughout – SQL injection protected
- CSRF tokens on all POST forms
- `password_hash()` / `password_verify()` for credentials
- `htmlspecialchars()` on all output
- Session regeneration on login

### Guest Compatibility
- Cart always uses `localStorage` (no login required to shop)
- Orders saved to localStorage for guests; saved to DB for logged-in users
- Guest sees friendly notice on Orders page with login prompt

---

## 🗄️ Database Schema

| Table         | Purpose                                 |
|---------------|-----------------------------------------|
| `users`       | Registered user accounts                |
| `messages`    | Contact form submissions                |
| `orders`      | Order headers (delivery, payment, etc.) |
| `order_items` | Line items for each order               |

---

## 🛠️ Technologies Used

- **PHP 8+** – backend logic, sessions, PDO
- **MySQL** – persistent data storage
- **Bootstrap 5.3** – responsive UI framework
- **Vanilla JavaScript** – cart, checkout, AJAX calls
- **Bootstrap Icons** – icon set
- **Google Fonts** – Playfair Display + DM Sans

---

## 📝 Notes

- The project uses **no third-party PHP frameworks** – plain PHP as required by the course
- All `.html` files from Phase 2 have been converted to `.php`
- The existing `app.js` is kept intact with minimal changes (only `.html` → `.php` URL updates)
- `style.css` is **unchanged** from Phase 2
