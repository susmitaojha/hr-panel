<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectAssignment extends Model
{
    protected $table = 'projectassignments';
    protected $fillable = ['id', 'projectID', 'employeeID'];



}
