<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\Purchase; // Make sure to import your Purchase model
use App\Models\PurchaseCategory;
use App\Models\Location;



class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $purchases = Purchase::paginate(10); // Adjust the per-page count as needed
        $purchasecategory = PurchaseCategory::all();
        $locationnames = Location::all();
        
        $purchase_dates = $purchases->pluck('purchase_date')->toArray();
        $purchase_amounts = $purchases->pluck('total_amount')->toArray();
    
        return view('home', compact('purchases', 'purchasecategory', 'locationnames', 'purchase_dates', 'purchase_amounts'));
    }
    
    
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
    
    

}
