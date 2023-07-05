<?php
  
namespace App\Http\Controllers;
   
use App\Models\Location;

use Illuminate\Http\Request;
  
class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $locations = Location::latest()->paginate(5);
    
        return view('locations.index',compact('locations'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    function getLocationData($id=null)
    {
        $location = $id?Location::find($id):Location::all();
    
        return $location;
    }
      /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function create()
    {

        return view('locations.create');
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
            'location_name' => 'required',
        ]);
       
        Location::create($request->all());      
          
    
        return redirect()->route('locations.index')
                        ->with('success','Location created successfully.');
    }
    
    public function addLocationData(Request $request)
    {
        $request->validate([
            'location_name' => 'required',
        ]);
       
        $result=Location::create($request->all());      
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
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
  public function edit(Location $location)
    {

        return view('locations.edit',compact('location'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Location  $Location
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Location $location)
    {
        $request->validate([
            'location_name' => 'required',
           
        ]);
        
        $location->update($request->all());
       
    
        return redirect()->route('locations.index')
                        ->with('success','Company updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
  public function destroy(Location $location)
    {
        $location->delete();
    
        return redirect()->route('locations.index')
                        ->with('success','Location deleted successfully');
    }

    public function deleteLocationData($id)
    {
        $location = Location::find($id);

        $result=$location->delete();
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