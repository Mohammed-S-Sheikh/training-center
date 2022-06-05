<?php

namespace App\Http\Controllers;

use App\Models\Trainee;
use App\Http\Requests\StoreTraineeRequest;
use App\Http\Requests\UpdateTraineeRequest;

class TraineeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trainees = Trainee::all();

        return view('trainees.index', compact('trainees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('trainees.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTraineeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTraineeRequest $request)
    {
        $trainee = Trainee::create($request->validated());

        return redirect()->route('pages.trainee.index')->with('success', 'Trainee created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Trainee  $trainee
     * @return \Illuminate\Http\Response
     */
    public function show(Trainee $trainee)
    {
        return view('trainees.show', compact('trainee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Trainee  $trainee
     * @return \Illuminate\Http\Response
     */
    public function edit(Trainee $trainee)
    {
        return view('trainees.edit', compact('trainee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTraineeRequest  $request
     * @param  \App\Models\Trainee  $trainee
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTraineeRequest $request, Trainee $trainee)
    {
        $trainee->update($request->validated());

        return redirect()->route('pages.trainee.index')->with('success', 'Trainee updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Trainee  $trainee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Trainee $trainee)
    {
        $trainee->delete();

        return redirect()->route('pages.trainee.index')->with('success', 'Trainee deleted successfully.');
    }
}
