<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        if ($user) {
            $date = date('d.m.Y H:i:s');
            Storage::append('ownLog.log', "[HomePageEnter] $date {$user->name} зашел на страницу home");
        }

        $categories = Category::get();

        $data = [
            'categories' => $categories,
            'title' => 'Список категорий',
            'showTitle' => true
        ];
        return view('home', $data);
    }

    public function profile (Request $request)
    {
        // Auth::loginUsingId(1);
        $user = Auth::user();
         $addresses = Address::where('user_id', $user->id)->get();
        return view('profile', compact('user', 'addresses'));
    }

    public function profileUpdate (Request $request)
    {
        $request->validate([
            'picture' => 'mimes:jpg,bmp,png',
            'name' => 'required|max:255',
            'email' => 'required|email',
            'password' => 'nullable|confirmed|min:8',
        ]);

        $user = User::find(Auth::user()->id);
        $file = $request->file('picture');
        $input = $request->all();

        $currentPassword = Hash::make($input['current_password']);
        if ($input['password']) {
            $currentPassword = $input['current_password'];
            if (!Hash::check($currentPassword, request()->user()->password)) {
                session()->flash('currentPasswordError');
                return back();
            } else {
                $user->password = Hash::make($input['password']);
                $user->save();
            }
        }

        if ($file) {
            $ext = $file->getClientOriginalExtension();
            $fileName = time() . rand(1000, 9999) . '.' . $ext;
            $file->storeAs('public/img/users', $fileName);
            $user->picture = $fileName;
        }
    }


}
