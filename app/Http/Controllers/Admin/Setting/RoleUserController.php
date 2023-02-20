<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleUserController extends Controller
{
    public function index()
    {
        return view('admin.setting.role.index',[
            'title' => 'Role Users',
            'breadcrumbs' => Breadcrumbs::render('role-user'),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:teams|max:255',
        ]);

        $data = new Team();
        $data->name = $request->name;
        $data->personal_team = 1;
        $data->user_id = Auth::user()->id;
        $data->save();

        return redirect()->route('role-user.index')->with('success', 'Data Role berhasil ditambahkan');

    }

    public function edit(string $id)
    {
        $data = Team::FindOrFail($id);

        return view('admin.setting.role.edit',[
            'title' => 'Edit Role User',
            'breadcrumbs' => Breadcrumbs::render('role-user.edit',$data),
            'data' => $data,
        ]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|unique:teams,name,'.$id,
        ]);

        $data = Team::find($id);
        $data->update([
            'name' => $request->name,
        ]);

        return redirect()->route('role-user.index')->with('success', 'Data user berhasil diupdate');
    }

    public function destroy(string $id)
    {
        $data = Team::find($id);
        $data->delete();

        return redirect()->route('role-user.index')->with('error', 'Data Role berhasil dihapus');
    }
}
