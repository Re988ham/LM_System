<?php

namespace App\Http\Controllers;

use App\Models\Reports;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportsController extends Controller
{
    public function send_reports(Request $request){
        $user_id=Auth::user()->id;
        $data['report']=$request->report;
        $data['user_id']=$user_id;

        return Reports::create($data);
    }
}
