<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Setting;
use App\Models\Trainee;
use Illuminate\Pipeline\Pipeline;
use App\Http\Requests\UpdateLeadRequest;
use App\Http\Requests\StoreTraineeRequest;

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

        $delegates = User::all();

        return view('pages.lead.index', compact('leads', 'delegates'));
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
                'user_id' => auth()->id(),
                'amount' => $request->amount ?: Setting::where('key', 'course_amount')->value('value'),
                'discount' => $request->discount ?: Setting::where('key', 'course_discount')->value('value'),
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
    public function update(UpdateLeadRequest $request, Trainee $lead)
    {
        $lead->update(array_merge(
            $request->validated(), [
                'user_id' => auth()->id(),
                'amount' => $request->amount ?: Setting::where('key', 'course_amount')->value('value'),
                'discount' => $request->discount ?: Setting::where('key', 'course_discount')->value('value'),
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