<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
    public function deleteuser(string $id)
    {
        $data = User::find($id);
        $photo = $data->profile_photo_path;

        if ($photo != null) {
            Storage::delete($photo);
            $data->update([
                'profile_photo_path' => null,
            ]);
        }

        return redirect()->back()->with('error','Photo Profile berhasil di hapus');
    }
}
