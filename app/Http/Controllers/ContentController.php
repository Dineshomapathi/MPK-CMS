<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContentRequest;
use App\Http\Requests\UpdateContentRequest;
use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ContentController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('content_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $content = Content::all();
        return view('content.index', compact('content'));
    }

    public function create()
    {
        abort_if(Gate::denies('content_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('content.create');
    }

    public function store(StoreContentRequest $request)
    {
        Content::create($request->validated());
        toast('Content created successfully','success');
        return redirect()->route('content.index');
    }

    public function show(Content $content)
    {
        abort_if(Gate::denies('content_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('content.show', compact('content'));
    }

    public function edit(Content $content)
    {
        abort_if(Gate::denies('content_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('content.edit', compact('content'));
    }

    public function update(UpdateContentRequest $request, Content $content)
    {
        $content->update($request->validated());
        toast('Content updated successfully','success');
        return redirect()->route('content.index');
    }

    public function destroy(Content $content)
    {
        abort_if(Gate::denies('content_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $content->delete();
        toast('Content removed successfully','success');
        return redirect()->route('content.index');
    }

    public function getContentAPI($id)
    {
        $content = Content::find($id);
        return $content;
    }

    public function getContentAPIAll()
    {
        $content = Content::all();
        return $content;
    }

    public function getContentAPIDROPDOWN($title)
    {
        $content = DB::table('contents')->where('title', $title)->get();
        return $content;
    }
   
}
