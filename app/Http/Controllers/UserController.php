<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $users = User::latest()->get();
        return view('welcome', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:4',
            'email' => 'required|unique:users|max:255',
        ]);

        //return $request->all();

        $user = new User;
        $user->name = $request->name; 
        $user->email = $request->email;        
        $user->save();

        if ($user) {
            Session::flash('flash_message', 'User successfully Created!');
            return redirect()->route('user.index');
        } else {
            Session::flash('flash_message', 'Something Went Wrong :(');
            return redirect()->route('user.index');
        }
 

        
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
        return view('show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('edit', compact('user'));
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
        $request->validate([
            'name' => 'required|min:4',
            'email' => 'required',
        ]);

        //return $request->all();

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        if ($user) {
            Session::flash('flash_message', 'User successfully Updated!');
            return redirect()->route('user.index');
        } else {
            Session::flash('flash_message', 'Something Went Wrong :(');
            return redirect()->route('user.index');
        }
 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id)->delete();

        if ($user) {
            Session::flash('flash_message', 'User successfully Deleted!');
            return redirect()->route('user.index');
        }
        else{
            Session::flash('flash_message', 'Something Went Wrong :(');
            return redirect()->route('user.index');
        }
    }
}
