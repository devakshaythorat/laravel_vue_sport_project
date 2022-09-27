<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sport;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        $data['sports'] = Sport::active()->get()->count();
        $data['users']= User::all()->count();
        $data['subUsers'] = DB::table('sport_user')->where('status',1)->count();
        return Inertia::render('Admin/Dashboard',['dash'=>$data]);
    }
}
