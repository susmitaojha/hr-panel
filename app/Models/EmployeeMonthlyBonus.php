<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeMonthlyBonus extends Model
{
     protected $table = 'employee_monthly_bonus';
    protected $fillable = [
        'emp_id', 'bonus_month', 'bonus_amount', 'bonus_reason',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
