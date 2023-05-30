<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Models\ContentCategory;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Illuminate\Http\Request;

class ContentCategoryController extends Controller
{
    public function index()
    {
        return view('admin.setting.content-category.index',[
            'title' => 'Kategori',
            'breadcrumbs' => Breadcrumbs::render('content-category'),
        ]);
    }

    public function show($id)
    {
        $data = ContentCategory::find($id);

        return response()->json([
            'success' => true,
            'message' => 'Detail Data Post',
            'data'    => $data
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:content_category|max:255',
        ]);

        $data = new ContentCategory();
        $data->name = $request->name;
        $data->save();

        return redirect()->back()->with('success', 'Data berhasil ditambahkan');
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|unique:content_category,name,'.$id,
        ]);

        $data = ContentCategory::find($id);
        $data->update([
            'name' => $request->name,
        ]);

        return redirect()->back()->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        $data = ContentCategory::find($id);
        $data->delete();

        return redirect()->back()->with('error', 'Data berhasil dihapus');
    }

    public function data()
    {
        $data = ContentCategory::orderby('name','asc');

        return datatables()->of($data)
        ->addColumn('action','admin.setting.content-category.action')
        ->addIndexColumn()
        ->rawColumns(['action'])
        ->toJson();
    }
}
