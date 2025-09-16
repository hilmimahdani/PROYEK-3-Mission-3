<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Students</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-dark text-white">
            <h3 class="mb-0">📋 Daftar Students</h3>
        </div>
        <div class="card-body">
            
            <?php if(session()->getFlashdata('success')): ?>
                <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
            <?php endif; ?>
            
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>NIM</th>
                        <th>Nama Lengkap</th>
                        <th>Usia</th>
                        <th>Entry Year</th>
                        <th>Username</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($students)): ?>
                        <?php foreach($students as $s): ?>
                            <tr>
                                <td><?= esc($s['nim']) ?></td>
                                <td><?= esc($s['full_name']) ?></td>
                                <td><?= esc($s['age']) ?></td>
                                <td><?= esc($s['entry_year']) ?></td>
                                <td><?= esc($s['username']) ?></td>
                                <td><?= esc($s['email']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center text-muted">Belum ada student</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

            <a href="<?= base_url('home') ?>" class="btn btn-secondary mt-3">⬅ Kembali ke Dashboard</a>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
