<?php

namespace App\Http\Controllers;

use App\item;
use Illuminate\Http\Request;
use App\Shopping;
use Illuminate\Support\Carbon;

class ItemController extends Controller
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
    public function index(Shopping $shopping)
    {
        $shopping_id = $shopping->id;
        $items = Item::Where('shhping_list_id','=',$shopping_id)->latest()->paginate(5);

        return view('items.index',compact('items','shopping'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Shopping $shopping)
    {
        return view('items.create',compact('shopping'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Shopping $shopping)
    {

        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);
        Item::create($request->all());

        return redirect()->route('items.index',compact('shopping'))
            ->with('success','Item created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Shopping $shopping,Item $item)
    {
        return view('items.show',compact('item','shopping'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Shopping $shopping,Item $item)
    {
        return view('items.edit',compact('item','shopping'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shopping $shopping, Item $item)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $item->update($request->all());

        return redirect()->route('items.index',compact('shopping'))
            ->with('success','Item updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shopping $shopping,Item $item)
    {
        $item->delete();
        return redirect()->route('items.index',compact('shopping'))
            ->with('success','Item deleted successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function completed(Shopping $shopping,Item $item)
    {
        if($item->completed){
            $item->completed = 0;
            $item->completed_at = null;
        }else{
            $item->completed = 1;
            $item->completed_at = carbon::now();
        }

        $item->save();

        return redirect()->route('items.index',compact('shopping'))
            ->with('success','Item deleted successfully');
    }
}
