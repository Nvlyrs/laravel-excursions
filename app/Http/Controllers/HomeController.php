<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Excursion;

class HomeController extends Controller
{
    public function display(): Response
    {
        $excursions = Excursion::orderBy('id')->with(['user','type'])->get();

        return Inertia::render('Home/Display', [
            'auth_user' => Auth::user(),
            'status' => session('status'),
            'excursions' => $excursions,
        ]);
    }
}
