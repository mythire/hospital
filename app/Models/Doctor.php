<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;
    use \Staudenmeir\EloquentJsonRelations\HasJsonRelationships;

    protected $fillable = [
        'user_id',
        'saluation',
        'day',
        'time',
        'speciality',
        'fees',
    ];

    protected $casts = [
        'clinic_id' => 'array'
    ];


    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }


    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }


}
