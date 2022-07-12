<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Country;
use App\Models\Setting;
use App\Models\Trainee;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreForeignTraineeRequest;
use App\Http\Requests\UpdateForeignTraineeRequest;

class ForeignTraineeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        $trainees = app(Pipeline::class)
            ->send(Trainee::query())
            ->through(Trainee::FILTERS)
            ->thenReturn()
            ->with([
                'user' => function ($query) {
                    $query->withTrashed();
                },
                'user.city',
                'country',
            ])
            ->when(auth()->user()->role != 'admin', function ($query) {
                return $query->where('user_id', auth()->id());
            })
            ->whereHas('country', function ($query) {
                $query->whereNot('name', 'ليبيا');
            })
            ->where('is_paid', true)
            ->paginate();

        $users = User::all();
        $countries = Country::all();

        return view('pages.foreign-trainee.index', compact('trainees', 'users', 'countries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function create()
    {
        $countries = Country::all();

        return view('pages.foreign-trainee.create', compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreForeignTraineeRequest
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function store(StoreForeignTraineeRequest $request)
    {
        $foreign_trainee = Trainee::create(array_merge(
            $request->validated(), [
                'user_id' => auth()->id(),
                'amount' => $request->amount ?: Setting::where('key', 'course_amount')->value('value'),
                'discount' => $request->discount ?: Setting::where('key', 'course_discount')->value('value'),
            ]
        ));

        return redirect()->route('foreign-trainees.index')->with('success', 'تم إضافة المتدرب بنجاح');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Trainee  $tra
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function show(Trainee $foreign_trainee)
    {
        return view('pages.foreign-trainee.show', compact('trainee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Trainee  $tra
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function edit(Trainee $foreign_trainee)
    {
        $countries = Country::all();

        return view('pages.foreign-trainee.edit', compact('trainee', 'countries'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateForeignTraineeRequest  $request
     * @param  \App\Models\Trainee  $tra
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function update(UpdateForeignTraineeRequest $request, Trainee $foreign_trainee)
    {
        $foreign_trainee->update(array_merge(
            $request->validated(), [
                'user_id' => auth()->id(),
                'amount' => $request->amount ?: Setting::where('key', 'course_amount')->value('value'),
                'discount' => $request->discount ?: Setting::where('key', 'course_discount')->value('value'),
            ]
        ));

        return redirect()->route('foreign-trainees.index')->with('success', 'تم تحديث المتدرب بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Trainee  $tra
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function destroy(Trainee $foreign_trainee)
    {
        if (
            auth()->user()->role != 'admin' &&
            $foreign_trainee->created_at < now()->subWeek()
        ) {
            abort(403);
        }

        $foreign_trainee->delete();

        return redirect()->route('foreign-trainees.index')->with('success', 'تم حذف المتدرب بنجاح');
    }
}
