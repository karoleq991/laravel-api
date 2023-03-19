<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\ShopResource;
use App\Models\Shop;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Auth;
use Validator;

class ShopController extends BaseController
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $shops = Shop::all();

        return $this->sendResponse(ShopResource::collection($shops), 'Shops retrieved successfully.');
    }
    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required',
            'address' => 'required',
            'postal_code' => 'required',
            'city' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $user=Auth::user();
        $input['user_id']=$user->id;
        $shop = Shop::create($input);

        return $this->sendResponse(new ShopResource($shop), 'Shop created successfully.');
    }

    /**
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $shop = Shop::find($id);

        if (is_null($shop)) {
            return $this->sendError('Shop not found.');
        }

        return $this->sendResponse(new ShopResource($shop), 'Shop retrieved successfully.');
    }

    /**

     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shop $shop)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required',
            'address' => 'required',
            'postal_code' => 'required',
            'city' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $user=Auth::user();
        $shop->name = $input['name'];
        $shop->address = $input['address'];
        $shop->postal_code = $input['postal_code'];
        $shop->city = $input['city'];
        $shop->user_id=$user->id;
        $shop->save();

        return $this->sendResponse(new ShopResource($shop), 'Shop updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shop $shop)
    {
        $shop->delete();

        return $this->sendResponse([], 'Shop deleted successfully.');
    }
}
