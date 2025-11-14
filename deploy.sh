#!/bin/bash

# Travel CMS - Quick Deployment Script
# This script automates common deployment tasks
# Usage: ./deploy.sh [environment]

set -e

ENVIRONMENT=${1:-production}
APP_DIR="/var/www/travel-cms"
WEB_USER="www-data"

echo "🚀 Starting deployment for environment: $ENVIRONMENT"
echo "=================================================="

# Check if running as root or with sudo
if [ "$EUID" -ne 0 ]; then 
    echo "❌ Please run as root or with sudo"
    exit 1
fi

# Navigate to application directory
if [ ! -d "$APP_DIR" ]; then
    echo "❌ Application directory not found: $APP_DIR"
    exit 1
fi

cd $APP_DIR

echo ""
echo "📦 Step 1: Pulling latest changes..."
git pull origin main || git pull origin master

echo ""
echo "📦 Step 2: Installing PHP dependencies..."
composer install --optimize-autoloader --no-dev --no-interaction

echo ""
echo "📦 Step 3: Installing NPM dependencies..."
npm install --production

echo ""
echo "🔨 Step 4: Building assets..."
npm run build

echo ""
echo "🗄️  Step 5: Running database migrations..."
php artisan migrate --force

echo ""
echo "🔗 Step 6: Creating storage link..."
php artisan storage:link || true

echo ""
echo "🧹 Step 7: Clearing caches..."
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

echo ""
echo "⚡ Step 8: Optimizing application..."
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize

echo ""
echo "🔐 Step 9: Setting permissions..."
chown -R $WEB_USER:$WEB_USER $APP_DIR
chmod -R 755 $APP_DIR
chmod -R 775 storage bootstrap/cache

echo ""
echo "✅ Deployment completed successfully!"
echo ""
echo "📋 Next steps:"
echo "   1. Verify application: https://yourdomain.com"
echo "   2. Check logs: tail -f storage/logs/laravel.log"
echo "   3. Test admin panel: https://yourdomain.com/admin"
echo ""

