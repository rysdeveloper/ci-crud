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

    public function import()
    {
        if ($this->request->is('post')) {
            $file = $this->request->getFile('csv_file');
            if (!$file->isValid() || $file->getExtension() !== 'csv') {
                return redirect()->back()->with('errors', ['Please upload a valid CSV file.']);
            }
            $handle = fopen($file->getTempName(), 'r');
            if ($handle === false) {
                return redirect()->back()->with('errors', ['Unable to open uploaded CSV file.']);
            }

            $rawHeader = fgetcsv($handle);
            if ($rawHeader === false) {
                fclose($handle);
                return redirect()->back()->with('errors', ['CSV file is empty or malformed.']);
            }

            // Normalize header: trim, lowercase and remove BOM from first column
            $rawHeader[0] = preg_replace('/^\xEF\xBB\xBF/', '', $rawHeader[0]);
            $header = array_map(function ($h) {
                return strtolower(trim($h));
            }, $rawHeader);

            $required = ['name', 'description', 'price', 'stock'];
            $missing = array_diff($required, $header);
            if (!empty($missing)) {
                fclose($handle);
                return redirect()->back()->with('errors', ['CSV is missing required columns: ' . implode(', ', $missing)]);
            }

            $errors = [];
            $count = 0;
            $line = 2; // first data row number

            while (($row = fgetcsv($handle)) !== false) {
                // Ensure row has same number of columns as header
                if (count($row) < count($header)) {
                    $row = array_pad($row, count($header), null);
                }

                $assoc = array_combine($header, $row);

                $name = trim($assoc['name'] ?? '');
                $rawPrice = trim((string) ($assoc['price'] ?? ''));
                $rawStock = trim((string) ($assoc['stock'] ?? ''));

                // Try to clean common price formats: remove currency symbols and thousand separators
                $cleanPrice = preg_replace('/[^0-9.,\-]/', '', $rawPrice);
                // If both comma and dot present, assume comma is thousands separator
                if (strpos($cleanPrice, ',') !== false && strpos($cleanPrice, '.') !== false) {
                    $cleanPrice = str_replace(',', '', $cleanPrice);
                } else {
                    // Replace comma with dot if comma used as decimal separator
                    if (substr_count($cleanPrice, ',') === 1 && substr_count($cleanPrice, '.') === 0) {
                        $cleanPrice = str_replace(',', '.', $cleanPrice);
                    }
                }
                // Remove any remaining commas
                $cleanPrice = str_replace(',', '', $cleanPrice);

                $priceIsNumeric = $cleanPrice !== '' && is_numeric($cleanPrice);

                if ($name === '' || !$priceIsNumeric) {
                    $errors[] = "Line {$line}: Invalid data for product '{$name}' — raw price='{$rawPrice}' — row=" . implode(',', $row);
                    $line++;
                    continue;
                }

                $priceVal = (float) $cleanPrice;
                $stockVal = $rawStock === '' ? 0 : (int) preg_replace('/[^0-9\-]/', '', $rawStock);

                $data = [
                    'name' => $name,
                    'description' => $assoc['description'] ?? '',
                    'price' => number_format($priceVal, 2, '.', ''),
                    'stock' => $stockVal,
                ];

                if ($this->productModel->insert($data) === false) {
                    $modelErrors = $this->productModel->errors();
                    $errors[] = 'Failed to import ' . $name . ': ' . implode('; ', $modelErrors ?: ['unknown error']) . ' — row=' . implode(',', $row);
                    $line++;
                    continue;
                }

                $count++;
                $line++;
            }

            fclose($handle);

            $msg = $count . ' products imported.';
            if (!empty($errors)) {
                return redirect()->back()->with('errors', $errors)->with('success', $msg);
            }

            return redirect()->to('/products')->with('success', $msg);
        }
        return view('products/import');
    }
    public function index()
    {
        $data['products'] = $this->productModel->paginate();
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
        $data['product'] = $this->productModel->find($id);
        return view('products/delete', $data);
    }

    public function destroy($id)
    {
        $this->productModel->delete($id);
        return redirect()->to('/products')->with('success', 'Product deleted successfully.');
    }
}
