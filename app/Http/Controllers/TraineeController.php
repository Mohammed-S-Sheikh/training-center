<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Setting;
use App\Models\Trainee;
use Illuminate\Pipeline\Pipeline;
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
        $trainees = app(Pipeline::class)
            ->send(Trainee::query())
            ->through(Trainee::FILTERS)
            ->thenReturn()
            ->with('user')
            ->when(!auth()->user()->is_admin, function ($query) {
                return $query->where('user_id', auth()->id());
            })
            ->paginate();

        $delegates = User::all();

        return view('pages.trainee.index', compact('trainees', 'delegates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.trainee.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTraineeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTraineeRequest $request)
    {
        $trainee = Trainee::create(array_merge(
            $request->validated(), [
                'user_id' => auth()->id(),
                'amount' => $request->amount ?: Setting::where('key', 'course_amount')->value('value'),
                'discount' => $request->discount ?: Setting::where('key', 'course_discount')->value('value'),
            ]
        ));

        return redirect()->route('trainees.index')->with('success', 'تم إضافة المتدرب بنجاح');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Trainee  $trainee
     * @return \Illuminate\Http\Response
     */
    public function show(Trainee $trainee)
    {
        return view('pages.trainee.show', compact('trainee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Trainee  $trainee
     * @return \Illuminate\Http\Response
     */
    public function edit(Trainee $trainee)
    {
        return view('pages.trainee.edit', compact('trainee'));
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
        $trainee->update(array_merge(
            $request->validated(), [
                'user_id' => auth()->id(),
                'amount' => $request->amount ?: Setting::where('key', 'course_amount')->value('value'),
                'discount' => $request->discount ?: Setting::where('key', 'course_discount')->value('value'),
            ]
        ));

        return redirect()->route('trainees.index')->with('success', 'تم تحديث المتدرب بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Trainee  $trainee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Trainee $trainee)
    {
        if (
            !auth()->user()->is_admin &&
            $trainee->created_at < now()->subWeek()
        ) {
            abort(403);
        }

        $trainee->delete();

        return redirect()->route('trainees.index')->with('success', 'تم حذف المتدرب بنجاح');
    }
}
