<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use App\User;

use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "User List";

        $items = User::all();

        return view('pages.user.index', [
            'title' => $title,
            'items' => $items
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Create New User";

        return view('pages.user.create', [
            'title' => $title
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $photo = $request->file('photo');

        $data = $request->all();
        
        if ($photo){
            $data['photo'] = $photo->store(
                'assets/user', 'public'
            );
        }else{
            $data['photo'] = "";
        }

        $data['password'] = Hash::make($data['password']);

        User::create($data);

        return redirect()->route('user.index')->with('success','User berhasil dibuat!');
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
        $title = "Edit User";

        $item = User::findOrFail($id);

        return view('pages.user.edit', [
            'title' => $title,
            'item' => $item
        ]);
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
        $validator = Validator::make($request->all(), [
            'photo' => 'image',
            'name' => 'required|string',
            'email' => 'required|email:rfc,dns|unique:users,email,' . $id . ',id',
            'password' => $request->input('password') ? 'min:8' : ''
        ]);

        if ($validator->fails()) {
            return redirect()->route('user.edit', $id)
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

        return redirect()->route('user.index')->with('success','User berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        
        return redirect()->route('user.index')->with('success','User berhasil dihapus!');
    }
}
