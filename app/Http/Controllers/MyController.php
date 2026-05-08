<?php


//1. What is Controller in Laravel?
// A Controller is a class that handles the logic for a specific part of your application. It receives requests and returns responses.


//2. How to create a Controller in Laravel?
// You can create a Controller using the Artisan command-line tool. Run the following command in your terminal:
// php artisan make:controller MyController

//



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MyController extends Controller
{
    #basic controller methods
    public function index(){
        return 'This is index method';  
    }
    #controller method with parameter
    public function show($id){
        return 'This is show method with id: '.$id;  
    }
    #call view from controller
    public function welcome(){
        return view('welcome'); 
    }
    #controller method with request
    public function store(Request $request){
        return 'This is store method with request data: '.$request->input('name');
    }


    #call home page from controller
    // public function home(Request $request){
    //     $name = $request->input('name');
    //     return view('home', compact('name') );

    // }

       public function home($name){

        return view('home', ['name' => $name]);
            
    }

    public function userCreate()
    {
        return view('user.create');
    }

    public function storeUser(Request $request)
    {
        ////|email|unique:users,email',
        // validation and custom validation messages
        $request->validate([
            'name' => 'required|min:3|max:50',
            'email' => 'required',
            'password' => 'required|min:6'
        ],[
            'name.required' => 'Name is required',
            'name.min' => 'Name must be at least 3 characters',
            'name.max' => 'Name must not exceed 50 characters',
            'email.required' => 'Email is required',
            'password.required' => 'Password is required',
            'password.min' => 'Password must be at least 6 characters'
        ]);

        // Data Save (example)
        // User::create($request->all());
        return $request->all();
        //return redirect()->back()->with('success', 'User Created!');
    }


    public function getUsers(){
        // return DB::table('users')->get();
        $users = DB::table('users')->get();
        return view('user.userList',['users' => $users]); 
    }
    // Query Builder
    public function query(){

        #select all records & where condition
        // $response = DB::table('users')->get();
        // $response = DB::table('users')->where('id',1)->Orwhere('name', 'anuj')->get();
        // $response = DB::table('users')->first();
        // $response = DB::table('users')->select('id', 'name', 'email')->get();
        #updaterecord
        // $response = DB::table('users')->where('id', 1)->update(['name' => 'Updated Name']);
        #delete record
        // $response = DB::table('users')->where('id', 1)->delete();
        #Ordering 
        // $response = DB::table('users')->orderBy('created_at', 'desc')->get();
        // Limit and offset
        // $response = DB::table('users')->skip(1)->take(2)->get();
        // $response = DB::table('users')->limit(10)->offset(5)->get();
        #Join
        // $response = DB::table('users')->join('posts', 'users.id', '=', 'posts.user_id')
        // ->select('users.name', 'posts.title')->get();
        #Aggregates
        // $count = DB::table('users')->count();
        // $max   = DB::table('users')->max('age');
        // $avg   = DB::table('users')->avg('age');
            // $response = [
            //     'count' => $count,
            //     // 'max' => $max,
            //     // 'avg' => $avg
            // ];

        #Group By
        // $users = DB::table('users')->select('role', DB::raw('count(*) as total'))->groupBy('role')->get();
        #Pagination
        $response = DB::table('users')->paginate(10);
        return response()->json($response);   
    }

}
