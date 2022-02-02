<?php

namespace App\Http\Controllers;

use App\Models\Competition;
use Illuminate\Http\Request;

class CompetitionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $competitions = Competition::all();

            if (sizeof($competitions) == 0) {
                return response()->json([
                    'message' => 'Competitions dont found',
                    'statua' => 404
                ]);
            } else {
                return $competitions;
            }

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Something is wrong, contact the development sector',
                'Error:' => $e
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $competition = new Competition($request->all());
            $exists = Competition::where(['type' => $request->type, 'date' => $request->date])->first();

            if ($exists) {
                return response()->json([
                    'message' => 'There is already a competition of this type on that date',
                    'status' => 303
                ]);
            } else {
                $competition->save();
                return response()->json([
                    'message' => 'Competition registered successfully',
                    'data' => $request->all(),
                    'status' => 200]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Something is wrong, contact the development sector',
                'Error:' => $e]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Competition $competition
     * @return \Illuminate\Http\Response
     */
    public function show($id_competition)
    {
        try {
            $competition = Competition::where('id', $id_competition)->get();
            if (sizeof($competition) > 0) {
                return response()->json([
                    'message' => 'Competition found',
                    'data' => $competition,
                    'status' => 200
                ]);
            } else {
                return response()->json([
                    'message' => 'Competition not found',
                    'status' => 404
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Something is wrong, contact the development sector',
                'Error:' => $e]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Competition $competition
     * @return \Illuminate\Http\Response
     */
    public function edit(Competition $competition)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Competition $competition
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_competition)
    {
        try {
            $data = $request->all();
            $exists = Competition::where('id','=',$id_competition)->get();
            $competition = Competition::where('id',$id_competition);

            if (sizeof($exists) > 0 ){
                $competition->update($data);
                return response()->json([
                    'message' => 'Competition updated successfully!',
                    'data' => $data,
                    'status' => 200
                ]);
            } else {
                return response()->json([
                    'message' => 'Competition not found',
                    'satus' => 404
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Something is wrong, contact the development sector',
                'Error:' => $e
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Competition $competition
     * @return \Illuminate\Http\Response
     */
    public function destroy(Competition $competition)
    {
        //
    }
}
