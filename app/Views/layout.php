<!DOCTYPE html>
<html>

<head>
    <title><?= $title ?? 'Warehouse System' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .navbar .nav-link.active {
            text-decoration: none;
            border-bottom: 2px solid #ffffff;
            padding-bottom: 4px;
        }
    </style>
</head>

<body>
    <?php
        $uri = service('request')->getUri();
        $segment1 = $uri->getSegment(1) ?? '';
        $isActive = function (string $segment) use ($segment1): bool {
            if ($segment === '') {
                return $segment1 === '';
            }
            return $segment1 === $segment;
        };
    ?>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url('/') ?>">Warehouse System</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar"
                aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mainNavbar">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link<?= $isActive('') ? ' active' : '' ?>" href="<?= base_url('/') ?>" <?= $isActive('') ? 'aria-current="page"' : '' ?>>Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link<?= $isActive('products') ? ' active' : '' ?>" href="<?= base_url('products') ?>" <?= $isActive('products') ? 'aria-current="page"' : '' ?>>Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link<?= $isActive('warehouses') ? ' active' : '' ?>" href="<?= base_url('warehouses') ?>" <?= $isActive('warehouses') ? 'aria-current="page"' : '' ?>>Warehouses</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link<?= $isActive('stocks') ? ' active' : '' ?>" href="<?= base_url('stocks') ?>" <?= $isActive('stocks') ? 'aria-current="page"' : '' ?>>Stocks</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <?= $this->renderSection('content') ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>