<?php

namespace App\Http\Controllers;

use App\Models\Singer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SingerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $singers = Singer::all();
        return view("index", compact("singers"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $fileName = $request->file('photo')->getClientOriginalName();
        Singer::create([

            'name' => $request->input("name"),
            'photo' => $request->file("photo")->store('singers', 'public'),
            'age' => $request->input("age")
        ]);
        return to_route("singer.index");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Singer $singer)
    {
        return view("edit", compact("singer"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Singer $singer)
    {

        $photoPath = $singer->photo;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('singers', 'public');
        }

        $singer->fill([
            'name' => $request->input("name"),
            'photo' => $photoPath,
            'age' => $request->input("age")
        ]);
        $singer->save();
        return to_route("singer.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Singer $singer)
    {
        $filePath = $singer->photo;
        Singer::destroy($singer->id);
        Storage::disk('public')->delete($filePath);

        return to_route("singer.index");
    }
}
