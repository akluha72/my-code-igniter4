<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ProductModel;
use App\Models\WarehouseModel;

class ProductController extends BaseController
{
    public function index()
    {
        $productModel = new ProductModel();
        $data['products'] = $productModel->select('products.*, warehouses.name as warehouse_name')
            ->join('warehouses', 'products.warehouse_id = warehouses.id')
            ->findAll();
        return view('products/index', $data);
    }

    public function create()
    {
        $warehouseModel = new WarehouseModel();
        $data['warehouses'] = $warehouseModel->findAll();
        return view('products/create', $data);
    }

    public function store()
    {
        $rules = [
            'name' => 'required|min_length[3]',
            'sku' => 'required|min_length[3]',
            'warehouse_id' => 'required|integer',
            'quantity' => 'required|integer',
        ];

        if(!$this->validate($rules)){
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        
        $productModel = new ProductModel();
        $data = [
            'warehouse_id' => $this->request->getPost('warehouse_id'),
            'name' => $this->request->getPost('name'),
            'sku' => $this->request->getPost('sku'),
            'quantity' => $this->request->getPost('quantity')
        ];
        $productModel->insert($data);
        return redirect()->to('/products')->with('success', 'Product added successfully');
    }
}
