<?php

namespace App\Http\Controllers;

use App\Helpers\Constants;
use App\Review;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'stars' => ['required', Rule::in([1,2,3,4,5])],
            'review' => 'max:' . Constants::MAX_REVIEW_LENGTH
        ]);
        // reviewed user does not exist
        if(!$user) {
            return Response()->json(['message' => 'This user does not exist'], Constants::codes()::FORBIDDEN);
        }

        // trying to leave review for oneself's
        if(Auth::user()->id === $user->id) {
            return Response()->json(['message' => 'You cannot leave review to yourself'], Constants::codes()::FORBIDDEN);
        }
        // review already exists for this user (and from this user)
        if(Review::getReview($request->user->id, $user->id)) {
            return Response()->json(['message' => 'You already left a review for this user'], Constants::codes()::FORBIDDEN);
        }

        // all good, create review
        $validatedData['reviewer_id'] = Auth::user()->id;
        $validatedData['reviewed_id'] = $user->id;
        Review::create($validatedData)->save();
        return Response()->json(['message' => 'Success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(Review $review)
    {
        //
    }
}
