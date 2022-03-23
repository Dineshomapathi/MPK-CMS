<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImageUploadRequest;
use App\Http\Requests\ImageUploadUpdateRequest;
use App\Models\ImageUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ImageUploadController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('content_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $imageupload = ImageUpload::all();
        return view('imageupload.index', compact('imageupload'));
    }

    public function create()
    {
        abort_if(Gate::denies('content_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('imageupload.create');
    }

    public function store(ImageUploadRequest $request)
    {
        $request->validated();
        if($request->input('category') == "AKTIVITI MBK"){
            foreach($request->file('file-upload') as $imageupload){
                $categoryfolder = 'uploads/'.$request->input('category');
                $validated['title'] = $request->input('title');
                $validated['category'] = $request->input('category');
                $validated['subcategory'] = $request->input('subcategory');
                $validated['description'] = $request->input('description');
                $validated['name'] = $imageupload->store($categoryfolder, 'public');
                ImageUpload::create($validated);
            }
        }else{
            foreach($request->file('file-upload') as $imageupload){
                $categoryfolder = 'uploads/'.$request->input('category');
                $validated['title'] = $request->input('title');
                $validated['category'] = $request->input('category');
                $validated['description'] = $request->input('description');
                $validated['name'] = $imageupload->store($categoryfolder, 'public');
                ImageUpload::create($validated);
            }
        }
        

        toast('Image uploaded successfully','success');
        return redirect()->route('imageupload.index');
    }

    public function show(ImageUpload $imageupload)
    {
        abort_if(Gate::denies('content_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('imageupload.show', compact('imageupload'));
    }

    public function edit(ImageUpload $imageupload)
    {
        abort_if(Gate::denies('content_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('imageupload.edit', compact('imageupload'));
    }

    public function update(ImageUploadUpdateRequest $request, ImageUpload $imageupload)
    {
        $categoryfolder = 'uploads/'.$imageupload->category;
        $image_path = "storage/".$imageupload->name;
        if($request->file('file-upload') === null){
            $request->validated();
            $validated['title'] = $request->input('title');
            $validated['description'] = $request->input('description');
            // $validated['name'] = $request->file('file-upload')->store($categoryfolder, 'public');
            $imageupload->update($validated);
            toast('Image updated successfully','success');
            return redirect()->route('imageupload.index');
        }else{
            File::delete($image_path);
            $request->validated();
            $validated['title'] = $request->input('title');
            $validated['description'] = $request->input('description');
            $validated['name'] = $request->file('file-upload')->store($categoryfolder, 'public');
            $imageupload->update($validated);
            toast('Image updated successfully','success');
            return redirect()->route('imageupload.index');
        }
    }

    public function destroy(ImageUpload $imageupload)
    {
        abort_if(Gate::denies('content_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $image_path = "storage/".$imageupload->name;
        File::delete($image_path);
        $imageupload->delete();
        toast('Image removed successfully','success');
        return redirect()->route('imageupload.index');
    }

    public function getImageAPI($id)
    {
        $content = ImageUpload::find($id);
        return $content;
    }

    public function getImageAPIAll()
    {
        $content = ImageUpload::all();
        return $content;
    }

    public function getImageAPIDROPDOWNCATEGORY($category)
    {
        $image = DB::table('image_uploads')->where('category', $category)->get();
        return $image;
    }

    public function getImageAPIDROPDOWNTITLE($title)
    {
        $image = DB::table('image_uploads')->where('title', $title)->get();
        return $image;
    }
}
