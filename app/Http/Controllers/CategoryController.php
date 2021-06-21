<?php

namespace App\Http\Controllers;

use App\Category;
use App\Events\NewPostEvent;
use App\Notification;
use App\Services\CategoryService;
use App\Services\PostUtilService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PostUtilService $postUtilService)
    {
        //
        $categories = $postUtilService->getAllCategories();

        $user = request()->user();
        $n = Notification::where(["user_id" => auth()->user()->id, "read" => "no"])->get();
        
        
        return view("category.index", compact('categories', 'user', 'n'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $user = auth()->user();

        return view("category.create", compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, CategoryService $categoryService)
    {
        //
        return $categoryService->createCategory();
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
    public function update(Request $request, $id)
    {
        //
        $category = Category::findOrFail($id);
        
        $user = auth()->user()->categories()->whereId($id)->first();

        $input = [
            'name' => $request->name,
            'url' => $request->name,
        ];
        
        $user->update($input);

        return redirect()->back();
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
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->back();
    }
}
