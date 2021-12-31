<?php

namespace App\Http\Controllers;

use App\Models\TimeWork;
use Illuminate\Http\Request;

class TimeWorkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $date = request('date');
        $current_day = date('l d-m-Y');
        $current_date = date('Y-m-d', time());
        $time_work = TimeWork::whereDate('date', ($date)??$current_date)->first();

        return view('time-work', [
            "title" => "Time Work",
            "current_day" => $current_day,
            "current_date" => $current_date,
            "time_work" => $time_work
        ]); 
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
     * @param  \App\Models\TimeWork  $timeWork
     * @return \Illuminate\Http\Response
     */
    public function show(TimeWork $timeWork)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TimeWork  $timeWork
     * @return \Illuminate\Http\Response
     */
    public function edit(TimeWork $timeWork)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TimeWork  $timeWork
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $time_work = TimeWork::find($id);
        $request->validate([
            'start_at' => 'required',
            'end_at' => 'required',
        ]);

        TimeWork::where('id', $id)
        ->update([
            'start_at' => ($request->start_at) ?? $time_work->start_at,
            'end_at' => ($request->end_at) ?? $time_work->end_at
        ]);
        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TimeWork  $timeWork
     * @return \Illuminate\Http\Response
     */
    public function destroy(TimeWork $timeWork)
    {
        //
    }
}
