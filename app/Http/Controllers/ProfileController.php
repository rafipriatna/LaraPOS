<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use\App\User;
use\Auth;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "My Profile";

        $item = User::findOrFail(Auth::user()->id);

        return view('pages.profile.index', [
            'title' => $title,
            'item' => $item
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $id = Auth::user()->id;

        $validator = Validator::make($request->all(), [
            'photo' => 'image',
            'name' => 'required|string',
            'email' => 'required|email:rfc,dns|unique:users,email,' . $id . ',id',
            'password' => $request->input('password') ? 'min:8' : ''
        ]);

        if ($validator->fails()) {
            return redirect()->route('profile.index')
                        ->withErrors($validator)
                        ->withInput();
        }

        $photo = $request->file('photo');
        $password = $request->input('password');

        if ($password){
            $data = $request->all();
            $data['password'] = Hash::make($data['password']);
        }else{
            $data = $request->except('password');
        }
        
        if ($photo){
            $data['photo'] = $photo->store(
                'assets/user', 'public'
            );
        }

        User::findOrFail($id)->update($data);

        return redirect()->route('profile.index')->with('success','Berhasil memperbarui profil');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
