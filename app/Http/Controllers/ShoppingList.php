<?php

namespace App\Http\Controllers;

use App\Shopping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShoppingList extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::user()->id;

        $shoppings = Shopping::Where('user_id', '=',$user_id)->latest()->paginate(5);

        return view('shopping-list.index',compact('shoppings'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('shopping-list.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        Shopping::create($request->all());

        return redirect()->route('shopping-list.index')
            ->with('success','Product created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Shopping $shopping_list)
    {
        return view('shopping-list.show',compact('shopping_list'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Shopping $shopping_list)
    {

        return view('shopping-list.edit',compact('shopping_list'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shopping $shopping_list)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $shopping_list->update($request->all());

        return redirect()->route('shopping-list.index')
            ->with('success','Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shopping $shopping_list)
    {
        $shopping_list->delete();
        return redirect()->route('shopping-list.index')
            ->with('success','Item deleted successfully');
    }
}
