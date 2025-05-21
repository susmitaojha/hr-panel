<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = ['employee_id', 'date', 'entry_time', 'exit_time', 'status'];

    public function employee() {
        return $this->belongsTo(Employee::class,'employee_id');
    }
}
