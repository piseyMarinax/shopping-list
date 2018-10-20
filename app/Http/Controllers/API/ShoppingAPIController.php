<?php

namespace App\Http\Controllers\API;

use App\Shopping;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\API\APIBaseController as APIBaseController;
use Validator;

class ShoppingAPIController extends APIBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (isset($_GET['user_id'])) {
            // return shoping list with id
            $user_id = $_GET['user_id'];

            $user = User::find($user_id);
            if (is_null($user)) {
                return $this->sendError('User not found.');
            }

            $shoppings = Shopping::Where('user_id', '=',$user_id)->get();
            return $this->sendResponse($shoppings->toArray(), 'Shopping retrieved successfully.');
        }

        // return all shoping list
        $shoppings = Shopping::latest()->get();
        return $this->sendResponse($shoppings->toArray(), 'Shopping retrieved successfully.');


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'title' => 'required',
            'description' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $shopping = Shopping::create($input);

        return $this->sendResponse($shopping->toArray(), 'Post created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $shopping = Shopping::find($id);

        if (is_null($shopping)) {
            return $this->sendError('Post not found.');
        }

        return $this->sendResponse($shopping->toArray(), 'Shopping retrieved successfully.');
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
        $input = $request->all();

        $validator = Validator::make($input, [
            'title' => 'required',
            'description' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $shopping = Shopping::find($id);
        if (is_null($shopping)) {
            return $this->sendError('Post not found.');
        }

        $shopping->title = $input['title'];
        $shopping->description = $input['description'];
        $shopping->save();

        return $this->sendResponse($shopping->toArray(), 'Post updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $shopping = Shopping::find($id);

        if (is_null($shopping)) {
            return $this->sendError('Post not found.');
        }

        $shopping->delete();

        return $this->sendResponse($id, 'Shopping deleted successfully.');
    }
}
