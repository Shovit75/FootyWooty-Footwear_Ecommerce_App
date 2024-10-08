<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Webuser;

class WebuserController extends Controller
{
    public function index(){
        $webuser = Webuser::all();
        return view('webusers.index', compact('webuser'));
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:255|unique:webusers,name',
            'password' => 'required|string|min:8',
        ]);
        $webuser = new Webuser;
        $webuser -> name = $request['name'];
        $webuser -> password = Hash::make($request['password']);
        $webuser->save();
        return redirect()->back();
    }

    public function edit($id){
        $webuser = Webuser::find($id);
        return view('webusers.edit', compact('webuser'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:8',
        ]);
        $webuser = Webuser::find($id);
        $webuser -> name = $request['name'];
        $webuser -> password = Hash::make($request['password']);
        $webuser->save();
        return redirect()->route('webuser.index');
    }

    public function delete($id){
        $webuser = Webuser::find($id);
        $webuser->delete();
        return redirect()->back();
    }

}
