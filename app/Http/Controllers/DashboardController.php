<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Setting;
use App\Models\Trainee;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function __invoke(Request $request)
    {
        $settings = Setting::all();
        $delegatesCount = User::count();
        $trainees = Trainee::all();
        $delegates = User::query()
            ->with([
                'city',
                'leads:id,amount,discount,user_id',
                'trainees:id,amount,discount,user_id',
            ])
            ->withCount(['trainees', 'leads'])
            ->paginate();

        return view('pages.dashboard', array(
            'settings' => $settings,
            'delegates' => $delegates,
            'delegatesCount' => $delegatesCount,
            'trainees' => $trainees->where('is_paid', true),
            'leads' => $trainees->where('is_paid', false),
        ));
    }
}
