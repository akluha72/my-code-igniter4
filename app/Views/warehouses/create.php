<!DOCTYPE html>
<html>

<head>
    <title>Create Warehouse</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container mt-5">

    <h2>Add Warehouse</h2>

    <form action="/warehouses/store" method="post">
        <?= csrf_field() ?>

        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="<?= old('name') ?>">
        </div>

        <div class="mb-3">
            <label>Location</label>
            <input type="text" name="location" class="form-control" value="<?= old('location') ?>">
        </div>

        <button class="btn btn-success">Save</button>
    </form>
    <?php if (session()->getFlashdata('errors')): ?>
        <div class="alert alert-danger">
            <?php foreach (session()->getFlashdata('errors') as $error): ?>
                <div>
                    <?= $error ?>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>
</body>

</html>