# Travel OnePage CMS

A modern, feature-rich Content Management System built with Laravel for travel agencies. This application provides a complete solution for managing destinations, tours, blogs, galleries, and customer inquiries for travel businesses.

## 🚀 Features

### Frontend Features
- **Homepage** with dynamic hero sections, featured circuits, gallery categories, FAQs, and latest blog posts
- **Destinations** - Browse and view detailed destination pages with associated tours
- **Circuits/Tours** - Detailed tour pages with itineraries, highlights, pricing, and duration
- **Blog System** - Full-featured blog with categories and individual post pages
- **Gallery** - Image gallery with category organization
- **Static Pages** - Customizable CMS pages (About, Contact, etc.)
- **Quote Request Form** - Customer inquiry form for tour quotes
- **Contact Form** - Contact form with math captcha protection
- **FAQ Section** - Frequently asked questions with sorting
- **Sitemap** - Auto-generated XML sitemap for SEO
- **Responsive Design** - Mobile-first design with Tailwind CSS

### Admin Panel Features
- **Dashboard** - Overview of key metrics and recent activity
- **Destinations Management** - Create, edit, duplicate, and manage travel destinations
- **Circuits Management** - Manage tour packages with detailed information
- **Blog Management** - Full CRUD operations for blog posts
- **Gallery Management** - Upload and organize images with categories
- **FAQ Management** - Create and manage frequently asked questions
- **Hero Sections** - Manage homepage hero banners
- **Pages Management** - Create and manage custom CMS pages
- **Quote Requests** - View and manage customer quote requests
- **Contact Messages** - Manage contact form submissions
- **Settings** - Comprehensive site settings including:
  - General settings (site name, description, contact info)
  - Logo and branding
  - SEO settings
  - Social media links
  - Business hours
  - Currency and timezone

### Technical Features
- **User Authentication** - Secure login system with Laravel Breeze
- **Admin Middleware** - Role-based access control for admin panel
- **Image Management** - File upload and storage system
- **SEO Optimization** - Meta tags, sitemap, and SEO-friendly URLs
- **API Endpoints** - JSON APIs for destinations, logo settings, and social settings
- **Database Migrations** - Comprehensive database schema
- **Seeders** - Sample data seeders for quick setup
- **Testing** - Pest PHP testing framework setup

## 📋 Requirements

- PHP >= 8.5 (recommended) or PHP >= 8.2 (minimum)
- Composer
- Node.js >= 18.x and npm
- SQLite (default) or MySQL/PostgreSQL
- Web server (Apache/Nginx) or PHP built-in server

> **Note:** This project is configured for PHP 8.5. See [PHP_8.5_MIGRATION.md](PHP_8.5_MIGRATION.md) for migration instructions.

## 🛠️ Installation

### 1. Clone the repository

```bash
git clone <repository-url>
cd travel-onepage-cms
```

### 2. Install PHP dependencies

```bash
composer install
```

### 3. Install Node.js dependencies

```bash
npm install
```

### 4. Environment setup

```bash
cp .env.example .env
php artisan key:generate
```

### 5. Configure database

Edit `.env` file and configure your database settings. By default, the project uses SQLite:

```env
DB_CONNECTION=sqlite
DB_DATABASE=/absolute/path/to/database/database.sqlite
```

For MySQL/PostgreSQL:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=travel_cms
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 6. Create database (if using SQLite)

```bash
touch database/database.sqlite
```

### 7. Run migrations and seeders

```bash
php artisan migrate
php artisan db:seed
```

This will:
- Create all necessary database tables
- Seed an admin user (check `database/seeders/AdminUserSeeder.php` for credentials)
- Add sample data for destinations, circuits, blogs, pages, etc.

### 8. Create storage link

```bash
php artisan storage:link
```

### 9. Build frontend assets

For development:
```bash
npm run dev
```

For production:
```bash
npm run build
```

### 10. Start the development server

```bash
php artisan serve
```

Or use the convenient dev script that runs everything:
```bash
composer dev
```

This will start:
- Laravel development server
- Queue worker
- Log viewer (Pail)
- Vite dev server

Visit `http://localhost:8000` in your browser.

## 🔐 Default Admin Credentials

After running the seeders, you can log in with the default admin account. Check `database/seeders/AdminUserSeeder.php` for the default credentials, or create a new admin user:

```bash
php artisan tinker
```

```php
$user = \App\Models\User::create([
    'name' => 'Admin',
    'email' => 'admin@example.com',
    'password' => bcrypt('password'),
    'is_admin' => true,
]);
```

## 📁 Project Structure

```
travel-onepage-cms/
├── app/
│   ├── Helpers/              # Helper functions (SettingHelper, MathCaptcha)
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/        # Admin panel controllers
│   │   │   ├── ContactController.php
│   │   │   ├── FrontendController.php
│   │   │   ├── ProfileController.php
│   │   │   └── QuoteRequestController.php
│   │   ├── Middleware/       # Custom middleware
│   │   └── Requests/         # Form request validation
│   ├── Models/               # Eloquent models
│   ├── Providers/            # Service providers
│   └── View/                 # View components
├── database/
│   ├── migrations/           # Database migrations
│   ├── seeders/              # Database seeders
│   └── database.sqlite       # SQLite database (default)
├── public/                   # Public assets
│   ├── build/                # Compiled assets
│   ├── images/               # Uploaded images
│   └── storage/              # Storage symlink
├── resources/
│   ├── css/                  # Stylesheets
│   ├── js/                   # JavaScript files
│   └── views/                # Blade templates
│       ├── admin/            # Admin panel views
│       ├── auth/             # Authentication views
│       ├── components/       # Reusable components
│       └── frontend/         # Frontend views
├── routes/
│   ├── web.php               # Web routes
│   └── auth.php              # Authentication routes
└── tests/                    # Pest PHP tests
```

## 🎨 Technologies Used

### Backend
- **Laravel 12.0** - PHP web framework
- **PHP 8.2+** - Programming language
- **SQLite/MySQL/PostgreSQL** - Database

### Frontend
- **Tailwind CSS 3.1** - Utility-first CSS framework
- **Alpine.js 3.4** - Lightweight JavaScript framework
- **Vite 7.0** - Next-generation frontend tooling

### Development Tools
- **Laravel Breeze** - Authentication scaffolding
- **Pest PHP** - Testing framework
- **Laravel Pint** - Code style fixer
- **Laravel Pail** - Log viewer

## 📝 Key Models

- **Destination** - Travel destinations
- **Circuit** - Tour packages/circuits
- **Blog** - Blog posts
- **Galerie** - Gallery images
- **GalerieCategory** - Gallery categories
- **Faq** - Frequently asked questions
- **Hero** - Homepage hero sections
- **Page** - Custom CMS pages
- **QuoteRequest** - Customer quote requests
- **Contact** - Contact form submissions
- **Setting** - Site settings
- **User** - Application users

## 🔧 Configuration

### Settings Management

The application uses a flexible settings system. Access settings in the admin panel at `/admin/settings` or use the helper function:

```php
use App\Models\Setting;

// Get a setting
$siteName = Setting::get('site_name', 'Default Name');

// Or use the helper function
$siteName = setting('site_name', 'Default Name');
```

### File Storage

Uploaded files are stored in `storage/app/public/images/`. Make sure to run `php artisan storage:link` to create the symbolic link.

### Mail Configuration

Configure mail settings in `.env` for quote request and contact form notifications:

```env
MAIL_MAILER=smtp
MAIL_HOST=mailpit
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"
```

## 🧪 Testing

Run tests using Pest PHP:

```bash
php artisan test
```

Or use the composer script:

```bash
composer test
```

## 🚀 Deployment

For detailed step-by-step deployment instructions, see:
- **[DEPLOYMENT.md](./DEPLOYMENT.md)** - Complete deployment guide with all steps
- **[QUICK_DEPLOY.md](./QUICK_DEPLOY.md)** - Quick deployment guide for experienced users

### Quick Production Build

1. **Optimize for production:**
```bash
composer install --optimize-autoloader --no-dev
npm run build
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

2. **Set environment variables:**
   - Update `.env` with production values
   - Set `APP_ENV=production`
   - Set `APP_DEBUG=false`

3. **Run migrations:**
```bash
php artisan migrate --force
```

4. **Set proper permissions:**
```bash
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

### Automated Deployment

Use the provided deployment script:

```bash
chmod +x deploy.sh
sudo ./deploy.sh production
```

## 📄 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## 🤝 Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## 📞 Support

For support, email contact@indiatourisme.fr or open an issue in the repository.

## 🎯 Roadmap

- [ ] Multi-language support
- [ ] Payment gateway integration
- [ ] Email notifications for quote requests
- [ ] Advanced search functionality
- [ ] Booking system
- [ ] Customer portal
- [ ] Analytics integration
- [ ] Social media integration enhancements

---

**Built with ❤️ using Laravel**
