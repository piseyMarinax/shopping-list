<?php

namespace App\Http\Controllers\API;

use App\Item;
use App\Shopping;
use Illuminate\Http\Request;
use App\Http\Controllers\API\APIBaseController as APIBaseController;
use Validator;

class ItemAPIController extends APIBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Shopping $shopping)
    {
        $shopping_id = $shopping->id;
        $items = Item::Where('shhping_list_id','=',$shopping_id)->latest()->get();
        return $this->sendResponse($items->toArray(), 'Item retrieved successfully.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Shopping $shopping)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'title' => 'required',
            'description' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $item = Item::create($input);

        return $this->sendResponse($item->toArray(), 'Post created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Shopping $shopping,Item $item)
    {

        if (is_null($item)) {
            return $this->sendError('Post not found.');
        }

        return $this->sendResponse($item->toArray(), 'Shopping retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shopping $shopping, Item $item)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'title' => 'required',
            'description' => 'required'
        ]);


        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }


        $item = Item::find($item->id);
        if (is_null($item)) {
            return $this->sendError('Post not found.');
        }


        $item->title = $input['title'];
        $item->description = $input['description'];
        $item->update_by = $input['update_by'];
        $item->save();

        return $this->sendResponse($item->toArray(), 'Post updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shopping $shopping,Item $item)
    {

        $shopping = Shopping::find($shopping->id);
        if (is_null($shopping)) {
            return $this->sendError('Post not found.');
        }

        $item = Item::find($item->id);

        if (is_null($item)) {
            return $this->sendError('Post not found.');
        }



        $item->delete();

        return $this->sendResponse($item, 'Shopping deleted successfully.');
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

        return $this->sendResponse($item, 'Shopping deleted successfully.');
    }

}
