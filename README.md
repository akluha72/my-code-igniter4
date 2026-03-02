# Warehouse Mini Dashboard (CodeIgniter 4)

A **warehouse management mini-project** built with **CodeIgniter 4**, **MySQL**, and **Bootstrap**, demonstrating basic virtual warehouse operations including:  

- Product management  
- Stock movements (IN/OUT)  
- Low-stock alerts  
- Warehouse summaries  
- Recent stock movements dashboard  

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

## Installation

### Manual Installation (Local)

1. Clone the repository:

```bash
git clone https://github.com/akluha72/my-code-igniter4
cd warehouse-mini-dashboard
```

2. Install PHP dependencies:

```bash
composer install
```

3. Copy the environment file and configure it:

```bash
cp env .env
```

Edit `.env` and set the following values:

```ini
CI_ENVIRONMENT = development

database.default.hostname = 127.0.0.1
database.default.database = ci4
database.default.username = root
database.default.password = root
database.default.DBDriver = MySQLi
database.default.port     = 3306
```

4. Run database migrations and seeders:

```bash
php spark migrate
php spark db:seed DatabaseSeeder
```

5. Start the built-in development server:

```bash
php spark serve
```

The application will be available at `http://localhost:8080`.

---

## Running with Docker

### Prerequisites

- [Docker](https://www.docker.com/get-started) installed
- [Docker Compose](https://docs.docker.com/compose/install/) installed

### Steps

1. Clone the repository (if not already done):

```bash
git clone https://github.com/yourusername/warehouse-mini-dashboard.git
cd warehouse-mini-dashboard
```

2. Copy the environment file:

```bash
cp env .env
```

3. Update `.env` to use the Docker database service:

```ini
CI_ENVIRONMENT = development

database.default.hostname = db
database.default.database = ci4
database.default.username = root
database.default.password = root
database.default.DBDriver = MySQLi
database.default.port     = 3306
```

> **Note:** The hostname must be `db` (the Docker Compose service name), not `127.0.0.1`.

4. Build and start the containers:

```bash
docker-compose up -d --build
```

This will start two containers:

| Container | Service | Exposed Port |
|-----------|---------|--------------|
| `ci4_app` | Apache  | `8080 → 80`  |
| `ci4_db`  | MySQL   | `3307 → 3306`|

5. Run database migrations inside the app container:

```bash
docker exec -it ci4_app php spark migrate
docker exec -it ci4_app php spark db:seed DatabaseSeeder
```

6. Open your browser and visit:

```
http://localhost:8080
```

### Useful Docker Commands

```bash
# Stop containers
docker-compose down

# View logs
docker-compose logs -f

# Restart containers
docker-compose restart

# Access the app container shell
docker exec -it ci4_app bash

# Access MySQL inside the db container
docker exec -it ci4_db mysql -u root -proot ci4
```