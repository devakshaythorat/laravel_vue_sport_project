<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SportRequest;
use App\Models\Sport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class SportController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('Admin/Sports/Index', [
            'sports' => Sport::query()->with('users')->when($request->input('search'), function ($query, $search) {
                $query->where('title', 'Like', '%' . $search . '%');
            })->active()->get(),
            'filters' => request()->only(['search'])
        ]);
    }

    public function store(SportRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = Auth::user()->id;
        Sport::create($data);

        return redirect()->route('admin.sports.index');
    }

    public function show(Sport $sport)
    {
        return response()->json($sport);
    }

    public function update(Sport $sport, SportRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = Auth::user()->id;
        $sport->update($data);

        return redirect()->route('admin.sports.index');
    }

    public function destroy(Sport $sport)
    {
        $sport->status = 0;
        $sport->save();

        return redirect()->route('admin.sports.index');
    }

    public function users(Sport $sport)
    {
        $users = $sport->Users()->get();

        return response()->json($users);
    }


}
