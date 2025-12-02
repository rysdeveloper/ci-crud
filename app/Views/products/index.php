<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>
    <h1>Product List</h1>
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>
    <a href="/products/create" class="btn btn-primary mb-3">Add New Product</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
                <tr>
                    <td><?= $product['id'] ?></td>
                    <td><?= esc($product['name']) ?></td>
                    <td><?= esc($product['description']) ?></td>
                    <td><?= number_format($product['price'], 2) ?></td>
                    <td><?= $product['stock'] ?></td>
                    <td>
                        <a href="/products/edit/<?= $product['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                        <a href="/products/delete/<?= $product['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?= $pagination->links() ?>
<?= $this->endSection(); ?>
