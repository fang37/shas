<?php

namespace Database\Seeders;

use App\Models\Rfid;
use App\Models\Attender;
use App\Models\TimeWork;
use App\Models\TimeEntry;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Attender::factory(20)->create();
        Attender::create([
                'name' => 'Ariq Rizqullah',
                'number_id' => '1801386'
            ]);
        Attender::create([
                'name' => 'Jihad Akbar',
                'number_id' => '1802022'
            ]);
        
        TimeEntry::factory(20)->create();
        
        TimeWork::factory(1)->create();

        Rfid::create([
                'name' => 'Irfan',
                'rfid' => '24718711817',
                'number_id' => '1801366'
            ]);
        Rfid::create([
                'name' => 'Ariq',
                'rfid' => '4112111226',
                'number_id' => '1801386'
            ]);
        Rfid::create([
                'name' => 'Jihad',
                'rfid' => '1632542322',
                'number_id' => '1802022'
            ]);

        
        // \App\Models\User::factory(10)->create();
        // Attender::create([
        //     'name' => 'Irfan Ghifari',
        //     'number_id' => '1801366'
        // ]);
        // Attender::create([
        //     'name' => 'Shafira',
        //     'number_id' => '1801367'
        // ]);
        // Attender::create([
        //     'name' => 'Meifa',
        //     'number_id' => '1801368'
        // ]);

        // TimeEntry::create([
        //     'attender_id' => 1,
        //     'time_start' => date("2021-8-17 7:00:10"),
        //     'time_end' => date("2021-8-17 15:30:00")
        // ]);

        // TimeEntry::create([
        //     'attender_id' => 3,
        //     'time_start' => date("2021-8-17 7:03:15"),
        //     'time_end' => date("2021-8-17 16:30:00")
        // ]);

        // TimeEntry::create([
        //     'attender_id' => 2,
        //     'time_start' => date("2021-8-17 6:50:10"),
        //     'time_end' => date("2021-8-17 15:30:15")
        // ]);
        // TimeEntry::create([
        //     'attender_id' => 2,
        //     'time_start' => date("2021-8-18 6:58:11"),
        //     'time_end' => date("2021-8-18 15:30:10")
        // ]);
        // TimeEntry::create([
        //     'attender_id' => 2,
        //     'time_start' => date("2021-8-17 7:00:10"),
        // ]);

    }
}
