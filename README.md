# GreenBasket – PHP Grocery Store

A simple full-stack grocery shopping website built with **PHP, MySQL, HTML, CSS and JavaScript**.

## Features
- Responsive grocery storefront
- Product categories and product listing
- Shopping cart
- User registration and login
- Checkout and order storage
- Simple admin dashboard
- MySQL database

## Frontend
- HTML5
- CSS3
- JavaScript

## Backend
- PHP
- MySQL / MariaDB

## Prerequisites
- AWS EC2 (Amazon Linux 2023)
- Apache or Nginx
- PHP
- MySQL/MariaDB
- Git
- GitHub
- Domain/subdomain

## Local Setup
1. Copy the project into your web server directory.
2. Create a MySQL database.
3. Import `database/greenbasket.sql`.
4. Update database credentials in `config/database.php`.
5. Open the project in your browser.

## AWS EC2 Deployment

### 1. Launch EC2
Launch an Amazon Linux 2023 EC2 instance and allow:
- SSH – 22
- HTTP – 80
- HTTPS – 443

### 2. Install PHP and Nginx
```bash
sudo dnf update -y
sudo dnf install nginx php php-mysqli php-fpm git -y
sudo systemctl enable --now nginx
sudo systemctl enable --now php-fpm
```

### 3. Clone Project
```bash
cd /usr/share/nginx/html
sudo git clone YOUR_GITHUB_REPOSITORY_URL greenbasket
sudo chown -R nginx:nginx greenbasket
```

### 4. Configure Nginx
Create:
```bash
sudo nano /etc/nginx/conf.d/greenbasket.conf
```

Use:
```nginx
server {
    listen 80;
    server_name your-domain.com www.your-domain.com;

    root /usr/share/nginx/html/greenbasket;
    index index.php index.html;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        include fastcgi_params;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        fastcgi_pass unix:/run/php-fpm/www.sock;
    }
}
```

Test and restart:
```bash
sudo nginx -t
sudo systemctl restart nginx
```

### 5. Database
Install/start MariaDB:
```bash
sudo dnf install mariadb105-server -y
sudo systemctl enable --now mariadb
```

Create/import the database:
```bash
mysql -u root -p < database/greenbasket.sql
```

Update `config/database.php` with your database username/password.

### 6. Domain
Point your domain/subdomain DNS record to the **EC2 public IP**.

Example:
```text
shop.yourdomain.com  →  EC2 Public IP
```

No Elastic IP is required for this project.

## Project Structure
```text
greenbasket/
├── index.php
├── products.php
├── cart.php
├── checkout.php
├── login.php
├── register.php
├── admin/
├── config/
├── includes/
├── assets/
├── database/
└── README.md
```

## Future Improvements
- Online payment gateway
- Product image upload
- Admin product CRUD
- Order status tracking
- HTTPS with SSL
