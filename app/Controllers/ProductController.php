<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductModel;

class ProductController extends BaseController
{
    protected $productModel;
    public function __construct()
    {
        $this->productModel = new ProductModel();
    }

    public function index()
    {
        $data['products'] = $this->productModel->findAll();
        $data['pagination'] = $this->productModel->pager;
        return view('products/index', $data);
    }

    public function create()
    {
        return view('products/create');
    }

    public function store()
    {
        $input = $this->request->getpost();
        if ($this->productModel->insert($input)) {
            return redirect()->to('/products')->with('success', 'Product created successfully.');
        } else {
            return redirect()->back()->withInput()->with('errors', $this->productModel->errors());
        }
    }

    public function edit($id)
    {
        $data['product'] = $this->productModel->find($id);
        return view('products/edit', $data);
    }

    public function update($id)
    {
        $input = $this->request->getpost();
        if ($this->productModel->update($id, $input)) {
            return redirect()->to('/products')->with('success', 'Product updated successfully.');
        } else {
            return redirect()->back()->withInput()->with('errors', $this->productModel->errors());
        }
    }

    public function delete($id)
    {
        $this->productModel->delete($id);
        return redirect()->to('/products')->with('success', 'Product deleted successfully.');
    }
}
