<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Diri</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    body {
        background-color: #e3f2fd;
        /* Warna latar biru muda */
        font-family: 'Arial', sans-serif;
    }

    .card {
        border: none;
        border-radius: 20px;
        box-shadow: 0 6px 25px rgba(0, 0, 0, 0.15);
        background: linear-gradient(145deg, #ffffff, #d6e9f9);
    }

    h3 {
        color: #0d6efd;
        /* Warna biru Bootstrap */
        font-weight: bold;
        margin-bottom: 20px;
    }

    .btn-primary {
        background-color: #0d6efd;
        border-color: #0d6efd;
        transition: all 0.3s ease-in-out;
    }

    .btn-primary:hover {
        background-color: #084298;
        /* Biru lebih gelap saat hover */
        border-color: #084298;
    }

    .rounded-circle {
        border: 3px solid #0d6efd;
        width: 120px;
        height: 120px;
        object-fit: cover;
    }

    .form-label {
        font-weight: bold;
    }

    .modal-content {
        border-radius: 20px;
        box-shadow: 0 6px 25px rgba(0, 0, 0, 0.2);
    }

    .container {
        max-width: 900px;
    }

    .card p {
        font-size: 16px;
        color: #333;
        margin-bottom: 8px;
    }

    footer {
        margin-top: 50px;
        background-color: #0d6efd;
        color: #fff;
        text-align: center;
        padding: 15px;
        border-radius: 10px;
    }

    footer a {
        color: #fff;
        text-decoration: underline;
    }

    footer a:hover {
        text-decoration: none;
    }
    </style>
    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container mt-5">
        <h3 class="text-center">Data Diri</h3>
        <div class="card p-4">
            <div class="row g-4 align-items-center">
                <!-- Foto Profil -->
                <div class="col-md-4 text-center">
                    <img alt="Foto Profil"
                        src="https://storage.googleapis.com/a1aa/image/EQfmn4Xbi2waCCbUEeHlR3z5FdjWdqNHXR3RVeCZ1uCD1CQnA.jpg"
                        class="rounded-circle">
                    <button class="btn btn-primary mt-3 w-100" data-bs-toggle="modal" data-bs-target="#editFotoModal">
                        Edit Foto
                    </button>
                </div>
                <!-- Informasi Profil -->
                <div class="col-md-8">
                    <p><strong>Nama:</strong> Mulyana</p>
                    <p><strong>Email:</strong> mulyana@gmail.com</p>
                    <p><strong>NIP:</strong> 351010100020</p>
                    <p><strong>No. Hp:</strong> +6281-6664-5555</p>
                    <button class="btn btn-primary mt-3 w-50" data-bs-toggle="modal" data-bs-target="#editProfilModal">
                        Edit Profil
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Foto -->
    <div class="modal fade" id="editFotoModal" tabindex="-1" aria-labelledby="editFotoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="edit_foto.php" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editFotoModalLabel">Edit Foto</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <label for="fotoProfil" class="form-label">Unggah Foto Baru</label>
                        <input type="file" class="form-control" id="fotoProfil" name="fotoProfil" required>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit Profil -->
    <div class="modal fade" id="editProfilModal" tabindex="-1" aria-labelledby="editProfilModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="edit_profil.php">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editProfilModalLabel">Edit Profil</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" value="Mulyana" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="mulyana@gmail.com"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="nip" class="form-label">NIP</label>
                            <input type="text" class="form-control" id="nip" name="nip" value="351010100020" required>
                        </div>
                        <div class="mb-3">
                            <label for="nohp" class="form-label">No. Hp</label>
                            <input type="text" class="form-control" id="nohp" name="nohp" value="+6281-6664-5555"
                                required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p>© 2024 Data Diri</p>
        <p><a href="#">Kebijakan Privasi</a> | <a href="#">Syarat & Ketentuan</a></p>
    </footer>
</body>

</html>