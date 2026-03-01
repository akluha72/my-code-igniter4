<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<h2>Stock Movements</h2>
<a href="/stocks/create" class="btn btn-primary mb-3">Add Movement</a>

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
            <th>Product</th>
            <th>Type</th>
            <th>Quantity</th>
            <th>Date</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($movements as $m): ?>
            <tr>
                <td>
                    <?= $m['id'] ?>
                </td>
                <td>
                    <?= $m['product_name'] ?>
                </td>
                <td>
                    <?= $m['type'] ?>
                </td>
                <td>
                    <?= $m['quantity'] ?>
                </td>
                <td>
                    <?= $m['created_at'] ?>
                </td>
                <td>
                    <a href="/stocks/edit/<?= $m['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                    <form action="/stocks/delete/<?= $m['id'] ?>" method="post" class="d-inline">
                        <?= csrf_field() ?>
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this movement?')">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?= $this->endSection() ?>