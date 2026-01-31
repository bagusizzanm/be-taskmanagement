# Task Management System

## Deskripsi Singkat Aplikasi

Task Management System adalah aplikasi berbasis web yang digunakan untuk membantu pengguna dalam mengelola tugas harian. Aplikasi ini menyediakan fitur autentikasi pengguna, manajemen task (CRUD), serta filter dan sorting task berdasarkan status dan deadline. Backend dibangun sebagai REST API dan frontend menggunakan React.

---

## Langkah Menjalankan Backend

1. Clone repository:

   ```bash
   git clone <repository-url>
   cd backend
   ```

2. Install dependency:

   ```bash
   composer install
   ```

3. Salin file environment:

   ```bash
   cp .env.example .env
   ```

4. Konfigurasi database di file `.env`:

   ```env
   DB_DATABASE=task_management
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. Generate application key:

   ```bash
   php artisan key:generate
   ```

6. Jalankan migration:

   ```bash
   php artisan migrate
   ```

7. Jalankan server:
   ```bash
   php artisan serve
   ```

Backend akan berjalan di:

```
http://localhost:8000
```

---

## Teknologi yang Digunakan

### Backend

- Laravel
- Laravel Sanctum (Authentication)
- MySQL
- Eloquent ORM

### Frontend

- ReactJS
- TailwindCSS
- Axios

---

## Informasi Login Dummy

Gunakan akun berikut untuk testing:

```
Email    : cek@gmail.com
Password : cekakun
```

Atau dapat melakukan register user baru melalui endpoint `/api/register`.

---

## Struktur Database

### Tabel users

| Kolom      | Tipe Data | Keterangan        |
| ---------- | --------- | ----------------- |
| id         | bigint    | Primary Key       |
| name       | varchar   | Nama user         |
| username   | varchar   | Username          |
| email      | varchar   | Email user        |
| password   | varchar   | Password (hashed) |
| created_at | timestamp | Created           |
| updated_at | timestamp | Updated           |

### Tabel tasks

| Kolom       | Tipe Data | Keterangan                |
| ----------- | --------- | ------------------------- |
| id          | bigint    | Primary Key               |
| user_id     | bigint    | Foreign Key (users)       |
| title       | varchar   | Judul task                |
| description | text      | Deskripsi task            |
| status      | enum      | todo / in_progress / done |
| deadline    | date      | Deadline task             |
| created_by  | varchar   | Pembuat task              |
| created_at  | timestamp | Created                   |
| updated_at  | timestamp | Updated                   |
