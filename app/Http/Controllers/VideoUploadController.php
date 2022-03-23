<?php

namespace App\Http\Controllers;

use App\Http\Requests\VideoUploadRequest;
use App\Http\Requests\VideoUploadUpdateRequest;
use App\Models\VideoUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class VideoUploadController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('content_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $videoupload = VideoUpload::all();
        return view('videoupload.index', compact('videoupload'));
    }

    public function create()
    {
        abort_if(Gate::denies('content_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('videoupload.create');
    }

    public function store(VideoUploadRequest $request)
    {
        $request->validated();
        if($request->input('category') == "AKTIVITI MBK"){
            foreach($request->file('file-upload') as $videoupload){
                $categoryfolder = 'uploads/'.$request->input('category');
                $validated['title'] = $request->input('title');
                $validated['category'] = $request->input('category');
                $validated['subcategory'] = $request->input('subcategory');
                $validated['description'] = $request->input('description');
                $validated['name'] = $videoupload->store($categoryfolder, 'public');
                videoupload::create($validated);
            }
        }else{
            foreach($request->file('file-upload') as $videoupload){
                $categoryfolder = 'uploads/'.$request->input('category');
                $validated['title'] = $request->input('title');
                $validated['category'] = $request->input('category');
                $validated['description'] = $request->input('description');
                $validated['name'] = $videoupload->store($categoryfolder, 'public');
                videoupload::create($validated);
            }
        }

        toast('Video uploaded successfully','success');
        return redirect()->route('videoupload.index');
    }

    public function show(VideoUpload $videoupload)
    {
        abort_if(Gate::denies('content_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('videoupload.show', compact('videoupload'));
    }

    public function edit(VideoUpload $videoupload)
    {
        abort_if(Gate::denies('content_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('videoupload.edit', compact('videoupload'));
    }

    public function update(VideoUploadUpdateRequest $request, VideoUpload $videoupload)
    {
        $categoryfolder = 'uploads/'.$videoupload->category;
        $video_path = "storage/".$videoupload->name;
        if($request->file('file-upload') === null){
            $request->validated();
            $validated['title'] = $request->input('title');
            $validated['description'] = $request->input('description');
            // $validated['name'] = $request->file('file-upload')->store($categoryfolder, 'public');
            $videoupload->update($validated);
            toast('Video updated successfully','success');
            return redirect()->route('videoupload.index');
        }else{
            File::delete($video_path);
            $request->validated();
            $validated['title'] = $request->input('title');
            $validated['description'] = $request->input('description');
            $validated['name'] = $request->file('file-upload')->store($categoryfolder, 'public');
            $videoupload->update($validated);
            toast('Video updated successfully','success');
            return redirect()->route('videoupload.index');
        }
    }

    public function destroy(VideoUpload $videoupload)
    {
        abort_if(Gate::denies('content_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $video_path = "storage/".$videoupload->name;
        File::delete($video_path);
        $videoupload->delete();
        toast('Video removed successfully','success');
        return redirect()->route('videoupload.index');
    }

    public function getVideoAPI($id)
    {
        $content = VideoUpload::find($id);
        return $content;
    }

    public function getVideoAPIAll()
    {
        $content = VideoUpload::all();
        return $content;
    }

    public function getVideoAPIDROPDOWNCATEGORY($category)
    {
        $video = DB::table('video_uploads')->where('category', $category)->get();
        return $video;
    }

    public function getVideoAPIDROPDOWNTITLE($title)
    {
        $video = DB::table('video_uploads')->where('title', $title)->get();
        return $video;
    }
}
