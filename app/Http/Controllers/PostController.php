<?php

namespace App\Http\Controllers;

use App\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(){
        $datas = Post::all();
        return view('post.index', ['datas' => $datas]);
    }

    public function create(Request $request){
        $this->validate($request,[
            'title' => 'required|max:30',
            'author' => 'required',
            'content' => 'required',
        ]);

        if($request->has('draft')){
            $status = 'draft';
        }else{
            $status = 'published';
        }

//
//        $data = Post::create([
//            'title' => $request->title,
//            'content' => $request->content,
//            'status' => $status,
//            'published_at' => Carbon::create($request->published_at),
//            'created_by' => 1
//        ]);

        $data = Post::create(array_merge($request->all(),
            [
                'status' => $status,
                'published_at' => Carbon::create($request->published_at),
                'created_by' => 1
            ]
        ));

        return redirect()->back();
    }

    public function update($id){
        $datas = Post::findOrFail($id);

        return view('post.update',['datas' => $datas]);
    }

    public function store(Request $request){
        $data = Post::findOrFail($request->id);

        $this->validate($request,[
            'title' => 'required|max:30',
            'author' => 'required',
            'content' => 'required',
        ]);

        if($request->has('draft')){
            $status = 'draft';
        }else{
            $status = 'published';
        }

        $data->update(array_merge($request->all(),
            [
                'status' => $status,
                'published_at' => Carbon::create($request->published_at),
                'created_by' => 1
            ]
        ));

        return redirect()->route('post_index');
    }


    public function delete(Request $request){
        $data = Post::findOrFail($request->id);

        $data->delete();

        return redirect()->route('post_index');
    }
}
