<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MyController;
use App\Http\Controllers\UserController;
// middleware import
use App\Http\Middleware\CheckAge;



#Basic Route

Route::get('/', function () {
    return view('welcome');
});


// middleware route
Route::get('/check/{age}/{country}', function ($age, $country) {
    return 'This is age check page';
})->middleware('check1');



Route::get('/home', function () {
    return '<h1>This is home page</h1>';
});

#Route with Parameter
Route::get('user/{id}',function($id = null){
    return 'User id is: '.$id;
});
    #with default value
 Route::get('post/{id?}',function($id = null){
    return 'Post id is: '.$id;
});

#Named Route
Route::get('profile',function(){
    return 'This is profile page';
})->name('profile');

#route with multiple parameters
Route::get('product/{id}/{name}',function($id,$name){
    return 'Product id is: '.$id.' and name is: '.$name;
});

#route with regular expression constraints
Route::get('order/{id}',function($id){
    return 'Order id is: '.$id;
})->where('id','[0-9]+');   

#route with optional parameter
Route::get('category/{name?}',function($name = null){
    return 'Category name is: '.$name;
});

#route with multiple optional parameters
Route::get('blog/{id?}/{slug?}',function($id = null,$slug = null){
    return 'Blog id is: '.$id.' and slug is: '.$slug;
});

#route redirect
Route::redirect('/old-home','/home');


#Route Group
Route::prefix('admin')->group(function(){
    Route::get('/dashboard',function(){
        return 'This is admin dashboard';
    });
    Route::get('/settings',function(){
        return 'This is admin settings';
    });
});

#Route method List in comment

/*
Route::get($uri, $callback);
Route::post($uri, $callback);
Route::put($uri, $callback);
Route::patch($uri, $callback);
Route::delete($uri, $callback);
Route::options($uri, $callback);
*/
    
#Route with Controller
Route::get('/controller', [MyController::class, 'index']);
Route::get('/controller/{id}', [MyController::class, 'show']);
Route::get('/welcome', [MyController::class, 'welcome']);
Route::post('/store', [MyController::class, 'store']);
Route::get('/myhome/{name}', [MyController::class, 'home']);

// Route::get('/userCreate', [MyController::class, 'userCreate'])->name('user.create');
Route::post('/user/storeUser', [MyController::class, 'storeUser'])->name('user.store');


Route::get('/get-users', [MyController::class, 'getUsers']);
Route::get('/query', [MyController::class, 'query']);




######################USER-CRUD######################################
//userllist
Route::get('/user_list',[UserController::class,'userList'])->name('user.list');

//add user
Route::get('/user_add',[UserController::class,'userAdd'])->name('user.add');
Route::post('create_user',[UserController::class,'createUser'])->name('user.create');

//Modify user
Route::get('/user_edit',[UserController::class,'editUser'])->name('user.edit');
Route::post('/user_update',[UserController::class,'updateUser'])->name('user.update');

//Delete user
Route::get('/user_delete',[UserController::class,'deleteUser'])->name('user.delete');


######################USER-CRUD######################################