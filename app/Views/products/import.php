<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0"><i class="fas fa-file-csv"></i> Import Products from CSV</h4>
                </div>
                <div class="card-body">
                    <?php if (session()->getFlashdata('errors')): ?>
                        <div class="alert alert-danger">
                            <ul>
                                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                                    <li><?= esc($error) ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                    <?php if (session()->getFlashdata('success')): ?>
                        <div class="alert alert-success">
                            <?= session()->getFlashdata('success') ?>
                        </div>
                    <?php endif; ?>
                    <form action="/products/import" method="post" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        <div class="mb-3">
                            <label for="csv_file" class="form-label">CSV File</label>
                            <input type="file" name="csv_file" id="csv_file" class="form-control" accept=".csv" required>
                        </div>
                        <button type="submit" class="btn btn-success"><i class="fas fa-upload"></i> Import</button>
                        <a href="/products" class="btn btn-secondary ms-2">Cancel</a>
                    </form>
                    <hr>
                    <p class="text-muted small">CSV columns required: <strong>name, description, price, stock</strong></p>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
