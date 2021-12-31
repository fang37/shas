<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpMqtt\Client\Facades\MQTT;

class MqttConnect extends Model
{
    use HasFactory;

    public function subscribe()
    {
        /** @var \PhpMqtt\Client\Contracts\MqttClient $mqtt */
        $mqtt = MQTT::connection();
        $mqtt->subscribe('/oneM2M/resp/antares-cse/d6983693e35e5710:16913e6eae1d0d05/json', function (string $topic, string $message) {
            echo sprintf('Received QoS level 1 message on topic [%s]: %s', $topic, $message);
        }, 1);
        $mqtt->loop(true);
    }
}
