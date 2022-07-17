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
        $usersCount = User::count();
        $trainees = Trainee::all();
        $users = User::query()
            ->with([
                'city',
                'leads:id,ly,us,user_id',
                'trainees:id,ly,us,user_id',
            ])
            ->withCount(['trainees', 'leads'])
            ->paginate();

        return view('pages.dashboard', array(
            'settings' => $settings,
            'users' => $users,
            'usersCount' => $usersCount,
            'trainees' => $trainees->where('is_paid', true),
            'leads' => $trainees->where('is_paid', false),
        ));
    }
}
