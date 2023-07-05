<?php
  
namespace App\Http\Controllers;
   
use App\Models\Company;

use Illuminate\Http\Request;
  
class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::latest()->paginate(5);
        return view('companies.index',compact('companies'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    function getCompanyData($id=null)
    {
        $company = $id?Company::find($id):Company::all();
    
        return $company;
    }
      /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function create()
    {

        return view('companies.create');
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
            'company_name' => 'required',
            'company_logo' => 'required|max:2048',
        ]);
       
        
      
           $name = $request->file('company_logo')->getClientOriginalName();
           $extension = $request->file('company_logo')->getClientOriginalExtension();
          
          $path = $request->file('company_logo')->store('public/company_logos');
         
$p=explode('/',$path);
$filepath= 'storage/company_logos/'.$p[2];
           Company::create(array(
            'company_name' => $request['company_name'],
            'company_logo'  => $filepath,
                ));
    
        return redirect()->route('companies.index')
                        ->with('success','Company created successfully.');
    }

    public function addCompanyData(Request $request)
    {
        $request->validate([
            'company_name' => 'required',
            'company_logo' => 'required|max:2048',
        ]);
       
        
      
           $name = $request->file('company_logo')->getClientOriginalName();
           $extension = $request->file('company_logo')->getClientOriginalExtension();
          
          $path = $request->file('company_logo')->store('public/company_logos');
         
$p=explode('/',$path);
$filepath= 'storage/company_logos/'.$p[2];
$result= Company::create(array(
            'company_name' => $request['company_name'],
            'company_logo'  => $filepath,
                ));
    
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
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
   public function edit(Company $company)
    {


        return view('companies.edit',compact('company'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Company  $Company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        $request->validate([
            'company_name' => 'required',
            'company_logo' => 'required|max:2048',
        ]);
        if(!empty($target = $request['company_logo_new']))
        {
        $name = $request->file('company_logo_new')->getClientOriginalName();
        $extension = $request->file('company_logo_new')->getClientOriginalExtension();
       
       $path = $request->file('company_logo_new')->store('public/company_logos');
      
$p=explode('/',$path);
$filepath= 'storage/company_logos/'.$p[2];
$filepath= 'storage/company_logos/'.$p[2];
$company->update(array(
            'company_name' => $request['company_name'],
            'company_logo'  => $filepath,
                ));
        }
        else{
        $company->update($request->all());
        }
    
        return redirect()->route('companies.index')
                        ->with('success','Company updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
  public function destroy(Company $company)
    {
        $company->delete();
    
        return redirect()->route('companies.index')
                        ->with('success','Company deleted successfully');
    }

    public function deleteCompanyData($id)
    {
        $company = Company::find($id);

        $result=$company->delete();
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