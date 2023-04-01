<?php

namespace App\Http\Controllers;

use App\Models\Response;
use Illuminate\Http\Request;

class ResponseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Response $response)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($interview_id)
    {
        
        $interview = Response::where ('interview_id', $interview_id)->first();
        $lamaranId = $interview_id;
        return view('response', compact('interview', 'lamaranId'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateResponse(Request $request, $lamaran_id)
    {
        $request->validate([
            'status' => 'required',
            'pesan' => 'required',
        ]);
        if ($request->status == 'Ditolak')
        {
            $schedule = null;
        }
        else {
            $schedule = $request->schedule;
        }
        Response::updateorCreate(
            [
                'interview_id' => $lamaran_id
            ],
            [
                'status'=> $request->status,
                'pesan' => $request->pesan,
                'schedule' =>$schedule,
            ]
            );

            return redirect()->route('data_petugas')->with('toast_success', 'Berhasil Mengubah Data!');
       
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Response $response)
    {
        //
    }
}
