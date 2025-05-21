<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeSalary extends Model
{
    protected $table = 'employee_salary';
    protected $fillable = [
        'emp_id',
        'basic',
        'hra',
        'conv_allowance',
        'trans_allowance',
        'others',
        'medical_allowance',
        'pf_employer',
        'bonus',
        'esi_employer',
        'other_benefits',
        'salary_nett',
        'increment_percent',
        'incremented_salary',
        'created_at'
    ];
}
