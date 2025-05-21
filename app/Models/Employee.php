<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = ['emp_code','fname','mname','lname','email','contact_no','gender','managerid','team_lead_id', 'senior_emp_id','department','role','skills','fixedsalary','cl','salary_deduction','emp_photo'];

    public function attendances() {
        return $this->hasMany(Attendance::class,'employee_id');
    }

    public function holiday() {
        return $this->hasMany(Holiday::class,'employee_id');
    }
    public function documents()
    {
        return $this->hasMany(EmployeeDocument::class, 'emp_id');
    }

    public function salary()
    {
        return $this->hasOne(EmployeeSalary::class, 'emp_id');
    }
    // In Employee.php (your model)
    public function manager()
    {
        return $this->belongsTo(Employee::class, 'managerid');
    }
    public function getFullNameAttribute()
    {
        return trim("{$this->fname} {$this->mname} {$this->lname}");
    }
    public function teamLeadEmployees()
    {
        return $this->hasMany(Employee::class, 'team_lead_id');
    }

}
