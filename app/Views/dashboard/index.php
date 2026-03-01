<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<h2 class="mb-4">Warehouse Dashboard</h2>

<div class="row mb-4">
    <!-- Warehouse summary card -->
    <div class="col-md-6">
            <div class="card border-primary">
                <div class="card-header bg-primary text-white">
                    Warehouse Summary
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <?php foreach ($warehouseSummary as $ws): ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <?= $ws['warehouse'] ?>
                                <span>
                                    Products: <strong><?= $ws['totalProducts'] ?></strong>,
                                    Total Qty: <strong><?= $ws['totalQuantity'] ?></strong>
                                </span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>

    <!-- Low-stock alert card -->
    <div class="col-md-6">
        <div class="card border-danger">
            <div class="card-header bg-danger text-white">
                Low-stock Products (Qty < 5) </div>
                    <div class="card-body">
                        <?php if ($lowStock): ?>
                            <ul class="list-group">
                                <?php foreach ($lowStock as $p): ?>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <?= $p['name'] ?> (Warehouse ID: <?= $p['warehouse_id'] ?>)
                                        <span class="badge bg-danger rounded-pill"><?= $p['quantity'] ?></span>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php else: ?>
                            <p class="text-success">No low-stock products!</p>
                        <?php endif; ?>
                    </div>
            </div>
        </div>
    </div>

    <!-- Recent stock movements table -->
    <div class="card">
        <div class="card-header bg-secondary text-white">
            Recent Stock Movements
        </div>
        <div class="card-body table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Warehouse</th>
                        <th>Type</th>
                        <th>Quantity</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($recentMovements as $m): ?>
                        <tr>
                            <td><?= $m['product_name'] ?></td>
                            <td><?= $m['warehouse_name'] ?></td>
                            <td>
                                <?php if ($m['type'] == 'IN'): ?>
                                    <span class="badge bg-success"><?= $m['type'] ?></span>
                                <?php else: ?>
                                    <span class="badge bg-warning text-dark"><?= $m['type'] ?></span>
                                <?php endif; ?>
                            </td>
                            <td><?= $m['quantity'] ?></td>
                            <td><?= $m['created_at'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <?= $this->endSection() ?>