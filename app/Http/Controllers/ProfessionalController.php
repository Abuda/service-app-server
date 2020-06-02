<?php

namespace App\Http\Controllers;

use App\Helpers\Constants;
use App\Profession;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class ProfessionalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $validatedInput = $request->validate([
            'term' => 'max:' . Constants::MAX_TERM_LENGTH,
            'min_hourly_rate' => 'numeric|min:0|max:' . Constants::MAX_HOURLY_RATE,
            'max_hourly_rate' => 'numeric|min:0|max:' . Constants::MAX_HOURLY_RATE,
            'profession_id' => 'exists:professions,id',
            'order_by' => [Rule::in(Constants::ALLOWED_ORDER_BY)],
            'order_direction' => [Rule::in(['asc', 'desc'])]
        ]);

        // initialize result list
        $result = User::where('professional', true);

        // filter result list (if parameters present)
        // filter by profession_id
        if(isset($validatedInput['profession_id'])) {
            $result = $result->where('profession_id', $validatedInput['profession_id']);
        }
        // filter by search term
        if(isset($validatedInput['term'])) {
            $result = $result->where('name', 'like', '%' . $validatedInput['term'] . '%');
            $result = $result->where('description', 'like', '%' . $validatedInput['term'] . '%');
        }
        // filter by min hourly rate
        if(isset($validatedInput['min_hourly_rate'])) {
            $result = $result->where('hourly_rate', '>=', $validatedInput['min_hourly_rate']);
        }
        // filter by max hourly rate
        if(isset($validatedInput['max_hourly_rate'])) {
            $result = $result->where('hourly_rate', '<=', $validatedInput['max_hourly_rate']);
        }
        // handle order by
        if(isset($validatedInput['order_by']) && isset($validatedInput['order_direction'])) {
            switch ($validatedInput['order_by']) {
                case 'hourly_rate':
                    $result = $result->orderBy('hourly_rate', $validatedInput['order_direction']);
                    break;
                case 'name':
                    $result = $result->orderBy('name', $validatedInput['order_direction']);
                default:
                    break;
            }
        }

        $result = $result->take(Constants::MAX_RESULT_LIST)->get();
        return Response()->json(['list' => $result]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
