<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\OrderService;

class OrderController extends Controller
{
    protected $order;

    public function __construct()
    {
        $this->order = app()->make(OrderService::class);
    }

    public function index()
    {
        $list = $this->order->all();
        return $list;
    }

    public function store(Request $request)
    {
        $response = $this->order->add($request);
        return $response;
    }

    public function show($id)
    {
        $response = $this->order->search($id);
        return $response;
    }

    public function update(Request $request, $id)
    {
        $response = $this->order->edit($request, $id);
        return $response;
    }

    public function destroy($id)
    {
        $response = $this->order->delete($id);
        return $response;
    }
}
