<?php

namespace App\Http\Controllers;

use App\Models\Attender;
use App\Models\TimeWork;
use App\Models\TimeEntry;
use Illuminate\Http\Request;
use PhpMqtt\Client\SubscribeRequest;

class TimeEntryController extends Controller
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
        $current_time = date('H:i:s', time());
        $current_date = date('Y-m-d', time());
        $time_entries = TimeEntry::with('attender')->whereDate('time_start', ($date)??$current_date)->orderBy('time_start', 'DESC');
        $time_work = TimeWork::whereDate('date', $current_date)->first();
    
        $time_status = "";

        if ($current_time > $time_work->start_at && $current_time < $time_work->end_at){
           $time_status = "Waktu Kerja";
        };
        if($current_time > $time_work->end_at) {
            $time_status = "Waktu Pulang";
        };
        if($current_time < $time_work->start_at){
            $time_status = "Waktu Masuk";
        };
    
        
        // ->get()
        
        
        // if(request('search')) {
        //     $attender = Attender::firstWhere('number_id', request('search'));
        //     // $title = ' in '. $attender->name;
        // }
        
        // if(request('datepicker')) {
            
        //     $date = request('datepicker');
        //     //$attender = Attender::firstWhere('number_id', request('datepicker'));
        //     // dd(['datepicker']);
        //     $time_entries = TimeEntry::with('attender')->whereDate('time_start', $date);
        // }

        return view('attendance', [
            "title" => "Attendance",
            "current_day" => $current_day,
            "current_date" => $current_date,
            "time_status" => $time_status,
            "time_entries" => $time_entries->filter(request(['search', 'attender', 'author', 'datepicker']))->paginate(10)->withQueryString()
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
        // dd($request);
        $time_entry = new TimeEntry;
        $time_entry->attender_id = $request->attender_id;
        $time_entry->temperature = $request->temperature;
        $time_entry->time_start = $request->time_start;
        $time_entry->time_end = $request->time_end;
        // dd($time_entry);

        $request->validate([
            'attender_id' => 'required',
            'temperature' => 'required',
            'time_start' => 'required',
        ]);

        $time_entry->save();

        return redirect('/employee')->with('status', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TimeEntry  $timeEntry
     * @return \Illuminate\Http\Response
     */
    public function show(TimeEntry $timeEntry)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TimeEntry  $timeEntry
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $time_entry = TimeEntry::find($id);
        return view('time_entry.edit', [
            "title" => "Attendance Time Entries",
            "time_entry" => $time_entry
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TimeEntry  $timeEntry
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $time_entry = TimeEntry::find($id);
        $request->validate([
            // 'attender_id' => 'required',
            // 'temperature' => 'required',
            'time_end' => 'required',
        ]);

        TimeEntry::where('id', $id)
        ->update([
            'attender_id' => $request->attender_id,
            'temperature' => ($request->temperature) ?? $time_entry->temperature,
            'time_start' => ($request->time_start) ?? $time_entry->time_start,
            'time_end' => ($request->time_end) ?? $time_entry->time_end
        ]);
        return redirect('/attendance');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TimeEntry  $timeEntry
     * @return \Illuminate\Http\Response
     */
    public function destroy(TimeEntry $timeEntry)
    {
        //
    }
}
