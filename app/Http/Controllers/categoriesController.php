<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\category;
use Validator;
class categoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $request = new Request;
        // $page = $request->page;
        // return $request->get('page')*5;
        // $items = 5;
        // if( $page > 1){
        //     $offset = $items * $page;
        //     $categories = category::offset($offset)->get();
        //     return $categories;
        //     if (!$categories) {
        //        return redirect('/dashboard/categories');
        //     }
        // }
        $categories = category::paginate(5);
        return view("dashboard.categories" , ['categories'=>$categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $validator = Validator::make($request->all(),[

            'categoryName'=>'required'
        ]);
         

        if($validator->fails()){
            return back()->withErrors($validator , 'add');
        }
        $category       = new category;
        $category->name = $request->categoryName;
        $category->save(); 
        return redirect('/dashboard/categories');
            

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $categoryFounded = category::find($id);
        if (!$categoryFounded) {
            return redirect("/");
        }
        $posts = $categoryFounded->posts;

        return view("relatedPosts" ,['posts'=>$posts]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = category::find($id);
        return response()->json($category);
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
        $validator = Validator::make($request->all(),[

            'categoryName'=>'required'
        ]);
        if($validator->fails()){
            session()->put('id',$id);
            return back()->withErrors($validator , 'edit');
        }

        $category = category::find($id);
        if($category){
            $category->name = $request->categoryName;
            $category->update();
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categoryPosts = category::find($id)->posts;

        if(count($categoryPosts) > 0){
            return back()->with(['categoryPosts'=>$categoryPosts]);
           }else {
            $category = category::find($id);
            $category->delete();
            return back();
        }
        
    }
}
