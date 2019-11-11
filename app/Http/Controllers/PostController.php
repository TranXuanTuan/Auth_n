<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getList()
    {
        $posts = Post::orderBy('id','desc')->get();
        return view('admin.posts.list',['posts'=>$posts]);  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAdd()
    {
       return view('admin.posts.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postAdd(Request $request)
    {
        $this->validate($request,[
            'Title'=>'required|min:3|unique:posts,Title', 
            'Summary'=>'required',
            'Body'=>'required'
        ]);

        $posts = new Post;
        $posts->Title = $request->Title;
        $posts->Summary =$request->Summary;
        $posts->Body = $request->Body;
        $posts->View = 0;

        if($request->hasFile('Image'))
        {
            $file = $request->file("Image");
            $duoi = $file->getClientOriginalExtension();
            if($duoi != 'jpg' && $duoi !='png' && $duoi != 'jpeg')
            {
                return redirect('admin/posts/add')->with('loi','Only Image(jpg,png,jpeg)');
            }
            $name = $file->getClientOriginalName();
            $Image = str_random(4)."_".$name;
            while (file_exists("upload/post/".$Image)) 
            {
                $Image = str_random(4)."_".$name;
            }
            $file -> move("upload/post",$Image);
            $posts ->Image = $Image;
        }
        else
        {
            $posts->Image=" ";
        }
        $posts->save();

        return redirect('admin/posts/add')->with('flash_message','Post successfully added.');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getEdit($id)
    {
        $posts = Post::find($id);
        return view('admin.posts.edit',['posts'=>$posts]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function postEdit(Request $request, $id)
    {
        $posts = Post::find($id);
        $this->validate($request,[
            'Title'=>'required|min:3', 
            'Summary'=>'required',
            'Body'=>'required'
        ]);
        $posts->Title = $request->Title;
        $posts->Summary =$request->Summary;
        $posts->Body = $request->Body;

        if($request->hasFile('Image'))
        {
            $file = $request->file("Image");
            $duoi = $file->getClientOriginalExtension();
            if($duoi != 'jpg' && $duoi !='png' && $duoi != 'jpeg')
            {
                return redirect('admin/posts/add')->with('loi','Only Image(jpg,png,jpeg)');
            }
            $name = $file->getClientOriginalName();
            $Image = str_random(4)."_".$name;
            while (file_exists("upload/post/".$Image)) 
            {
                $Image = str_random(4)."_".$name;
            }

            $file -> move("upload/post",$Image);
            unlink("upload/post/".$posts->Image);
            $posts ->Image = $Image;
        }
        $posts->save();
        return redirect('admin/posts/edit/'.$id)-> with('flash_message','Post successfully edited.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getDelete($id)
    {
        $posts = Post::findorFail($id);
        $posts->delete();

        return redirect('admin/posts/list')->with('flash_message','Post successfully deleted.');
    }
}
