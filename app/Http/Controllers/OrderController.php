<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\User;
use Carbon\Carbon;
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
        $result = Order::findOrFail($order);
        $this->authorize('view', $result);
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
        $this->authorize('create', Order::class);
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
        $this->authorize('create', Order::class);
        $data = request()->validate([
            'name' => ['required', 'string'],
            'body' => '',
            'status' => 'string',
            'estimated' => '',
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
        $this->authorize('viewAny', Order::class);
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
        $this->authorize('update', $order);
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
        $this->authorize('update', $order);
        $data = $request->validate([
            'name' => 'string|required',
            'body' => '',
            'status' => 'string',
            'Estimated' => '',
        ]);
        if(!empty($request->input('manager')))
        {
            $target = [$request->input('client'), $request->input('manager')];
        }
        else
        {
            $target = [$request->input('client')];
        }
        $order->updated_at = Carbon::now();
        $order->save();
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
    public function destroy(Order $order)
    {
        $this->authorize('destroy', $order);
    }
}
