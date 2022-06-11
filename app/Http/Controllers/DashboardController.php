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
        $delegatesCount = User::count();
        $traineesCount = Trainee::count();
        $totalRevenue = Trainee::sum('amount');
        $delegates = User::with('trainees:id,amount,discount,user_id')->withCount('trainees')->paginate();
        $settings = Setting::all();

        return view('pages.dashboard', compact(
            'delegates',
            'delegatesCount',
            'traineesCount',
            'totalRevenue',
            'settings',
        ));
    }
}
