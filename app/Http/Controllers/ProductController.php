<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ProductService;

class ProductController extends Controller
{
    protected $product;

    public function __construct()
    {
        $this->product = app()->make(ProductService::class);
    }

    public function index()
    {
        $list = $this->product->all();
        return $list;
    }

    public function store(Request $request)
    {
        $response = $this->product->add($request);
        return $response;
    }

    public function show($id)
    {
        $response = $this->product->search($id);
        return $response;
    }

    public function update(Request $request, $id)
    {
        $response = $this->product->edit($request, $id);
        return $response;
    }

    public function destroy($id)
    {
        $response = $this->product->delete($id);
        return $response;
    }
}
