<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function user()
    {
        $data = User::all();
        $title = 'Data Users';

        // return view('admin.pdf.user',[
        //     'title' => $title,
        //     'data' => $data,
        // ]);

        return PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])
                ->loadView('admin.pdf.user', [
                    'title' => $title,
                    'data' => $data,
                 ])
                 ->setPaper('a4', 'potrait')
                 ->stream($title.'.pdf');
    }
}
