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
use App\Models\Comment;

class ExcursionController extends Controller
{
    /**
     * Display the excursion page.
     */
    public function display(String $id): Response
    {
        Excursion::where('id', $id)->increment('hits');
        $excursion = Excursion::where('id', $id)->with(['user', 'type', 'dateFrames', 'comments'])->first();

        return Inertia::render('Excursion/Display', [
            'auth_user' => Auth::user(),
            'status' => session('status'),
            'excursion' => $excursion,
        ]);
    }

    /**
     * Booking process.
     */
    public function booking(Request $request): Response
    {
        dd($request);
    }

    public function saveComment(Request $request)
    {
        $excursionRating = 0.0;
        $validatedData = $request->validate([
            'message' => ['required'],
            'rating' => ['required'],
            'excursionId' => ['required']
        ]);

        $excursionComments = Comment::where('excursion_id', $validatedData['excursionId'])->get();

        foreach($excursionComments as $comment){
            $excursionRating += $comment->excursion_rating;
        }

        $excursionRating += $validatedData['rating'];

        $excursionRating = $excursionRating/(count($excursionComments) + 1);

        Excursion::where('id', $validatedData['excursionId'])->update(['rating' => $excursionRating > 5.0 ? 5 : $excursionRating]);

        Comment::create([
            'user_id' => Auth::user()->id,
            'excursion_id' => $validatedData['excursionId'],
            'content' => $validatedData['message'],
            'excursion_rating' => $validatedData['rating'],
        ]);

        return redirect()->back(); 
    }

    public function saveFavorite(Request $request){

    }
}
