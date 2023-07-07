<?php
  
namespace App\Http\Controllers;
   
use App\Models\Purchase;
use App\Models\Project;
use App\Models\Location;
use App\Models\PurchaseCategory;
use App\Models\User;
use App\Models\State;


use Illuminate\Http\Request;
  
class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $purchases= Purchase::latest()->paginate(5);
        return view('purchases.index',compact('purchases'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
      /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function create()
    {
        $projectnames = Project::latest()->get();
        $locationnames = Location::latest()->get();
        $purchasecategory = PurchaseCategory::latest()->get();
             $users = User::where('usertype', 3)->latest()->get();
        $statenames = State::latest()->get();
        return view('purchases.create',compact('projectnames','locationnames','purchasecategory','users','statenames'));
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
            'purchase_category' => 'required',
            'product_image' => 'required|max:2048',
        ]);
       
      
      
           $name = $request->file('product_image')->getClientOriginalName();
           $extension = $request->file('product_image')->getClientOriginalExtension();
          
          $path = $request->file('product_image')->store('public/product_image');
         
$p=explode('/',$path);
$filepath= 'storage/product_image/'.$p[2];
Purchase::create(array(
            'project_name' => $request['project_name'],
            'project_location' => $request['project_location'],
            'purchase_date' => $request['purchase_date'],
            'purchase_category' => $request['purchase_category'],
            'product_image' => $filepath,
            'total_amount' => $request['total_amount'],
            'subcontractor' => $request['subcontractor'],
            'state' => $request['state'],
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'email' => $request['email'],
            'phone' => $request['phone_number'],
            'userid' => $request['userid'],

                ));
    
                
       // Purchase::create($request->all());  
      
           
    
        return redirect()->route('purchases.index')
                        ->with('success','Purchase  created successfully.');
    }
    
     
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
   public function edit(Purchase $purchase)
    {
        $locationnames = Location::latest()->get();
        $purchasecategory = PurchaseCategory::latest()->get();
        $users = User::where('usertype', 3)->latest()->get();
        $projectnames = Project::latest()->get();
        $statenames = State::latest()->get();

        return view('purchases.edit',compact('purchase','locationnames','purchasecategory','users','projectnames','statenames'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Purchase $purchase)
    {
        $request->validate([
            'purchase_category' => 'required',
        ]);
        if(!empty($target = $request['product_image_new']))
        {
           
        $name = $request->file('product_image_new')->getClientOriginalName();
        $extension = $request->file('product_image_new')->getClientOriginalExtension();
       $path = $request->file('product_image_new')->store('public/product_image');
       

$p=explode('/',$path);
$filepath= 'storage/product_image/'.$p[2];
$filepath= 'storage/product_image/'.$p[2];
$purchase->update(array(
    'product_name' => $request['product_name'],
    'project_name' => $request['project_name'],
    'project_location' => $request['project_location'],
    'purchase_date' => $request['purchase_date'],
    'purchase_category' => $request['purchase_category'],
    'product_image' => $filepath,
    'total_amount' => $request['total_amount'],
    'subcontractor' => $request['subcontractor'],
    'state' => $request['state'],
    'first_name' => $request['first_name'],
    'last_name' => $request['last_name'],
    'email' => $request['email'],
    'phone' => $request['phone_number'],
    'userid' => $request['userid'],
        ));
        }
        else{
           // print_r($request['phone_number']);exit;
            //echo "old image";exit;
            $purchase->update($request->all());
       echo $purchase;exit;
        }
        
    
        return redirect()->route('purchases.index')
                        ->with('success','Purchase updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
  public function destroy(Purchase $purchase)
    {
        $purchase->delete();
    
        return redirect()->route('purchases.index')
                        ->with('success','Purchase  deleted successfully');
    }
}
?>