<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Jobs\SportSubscription;
use App\Mail\SubscribeMail;
use App\Models\Sport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;
use Illuminate\Support\Facades\Bus;

class HomeController extends Controller
{
    public function index()
    {
        return Inertia::render('User/Dashboard', [
            'sports' => Sport::query()->with('users')->active()->get()
        ]);
    }

    public function subscribe(Sport $sport)
    {
        $sport->users()->attach(Auth::user()->id);
        Bus::dispatch(new SportSubscription($sport, Auth::user()->email));

        return redirect()->route('user.dashboard');
    }

    public function unsubscribe(Sport $sport)
    {
        $sport->users()->detach(Auth::user()->id);

        return redirect()->route('user.dashboard');
    }
}
