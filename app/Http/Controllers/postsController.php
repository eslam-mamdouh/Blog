<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\post;
use Validator;
class postsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = post::paginate(5);
        return view("dashboard.posts" , ['posts'=>$posts]);
    }

    public function userHome(){
        $allPosts = post::all();
        return view("home" , ['allPosts'=>$allPosts]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all() ,[
            'title'=>"required",
            'description'=>"required",
            'content'=>"required",
            'category'=>"required|exists:categories,id",
        ]);
        if($validator->fails()){
            return back()->withErrors($validator , 'add');
        }

        $post = new post;
        $post->title       = $request->title;
        $post->content     = $request->content;
        $post->description = $request->description;
        $post->category_id = $request->category;
        $post->save();
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = post::find($id);
        if($post){
            return view("postDetails" ,['post'=>$post]);
        }
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = post::find($id);
        return response()->json($post);
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
        $validator = Validator::make($request->all() ,[
            'title'=>"required",
            'description'=>"required",
            'content'=>"required",
            'category'=>"required|exists:categories,id",
        ]);
        if($validator->fails()){
            session()->put('id',$id);
            return back()->withErrors($validator , 'edit');
        }

        $post = post::find($id);
        if($post){
            $post->title        = $request->title;
            $post->description  = $request->description;
            $post->content      = $request->content;
            $post->category_id  = $request->category;
            $post->update();
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
        $post = post::find($id);
        
        if($post){
            $post->delete();
        }
        return back();
    }
}
