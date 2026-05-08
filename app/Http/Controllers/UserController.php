<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{

    // User List
    public function UserList()
    {
       $response = User::whereNotNull('email')->get();
       //return response()->json($response);  
       session()->flash('welcome', 'Welcome to user List'); 
       return view('user_list', ['users'=>$response]);
    }
    //Add User
    public function userAdd()
    {
      return view('user_add');
    }

    public function createUser(Request $request)
{
    $request->validate([
        'name' => 'required|min:3|max:50',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
    ],[
        'name.required' => 'Name is required',
        'name.min' => 'Name must be at least 3 characters',
        'email.required' => 'Email is required',
        'email.email' => 'Email must be a valid email address',
        'email.unique' => 'Email already exists',
        'password.required' => 'Password is required',
        'password.min' => 'Password must be at least 6 characters',
        'image.image' => 'File must be an image',
        'image.mimes' => 'Image must be a file of type: jpeg, png, jpg, gif',
        'image.max' => 'Image size must be less than 2MB'
    ]);

    $imageName = null;

    // Upload Image
    if($request->hasFile('image'))
    {
        $image = $request->file('image');

        $imageName = time().'_'.rand(1111,9999).'.'.$image->getClientOriginalExtension();

        $destinationPath = public_path('uploads/users');

        // Create folder if not exists
        if(!file_exists($destinationPath))
        {
            mkdir($destinationPath, 0777, true);
        }

        // Move Image
        $image->move($destinationPath, $imageName);
    }

    // Save User
    User::create([

        'image' => $imageName,
        'img_alt' => $request->input('name'),
        'name' => $request->input('name'),
        'email' => $request->input('email'),
        'password' => bcrypt($request->input('password'))
    ]);

    return redirect()
            ->route('user.list')
            ->with('success', 'User created successfully');
}
    public function editUser(Request $request)
    {
        $id = $request->id;
        if($id != ''){
             $user = User::findOrFail($id);
             return view('user_add', ['user' => $user]);
        }
    }

    public function updateUser(Request $request)
    {
        $id = $request->id;
         
    $user = User::findOrFail($id);

    $request->validate([
        'name' => 'required|min:3|max:50',
        'email' => 'required|email|unique:users,email,' . $id,
    ]);

    $data = [
        'name' => $request->name,
        'email' => $request->email,
    ];

    // Password update only if filled
    if($request->password != '')
    {
        $data['password'] = bcrypt($request->password);
    }

    $user->update($data);

    return redirect()->route('user.list')
            ->with('success', 'User Updated Successfully');
}
    
    public function deleteUser(Request $request)
    {
        $id = $request->id;
        if($id != ''){
             $user = User::findOrFail($id);
             $user->delete();
             return redirect('user_list')->with('success', 'User Deleted');

        }
    }
}


