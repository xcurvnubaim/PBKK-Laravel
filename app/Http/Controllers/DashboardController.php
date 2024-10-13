<?php

namespace App\Http\Controllers;


class DashboardController extends Controller
{
    public function index()
    {
        return view('pages/dashboard/dashboard');
    }

    /**
     * Displays the analytics screen
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
}
