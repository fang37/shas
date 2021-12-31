<?php

namespace App\Http\Controllers;

use App\Models\Rfid;
use App\Models\Attender;
use App\Models\TimeWork;
use App\Models\TimeEntry;
use App\Libraries\antares_php;

use Illuminate\Http\Request;
use function PHPUnit\Framework\isEmpty;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Console\Input\Input;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;

class APIController extends Controller
{
    public function create(Request $request) 
    {
        $current_date = date('Y-m-d', time());
        $current_time = date('H:i:s', time());
        
        $time_work = TimeWork::whereDate('date', $current_date)->first();
        
        $request->validate([
            'nim' => 'required',
            'temp' => 'required'
        ]);
        $attender_id = (Attender::where('number_id', $request->nim)->first()->id) ?? null;

        if($attender_id == null) return response()->json([
            'message' => 'id tidak terdaftar'
        ], 404);
        
        $time_entries = TimeEntry::whereDate('time_start', $current_date)->get();
        $time_entries = $time_entries->where('attender_id', $attender_id)->first();
        
        //dd($time_entry);
        
        if($time_entries == null)
        {
            // dd('presensi masuk');
            $time_entry = new TimeEntry;
            $time_entry->attender_id = $attender_id;
            $time_entry->temperature = $request->temp;
            $time_entry->time_start = date('Y-m-d H:i:s', time());
            $time_entry->save();

            $antares = new antares_php();
            $antares->set_key('d6983693e35e5710:16913e6eae1d0d05');
            $yourdata = '{"id" :"'.$request->nim.'", "temp":"'.$time_entry->temperature.'"}';
            $antares->send($yourdata, 'flutterDevice', 'flutter');
            
            return response()->json([
                'message' => 'presensi masuk berhasil'
            ], 200);
            }
            // ($time_entries->whereDate('time_start', $current_date) <> null )
        else
        {
            if($current_time > $time_work->end_at) {
                // dd("Waktunya pulang");
                // WAKTU PULANG
                TimeEntry::where('id', $time_entries->id)
                    ->update([
                    'time_end' => date('Y-m-d H:i:s', time())
                ]);

                $antares = new antares_php();
                $antares->set_key('d6983693e35e5710:16913e6eae1d0d05');
                $yourdata = '{"id" :"'.$request->nim.'", "temp":"'.$request->temp.'"}';
                $antares->send($yourdata, 'flutterDevice', 'flutter');

                return response()->json([
                    'message' => 'presensi keluar berhasil'
                ], 200);
            } else{
                $antares = new antares_php();
                $antares->set_key('d6983693e35e5710:16913e6eae1d0d05');
                $yourdata = '{"id" :"'.$request->nim.'", "temp":"'.$request->temp.'"}';
                $antares->send($yourdata, 'flutterDevice', 'flutter');
                
                return response()->json([
                'message' => 'belum waktu pulang'
            ], 201);}

        };
        // $time_entry->time_start = $request->time_start;
        // $time_entry->time_end = $request->time_end;
        // dd($time_entry);

        

        // dd($request->all());
        
        // $time_entry = new TimeEntry;
        // $time_entry->where()

        return response()->json([
            'message' => 'ini halaman create data'
        ], 200);
    }

    public function image(Request $request) 
    {
        $image = base64_decode($request->image);
        $id = $request->id;

        $current_date = date('Y-m-d', time());

        $imageName = $id."_".$current_date.'.jpeg';
        
        $attender_id = (Attender::where('number_id', $id)->first()->id) ?? null;

        if($attender_id == null) return response()->json([
            'message' => 'id tidak terdaftar'
        ], 200);

        $time_entries = TimeEntry::whereDate('time_start', $current_date)->get();
        $time_entries = $time_entries->where('attender_id', $attender_id)->first();


        // Cek kalau absen pulang
        if($time_entries->time_end <> null)
        {
            return response()->json([
                'message' => 'waktu pulang tidak foto'
            ], 200);
        }

        
        // $image = $request->image;  // your base64 encoded
        // $image = str_replace('data:image/jpeg;base64,', '', $image);   
        // $image = str_replace('data:image/png;base64,', '', $image);
        // $image = str_replace(' ', '+', $image);
        // Storage::putFile(storage_path(). '/' . $imageName, base64_decode($image));
        
        
        $time_entries->update([
            'file_path' => $imageName,
        ]);
        
        Storage::disk('public')->put($imageName, $image);
        
        return response()->json([
            'message' => 'photo captured for : '.$id
        ], 200);
        
    }

    public function getId(Request $request) 
    {
        $request->validate([
            'rfid' => 'required',
        ]);

        $rfids = Rfid::where('rfid', $request->rfid)->first();

        $number_id = ($rfids->number_id) ?? null;

        if ($number_id == null) {
            return response()->json([
                'message' => 'id tidak ditemukan'
            ], 404);
        }
        
        $name = $rfids->name;
        // dd($request->all());
        
        // $time_entry = new TimeEntry;
        // $time_entry->where()

        return response()->json([
            'name' => $name,
            'number_id' => $number_id
        ], 200);
    }
}
