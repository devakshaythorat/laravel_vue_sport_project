<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Sport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        $sports = Sport::with('users')->active()->get();
        return Inertia::render('User/Dashboard',['sports'=>$sports]);
    }

    public function subscribe($id){
        $sport = Sport::find($id);
        $sport->users()->attach(Auth::user()->id);
        return redirect()->route('user.dashboard');
    }

    public function unsubscribe($id){
        $sport = Sport::find($id);
        $sport->users()->detach(Auth::user()->id);
        return redirect()->route('user.dashboard');
    }
}
