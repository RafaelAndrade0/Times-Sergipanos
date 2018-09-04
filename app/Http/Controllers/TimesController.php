<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\time;
use Storage;

class TimesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $times = time::all();
        $times = time::orderBy('title', 'asc')->paginate(5);
        return view('times.index')->with('times', $times);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('times.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required'
        ]);

        if($request->hasFile('cover_image')){
            // Get Filename with extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            // Get Just The filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get Just The Extension
            $extension = $request->file('cover_image')->getClientOriginalExtension();

            // Filename to store
            $filenameToStore = $filename.'_'.time().'.'.$extension;
            // Upload the image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $filenameToStore);
        }

        if($request->hasFile('header_image')){
            // Get Filename with extension
            $filenameWithExtHeader = $request->file('header_image')->getClientOriginalName();
            // Get Just The filename
            $filenameHeader = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get Just The Extension
            $extensionHeader = $request->file('header_image')->getClientOriginalExtension();

            // Filename to store
            $filenameToStoreHeader = $filename.'_'.time().'.'.$extension;
            // Upload the image
            $pathHeader = $request->file('header_image')->storeAs('public/header_images', $filenameToStore);
        }

        $time = new time;
        $time->title = $request->input('title');
        $time->body = $request->input('body');
        $time->cover_image = $filenameToStore;
        $time->header_image = $filenameToStoreHeader;
        $time->save();

        return redirect('/times')->with('success', 'Post Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $time = time::find($id);
        return view('times.show')->with('time', $time);
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        $time = time::find($id);
        Storage::delete('public/cover_images/'.$time->cover_image);
        Storage::delete('public/header_images/'.$time->header_image);

        $time->delete();

        return redirect('/times')->with('success', 'Time Removido');
    }
}
