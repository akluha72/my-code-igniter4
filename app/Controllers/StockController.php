<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\StockMovementModel;
use App\Models\ProductModel;

class StockController extends BaseController
{
    private function adjustProductQuantity(ProductModel $productModel, int $productId, int $delta): void
    {
        $product = $productModel->find($productId);
        if (!$product) {
            return;
        }

        $newQty = (int) $product['quantity'] + $delta;
        if ($newQty < 0) {
            $newQty = 0;
        }
        $product['quantity'] = $newQty;
        $productModel->save($product);
    }

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

    public function edit($id)
    {
        $stockModel = new StockMovementModel();
        $productModel = new ProductModel();

        $movement = $stockModel->find($id);
        if (!$movement) {
            return redirect()->to('/stocks')->with('error', 'Stock movement not found.');
        }

        $data['movement'] = $movement;
        $data['products'] = $productModel->findAll();
        return view('stocks/edit', $data);
    }

    public function update($id)
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
        $existing = $stockModel->find($id);
        if (!$existing) {
            return redirect()->to('/stocks')->with('error', 'Stock movement not found.');
        }

        $newProductId = (int) $this->request->getPost('product_id');
        $newQuantity = (int) $this->request->getPost('quantity');
        $newType = $this->request->getPost('type');

        $oldImpact = ($existing['type'] === 'IN') ? (int) $existing['quantity'] : -((int) $existing['quantity']);
        $newImpact = ($newType === 'IN') ? $newQuantity : -$newQuantity;

        if ((int) $existing['product_id'] === $newProductId) {
            $this->adjustProductQuantity($productModel, $newProductId, -$oldImpact + $newImpact);
        } else {
            $this->adjustProductQuantity($productModel, (int) $existing['product_id'], -$oldImpact);
            $this->adjustProductQuantity($productModel, $newProductId, $newImpact);
        }

        $stockModel->update($id, [
            'product_id' => $newProductId,
            'quantity' => $newQuantity,
            'type' => $newType
        ]);

        return redirect()->to('/stocks')->with('success', 'Stock movement updated successfully.');
    }

    public function delete($id)
    {
        $stockModel = new StockMovementModel();
        $productModel = new ProductModel();

        $existing = $stockModel->find($id);
        if (!$existing) {
            return redirect()->to('/stocks')->with('error', 'Stock movement not found.');
        }

        $oldImpact = ($existing['type'] === 'IN') ? (int) $existing['quantity'] : -((int) $existing['quantity']);
        $this->adjustProductQuantity($productModel, (int) $existing['product_id'], -$oldImpact);
        $stockModel->delete($id);

        return redirect()->to('/stocks')->with('success', 'Stock movement deleted successfully.');
    }

}
