<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>
    <h1>Create Product</h1>
    <?php if (session()->getFlashdata('errors')): ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
    <form action="/products/store" method="post">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="<?= set_value('name') ?>">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control"><?= set_value('description') ?></textarea>
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="text" name="price" id="price" class="form-control  " value="<?= set_value('price') ?>">
        </div>
        <div class="form-group">
            <label for="stock">Stock</label>
            <input type="number" name="stock" id="stock" class="form-control" value="<?= set_value('stock') ?>">
        </div>
        <?= csrf_field() ?>
        <button type="submit" class="btn btn-primary mt-3">Create Product</button>
    </form>
<?= $this->endSection(); ?>