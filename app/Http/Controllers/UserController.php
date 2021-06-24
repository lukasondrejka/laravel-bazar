<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManagerStatic as Image;

class UserController extends Controller
{

    public function edit()
    {
        $user = Auth::user();
        //return $user;
        $products = \App\Product::all();
        return view('user.user_edit', ['user' => $user, 'products' => $products, ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        return view('user.user', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //$user = User::find($user = Auth::user()->id);
        $user = Auth::user();
        //dd($request->all());
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->bio = $request->bio;

        //return redirect()->route('product', 'id', $id)->with('success', 'Post has been updated successfully!');
        //dd(alpha_num_localised_characters_plus_allowed_html_tags($request->description));
        if($request->hasFile('avatar')){
            $avatar = $request->file('avatar');
            $path = public_path('avatar/');
            $filename = time() . rand(11, 999999);
            $extension = '.' . $avatar->getClientOriginalExtension();


            //if (!file_exists(public_path('avatar/'))) mkdir( public_path('avatar/'), 666, true);

            $image = Image::make($avatar);
            $image->fit(250, 250)->save( $path . $filename . $extension);
            $image->resize(50, 50)->save( $path . $filename . '-small' . $extension);

            $user->avatar = $filename . $extension;
        }

        $user->save();

        return redirect()->route('user.edit');
    }


    public function avatarDestroy()
    {
        $user = Auth::user();
        $user->avatar = null;
        $user->save();

        return redirect()->route('user.edit');
    }
}
