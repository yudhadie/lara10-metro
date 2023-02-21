<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function user(Request $request)
    {
        $data = User::all();
        $title = 'Data Users';
        $ttd = 'time: '.Carbon::now().' user: '.Auth::user()->name;

        // return view('admin.pdf.user',[
        //     'title' => $title,
        //     'data' => $data,
        // ]);

        return PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])
                ->loadView('admin.pdf.user', [
                    'title' => $title,
                    'data' => $data,
                    'ttd' => $ttd,
                 ])
                 ->setPaper('a4', 'potrait')
                 ->stream($title.'.pdf');
    }
}
