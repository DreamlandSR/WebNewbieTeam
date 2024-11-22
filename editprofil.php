<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Diri</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container">
        <h3 class="text-center">Data Diri</h3>
        <div class="card p-4">
            <div class="row align-items-center">
                <div class="col-md-3 text-center">
                    <img alt="Profile picture placeholder" height="100"
                        src="https://storage.googleapis.com/a1aa/image/EQfmn4Xbi2waCCbUEeHlR3z5FdjWdqNHXR3RVeCZ1uCD1CQnA.jpg"
                        class="rounded-circle img-thumbnail" width="100" />
                    <button class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#editFotoModal">
                        Edit Foto
                    </button>
                </div>
                <div class="col-md-9">
                    <p><strong>Nama:</strong> Mulyana</p>
                    <p><strong>Email:</strong> mulyana@gmail.com</p>
                    <p><strong>NIP:</strong> 351010100020</p>
                    <p><strong>No. Hp:</strong> +6281-6664-5555</p>
                    <button class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#editProfilModal">
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
                            <label for="no_hp" class="form-label">No. Hp</label>
                            <input type="text" class="form-control" id="no_hp" name="no_hp" value="+6281-6664-5555"
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
</body>

</html>