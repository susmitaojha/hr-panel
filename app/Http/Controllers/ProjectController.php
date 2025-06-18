<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Employee;
use App\Models\ProjectAssignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function index()
    {
        // $data = Project::all();
        // return view('frontend.addproject', compact('data'));
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'You need to be logged in to access this page.');
        } else {
            $auth_user_id = Auth::user()->id;
            $data = Project::with(['manager', 'teamLead'])->where('is_deleted', 0)->orderBy('created_at', 'ASC')->get();
            return view('frontend.allProject', ['data' => $data]);
        }
    }
    public function appEditProject(Request $request, $id)
    {
        $data['project'] = Project::find($id);
        $data['mangerdata'] = Employee::where('role', '1')->where('status', '0')->where('is_deleted', 0)->orderBy('id', 'desc')->get();
        $data['teamleaddata'] = Employee::where('role', '2')->where('status', '0')->where('is_deleted', 0)->orderBy('id', 'desc')->get();
        return view('frontend.addProject', $data);
    }
    public function addProject(Request $request)
    {
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'You need to be logged in to access this page.');
        } else {
            if ($request->project_id == 0) {
                $validated = $request->validate([
                    'pname' => 'required|string|max:255',
                    'note' => 'nullable|string',
                    'priority' => 'required|in:Low,Medium,High',
                    'managerid' => 'required|numeric',
                    'team_lead_id' => 'required|numeric',
                    'start_date' => 'nullable|date',
                    'end_date' => 'nullable|date',
                    'hours' => 'nullable|numeric',
                    'status' => 'nullable|string',
                ]);

                $projectName = $request->pname;
                $p_code = strtoupper(substr(preg_replace('/\s+/', '', $projectName), 0, 3)) . time();

                $project = Project::create([
                    'p_code' => $p_code,
                    'pname' => $request->pname,
                    'hours' => $request->hours,
                    'note' => $request->note,
                    'priority' => $request->priority,
                    'managerid' => $request->managerid,
                    'team_lead_id' => $request->team_lead_id,
                    'start_date' => $request->start_date,
                    'end_date' => $request->end_date,
                    'status' => $request->status,
                ]);
                if ($project) {
                    return redirect()->back()->with('success', 'Project added successfully');
                } else {
                    return redirect()->back()->with('error', 'Failed to add project');
                }
            } else{
                $project = Project::find($request->project_id);

                if ($project) {
                    $project->pname = $request->pname;
                    $project->hours = $request->hours;
                    $project->note = $request->note;
                    $project->priority = $request->priority;
                    $project->managerid = $request->managerid;
                    $project->team_lead_id = $request->team_lead_id;
                    $project->start_date = $request->start_date;
                    $project->end_date = $request->end_date;
                    $project->status = $request->status;

                    if ($project->save()) {
                        return redirect()->back()->with('success', 'Project updated successfully');
                    } else {
                        return redirect()->back()->with('error', 'Failed to update project');
                    }
                } else {
                    return redirect()->back()->with('error', 'Project not found');
                }
            }
        }
    }
    public function assignProject(Request $request, $id){

        $project = Project::with(['manager', 'teamLead'])->find($id);
        $assignedEmployeeIds = ProjectAssignment::where('projectID', $id)
            ->pluck('employeeID')
            ->toArray();

        $data['project'] = $project;
        $data['assignEmployees'] = $project && $project->teamLead
            ? $project->teamLead->teamLeadEmployees
            : collect();
        $data['assignedEmployeeIds'] = $assignedEmployeeIds;
        return view('frontend.assignProject', $data);

    }
    public function postAssignEmployees(Request $request){

        $request->validate([
            'projectId' => 'required|exists:projects,id',
            'employees' => 'required|array',
        ]);

        $projectId = $request->projectId;
        $alreadyAssigned = [];

        foreach ($request->employees as $employeeId) {
            $exists = ProjectAssignment::where('projectID', $projectId)
                                       ->where('employeeID', $employeeId)
                                       ->exists();

            if ($exists) {
                $alreadyAssigned[] = $employeeId; // Just track IDs, no need for names
            } else {
                ProjectAssignment::create([
                    'projectID' => $projectId,
                    'employeeID' => $employeeId,
                ]);
            }
        }

        if (!empty($alreadyAssigned)) {
            return redirect()->back()->with('error', 'These employees are already assigned to this project.');
        }

        return redirect()->back()->with('success', 'Employees assigned to project successfully.');
    }
    public function deleteProject($id)
    {
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'You need to be logged in to access this page.');
        } else {
            $project = Project::find($id);
            if ($project) {
                $project->is_deleted = 1;
                $project->save();

                return redirect()->back()->with('success', 'Project marked as deleted.');
            }
            return redirect()->back()->with('error', 'Project not found.');
        }
    }
}
