<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Models\LogActivity;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Illuminate\Http\Request;

class LogActivityController extends Controller
{
    public function index()
    {
        return view('admin.setting.log.index',[
            'title' => 'Activity Log',
            'breadcrumbs' => Breadcrumbs::render('log-activity'),
        ]);
    }

    public function show($id)
    {
        $data = LogActivity::FindOrFail($id);

        return view('admin.setting.log.show',[
            'title' => 'Detail Activity Log',
            'breadcrumbs' => Breadcrumbs::render('log-activity.show',$data),
            'data' => $data,
        ]);
    }
}
