<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Appointment extends Model
{
    use HasFactory;
    use \Staudenmeir\EloquentJsonRelations\HasJsonRelationships;
    use SoftDeletes;

    protected $fillable = [
        'reference_no',
        'doctor_id',
        'session_datetimestamp',
        'name',
        'address',
        'status'
    ];

    protected $casts = [
        'session_datetimestamp' => 'datetime',
    ];

    public function viewDoctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id', 'id');
    }


}
