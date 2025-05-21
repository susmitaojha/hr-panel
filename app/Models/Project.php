<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['id','p_code','pname', 'hours', 'status', 'note', 'priority', 'managerid', 'team_lead_id', 'created_at', 'updated_at', 'start_date', 'end_date'];

    public function manager()
    {
        return $this->belongsTo(Employee::class, 'managerid');
    }

    public function teamLead()
    {
        return $this->belongsTo(Employee::class, 'team_lead_id');
    }
    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

}
