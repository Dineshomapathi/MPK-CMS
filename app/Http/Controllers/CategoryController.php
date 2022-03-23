<?php

namespace App\Http\Controllers;

use App\Models\ImageUpload;
use App\Models\VideoUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index( Request $request )
    {
        abort_if(Gate::denies('content_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $categories = $request->category;
        $videocategory = DB::table('image_uploads')->where('category', $categories)->get();
        $imagecategory = DB::table('video_uploads')->where('category', $categories)->get();
        // $imagecategory = DB::table('image_uploads')->select('id','title','name','category','description')->where('category', $categories)->groupby('category');
        // $videocategory = DB::table('video_uploads')->select('id','title','name','category','description')->where('category', $categories)->groupby('category');
        // $join = $imagecategory->unionAll($videocategory);
        // $contentcategory = DB::table(DB::raw("({$join->toSql()}) AS mg"))->mergeBindings($join)->get();

        return view('category', compact('videocategory','imagecategory'));
    }
}
