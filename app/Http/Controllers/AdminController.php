<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\Comment;
use App\Role;
use App\User;

class AdminController extends Controller
{
    //

    public function index()
    {
        $user = auth()->user();
        $postCount = Post::count();
        $categoryCount = Category::count();
        $commentCount = Comment::count();
        $users = User::all();


        if($user->role === "admin"){
         return view('admin.index', compact('postCount', 'categoryCount', 'commentCount', 'users', "user"));

    }
    return "You are not permitted to access this page";

}

public function users(){
    $users = User::all();
    $user = auth()->user();

    return view('admin.users.index', compact('users', "user"));
}

public function create () {
    $roles = Role::all();
    return view("admin.users.create", compact('roles'));
}

public function store(Request $request) {

    if(trim($request->password) == ''){
        $input = $request->except('password');
    }else{
        $input = $request->all();
        $input['password'] = bCrypt($request->password);
    }      
    
     User::create($input);

     return redirect('/admin/');

}

public function edit ($id) {
    $roles = Role::all();
    $user = User::where(["id" => $id])->first();
    return view("admin.users.edit", compact('user', 'roles'));
}

public function update($id, Request $request) {

    $user = User::findOrFail($id);
    if(trim($request->password) == ''){
        $input = $request->except('password');
    }else{
        $input = $request->all();
        $input['password'] = bCrypt($request->password);
    }      
    
     $user->update($input);

     return redirect('/admin/users/index');

}

}
