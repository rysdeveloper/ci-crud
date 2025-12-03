<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>
    <!-- Page Header -->
    <div class="page-header">
        <div class="container">
            <h1><i class="fas fa-list"></i> Product List</h1>
        </div>
    </div>

    <!-- Success Message -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> <?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <!-- Add Button -->
    <div class="mb-4">
        <a href="/products/create" class="btn btn-primary btn-lg">
            <i class="fas fa-plus"></i> Add New Product
        </a>
    </div>

    <!-- Products Table -->
    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th><i class="fas fa-hashtag"></i> ID</th>
                        <th><i class="fas fa-box"></i> Name</th>
                        <th><i class="fas fa-align-left"></i> Description</th>
                        <th><i class="fas fa-dollar-sign"></i> Price</th>
                        <th><i class="fas fa-warehouse"></i> Stock</th>
                        <th><i class="fas fa-cogs"></i> Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $product): ?>
                        <tr>
                            <td>
                                <span class="badge bg-primary"><?= $product['id'] ?></span>
                            </td>
                            <td>
                                <strong><?= esc($product['name']) ?></strong>
                            </td>
                            <td>
                                <small class="text-muted"><?= esc(substr($product['description'], 0, 50)) ?><?= strlen($product['description']) > 50 ? '...' : '' ?></small>
                            </td>
                            <td>
                                <span class="badge bg-success">$<?= number_format($product['price'], 2) ?></span>
                            </td>
                            <td>
                                <span class="badge <?= $product['stock'] > 0 ? 'bg-info' : 'bg-danger' ?>">
                                    <?= $product['stock'] ?> units
                                </span>
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="/products/edit/<?= $product['id'] ?>" class="btn btn-warning" title="Edit Product">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="/products/delete/<?= $product['id'] ?>" class="btn btn-danger" title="Delete Product">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <?php if ($pagination): ?>
        <nav aria-label="Page navigation" class="mt-4">
            <div class="d-flex justify-content-center">
                <?= $pagination->links() ?>
            </div>
        </nav>
    <?php endif; ?>
<?= $this->endSection(); ?>
