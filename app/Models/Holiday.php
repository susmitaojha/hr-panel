<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    protected $fillable = ['employee_id','date', 'reason'];

    public function employee() {
        return $this->belongsTo(Employee::class,'employee_id');
    }
}
