# Rekrutmen Bersama BUMN (RBB) 
# Test Kompetensi Bidang (es Kompetensi Bidang) : Staf IT
# PT-Surveyor
# Simple-Sales-System

Developed as part of the TKB (Tes Kemampuan Bidang) task for the Rekrutmen Bersama BUMN (RBB) 2025, specifically for the Staf IT position at PT Surveyor Indonesia. Built using PHP &amp; MySQL. CRUD and simple dashboard of sales system.

This project was created as a timed prototype within ~2 hours for demonstration purposes.

Further information can be read on : CINDY APRILIA TKB Staf IT_Report & Readme.pdf

## 🎯 Project Purpose
To simulate a real-world application for managing sales operations, including:
- Sales data
- Product catalog
- Client information
- Sales activities
- Daily sales transactions
- Dashboard with data visualization

## 📌 Features

- CRUD operations for Sales, Clients, Products, and Sales Activities
- Multi-product Sales Entry Form
- Real-time Invoice Calculation
- Trigger & Stored Procedures for Data Consistency
- Dashboard with Chart.js Visualization
- Provinces data covering all regions in Indonesia
- No authentication system (planned as future enhancement)

## 🛠️ Tech Stack

- PHP (Native, no framework)
- MySQL / MariaDB
- phpMyAdmin
- Chart.js

## 📂 Project Structure
```
/rbbsurveyor
│
├── db.php # Database connection
├── index.php # Dashboard with charts
├── penjualan.php # Sales entry form
├── produk.php # CRUD for products
├── sales.php # CRUD for sales staff
├── klien.php # CRUD for clients
└── aktivitas_sales.php # CRUD for sales activities
```

## 🚀 Installation

1. Install Apache & MySQL (suggested: XAMPP)
2. Import `rbb2025_pt_surveyor_system_sales.sql` into MySQL
3. Copy project files to your PHP server (e.g., `htdocs/` on XAMPP)
4. Open in browser: `http://localhost/rbbsurveyor/index.php`

## 📌 Future Enhancements

- Add Login & Role-based Access Control
- Input Validation for Public Use
- Use Bootstrap for better UI/UX
- Add deletion audit logs
- Navigation bar for easier access
- Expand dashboard visualizations

## 🗃️ Database Design

<img width="670" alt="ERD" src="https://github.com/user-attachments/assets/63d91074-1ae8-40ff-ab66-826a37686c1d" />


**Entities:**

- `Sales`: `sales_id`, `nama_sales`, `email`, `telepon`
- `Produk`: `produk_id`, `nama_produk`, `kategori`, `harga`
- `Wilayah`: `wilayah_id`, `nama_provinsi`
- `Klien`: `klien_id`, `nama_klien`, `alamat`, `wilayah_id`
- `Aktivitas_Sales`: `aktivitas_id`, `sales_id`, `klien_id`, `tanggal_aktivitas`, `deskripsi`
- `Penjualan`: `penjualan_id`, `produk_id`, `sales_id`, `klien_id`, `tanggal`, `jumlah`, `total_harga`, `notes`

**Relationships:**

- 1 Sales → Many Penjualan, Aktivitas_Sales
- 1 Produk → Many Penjualan
- 1 Klien → Many Aktivitas, Penjualan
- 1 Wilayah → Many Klien

## 🧾 SQL

### ⚙️ Function: `TotalPenjualanSales(sales_id)`
Returns total sales of the day for a given `sales_id`.

### ⚙️ Procedure: `TambahPenjualan(...)`
Adds new sales records and calculates totals if applicable.

### ⚙️ Trigger: `HitungTotalHarga`
Automatically calculates `total_harga` if `notes` is not NULL.

## 🧮 Dashboard & Forms

- CRUD Forms for Products, Sales, Clients, Activities
- Dynamic multi-product entry for sales
- Real-time auto-calculation of total prices
- Dashboard (index.php) uses Chart.js for:
  - Daily Sales
  - Top 5 Best-selling Products
  - Other future dashboards





