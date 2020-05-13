<?php

namespace App\Http\Controllers;

use App\Seller;
use App\ShopSeller;
use App\User;
use Illuminate\Http\Request;
use Validator;

class SellerController extends Controller
{
    /**
     * Register a new user
     */
    public function register(Request $request)
    {
        $v = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password'  => 'required|min:3',
            'shipping_id'  => 'required',
            'payment_id'  => 'required',
            'shops'  => 'required',
        ]);
        if ($v->fails())
        {
            return response()->json([
                'status' => 'error',
                'errors' => $v->errors()
            ], 422);
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        if (isset($request->logo)) {
            if(!$request->hasFile('logo')) {
                return response()->json(['upload_file_not_found'], 400);
            }
            $file = $request->file('logo');
            if(!$file->isValid()) {
                return response()->json(['invalid_file_upload'], 400);
            }
            $path = public_path() . '/uploads/images/store/';
            $file_name = $user->id . '_' . date("mdYHis");
            $route = '/uploads/images/store/' . $file_name . '.' . $file->getClientOriginalExtension();
            $file->move($path, $file_name . '.' . $file->getClientOriginalExtension());
        }

        $seller = new Seller();
        $seller->logo_url = $route ?? '';
        $seller->name = $request->name;
        $seller->description = $request->description ?? '';
        $seller->shipping_id = $request->shipping_id;
        $seller->payment_id = $request->payment_id;
        $seller->user_id = $user->id;
        $seller->save();

        foreach ($request->shops as $key => $value) {
            $shop_seller = new ShopSeller();
            $shop_seller->seller_id = $seller->id;
            $shop_seller->shop_id = $value['shop_id'];
            $shop_seller->url = $value['url'];
            $shop_seller->primary = $value['primary'] == 'true' ? 1 : 0;
            $shop_seller->save();
        }

        return response()->json(['status' => 'success'], 200);
    }

    public function me()
    {
        $user = auth()->user();
        $seller = $user->seller;
        $seller->shops;
        $seller->payments;
        $seller->shippings;

        foreach ($seller->shops as $key => $value) {
            $value->shops;
        }
        //dd($seller->payments()->toSql());
        return response()->json(['status' => 'success',  'seller' => $seller], 200);
    }
}
