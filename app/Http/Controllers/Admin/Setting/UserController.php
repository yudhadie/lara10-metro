<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Models\User;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

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

        if ($request->hasFile('photo')) {
            $location = 'uploads/user/'.$data->id.'.jpg';
            Image::make($request->file('photo'))->resize(1920, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($location);
            $data->update([
                'profile_photo_path' => $location,
            ]);
        }

        return redirect()->route('user.index')->with('success', 'Data user berhasil ditambahkan');


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function profile()
    {

        return view('admin.setting.user.profile',[
            'title' => 'Profile Detail',
            'breadcrumbs' => Breadcrumbs::render('profile'),
            'data' => Auth::user(),
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = User::FindOrFail($id);
        $teams = Team::where('id','!=',$data->current_team_id)->orderby('name','asc')->get();

        return view('admin.setting.user.edit',[
            'title' => 'Edit Users',
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
        $request->validate([
            'email' => 'required|unique:users,email,'.$id,
        ]);

        $data = User::find($id);
        $photo = $data->profile_photo_path;

        if ($request->hasFile('photo')) {
            $location = 'uploads/user/'.$data->id.'.jpg';
            Image::make($request->file('photo'))->resize(1920, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($location);
            $photo = $location;
        }

        $data->update([
            'name' => $request->name,
            'email' => $request->email,
            'profile_photo_path' => $photo,
        ]);

        if ($request->current_team_id != null) {
            $data->update([
                'current_team_id' => $request->current_team_id,
                'active' => $request->active,
            ]);
        }

        if ($request->password != null) {
            $data->password = bcrypt($request->password);
            $data->update([
                'password' => bcrypt($request->password),
            ]);
        }

        return redirect()->back()->with('success', 'Data user berhasil diupdate');
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
