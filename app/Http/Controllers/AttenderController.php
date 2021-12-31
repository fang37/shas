<?php

namespace App\Http\Controllers;

use App\Models\Attender;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\MqttConnect;
use App\Models\TimeEntry;

class AttenderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    
    public function index()
    {
        // $employees = Attender::all();
        $employees = Attender::with('time_entries');

        if(request('search')) {
            $attender = Attender::firstWhere('number_id', request('search'));
            // $title = ' in '. $attender->name;
        }

        return view('employee', [
            "title" => "Employee Management",
            "employees" => $employees->filter(request(['search', 'attender', 'author']))->paginate(10)->withQueryString()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employees = Attender::all();
        return view('attenders.create', [
            "title" => "Employee Management",
            "employees" => $employees
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attender = new Attender;
        $attender->name = $request->name;
        $attender->number_id = $request->number_id;
        $attender->division = $request->division;
        $attender->phone = $request->phone;
        
        $request->validate([
            'name' => 'required',
            'number_id' => 'required',
            'division' => 'required',
            'phone' => 'required',
        ]);

        $attender->save();

        // Attender::create([
        //     'nama' => $request->nama,
        //     'nim' => $request->nim,
        //     'email' => $request->email,
        //     'jurusan' => $request->jurusan,
        //     ]);

        // Attender::create($request->all());
        return redirect('/employee')->with('status', 'Data berhasil ditambahkan');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Attender  $attender
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = Attender::find($id);
        $time_entries = TimeEntry::with('attender')->where('attender_id', $id)->orderBy('time_start', 'DESC');

        $current_date = date('Y-m-d H:i:s', time());
        //dd($employee);
        // $employee = $employee->where('id', $id)->get();
        //$time_entries = $employee->time_entries;
        return view('attenders.show', [
            "title" => "Employee Detail",
            "employee" => $employee,
            "current_date" => $current_date,
            "time_entries" => $time_entries->paginate(2)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Attender  $attender
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = Attender::find($id);
        return view('attenders.edit', [
            "title" => "Employee Edit",
            "employee" => $employee
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Attender  $attender
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $attender = Attender::find($id);
        $request->validate([
            'name' => 'required',
            'number_id' => 'required',
            'division' => 'required',
            'phone' => 'required',
        ]);

        Attender::where('id', $attender->id)
        ->update([
            'name' => $request->name,
            'number_id' => $request->number_id,
            'division' => $request->division,
            'phone' => $request->phone            
        ]);
        return redirect('/employee')->with('status', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Attender  $attender
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attender $attender)
    {
        TimeEntry::where('attender_id', $attender->id)->delete();
        
        Attender::destroy($attender->id);

        return redirect('/employee')->with('status', 'Data berhasil dihapus');

    }
}
