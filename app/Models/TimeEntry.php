<?php

namespace App\Models;

use PhpMqtt\Client\Facades\MQTT;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TimeEntry extends Model
{
    use HasFactory;
    // use SoftDeletes;
    protected $guarded = ['id'];
    
    public function scopeFilter($query, array $filters)
    {
        // $query->when($filters['search'] ?? false, function($query, $search){
        //     return $query->where('id', 'like', '%' . $search . '%')
        //     ->orWhere('attender_id', 'like', '%'. $search . '%');
        // });

        // $query->when($filters['category'] ?? false, function($query, $category){
        //     return $query->whereHas('category', function($query) use ($category){
        //         $query->where('slug', $category);

        //     });
        // });

        // $query->when($filters['author'] ?? false, function($query, $author){
        //     return $query->whereHas('author', function($query) use ($author){
        //         $query->where('username', $author);

        //     });
        // });
        
        $query->when($filters['search'] ?? false, fn($query, $search) => 
            $query->whereHas('attender', fn($query) => 
                $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('number_id', 'like', '%'. $search . '%')
            
        ));
        $query->when($filters['datepicker'] ?? false, fn($query, $datepicker) => 
            $query->whereDate('time_start', 'like', '%' . $datepicker . '%')
            ->orWhere('time_end', 'like', '%'. date('Y-m-d').' 00:00:00' . '%')
        );


        // $query->when($filters['datepicker'] ?? false, fn($query, $datepicker) => 
        //     $query->whereHas('attender', fn($query) => 
        //         $query->where('time_start', 'like', '%' . $datepicker . '%')
        //         ->orWhere('time_end', 'like', '%'. $datepicker . '%')
            
        // ));
    }

    public function subscribe()
    {
        /** @var \PhpMqtt\Client\Contracts\MqttClient $mqtt */
        $mqtt = MQTT::connection();
        $mqtt->subscribe('/oneM2M/resp/antares-cse/d6983693e35e5710:16913e6eae1d0d05/json', function (string $topic, string $message) {
            echo sprintf('Received QoS level 1 message on topic [%s]: %s', $topic, $message);
        }, 1);
        $mqtt->loop(true);
    }
    
    public function attender()
    {
        return $this->belongsTo(Attender::class);
    }
}
