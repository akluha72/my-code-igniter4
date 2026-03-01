<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<h2>Edit Warehouse</h2>

<?php if (session()->getFlashdata('errors')): ?>
    <div class="alert alert-danger">
        <?php foreach (session()->getFlashdata('errors') as $error): ?>
            <div>
                <?= $error ?>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<form action="/warehouses/update/<?= $warehouse['id'] ?>" method="post">
    <?= csrf_field() ?>

    <div class="mb-3">
        <label>Name</label>
        <input type="text" name="name" class="form-control" value="<?= old('name', $warehouse['name']) ?>">
    </div>

    <div class="mb-3">
        <label>Location</label>
        <input type="text" name="location" class="form-control" value="<?= old('location', $warehouse['location']) ?>">
    </div>

    <button class="btn btn-success">Update</button>
    <a href="/warehouses" class="btn btn-secondary">Cancel</a>
</form>

<?= $this->endSection() ?>
