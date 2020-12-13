<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\User;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($order)
    {
        //
        $result = Order::findOrFail($order);
        if(!empty($result->user->where('type', 'Manager'))) $manager = $result->user->where('type', 'Manager')->first();
        return view('orders.index', [
            'order' => $result,
            'manager' => $manager,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
                //
        return view('orders.create', [
            'users' => User::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = request()->validate([
            'name' => ['required', 'string'],
            'body' => '',
        ]);
        $users = \App\User::find($request->input('user_id'));

        $result = Order::create($data);
        $result->user()->attach($users);
        return redirect('/order/' . $result->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('orders.show', [
            'orders' => Order::all(),
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        if(!empty($order->user->where('type', 'Manager'))) $manager = $order->user->where('type', 'Manager')->first();
        return view('orders.edit', [
            'order' => $order,
            'users' => User::all(),
            'manager' => $manager,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Order $order)
    {
        $data = $request->validate([
            'name' => 'string|required',
            'body' => 'string'
        ]);
        if(!empty($request->input('manager')))
        {
            $target = [$request->input('client'), $request->input('manager')];
        }
        else
        {
            $target = [$request->input('client')];
        }
        $order->update($data);
        $order->user()->sync($target);
        return redirect("/order/{$order->id}");
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
