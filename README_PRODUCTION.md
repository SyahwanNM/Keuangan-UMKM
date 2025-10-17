# 💰 Keuangan UMKM - Production

Sistem Manajemen Keuangan untuk UMKM yang lengkap dan mudah digunakan.

## 🚀 **FITUR UTAMA**

### **Authentication & Security**
- ✅ Login/Register dengan tampilan custom
- ✅ Forgot Password dengan email verification
- ✅ Session management yang aman
- ✅ Password hashing dengan bcrypt

### **Manajemen Keuangan**
- ✅ Dashboard keuangan real-time
- ✅ Manajemen transaksi (Pemasukan/Pengeluaran)
- ✅ Upload bukti transaksi
- ✅ Kategori transaksi otomatis

### **Sistem Pajak**
- ✅ Perhitungan pajak otomatis
- ✅ Laporan pajak bulanan dan tahunan
- ✅ Export PDF untuk laporan pajak
- ✅ Reminder pembayaran pajak

### **Laporan Keuangan**
- ✅ Laporan harian, mingguan, bulanan, tahunan
- ✅ Export PDF dan Excel
- ✅ Grafik dan statistik keuangan
- ✅ Analisis profit/loss

### **Manajemen Modal**
- ✅ Tracking modal awal
- ✅ Perhitungan ROI
- ✅ Analisis investasi

### **Profil Bisnis**
- ✅ Informasi bisnis lengkap
- ✅ Statistik bisnis
- ✅ Customization tema

## 🛠️ **TECHNOLOGY STACK**

- **Backend:** Laravel 11
- **Frontend:** Tailwind CSS + Alpine.js
- **Database:** MySQL
- **PDF:** DomPDF
- **Excel:** Maatwebsite Excel
- **Email:** SMTP (Gmail)
- **Build Tool:** Vite

## 📋 **REQUIREMENTS**

- PHP 8.2+
- MySQL 5.7+
- Composer
- Node.js 16+
- NPM/Yarn

## 🔧 **INSTALLATION**

### **1. Clone Repository**
```bash
git clone https://github.com/yourusername/keuangan-umkm.git
cd keuangan-umkm
```

### **2. Install Dependencies**
```bash
# Install PHP dependencies
composer install --no-dev --optimize-autoloader

# Install NPM dependencies
npm install

# Build assets
npm run build
```

### **3. Environment Setup**
```bash
# Copy environment file
cp env.example .env

# Generate application key
php artisan key:generate

# Configure .env file
nano .env
```

### **4. Database Setup**
```bash
# Run migrations
php artisan migrate --force

# Create storage link
php artisan storage:link
```

### **5. Optimize for Production**
```bash
# Cache configuration
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Clear cache
php artisan cache:clear
```

## ⚙️ **CONFIGURATION**

### **Database Configuration**
```env
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=keuangan_umkm
DB_USERNAME=your_db_user
DB_PASSWORD=your_db_password
```

### **Email Configuration**
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-16-digit-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your-email@gmail.com
MAIL_FROM_NAME="Keuangan UMKM"
```

### **Application Configuration**
```env
APP_NAME="Keuangan UMKM"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com
```

## 📁 **DIRECTORY STRUCTURE**

```
keuangan-umkm/
├── app/
│   ├── Http/Controllers/     # Controllers
│   ├── Models/              # Eloquent Models
│   ├── Mail/                # Email Classes
│   └── Services/            # Business Logic
├── database/
│   ├── migrations/          # Database Migrations
│   └── seeders/            # Database Seeders
├── resources/
│   ├── views/              # Blade Templates
│   ├── css/                # CSS Files
│   └── js/                 # JavaScript Files
├── public/
│   ├── build/              # Compiled Assets
│   └── storage/            # Public Storage
├── storage/
│   ├── app/                # File Storage
│   ├── logs/               # Log Files
│   └── framework/          # Framework Cache
└── routes/
    └── web.php             # Web Routes
```

## 🔒 **SECURITY FEATURES**

- ✅ CSRF Protection
- ✅ SQL Injection Prevention
- ✅ XSS Protection
- ✅ Password Hashing
- ✅ Session Security
- ✅ File Upload Validation
- ✅ Input Validation & Sanitization

## 📊 **PERFORMANCE OPTIMIZATION**

- ✅ Database Query Optimization
- ✅ View Caching
- ✅ Route Caching
- ✅ Config Caching
- ✅ Asset Minification
- ✅ Image Optimization

## 🚀 **DEPLOYMENT**

Lihat file `DEPLOYMENT_GUIDE.md` untuk panduan deployment lengkap ke Plesk.

## 📞 **SUPPORT**

Untuk bantuan dan support, silakan hubungi:
- Email: support@keuanganumkm.com
- Documentation: [Link ke dokumentasi]

## 📄 **LICENSE**

MIT License - Lihat file LICENSE untuk detail lengkap.

---

**Dibuat dengan ❤️ untuk UMKM Indonesia**
