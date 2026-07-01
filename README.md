
---

# 📦 Inventory Management System (IMS)

**Developed by [TechLink360](https://techlink360.net)**

A powerful and modern **Inventory Management System** built using **Laravel 11**, **Livewire 3**, and **AdminLTE**, designed for electronics shops that sell phones, accessories, and spare parts.

This system provides full transparency and efficiency for inventory tracking, sales, expenses, reporting, POS operations, and organizational settings.

---

## 🚀 Features

### ✅ Core Inventory Functions

* Product Management
* Category Management
* Supplier Management
* Purchase Records
* Sales & POS System
* Customer Records
* Return Handling
* Expense Management

---

### 📊 Dashboard

The main dashboard gives a complete business overview:

* Total Sales Today
* Current Stock Levels
* Profit Today
* Low Stock Alerts
* Best-Selling Products
* Recent Transactions
* Sales Chart (7 days)
* Expense Summary

---

### ⚙️ Settings Module

The system includes a **Setup Page** where the owner configures the application:

* System Organization Name
* Contact Numbers
* Logo Upload
* Shop Name, Email, Phone, Address
* **Markup Percentage** (auto price calculation)
* **Tax Percentage**
* Enable/Disable POS
* Allow/Disallow Negative Stock

Settings are stored in a dedicated database table:

```sql
settings: {
    id,
    system_organization_name,
    system_phone_1,
    system_phone_2,
    system_phone_3,
    logo,
    shop_name,
    shop_email,
    shop_phone,
    shop_address,
    markup_percentage,
    tax_percentage,
    pos_enabled,
    allow_negative_stock,
    timestamps
}
```

---

## 🧑‍💼 User Roles & Permissions

The system uses **role-based access control**:

| Role       | Access Level                     |
| ---------- | -------------------------------- |
| **system** | Full system access (super admin) |
| **owner**  | Full business management access  |
| **seller** | POS & basic sales operations     |

Middleware is used to restrict routes based on roles.

---

## 🧩 Tech Stack

* **Laravel 11**
* **Livewire 3**
* **AdminLTE (Bootstrap 5)**
* **MySQL**
* **Alpine.js**
* **Chart.js**
* **Jetstream Authentication**

---

<!-- ## 🗂️ Livewire Component Structure

```
app/Livewire/
│
├── Dashboard/
│   └── DashboardLivewire.php
│
├── Users/
│   └── LivewireUsers.php
│
├── Products/
│   └── ProductLivewire.php
│
├── Categories/
│   └── CategoriesLivewire.php
│
├── Suppliers/
│   └── SupplierLivewire.php
│
├── Purchases/
│   └── PurchaseLivewire.php
│
├── Sales/
│   └── SaleLivewire.php
│
├── Customers/
│   └── CustomerLivewire.php
│
├── Returns/
│   └── ReturnLivewire.php
│
├── Expenses/
│   └── ExpenseLivewire.php
│
├── Reports/
│   ├── ReportSalesLivewire.php
│   ├── ReportProfitLivewire.php
│   └── ReportStockLivewire.php
│
└── Setup/
    └── UserSetupLivewire.php
```

--- -->

## 🛠️ Installation

### 1️⃣ Clone the Project

```bash
git clone https://github.com/your-repo/ims.git
cd ims
```

### 2️⃣ Install Dependencies

```bash
composer install
npm install
npm run build
```

### 3️⃣ Setup Environment

```bash
cp .env.example .env
php artisan key:generate
```

Update `.env`:

```
DB_DATABASE=ims
DB_USERNAME=root
DB_PASSWORD=
```

### 4️⃣ Run Migrations & Seed Initial Users

```bash
php artisan migrate --seed
```

Seeder creates these users:

| Name          | Email                     | Password | Role   |
| ------------- | ------------------------- | -------- | ------ |
| =====         | [b@b.com](mailto:---.com) |          | owner  |
| =====        | [c@c.com](mailto:---.com) |          | seller |

### 5️⃣ Start the Server

```bash
php artisan serve
```

Visit:
**[http://localhost:8000](http://localhost:8000)**

---

## 🧪 POS System

Includes:

* Fast product lookup
* Automatic tax and markup
* Receipt printing
* Customer tracking
<!-- * Optional negative stock mode -->

---

## ⚡ Setup Page (Installer)

When the system first runs:

* Checks database availability
* Checks if an **owner** exists
* If not, redirects to **Setup Page**
* User enters system details and creates first owner

Includes loading screen animation.

---

## 🤝 Contributing

Pull requests are welcome!
For major changes, please open an issue first.

---

## 📄 License

This project is proprietary software belonging to **TechLink360**.

---

## ⚙️ Advanced Setup & Maintenance

### Database Manager Settings
The Database Manager is accessible via `/database/manager` or the Help menu:
* **Backup Management**: Back up SQLite database files dynamically with automated timestamps.
* **Restore Backups**: Perform atomic restoration of previous snapshots safely.
* **Custom Connections**: Enter any absolute system path to an SQLite database file to disconnect from the active database and reconnect to your custom path. The system updates the local `.env` configuration file automatically.

---

## 🏢 Developed By

# **TechLink360**

🌐 [https://techlink360.net](https://techlink360.net)
📧 [info@techlink360.net](mailto:info@techlink360.net)
📍 Malawi
