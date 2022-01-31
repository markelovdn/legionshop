<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    public function getAddress()
    {
        $user = Auth::user();
//        return $addresses = Address::where('user_id', $user->id)->get();
        return $user->addresses;
    }

    public function newAddress (Request $request)
    {
        $request->validate([
            'address' => 'required',
        ]);

//        $user = User::find(Auth::user()->id);
        $user = Auth::user();
        $input = $request->all();

        if (isset($input['mainAddress'])) {
            Address::where('user_id', $user->id)->where('main', '=', true)->update([
                'main' => false
            ]);
            $address = new Address();
            $address->user_id = $user->id;
            $address->address = $input['address'];
            $address->main = true;
            $address->save();

        } else {
            $address = new Address();
            $address->user_id = $user->id;
            $address->address = $input['address'];
            $address->main = false;
            $address->save();
        }
        return $user->addresses()->get();
//        return $this->getAddress();
    }

    public function updateAddress (Request $request, $id)
    {
        $user = User::find(Auth::user()->id);
        $input = $request->all();

        if (isset($input['setMain'])) {
            Address::where('user_id', $user->id)->where('main', '=', true)->update([
                'main' => false
            ]);
            Address::where('id', $id)->update([
                'main' => true
            ]);
        }
    }


}
