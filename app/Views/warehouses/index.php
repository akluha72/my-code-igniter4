<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<h2>Warehouse List</h2>

<a href="/warehouses/create" class="btn btn-primary mb-3">Add Warehouse</a>
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
            <th>Location</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($warehouses as $warehouse): ?>
            <tr>
                <td>
                    <?= $warehouse['id'] ?>
                </td>
                <td>
                    <?= $warehouse['name'] ?>
                </td>
                <td>
                    <?= $warehouse['location'] ?>
                </td>
                <td>
                    <a href="/warehouses/edit/<?= $warehouse['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                    <form action="/warehouses/delete/<?= $warehouse['id'] ?>" method="post" class="d-inline">
                        <?= csrf_field() ?>
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this warehouse?')">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?= $this->endSection() ?>