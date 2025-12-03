<?php
namespace App\Models;
use CodeIgniter\Model;
class ProductModel extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'description', 'price', 'stock'];
    protected $useTimestamps = true;
    protected $useSoftDeletes = true;
    protected $deletedField = 'deleted_at';
    protected $returnType = 'array';
    protected $perPage = 10;

    protected $validationRules = [
        'name'        => 'required|min_length[3]|max_length[255]',
        'price'       => 'required|decimal',
        'stock'       => 'permit_empty|is_natural',
    ];

    protected $validationMessages = [
        'name' => [
            'required' => 'Please enter a product name.',
        ],
        'price' => [
            'decimal' => 'Enter a valid price (e.g., 99.99).',
        ]
    ];
}