<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Models\User;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teams = Team::orderby('name','asc')->get();

        return view('admin.setting.user.index',[
            'title' => 'Users',
            'breadcrumbs' => Breadcrumbs::render('user'),
            'teams' => $teams,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|unique:users|max:255',
        ]);

        $data = new User();
        $data->name = $request->name;
        $data->email = $request->email;
        $data->password = bcrypt($request->password);
        $data->current_team_id = $request->current_team_id;
        $data->active = $request->active;
        $data->save();

        return redirect()->route('user.index')->with('success', 'Data user berhasil ditambahkan');


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = User::FindOrFail($id);
        $teams = Team::orderby('name','asc')->get();

        return view('admin.setting.user.edit',[
            'title' => 'Users',
            'breadcrumbs' => Breadcrumbs::render('user.edit',$data),
            'teams' => $teams,
            'data' => $data,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = User::find($id);

        $photo = $data->profile_photo_path;
        if ($photo != null) {
            Storage::delete($photo);
        }
        $data->delete();

        return redirect()->route('user.index')->with('error', 'Data User berhasil dihapus');
    }
}
