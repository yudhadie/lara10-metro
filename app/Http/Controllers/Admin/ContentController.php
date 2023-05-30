<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Content;
use App\Models\ContentCategory;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function index()
    {
        $category = ContentCategory::orderby('name')->get();

        return view('admin.content.index',[
            'title' => 'Content',
            'breadcrumbs' => Breadcrumbs::render('content'),
            'categorys' => $category,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:content|max:255',
        ]);

        $data = new Content();
        $data->title = $request->title;
        $data->content_category_id = $request->content_category_id;
        $data->desc = $request->desc;
        $data->save();

        return redirect()->back()->with('success', 'Data berhasil ditambahkan');
    }

    public function show($id)
    {
        $data = Content::find($id);

        return response()->json([
            'success' => true,
            'message' => 'Detail Data Post',
            'data'    => $data
        ]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|unique:content,title,'.$id,
            'desc' => 'required',
        ]);

        $data = Content::find($id);
        $data->update([
            'title' => $request->title,
            'content_category_id' => $request->content_category_id,
            'desc' => $request->desc,
        ]);

        return redirect()->route('content.index')->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        $data = Content::find($id);
        $data->delete();

        return redirect()->route('content.index')->with('error', 'Data berhasil dihapus');
    }

    public function data()
    {
        // $data = Content::onlyTrashed();
        // $data = Content::withTrashed();
        $data = Content::all();

        return datatables()->of($data)
        ->addColumn('action', 'admin.content.action')
        ->addColumn('category', function($data){
            return $data->content_category->name;
        })
        ->addIndexColumn()
        ->rawColumns(['action'])
        ->toJson();
    }
}
