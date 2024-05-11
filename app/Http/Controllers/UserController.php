<?php

namespace App\Http\Controllers;

use App\Models\Provider;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        $providers=provider::all();
        return view('/admin/providers', compact('providers'));
        }     
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'nullable|string',
            'username' => 'nullable|string',
            'email' => 'required|email|unique:providers',
            'password' => 'required|string',
            'avatar' => 'nullable',
            'type' => 'boolean',
        ], [
            'first_name.required' => 'The first name field is required.',
            'phone.required' => 'The phone number field is required.',
            'phone.unique' => 'The phone number has already been taken.',
            'password.required' => 'The password field is required.',
            'type.boolean' => 'The type field must be true or false.',
        ]);
        $request->merge(['type' => 0]);    
        $provider = Provider::create($request->all());
    
        if ($request->has('password')) {
            $provider->password = bcrypt($request->input('password'));
            $provider->save();
        }
    
        if ($request->hasFile('avater')) {
            $avatar = $request->file('avater');
            $avatarName = time() . '.' . $avatar->getClientOriginalExtension();
            $avatar->move(public_path('avaters'), $avatarName);
            $avatarPath = 'avaters/' . $avatarName;
            $provider->avater = $avatarPath;
            $provider->save();
        }
    
        toastr()->success(' Data Added Success  ');
        return back();
        }
    

        public function update(Request $request, $id)
        {
            $request->validate([
                'first_name' => 'string|required',
                'last_name' => 'nullable|string',
                'username' => 'nullable|string',
                'password' => 'string',
                'email' => 'email|required',
                'type' => 'boolean',
            ], [
                'first_name.string' => 'The first name must be a string.',
                'last_name.string' => 'The last name must be a string.',
                'username.string' => 'The username must be a string.',
                'type.boolean' => 'The type field must be true or false.',
            ]);        
            $provider = Provider::findOrFail($id);
            $provider->update($request->all());
            if ($request->has('password')) {
                $provider->password = bcrypt($request->input('password'));
                $provider->save();
            }
            if ($request->hasFile('avater')) {
                $avatar = $request->file('avater');
                $avatarName = time() . '.' . $avatar->getClientOriginalExtension();
                $avatar->move(public_path('avaters'), $avatarName);
                $avatarPath = 'avaters/' . $avatarName;
                $provider->avater = $avatarPath;
                $provider->save();
            }
            toastr()->success('  Data Added Success ');
            return back();
                }
        

    public function destroy($id)
    {
        $provider = Provider::findOrFail($id);
        $provider->delete();
        toastr()->success(' Data Deleted Success  ');
        return back();    
    }
}

