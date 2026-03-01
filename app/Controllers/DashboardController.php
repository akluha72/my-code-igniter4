<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ProductModel;
use App\Models\StockMovementModel;
use App\Models\WarehouseModel;
class DashboardController extends BaseController
{
    public function index()
    {
        $productModel = new ProductModel();
        $stockModel = new StockMovementModel();
        $warehouseModel = new WarehouseModel();

        //low stock products alert
        $data['lowStock'] = $productModel->where('quantity < ', 10)->findAll();

        // recent stock movements
        $data['recentMovements'] = $stockModel
            ->select('stock_movements.*, products.name as product_name, warehouses.name as warehouse_name')
            ->join('products', 'products.id = stock_movements.product_id')
            ->join('warehouses', 'warehouses.id = products.warehouse_id')
            ->orderBy('stock_movements.created_at', 'DESC')
            ->findAll();

        // warehouse overview
        $warehouses = $warehouseModel->findAll();
        $summary = [];
        foreach ($warehouses as $wh) {
            $products = $productModel->where('warehouse_id', $wh['id'])->findAll();
            $totalQty = array_sum(array_column($products, 'quantity'));
            $summary[] = [
                'warehouse' => $wh['name'],
                'totalProducts' => count($products),
                'totalQuantity' => $totalQty
            ];
        }
        $data['warehouseSummary'] = $summary;
        // dd($data['warehouseSummary']);

        return view('dashboard/index', $data);
    }
}
