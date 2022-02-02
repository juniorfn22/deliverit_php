<?php

namespace App\Http\Controllers;

use App\Models\Runner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function PHPUnit\Framework\isEmpty;

class RunnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $runners = Runner::all();
            if (sizeof($runners) == 0) {
                return response()->json([
                    'message' => 'Runners dont found',
                    'status' => 404
                ]);
            } else {
                return $runners;
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
            $runner = new Runner($request->all());
            $exists = Runner::where('name', $request->name)->first();
            if ($exists) {
                return response()->json([
                    'message' => 'Runner already exists',
                    'status' => 303
                ]);
            } else {
                $runner->save();
                return response()->json([
                    'message' => 'Runner registered successfully',
                    'data' => $request->all(),
                    'status' => 200]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Something is wrong, contact the development sector',
                'Error:' => $e]);
        }
    }


    public function addRunnerToCompetition(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Runner $runner
     * @return \Illuminate\Http\Response
     */
    public function show($id_runner)
    {
        try {
            $runner = Runner::where('id', '=', $id_runner)->get();
            if (sizeof($runner) > 0) {
                return response()->json([
                    'message' => 'Found Runner',
                    'data' => $runner,
                    'status' => 200
                ]);
            } else {
                return response()->json([
                    'message' => 'Runner not found',
                    'status' => 404
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
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Runner $runner
     * @return \Illuminate\Http\Response
     */
    public function edit(Runner $runner)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Runner $runner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_runner)
    {
        try {
            $data = $request->all();

            $exists = Runner::where('id', '=', $id_runner)->get();
            $runner = Runner::where('id', $id_runner);

            if (sizeof($exists) > 0) {
                $runner->update($data);
                return response()->json([
                    'message' => 'Runner updated successfully!',
                    'data' => $data,
                    'status' => 200
                ]);
            } else {
                return response()->json([
                    'message' => 'Runner not found',
                    'status' => 404
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
     * @param \App\Models\Runner $runner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Runner $runner)
    {
        try {

            $runner = Runner::where('id', $runner->id);

            $runner->delete();

            return response()->json([
                'mensagem' => 'runner deleted successfully!',
                'status' => 200
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Something is wrong, contact the development sector',
                'Eror:' => $e
            ]);
        }
    }
}
