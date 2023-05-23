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

    public function data()
    {
        $data = LogActivity::latest();

        return datatables()->of($data)
        ->addColumn('action', 'admin.setting.log.action')
        ->addIndexColumn()
        ->addColumn('user', function($data){
            return $data->user->name ?? 'deleted';
        })
        ->editColumn('event', function($data){
            if ($data->event == 'created') {
                return'<span class="text-success">created</span>';
            } elseif ($data->event == 'updated') {
                return'<span class="text-warning">updated</span>';
            } elseif ($data->event == 'deleted') {
                return'<span class="text-danger">deleted</span>';
            }
        })
        ->rawColumns(['action','event'])
        ->toJson();
    }
}
