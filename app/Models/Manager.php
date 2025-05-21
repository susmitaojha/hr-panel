<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Manager extends Model
{
    protected $fillable = ['fname','mname','lname','email','gender','designation','role','skills','fixedsalary'];

    public function projects()
    {
        return $this->hasMany(Project::class, 'managerid');
    }
    public function employees()
    {
        return $this->hasMany(Employee::class, 'managerid');
    }
}
