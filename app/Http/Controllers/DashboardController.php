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
        $trainees = Trainee::query()
            ->whereHas('country', function ($query) {
                $query->where('name', 'ليبيا');
            })->get();

        $users = User::query()
            ->with([
                'city',
                'leads:id,ly,us,user_id',
                'trainees:id,ly,us,user_id',
            ])
            ->withCount(['trainees', 'leads'])
            ->paginate();

        return view('pages.dashboard', array(
            'data' => $request->all(),
            'settings' => Setting::all(),
            'users' => $users,
            'usersCount' => User::count(),
            'trainees' => $trainees->where('is_paid', true),
            'leads' => $trainees->where('is_paid', false),
        ));
    }
}
