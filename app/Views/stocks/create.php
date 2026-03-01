<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<h2>Add Stock Movement</h2>

<?php if (session()->getFlashdata('errors')): ?>
    <div class="alert alert-danger">
        <?php foreach (session()->getFlashdata('errors') as $error): ?>
            <div>
                <?= $error ?>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<form action="/stocks/store" method="post">
    <?= csrf_field() ?>

    <div class="mb-3">
        <label>Product</label>
        <select name="product_id" class="form-control">
            <option value="">Select Product</option>
            <?php foreach ($products as $p): ?>
                <option value="<?= $p['id'] ?>" <?= old('product_id') == $p['id'] ? 'selected' : '' ?>>
                    <?= $p['name'] ?> (Qty:
                    <?= $p['quantity'] ?>)
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="mb-3">
        <label>Type</label>
        <select name="type" class="form-control">
            <option value="IN" <?= old('type') == 'IN' ? 'selected' : '' ?>>IN</option>
            <option value="OUT" <?= old('type') == 'OUT' ? 'selected' : '' ?>>OUT</option>
        </select>
    </div>

    <div class="mb-3">
        <label>Quantity</label>
        <input type="number" name="quantity" class="form-control" value="<?= old('quantity', 1) ?>">
    </div>

    <button class="btn btn-success">Save</button>
</form>

<?= $this->endSection() ?>