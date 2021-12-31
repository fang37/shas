<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attender extends Model
{
    use HasFactory;
    // use SoftDeletes;

    protected $guarded = ['id'];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function($query, $search){
                return $query->where('number_id', 'like', '%' . $search . '%')
                ->orWhere('name', 'like', '%'. $search . '%');
            });
    }


    public function time_entries()
    {
        return $this->hasMany(TimeEntry::class);
    }
}
