<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\User;

use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class DelegateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        $delegates = app(Pipeline::class)
            ->send(User::query())
            ->through(User::FILTERS)
            ->thenReturn()
            ->with('city')
            ->orderByDesc('id')
            ->paginate();

        $cities = City::all();

        return view('pages.delegate.index', compact('delegates', 'cities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function create()
    {
        $cities = City::all();

        return view('pages.delegate.create', compact('cities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUserRequest
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function store(StoreUserRequest $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'is_admin' => $request->is_admin?? 0,
            'city_id' => $request->city_id,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('delegates.index')->with('success', 'تم إضافة المندوب بنجاح');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function show(User $user)
    {
        return view('pages.delegate.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function edit(User $user)
    {
        $cities = City::all();

        return view('pages.delegate.edit', compact('user', 'cities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->city_id = $request->city_id;

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        if ($request->is_admin) {
            $user->is_admin = $request->is_admin;
        }

        $user->save();

        return redirect()->route('delegates.index')->with('success', 'تم تحديث المندوب بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('delegates.index')->with('success', 'تم حذف المندوب بنجاح');
    }
}
