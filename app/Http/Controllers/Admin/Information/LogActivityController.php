<?php

namespace App\Http\Controllers\Admin\Information;

use App\Http\Controllers\Controller;
use App\Models\LogActivity;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Illuminate\Http\Request;

class LogActivityController extends Controller
{
    public function index()
    {
        return view('admin.information.activity.index',[
            'title' => 'Activity',
            'breadcrumbs' => Breadcrumbs::render('log-activity'),
        ]);
    }

    public function show($id)
    {
        $data = LogActivity::FindorFail($id);

        return view('admin.information.activity.show',[
            'title' => 'Detail Activity',
            'breadcrumbs' => Breadcrumbs::render('log-activity.show',$data),
            'data' => $data,
        ]);
    }
}
