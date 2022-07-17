<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Country;
use App\Models\Setting;
use App\Models\Trainee;
use Illuminate\Pipeline\Pipeline;
use App\Http\Requests\StoreTraineeRequest;
use App\Http\Requests\UpdateTraineeRequest;

class LeadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        $leads = app(Pipeline::class)
            ->send(Trainee::query())
            ->through(Trainee::FILTERS)
            ->thenReturn()
            ->with('user.city')
            ->where('is_paid', false)
            ->paginate();

        $users = User::all();

        return view('pages.lead.index', compact('leads', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function create()
    {
        return view('pages.lead.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTraineeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTraineeRequest $request)
    {
        $lead = Trainee::create(array_merge(
            $request->validated(), [
                'country_id' => Country::where('name', 'ليبيا')->value('id'),
                'user_id' => auth()->id(),
                'ly' => $request->ly ?: Setting::where('key', 'course_ly')->value('value'),
                'us' => $request->us ?: Setting::where('key', 'course_us')->value('value'),
                'is_paid' => false,
            ]
        ));

        return redirect()->route('leads.index')->with('success', 'تم إضافة المتدرب بنجاح');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Trainee  $lead
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function show(Trainee $lead)
    {
        return view('pages.lead.show', compact('lead'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Trainee  $lead
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function edit(Trainee $lead)
    {
        return view('pages.lead.edit', compact('lead'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTraineeRequest  $request
     * @param  \App\Models\Trainee  $lead
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function update(UpdateTraineeRequest $request, Trainee $lead)
    {
        $lead->update(array_merge(
            $request->validated(), [
                'country_id' => Country::where('name', 'ليبيا')->value('id'),
                'user_id' => auth()->id(),
                'ly' => $request->ly ?: Setting::where('key', 'course_ly')->value('value'),
                'us' => $request->us ?: Setting::where('key', 'course_us')->value('value'),
            ]
        ));

        return redirect()->route('leads.index')->with('success', 'تم تحديث المتدرب بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Trainee  $lead
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function destroy(Trainee $lead)
    {
        $lead->delete();

        return redirect()->route('leads.index')->with('success', 'تم حذف المتدرب بنجاح');
    }

    public function promote(Trainee $lead)
    {
        $lead->update(['is_paid' => true]);

        return redirect()->route('leads.index')->with('success', 'تم نقل المتدرب بنجاح');
    }
}
