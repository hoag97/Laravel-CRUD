<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class DQBController extends Controller
{
    function listMember(){

        $rs = DB::table('members')
                    ->join('facultys', 'members.faculty_id', 'facultys.id')
                    ->orderBy('members.id', 'desc')
                    ->paginate(5);
        $count_rs = count($rs);
        return view('admin.pages.DQB.list-member', ['rs' => $rs, 'count_rs' => $count_rs]);

    }
}
