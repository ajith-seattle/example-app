<?php
  
namespace App\Http\Controllers;
   
use App\Models\Project;
use App\Models\Location;
use App\Models\State;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // $projects = Project::latest()->paginate(5);
    
        $projects = DB::table('projects')
            ->join('users', 'projects.subcontractor', '=', 'users.id')
            ->join('locations', 'projects.location', '=', 'locations.id')
            ->join('states', 'projects.state', '=', 'states.id')
            ->select('projects.*', 'users.name','locations.location_name','states.state_name')
            ->get();
        return view('projects.index',compact('projects'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
      /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function create()
    {
        $locationnames = Location::latest()->get();
        $statenames = State::latest()->get();
        $subcontractors = User::select('*')
        ->where('usertype', '=', 3)
        ->get();
        return view('projects.create',compact('locationnames','statenames','subcontractors'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'project_name' => 'required',
        ]);
       
        Project::create($request->all());      
          
    
        return redirect()->route('projects.index')
                        ->with('success','Project created successfully.');
    }
    
     
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
  public function edit(Project $project)
    {

        $locationnames = Location::latest()->get();
        $statenames = State::latest()->get();
        $subcontractors = User::select('*')
        ->where('usertype', '=', 3)
        ->get();
        return view('projects.edit',compact('project','locationnames','statenames','subcontractors'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $Project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'project_name' => 'required',
           
        ]);
        
        $project->update($request->all());
       
    
        return redirect()->route('projects.index')
                        ->with('success','Project updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
  public function destroy(Project $project)
    {
        $project->delete();
    
        return redirect()->route('projects.index')
                        ->with('success','Project deleted successfully');
    }
}