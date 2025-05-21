<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeDocument extends Model
{
    protected $table = 'employee_documents';
    protected $fillable = ['emp_id', 'emp_document', 'status', 'created_at'];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'emp_id');
    }
}
