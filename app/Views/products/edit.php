<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<h2>Edit Product</h2>

<?php if (session()->getFlashdata('errors')): ?>
    <div class="alert alert-danger">
        <?php foreach (session()->getFlashdata('errors') as $error): ?>
            <div>
                <?= $error ?>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<form action="/products/update/<?= $product['id'] ?>" method="post">
    <?= csrf_field() ?>

    <div class="mb-3">
        <label>Name</label>
        <input type="text" name="name" class="form-control" value="<?= old('name', $product['name']) ?>">
    </div>

    <div class="mb-3">
        <label>SKU</label>
        <input type="text" name="sku" class="form-control" value="<?= old('sku', $product['sku']) ?>">
    </div>

    <div class="mb-3">
        <label>Warehouse</label>
        <select name="warehouse_id" class="form-control">
            <option value="">Select Warehouse</option>
            <?php foreach ($warehouses as $wh): ?>
                <option value="<?= $wh['id'] ?>" <?= old('warehouse_id', $product['warehouse_id']) == $wh['id'] ? 'selected' : '' ?>>
                    <?= $wh['name'] ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="mb-3">
        <label>Quantity</label>
        <input type="number" name="quantity" class="form-control" value="<?= old('quantity', $product['quantity']) ?>">
    </div>

    <button class="btn btn-success">Update</button>
    <a href="/products" class="btn btn-secondary">Cancel</a>
</form>

<?= $this->endSection() ?>
