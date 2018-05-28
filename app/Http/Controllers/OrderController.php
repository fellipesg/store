<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Product;
use App\Client;
use App\User;
class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::with('products')->get();
        return view('order.index',compact('orders', 'clients', 'sellers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();
        $clients = Client::all();
        $seller = User::where('name', '=', 'Vendedor1')->get()[0];
        return view('order.create', compact('products', 'clients', 'seller'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $order = new Order();
        $order->description = $request->get('description');
        $products = $request->get('products');
        $saveProducts = [];
        foreach ($products as $key => $product) {
            $prod = Product::find($product['id']);
            $saveProducts[$key]['product'] = $prod;
            $saveProducts[$key]['quantity'] = $product['quantity'];
            $saveProducts[$key]['price'] = $product['price'];
        }
        $order->save();
        foreach ($saveProducts as $key => $saveProduct) {
            $order->products()->attach($saveProduct['product']->id, 
                [
                    'user_id'   =>  $order->user_id_fk,
                    'client_id' =>  $request->get('client'),
                    'user_id'   =>  $request->get('seller_id'),
                    'quantity'  =>  $saveProduct['quantity'],
                    'price'     =>  $saveProduct['price']
                ]
            );
        }
        return redirect('orders')->with('success', 'Pedido Cadastrado com Sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
