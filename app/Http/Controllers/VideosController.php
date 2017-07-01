<?php

namespace App\Http\Controllers;

use Request;
use App\Video;
use App\Http\Requests;
use App\Http\Requests\CreateVideoRequest;
use Auth;
use Session;
use App\Category;
class VideosController extends Controller
{
    
	public function __construct()
	{
		$this->middleware('auth',['only'=>['create','edit']]);
	}

    public function index()
    {
    	$videos=Video::latest()->get();
    	//return $videos;
    	return view('videos.index',compact('videos'));
    }


    /**
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(int $id)
    {
    	$video=Video::findOrFail($id);
    	return view('videos.show',compact('video'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $categories=Category::pluck('name','id');
    	return view('videos.create',compact('categories'));
    }

    /**
     * @param CreateVideoRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(CreateVideoRequest $request)
    {
    	//$input=Request::all();
    	$video=new Video($request->all());
    	Auth::user()->videos()->save($video);
        $categoryIds=$request->input('CategoryList');
        $video->categories()->attach($categoryIds);
    	Session::flash('video_created','Twój film został dodany');
    	return redirect('videos');
    }


    /**
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(int $id)
    {
    	//$input=Request::all();
        $categories=Category::pluck('name','id');
    	$video=Video::findOrFail($id);
    	return view('videos.edit',compact('video','categories'));
    }

    /**
     * @param int $id
     * @param CreateVideoRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(int $id, CreateVideoRequest $request)
    {
    	$video=Video::findOrFail($id);
    	$video->update($request->all());
        $categoryIds=$request->input('CategoryList');
        $video->categories()->sync($categoryIds);
    	return redirect('videos');
    }
}
