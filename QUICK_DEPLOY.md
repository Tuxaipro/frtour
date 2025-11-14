# Quick Deployment Guide

This is a condensed version of the full deployment guide. For detailed instructions, see [DEPLOYMENT.md](./DEPLOYMENT.md).

## Prerequisites

- Server with Ubuntu 20.04+ / Debian 11+ / CentOS 8+
- Root or sudo access
- Domain name pointing to server IP
- SSH access configured

## Quick Start (5 Minutes)

### 1. Server Setup

```bash
# Update system
sudo apt update && sudo apt upgrade -y

# Install PHP 8.2 and extensions
sudo apt install -y php8.2 php8.2-fpm php8.2-cli php8.2-mbstring \
    php8.2-xml php8.2-curl php8.2-zip php8.2-gd php8.2-pgsql \
    php8.2-bcmath php8.2-tokenizer php8.2-fileinfo php8.2-opcache

# Install Composer
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer

# Install Node.js 20
curl -fsSL https://deb.nodesource.com/setup_20.x | sudo -E bash -
sudo apt install -y nodejs

# Install PostgreSQL
sudo apt install -y postgresql postgresql-contrib

# Install Nginx
sudo apt install -y nginx
```

### 2. Database Setup

```bash
# Create database
sudo -u postgres psql
CREATE DATABASE travel_cms;
CREATE USER travel_user WITH ENCRYPTED PASSWORD 'your_password';
GRANT ALL PRIVILEGES ON DATABASE travel_cms TO travel_user;
\q
```

### 3. Deploy Application

```bash
# Create directory
sudo mkdir -p /var/www/travel-cms
sudo chown -R $USER:$USER /var/www/travel-cms
cd /var/www/travel-cms

# Clone repository
git clone <your-repo-url> .

# Install dependencies
composer install --optimize-autoloader --no-dev
npm install && npm run build

# Setup environment
cp .env.example .env
php artisan key:generate
nano .env  # Configure database and app settings

# Run migrations
php artisan migrate --force

# Set permissions
sudo chown -R www-data:www-data /var/www/travel-cms
sudo chmod -R 775 storage bootstrap/cache
php artisan storage:link

# Optimize
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize
```

### 4. Configure Nginx

```bash
sudo nano /etc/nginx/sites-available/travel-cms
```

Paste this configuration:

```nginx
server {
    listen 80;
    server_name yourdomain.com www.yourdomain.com;
    root /var/www/travel-cms/public;
    index index.php;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

Enable site:

```bash
sudo ln -s /etc/nginx/sites-available/travel-cms /etc/nginx/sites-enabled/
sudo nginx -t
sudo systemctl reload nginx
```

### 5. Setup SSL (Let's Encrypt)

```bash
sudo apt install -y certbot python3-certbot-nginx
sudo certbot --nginx -d yourdomain.com -d www.yourdomain.com
```

### 6. Setup Cron Job

```bash
sudo crontab -e -u www-data
# Add this line:
* * * * * cd /var/www/travel-cms && php artisan schedule:run >> /dev/null 2>&1
```

## Using the Deployment Script

For faster deployments, use the provided script:

```bash
# Make script executable
chmod +x deploy.sh

# Run deployment
sudo ./deploy.sh production
```

## Post-Deployment

1. **Test Application**
   - Visit: `https://yourdomain.com`
   - Admin: `https://yourdomain.com/admin`
   - Test quote form submission

2. **Monitor Logs**
   ```bash
   tail -f /var/www/travel-cms/storage/logs/laravel.log
   ```

3. **Check Status**
   ```bash
   sudo systemctl status nginx
   sudo systemctl status php8.2-fpm
   sudo systemctl status postgresql
   ```

## Common Commands

```bash
# Clear all caches
php artisan optimize:clear

# Rebuild assets
npm run build

# Run migrations
php artisan migrate

# View logs
tail -f storage/logs/laravel.log

# Maintenance mode
php artisan down
php artisan up
```

## Troubleshooting

**500 Error?**
```bash
php artisan config:clear
php artisan cache:clear
chmod -R 775 storage bootstrap/cache
```

**Assets not loading?**
```bash
npm run build
php artisan view:clear
```

**Permission errors?**
```bash
sudo chown -R www-data:www-data /var/www/travel-cms
sudo chmod -R 775 storage bootstrap/cache
```

---

For detailed instructions, see [DEPLOYMENT.md](./DEPLOYMENT.md)

