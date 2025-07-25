<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\User; // Assuming User model exists in the same namespace

class Appointment extends Model
{
    protected $fillable = ['customer_name', 'email', 'appointment_time', 'notes'];
    protected $casts = [
        'appointment_time' => 'datetime',
    ];
    public $timestamps = false; // Assuming you don't want timestamps for created_at and updated_at
    protected $table = 'appointments'; // Specify the table name if it differs from the default
    protected $primaryKey = 'id'; // Specify the primary key if it differs from the



    // default 'id' 
    public function user()
    {
        return $this->belongsTo(User::class); // Assuming an appointment belongs to a user
    }

}
