<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\StockMovementModel;
use App\Models\ProductModel;

class StockController extends BaseController
{
    public function index()
    {
        $stockModel = new StockMovementModel();
        $data['movements'] = $stockModel->select('stock_movements.*, products.name as product_name')
            ->join('products', 'products.id = stock_movements.product_id')
            ->orderBy('stock_movements.created_at', 'DESC')
            ->findAll();

        return view('stocks/index', $data);
    }


    public function create()
    {
        $productModel = new ProductModel();
        $data['products'] = $productModel->findAll();
        return view('stocks/create', $data);
    }


    public function store()
    {
        $rules = [
            'product_id' => 'required|integer',
            'quantity' => 'required|integer|greater_than[0]',
            'type' => 'required|in_list[IN,OUT]'
        ];


        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $stockModel = new StockMovementModel();
        $productModel = new ProductModel();

        $productId = $this->request->getPost('product_id');
        $quantity = $this->request->getPost('quantity');
        $type = $this->request->getPost('type');

        //save stock movement
        $stockModel->save([
            'product_id' => $productId,
            'quantity' => $quantity,
            'type' => $type
        ]);

        //update product quantity
        $product = $productModel->find($productId);

        if ($type === 'IN') {
            $product['quantity'] += $quantity;
        } else {
            $product['quantity'] -= $quantity;
            if ($product['quantity'] < 0)
                $product['quantity'] = 0; // prevent negative stock
        }
        $productModel->save($product);
        return redirect()->to('/stocks')->with('success', 'Stock movement recorded successfully.');

    }

}
