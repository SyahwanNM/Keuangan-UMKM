# 🚀 PANDUAN DEPLOYMENT KE PLESK

## 📋 **RINGKASAN PROJECT**

**Project:** Keuangan UMKM - Sistem Manajemen Keuangan untuk UMKM  
**Framework:** Laravel 11  
**Database:** MySQL  
**Frontend:** Tailwind CSS + Vite  
**Features:** 
- ✅ Authentication (Login/Register Custom)
- ✅ Forgot Password dengan Email Verification
- ✅ Dashboard Keuangan
- ✅ Manajemen Transaksi
- ✅ Sistem Pajak Otomatis
- ✅ Laporan Keuangan (PDF/Excel)
- ✅ Manajemen Modal
- ✅ Profil Bisnis
- ✅ Theme Customization

---

## 🗂️ **STRUKTUR PROJECT YANG SUDAH DIBERSIHKAN**

### **File yang Dihapus (Tidak Dibutuhkan untuk Production):**
- ❌ `tests/` - Folder test lengkap
- ❌ `database/seeders/SyahwanTransactionSeeder.php` - Seeder test
- ❌ `database/seeders/TransactionTestDataSeeder.php` - Seeder test
- ❌ `storage/framework/cache/*` - Cache files
- ❌ `storage/framework/sessions/*` - Session files
- ❌ `storage/framework/testing/*` - Testing files
- ❌ `storage/framework/views/*` - Compiled views
- ❌ `storage/logs/laravel.log` - Log files
- ❌ `public/hot` - Hot reload file
- ❌ `bootstrap/cache/*` - Bootstrap cache
- ❌ `resources/views/auth/forgot-password.blade.php` - Default view
- ❌ `resources/views/auth/reset-password.blade.php` - Default view
- ❌ `resources/views/auth/verify-email.blade.php` - Default view
- ❌ `database/migrations/2025_10_17_033926_add_primary_key_to_password_reset_tokens_table.php` - Failed migration

### **File yang Ditambahkan:**
- ✅ `storage/logs/.gitkeep` - Keep logs directory
- ✅ `storage/framework/cache/.gitkeep` - Keep cache directory
- ✅ `storage/framework/sessions/.gitkeep` - Keep sessions directory
- ✅ `storage/framework/testing/.gitkeep` - Keep testing directory
- ✅ `storage/framework/views/.gitkeep` - Keep views directory

---

## 🔧 **LANGKAH DEPLOYMENT KE PLESK**

### **1. PERSIAPAN GITHUB REPOSITORY**

#### **A. Push ke GitHub:**
```bash
# Add semua file
git add .

# Commit perubahan
git commit -m "Prepare for production deployment - Clean up unnecessary files"

# Push ke GitHub
git push origin main
```

#### **B. Buat Tag Release (Opsional):**
```bash
# Buat tag untuk versi production
git tag -a v1.0.0 -m "Production Release v1.0.0"
git push origin v1.0.0
```

### **2. KONFIGURASI PLESK**

#### **A. Buat Domain/Subdomain:**
1. Login ke Plesk Panel
2. Buat domain baru atau subdomain
3. Set document root ke folder project

#### **B. Setup Database:**
1. Buat database MySQL baru
2. Buat user database dengan privileges penuh
3. Catat informasi database:
   - Database Name: `keuangan_umkm`
   - Username: `your_db_user`
   - Password: `your_db_password`
   - Host: `localhost` (atau sesuai Plesk)

#### **C. Setup PHP:**
1. Set PHP version ke 8.2 atau lebih tinggi
2. Enable extensions yang dibutuhkan:
   - `php-mysql`
   - `php-mbstring`
   - `php-xml`
   - `php-curl`
   - `php-zip`
   - `php-gd`
   - `php-intl`

### **3. DEPLOYMENT DENGAN GIT**

#### **A. Clone Repository:**
```bash
# SSH ke server Plesk
ssh your-username@your-server.com

# Navigate ke document root
cd /var/www/vhosts/yourdomain.com/httpdocs

# Clone repository
git clone https://github.com/yourusername/keuangan-umkm.git .

# Atau jika sudah ada, pull terbaru
git pull origin main
```

#### **B. Install Dependencies:**
```bash
# Install Composer dependencies
composer install --no-dev --optimize-autoloader

# Install NPM dependencies
npm install

# Build assets
npm run build
```

#### **C. Setup Environment:**
```bash
# Copy .env.example ke .env
cp .env.example .env

# Generate application key
php artisan key:generate

# Edit .env file dengan konfigurasi production
nano .env
```

### **4. KONFIGURASI .ENV PRODUCTION**

```env
APP_NAME="Keuangan UMKM"
APP_ENV=production
APP_KEY=base64:your-generated-key
APP_DEBUG=false
APP_URL=https://yourdomain.com

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=keuangan_umkm
DB_USERNAME=your_db_user
DB_PASSWORD=your_db_password

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-16-digit-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your-email@gmail.com
MAIL_FROM_NAME="Keuangan UMKM"

SESSION_DRIVER=database
CACHE_STORE=database
QUEUE_CONNECTION=database
```

### **5. SETUP DATABASE**

```bash
# Run migrations
php artisan migrate --force

# Seed database (jika ada)
php artisan db:seed

# Create storage link
php artisan storage:link
```

### **6. SETUP PERMISSIONS**

```bash
# Set permissions untuk storage dan bootstrap/cache
chmod -R 775 storage
chmod -R 775 bootstrap/cache

# Set ownership
chown -R www-data:www-data storage
chown -R www-data:www-data bootstrap/cache
```

### **7. OPTIMASI PRODUCTION**

```bash
# Clear dan cache config
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Clear application cache
php artisan cache:clear
```

---

## 📁 **FILE YANG PERLU DI UPLOAD MANUAL**

### **1. File .env (WAJIB)**
- Upload file `.env` dengan konfigurasi production
- **JANGAN** commit file `.env` ke GitHub

### **2. File Storage (OPSIONAL)**
Jika ada file upload yang sudah ada:
- `storage/app/public/transaction-proofs/` - File bukti transaksi

### **3. File .htaccess (OPSIONAL)**
Jika Plesk tidak auto-generate:
```apache
<IfModule mod_rewrite.c>
    <IfModule mod_negotiation.c>
        Options -MultiViews -Indexes
    </IfModule>

    RewriteEngine On

    # Handle Authorization Header
    RewriteCond %{HTTP:Authorization} .
    RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]

    # Redirect Trailing Slashes If Not A Folder...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_URI} (.+)/$
    RewriteRule ^ %1 [L,R=301]

    # Send Requests To Front Controller...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^ index.php [L]
</IfModule>
```

---

## 🔍 **VERIFIKASI DEPLOYMENT**

### **1. Test Halaman Utama:**
- ✅ `https://yourdomain.com` - Landing page
- ✅ `https://yourdomain.com/login-custom` - Login custom
- ✅ `https://yourdomain.com/register-custom` - Register custom

### **2. Test Fitur Utama:**
- ✅ Login/Register
- ✅ Forgot Password
- ✅ Dashboard
- ✅ Transaksi
- ✅ Pajak
- ✅ Laporan

### **3. Test Email:**
- ✅ Forgot password email
- ✅ Email verification

---

## 🚨 **TROUBLESHOOTING**

### **1. Error 500:**
```bash
# Check logs
tail -f storage/logs/laravel.log

# Check permissions
ls -la storage/
ls -la bootstrap/cache/
```

### **2. Database Error:**
```bash
# Check database connection
php artisan tinker
# Then: DB::connection()->getPdo();
```

### **3. Asset Error:**
```bash
# Rebuild assets
npm run build

# Check public/build directory
ls -la public/build/
```

### **4. Permission Error:**
```bash
# Fix permissions
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

---

## 📊 **MONITORING PRODUCTION**

### **1. Log Monitoring:**
```bash
# Monitor error logs
tail -f storage/logs/laravel.log

# Monitor access logs
tail -f /var/log/apache2/access.log
```

### **2. Performance:**
- Monitor database performance
- Monitor server resources
- Monitor email delivery

### **3. Backup:**
- Setup automatic database backup
- Setup file backup
- Test restore process

---

## 🎯 **CHECKLIST DEPLOYMENT**

- [ ] Repository di-push ke GitHub
- [ ] Domain/subdomain dibuat di Plesk
- [ ] Database dibuat dan dikonfigurasi
- [ ] PHP version dan extensions dikonfigurasi
- [ ] Repository di-clone ke server
- [ ] Dependencies di-install
- [ ] Assets di-build
- [ ] File .env dikonfigurasi
- [ ] Database migrations dijalankan
- [ ] Permissions di-set
- [ ] Cache di-optimize
- [ ] Halaman utama di-test
- [ ] Fitur utama di-test
- [ ] Email di-test
- [ ] Monitoring di-setup

---

## 📞 **SUPPORT**

Jika ada masalah saat deployment, periksa:
1. **Log files** di `storage/logs/laravel.log`
2. **Server logs** di Plesk panel
3. **Database connection** di .env
4. **File permissions** untuk storage dan cache
5. **PHP version** dan extensions

**Selamat deployment! 🎉**
