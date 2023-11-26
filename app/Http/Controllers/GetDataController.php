<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GetDataController extends Controller
{
    public function getData()
    {
        $usersData = DB::table('roles')->get();
        return response()->json($usersData);
    }
}