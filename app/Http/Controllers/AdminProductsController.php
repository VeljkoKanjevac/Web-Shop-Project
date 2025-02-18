<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class AdminProductsController extends Controller
{
    public function allProducts()
    {
        $allProducts = Products::all();

        return view('admin.products.all', compact('allProducts'));
    }
}
