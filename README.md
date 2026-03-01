# Warehouse Mini Dashboard (CodeIgniter 4)

A simple **warehouse management mini-project** built with **CodeIgniter 4**, **MySQL**, and **Bootstrap**, demonstrating basic virtual warehouse operations including:  

- Product management  
- Stock movements (IN/OUT)  
- Low-stock alerts  
- Warehouse summaries  
- Recent stock movements dashboard  

This project is a **mini MVP** suitable for demonstrating your interest and skills in logistics software, ideal for interview purposes.  

---

## Tech Stack

- **Framework:** CodeIgniter 4 (v4.7.0)  
- **Database:** MySQL / MariaDB  
- **Frontend:** Bootstrap 5  
- **PHP:** 8.x  

---

## Features

1. **Products CRUD** – manage warehouse products and quantities  
2. **Stock Movements** – track inventory IN/OUT movements  
3. **Automatic Quantity Updates** – product quantity updates based on stock movements  
4. **Low-Stock Alerts** – highlights products with quantity below threshold  
5. **Warehouse Summary** – shows total products and quantity per warehouse  
6. **Recent Movements** – table of the latest stock movements with IN/OUT badges  
7. **Dashboard Layout** – Bootstrap cards for visual overview  

---

## Database Structure

### Tables

**products**
| Field        | Type        | Notes |
|--------------|------------|------|
| id           | INT        | Primary key, auto-increment |
| name         | VARCHAR    | Product name |
| quantity     | INT        | Current stock quantity |
| warehouse_id | INT        | Foreign key to warehouses table |
| created_at   | DATETIME   | CI4 timestamp |
| updated_at   | DATETIME   | CI4 timestamp |

**stock_movements**
| Field      | Type      | Notes |
|------------|-----------|------|
| id         | INT       | Primary key, auto-increment |
| product_id | INT       | Foreign key to products |
| type       | ENUM      | IN / OUT |
| quantity   | INT       | Movement quantity |
| created_at | DATETIME  | CI4 timestamp |
| updated    | DATETIME  | Optional updated timestamp |

**warehouses**
| Field      | Type      | Notes |
|------------|-----------|------|
| id         | INT       | Primary key |
| name       | VARCHAR   | Warehouse name |

---

## Installation

1. Clone the repository:

```bash
git clone https://github.com/yourusername/warehouse-mini-dashboard.git
cd warehouse-mini-dashboard