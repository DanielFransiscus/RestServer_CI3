
# # API-Mahasiswa

Proyek ini adalah sebuah aplikasi web yang dibangun menggunakan framework Codeigniter versi 3.1.13. RESTful API ini  digunakan untuk mengelola data mahasiswa. Proyek ini dibuat untuk tujuan pembelajaran.

## Persyaratan Server:

-   Direkomendasikan menggunakan versi PHP 5.6 atau yang lebih baru.
-   Disarankan untuk tidak menggunakan versi PHP 5.3.7 atau lebih lama karena potensi masalah keamanan, kinerja yang buruk, dan fitur yang tidak tersedia.

## Persyaratan Database:

-   Database yang didukung:
    -   MySQL (versi 5.1+) menggunakan driver mysql (deprecated), mysqli, dan pdo.

## Authentication
Semua API harus menggunakan autentikasi berikut:
Permintaan :
- Header :
    - X-API-KEY : "wpu123"
    - Authorization: Basic 
    username : daniel
    password : frans123

## ## Dapatkan Semua Mahasiswa
Permintaan :
[GET] {base_url}/api/mahasiswa

Respons :
```json 
{
    "code": 200,
    "status": "OK",
    "data": [
        {
            "id": "61",
            "nama": "horas",
            "email": "horas@mail.comkkjuhhTy",
            "jurusan": "Teknik Sipil",
            "gambar": "5dc3b83f830dab43254cdb349e854dc6.png",
            "createdAt": "2023-05-19 17:37:24",
            "updatedAt": "2023-05-19 18:35:00"
        },
        ...
    ],
    "links": {
        "first": "http://localhost/belajar/api/mahasiswa?page=1",
        "last": "http://localhost/belajar/api/mahasiswa?page=2",
        "prev": null,
        "next": "http://localhost/belajar/api/mahasiswa?page=2"
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 2,
        "path": "http://localhost/belajar/api/mahasiswa",
        "per_page": 5,
        "to": 5,
        "total": 7,
        "limit": 5
    }
}
```

## Paginasi
Permintaan :
[GET] {base_url}/api/mahasiswa?page=1

Respons :
```json 
{
    "code": 200,
    "status": "OK",
    "data": [
        {
            "id": "61",
            "nama": "horas",
            "email": "horas@mail.comkkjuhhTy",
            "jurusan": "Teknik Sipil",
            "gambar": "5dc3b83f830dab43254cdb349e854dc6.png",
            "createdAt": "2023-05-19 17:37:24",
            "updatedAt": "2023-05-19 18:35:00"
        },
        ...
    ],
    "links": {
        "first": "http://localhost/belajar/api/mahasiswa?page=1",
        "last": "http://localhost/belajar/api/mahasiswa?page=2",
        "prev": null,
        "next": "http://localhost/belajar/api/mahasiswa?page=2"
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 2,
        "path": "http://localhost/belajar/api/mahasiswa",
        "per_page": 5,
        "to": 5,
        "total": 7,
        "limit": 5
    }
}
```

##  Dapatkan Satu Mahasiswa
Permintaan :
[GET] {base_url}/api/mahasiswa/71

Respons :
```json 
{
    "code": 200,
    "status": "OK",
    "data": {
        "id": "71",
        "nama": "Boreno",
        "email": "buzang@mail.com",
        "jurusan": "Perhotelan",
        "gambar": "e58043377acbaba5d0e59dcc99999f88.jpg",
        "createdAt": "2023-05-19 19:03:58",
        "updatedAt": "2023-05-19 19:21:40"
    }
}
```

## Tambahkan Mahasiswa
Permintaan : 
[POST] {base_url}/api/mahasiswa

Body (form-data):
-   nama		: [nama mahasiswa]
-   email		: [email mahasiswa]
-   jurusan	: [jurusan mahasiswa]
-  gambar	: [optional]

Respons :
```json
{
    "code": 201,
    "status": "Created",
    "message": "Data berhasil ditambahkan",
    "data": {
        "nama": "Susi",
        "email": "susi@mail.com",
        "jurusan": "Perhotelan",
        "gambar": "dd467e88c0233dc69df9c01444ed49c5.jpeg",
        "gambar_url": "http://localhost/belajar/uploads/dd467e88c0233dc69df9c01444ed49c5.jpeg"
    }
}
```

## Update Mahasiswa
Permintaan : 
[POST] {base_url}/api/mahasiswa/72
Body (form-data):

-   nama 			: [nama mahasiswa]
-   email			: [email mahasiswa]
-   jurusan		: [jurusan mahasiswa]
- gambar		: [optional]
- _method	: PUT

Respons : 
```json 
{
    "code": 200,
    "status": "OK",
    "message": "Data berhasil diubah",
    "data": {
        "nama": "Brocoli",
        "email": "brocoli@mail.com",
        "jurusan": "Informatika",
        "gambar": "8d01a0ecac0bd83bf40b1d46ca919bcc.png",
        "gambar_url": "http://localhost/belajar/uploads/8d01a0ecac0bd83bf40b1d46ca919bcc.png"
    }
}
```

## Menghapus Mahasiswa
Permintaan :
[DELETE] {base_url}/api/mahasiswa/72

Respons :
 tidak ada karena 204 no content
