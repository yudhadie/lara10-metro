<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Content;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function index()
    {
        return view('admin.content.index',[
            'title' => 'Content',
            'breadcrumbs' => Breadcrumbs::render('content'),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:content|max:255',
        ]);

        $data = new Content();
        $data->title = $request->title;
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
        $data = Content::latest()->get();

        return datatables()->of($data)
        ->addColumn('action', 'admin.content.action')
        ->addIndexColumn()
        ->rawColumns(['action'])
        ->toJson();
    }
}
