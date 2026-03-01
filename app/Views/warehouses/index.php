<!DOCTYPE html>
<html>

<head>
    <title>Warehouses</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container mt-5">

    <h2>Warehouse List</h2>

    <a href="/warehouses/create" class="btn btn-primary mb-3">Add Warehouse</a>

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

</body>

</html>