## Detail Fitur & CRUD (Create, Read, Update, Delete)
### 1. Authentication (Otentikasi)
- **Register**: Pengguna baru dapat mendaftarkan akun.
- **Login**: Pengguna dapat masuk ke dalam sistem.
- **Logout**: Pengguna dapat keluar dari sistem.

### 2. Products (Produk)
Manajemen produk untuk toko kecantikan.
- **Admin**:
  - **Read**: Melihat daftar semua produk (`GET /admin/products`).
  - **Create**: Menambah produk baru melalui form (`GET /admin/products/create` & `POST /admin/products`).
  - **Update**: Mengedit detail produk seperti nama, harga, deskripsi, atau gambar (`GET /admin/products/{id}/edit` & `PUT /admin/products/{id}`).
  - **Delete**: Menghapus produk dari sistem (`DELETE /admin/products/{id}`).
- **User / Customer**:
  - **Read**: Melihat katalog semua produk di halaman utama (`GET /`).
  - **Read Detail**: Melihat detail spesifik suatu produk (`GET /products/{id}`).
  - **API Read**: Mengambil data produk dalam format JSON (`GET /api/products`).

### 3. Cart (Keranjang Belanja)
Keranjang belanja pengguna sebelum melakukan *checkout*.
- **User (Terautentikasi)**:
  - **Read**: Melihat isi keranjang belanja (`GET /cart`).
  - **Create**: Menambahkan produk ke keranjang (`POST /cart`).
  - **Update**: Mengubah kuantitas/jumlah barang di dalam keranjang (`PUT /cart/{id}`).
  - **Delete**: Menghapus salah satu barang dari keranjang (`DELETE /cart/{id}`).

### 4. Orders & Checkout (Pesanan & Pembayaran)
Proses pemesanan barang.
- **User (Terautentikasi)**:
  - **Create / Checkout**: Melakukan proses pemesanan dari isi keranjang (`GET /checkout` & `POST /checkout`).
  - **Read**: Melihat riwayat pesanan (Order History) milik pengguna itu sendiri (`GET /orders`).
- **Admin**:
  - **Read**: Melihat daftar seluruh pesanan yang masuk dari semua pengguna di Dashboard (`GET /admin/dashboard`).
  - **Update**: Mengubah status pesanan (contoh: *pending*, *processing*, *shipped*, *delivered*) (`PUT /admin/orders/{id}/status`).

### 5. Reviews (Ulasan Produk)
Ulasan atau *rating* dari pembeli terhadap produk yang dibeli.
- **User (Terautentikasi)**:
  - **Create**: Memberikan ulasan baru terhadap suatu produk (`POST /reviews`).
  - **Update**: Mengubah isi ulasan atau *rating* yang pernah diberikan (`GET /reviews/{id}/edit` & `PUT /reviews/{id}`).
  - **Read**  : Melihat ulasan atau rating 
  - **Delete**: Menghapus ulasan yang sudah diberikan (`DELETE /reviews/{id}`).

### 6. User Management (Manajemen Pengguna)
Pengelolaan data pengguna dan administrator.
- **Admin**:
  - **Read**: Melihat daftar seluruh pengguna terdaftar (`GET /admin/users`).
  - **Create**: Menambahkan pengguna baru secara manual (`GET /admin/users/create` & `POST /admin/users`).
  - **Update**: Mengubah data pengguna lain, termasuk mengatur peran/role (`GET /admin/users/{id}/edit` & `PUT /admin/users/{id}`).
  - **Delete**: Menghapus pengguna dari sistem (`DELETE /admin/users/{id}`).

---

## Teknologi yang Digunakan
- **Framework:** Laravel
- **Database:** PostgreSQL (Supabase)
- **Deployment:** Vercel / Clever Cloud
