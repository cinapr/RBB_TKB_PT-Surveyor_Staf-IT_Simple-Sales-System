# Rekrutmen Bersama BUMN (RBB) | Test Kompetensi Bidang (TKB) : Staf IT | PT-Surveyor
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

## 📌 Key Features

- CRUD operations for Sales, Clients, Products, and Sales Activities
- Multi-product Sales Entry Form
- Real-time Invoice Calculation
- Trigger & Stored Procedures for Data Consistency
- The possibility transaction adjustment for discount and negotiation with accountable record
- Provinces data covering all regions in Indonesia
- Dashboard (index.php) uses Chart.js for:
  - Daily Sales
  - Top 5 Best-selling Products
  - Other future dashboards
- Focus on Data Integrity & Accountability
- Incorporates planning for secure data handling : audit logs and authorization mechanisms for data modifications
- Solid & well-documented architecture for scalable & maintainability


## 📌 Future Enhancements

- authentication system : Add Login & Role-based Access Control
- Input Validation for Public Use
- Use Bootstrap for better UI/UX
- Add deletion audit logs
- Navigation bar for easier access
- Expand dashboard visualizations

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

## 🗃️ Database Design

<img width="670" alt="ERD" src="https://github.com/user-attachments/assets/63d91074-1ae8-40ff-ab66-826a37686c1d" />


### **Entities:**

- `Sales`: `sales_id`, `nama_sales`, `email`, `telepon`
- `Produk`: `produk_id`, `nama_produk`, `kategori`, `harga`
- `Wilayah`: `wilayah_id`, `nama_provinsi`
- `Klien`: `klien_id`, `nama_klien`, `alamat`, `wilayah_id`
- `Aktivitas_Sales`: `aktivitas_id`, `sales_id`, `klien_id`, `tanggal_aktivitas`, `deskripsi`
- `Penjualan`: `penjualan_id`, `produk_id`, `sales_id`, `klien_id`, `tanggal`, `jumlah`, `total_harga`, `notes`

### **Relationships:**

- 1 Sales → Many Penjualan, Aktivitas_Sales
- 1 Produk → Many Penjualan
- 1 Klien → Many Aktivitas, Penjualan
- 1 Wilayah → Many Klien

### 🧾 SQL Query

#### ⚙️ Function: `TotalPenjualanSales(sales_id)`
Returns total sales of the day for a given `sales_id`.

#### ⚙️ Procedure: `TambahPenjualan(...)`
Adds new sales records and calculates totals if applicable.

#### ⚙️ Trigger: `HitungTotalHarga`
Automatically calculates `total_harga` if `notes` is not NULL.


## Functional Overview
This Sales Application is designed to streamline sales data management for PT XYZ, focusing on robust backend operations and clear data insights. Developed as a technical assessment, it showcases core competencies in database design, SQL programming, and basic web application development.

1. Comprehensive Sales Data Management: Manages essential sales entities including:
- Sales Representatives (sales)
- Products (produk)
- Clients (klien) linked to geographical regions (wilayah)
- Sales Activities (aktivitas_sales)
- Daily Sales Transactions (penjualan)

2. Focus on Data Integrity & Accountability: Incorporates planning for secure data handling, including explicit considerations for audit logs and authorization mechanisms for data modifications, emphasizing accountability over destructive operations like DROP/TRUNCATE.

3. Scalable & Maintainable Foundation: The project's architecture provides a solid, well-commented foundation for future enhancements, including UI/UX improvements (e.g., integration with Bootstrap) and expansion of analytical dashboards.

4. Advanced SQL Programming: Demonstrates proficiency in Data Manipulation Language (DML) for data operations, alongside custom SQL constructs:

5. Robust Database Design (ERD & DDL): Implements a well-structured relational database schema, clearly defined with an Entity-Relationship Diagram (ERD) and Data Definition Language (DDL) scripts for tables, primary keys, and foreign key relationships.

6. Core Technology Stack: Built using PHP (Native) for backend logic and frontend rendering, MySQL/MariaDB for robust data storage, and Chart.js for data visualization.

7. Dynamic Multi-Product Sales Entry: Features a user-friendly form (```penjualan.php```) allowing sales representatives to input multiple products for a single transaction in a dynamic table format, with automatic price and total calculations.

8. Functions: Example ```TotalPenjualanSales``` for real-time sales performance tracking.

9. Procedures: ```TambahPenjualan``` for automated and conditional sales invoice processing.

10. Triggers: ```HitungTotalHarga``` to ensure data integrity and automate calculations based on specific business rules (e.g., handling discounts).

11. Basic Data Visualization Dashboard: Provides an initial dashboard (index.php) with charts (powered by Chart.js) to visualize key sales metrics, such as daily sales per salesperson and total sales per product, laying the groundwork for deeper analytical insights.





