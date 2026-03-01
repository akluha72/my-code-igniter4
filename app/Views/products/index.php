<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<h2>Products</h2>
<a href="/products/create" class="btn btn-primary mb-3">Add Product</a>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success">
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>
<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger">
        <?= session()->getFlashdata('error') ?>
    </div>
<?php endif; ?>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>SKU</th>
            <th>Warehouse</th>
            <th>Quantity</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($products as $product): ?>
            <tr>
                <td>
                    <?= $product['id'] ?>
                </td>
                <td>
                    <?= $product['name'] ?>
                </td>
                <td>
                    <?= $product['sku'] ?>
                </td>
                <td>
                    <?= $product['warehouse_name'] ?>
                </td>
                <td>
                    <?= $product['quantity'] ?>
                </td>
                <td>
                    <a href="/products/edit/<?= $product['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                    <form action="/products/delete/<?= $product['id'] ?>" method="post" class="d-inline">
                        <?= csrf_field() ?>
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this product?')">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?= $this->endSection() ?>