<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class SportController extends Controller
{
    public function index()
    {
        $sports = Sport::with('users')->when(request()->input('search'), function ($query, $search) {
            $query->where('title', 'Like', '%' . $search . '%');
        })->active()->get();
        return Inertia::render('Admin/Sports/Index', ['sports' => $sports, 'filters' => request()->only(['search'])]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);
        $data['user_id'] = Auth::user()->id;
        Sport::create($data);
        return redirect()->route('admin.sports.index');
    }

    public function show(Request $request, $id)
    {
        $sport = Sport::find($id);
        return response()->json($sport);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);
        $data['user_id'] = Auth::user()->id;
        $sport = Sport::find($id);
        $sport->update($data);
        return redirect()->route('admin.sports.index');
    }

    public function delete($id)
    {
        $sport = Sport::find($id);
        $sport->status = 0;
        $sport->Save();
        return redirect()->route('admin.sports.index');
    }

    public function users($id)
    {
        $sport = Sport::find($id);
        $users = $sport->Users()->get();
        return response()->json($users);

    }


}
