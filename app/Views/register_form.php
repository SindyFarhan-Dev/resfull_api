<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Registrasi</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Form Registrasi</h2>

        <!-- Menampilkan pesan kesalahan jika ada -->
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <!-- Menampilkan pesan sukses jika ada -->
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <!-- Form Registrasi -->
        <form action="<?= site_url('registrasi') ?>" method="post">
            <?= csrf_field(); ?> <!-- Untuk melindungi CSRF -->
            <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?= set_value('nama') ?>" required>
                <small class="form-text text-danger"><?= isset($validation) ? $validation->getError('nama') : '' ?></small>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= set_value('email') ?>" required>
                <small class="form-text text-danger"><?= isset($validation) ? $validation->getError('email') : '' ?></small>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
                <small class="form-text text-danger"><?= isset($validation) ? $validation->getError('password') : '' ?></small>
            </div>

            <div class="form-group">
                <label for="role">Role:</label>
                <select class="form-control" id="role" name="role" required>
                    <option value="supplier" <?= set_select('role', 'supplier') ?>>Supplier</option>
                    <option value="admin" <?= set_select('role', 'admin') ?>>Admin</option>
                </select>
                <small class="form-text text-danger"><?= isset($validation) ? $validation->getError('role') : '' ?></small>
            </div>

            <button type="submit" class="btn btn-primary">Daftar</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
