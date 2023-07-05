<?php
  
namespace App\Http\Controllers;
   
use App\Models\State;

use Illuminate\Http\Request;
  
class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {
        $states = State::latest()->paginate(5);
    
        return view('states.index',compact('states'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
      /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function create()
    {

        return view('states.create');
    }
    function getStateData($id=null)
    {
        $state = $id?State::find($id):State::all();
    
        return $state;
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
            'state_name' => 'required',
        ]);
       
        State::create($request->all());      
          
    
        return redirect()->route('states.index')
                        ->with('success','State created successfully.');
    }
    
    public function addStateData(Request $request)
    {
        $request->validate([
            'state_name' => 'required',
        ]);
       
        $result=State::create($request->all());      
          
    
        if($result)
        {
            return ["Result"=>"Data has been saved"];
        }
        else{
            return ["Result"=>"Failed"];
        }
    }
     
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\State  $state
     * @return \Illuminate\Http\Response
     */
  public function edit(State $state)
    {

        return view('states.edit',compact('state'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\State  $State
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, State $state)
    {
        $request->validate([
            'state_name' => 'required',
           
        ]);
        
        $state->update($request->all());
       
    
        return redirect()->route('states.index')
                        ->with('success','Company updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\State  $state
     * @return \Illuminate\Http\Response
     */
  public function destroy(State $state)
    {
        $state->delete();
    
        return redirect()->route('states.index')
                        ->with('success','State deleted successfully');
    }
    public function deleteStateData($id)
    {
        $state = State::find($id);

        $result=$state->delete();
    if( $result)
       {
        return["result"=>"Record has been deleted ".$id];
       }
       else
       {
        return["result"=>"Delete operation is failed ".$id];
       }
       
    }
}