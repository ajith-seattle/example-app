<?php
  
namespace App\Http\Controllers;
   
use App\Models\PurchaseCategory;

use Illuminate\Http\Request;
  
class PurchaseCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $purchasecategories = PurchaseCategory::latest()->paginate(5);
        return view('purchasecategories.index',compact('purchasecategories'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
      /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function create()
    {

        return view('purchasecategories.create');
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
        ]);
       
        PurchaseCategory::create($request->all());  
      
           
    
        return redirect()->route('purchasecategories.index')
                        ->with('success','Purchase Category created successfully.');
    }
    
     
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PurchaseCategory  $purchasecategory
     * @return \Illuminate\Http\Response
     */
   public function edit(PurchaseCategory $purchasecategory)
    {


        return view('purchasecategories.edit',compact('purchasecategory'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PurchaseCategory  $purchasecategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PurchaseCategory $purchasecategory)
    {
        $request->validate([
            'purchase_category' => 'required',
        ]);
       
        $purchasecategory->update($request->all());
        
    
        return redirect()->route('purchasecategories.index')
                        ->with('success','Purchase Category updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PurchaseCategory  $purchasecategory
     * @return \Illuminate\Http\Response
     */
  public function destroy(PurchaseCategory $purchasecategory)
    {
        $purchasecategory->delete();
    
        return redirect()->route('purchasecategories.index')
                        ->with('success','Purchase Category deleted successfully');
    }
}
?>