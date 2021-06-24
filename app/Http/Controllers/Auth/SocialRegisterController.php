<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Request;

class RegisterCompleteController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function showRegistrationForm()
    {
        $user = Auth::user();

        return view('auth.register_complete')->with('user', $user);
    }

    protected function update(Request $request)
    {
        $request->validate([
            'name' => ['string', 'max:30'],
            'username' => ['string', 'max:30', 'unique:users'],
            'password' => ['string', 'min:8', 'confirmed'],
        ]);

        $user = Auth::user();

        $user->update($request->all());

        return redirect()->route('user.my_profile');
    }
}
