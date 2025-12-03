<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card border-danger">
                    <div class="card-header bg-danger text-white">
                        <h4 class="mb-0">Delete Product</h4>
                    </div>
                    <div class="card-body">
                        <p class="text-muted">Are you sure you want to delete this product?</p>
                        <div class="alert alert-info">
                            <strong>Product ID:</strong> <?= $product['id'] ?><br>
                            <strong>Name:</strong> <?= esc($product['name']) ?><br>
                            <strong>Price:</strong> <?= number_format($product['price'], 2) ?>
                        </div>
                        <p class="text-warning"><strong>⚠️ Warning:</strong> This action cannot be undone!</p>
                        
                        <form action="/products/destroy/<?= $product['id'] ?>" method="post">
                            <?= csrf_field() ?>
                            <button type="submit" class="btn btn-danger">Yes, Delete Product</button>
                            <a href="/products" class="btn btn-secondary">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?= $this->endSection(); ?>
