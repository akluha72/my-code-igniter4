<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<h2>Warehouse List</h2>

<a href="/warehouses/create" class="btn btn-primary mb-3">Add Warehouse</a>
<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success">
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Location</th>
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
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?= $this->endSection() ?>