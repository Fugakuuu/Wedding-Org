# Wedding Organizer (jewepe WO)

🚧 **Status: Under Development**

Wedding Organizer adalah aplikasi manajemen paket pernikahan dengan admin panel berbasis Filament dan antarmuka pelanggan yang responsif.

## Stack Teknologi

- **Backend:** Laravel 12
- **Admin Panel:** Filament v5
- **Frontend:** Blade + Tailwind CSS + Alpine.js
- **Database:** MySQL
- **Package Manager:** Composer (PHP), npm (Node.js)

## Fitur Saat Ini

### ✅ Selesai
- Sistem autentikasi User (login, register, password reset)
- Migrasi User role (admin/user)
- Admin panel Filament di `/admin`
- Resources Filament: Katalog Paket, Pesanan
- User navbar responsif (Beranda, Katalog, Cek Status Pesanan)
- Design sistem hitam-putih (monochrome)

### 🚧 Tahap Development
- Seeding data katalog & pesanan
- Halaman booking publik (tanpa login, email-based)
- Halaman cek status pesanan (email + ID)
- Testing admin workflows
- Public pages design & responsive
- Validasi form lengkap
- Error handling & logging

### ❌ Belum Dimulai
- Email notifications
- Payment gateway integration
- Analytics & reporting
- Mobile app
- API endpoints

## Setup Lokal

### Prerequisites
- PHP 8.2+
- MySQL 5.7+
- Node.js 18+
- Composer

### Instalasi

1. **Clone repository**
   ```bash
   git clone https://github.com/Fugakuuu/Wedding-Org.git
   cd Wedding-Org
   ```

2. **Install dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Setup environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Configure database**
   Edit `.env` dan set:
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=jewpe_wedding
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. **Jalankan migrations**
   ```bash
   php artisan migrate
   ```

6. **Build assets**
   ```bash
   npm run build
   ```

7. **Jalankan server**
   ```bash
   php artisan serve
   ```

Akses aplikasi di `http://localhost:8000`

Admin panel: `http://localhost:8000/admin` (login dengan admin user)

## Struktur Project

```
wedding-org/
├── app/
│   ├── Filament/Resources/          # Filament resources
│   ├── Http/Controllers/            # Route controllers
│   ├── Models/                      # Eloquent models
│   └── Providers/                   # Service providers
├── database/
│   ├── migrations/                  # Database migrations
│   ├── seeders/                     # Database seeders
│   └── factories/                   # Model factories
├── resources/
│   ├── views/                       # Blade templates
│   ├── css/                         # Tailwind CSS
│   └── js/                          # Alpine.js scripts
├── routes/                          # Route definitions
├── tests/                           # Feature & unit tests
└── public/                          # Assets & entry point
```

## Workflow Development

1. **Database changes:** Buat migration baru, jangan edit migration lama
2. **UI changes:** Edit Blade di `resources/views/` atau Filament form/table
3. **Model logic:** Update di `app/Models/`
4. **Assets:** Jalankan `npm run dev` untuk dev mode, `npm run build` untuk production

## Testing

```bash
php artisan test
```

## Kontribusi

- Buat branch baru untuk fitur: `git checkout -b feature/nama-fitur`
- Commit dengan pesan deskriptif
- Push ke branch Anda
- Buat Pull Request

## License

MIT

## Status Pengembangan

**Last Updated:** 17 Oktober 2026

Lihat [Issues](https://github.com/Fugakuuu/Wedding-Org/issues) untuk task yang sedang dikerjakan.
