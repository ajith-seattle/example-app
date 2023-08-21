<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\Project;
use App\Models\Location;
use App\Models\PurchaseCategory;
use App\Models\User;
use App\Models\State;

use Illuminate\Http\Request;

// pdf 
use Barryvdh\Snappy\Facades\SnappyPdf;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

use Illuminate\Support\Facades\Log;
use PDF;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $date = $request->input('date');
    
        $purchases = Purchase::latest()->paginate(5);
        $purchasecategory = PurchaseCategory::latest()->get(); // Add this line to retrieve all purchase categories
        $locationnames = Location::latest()->get();
        return view('purchases.index', compact('purchases', 'purchasecategory','locationnames'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
        
    }
    

/**
 * Show the form for editing the specified resource.
 *
 * @param  \Illuminate\Http\Request  $request
 * @return \Illuminate\Http\Response
 */
public function search(Request $request)
{
    $dateString = $request->input('date');
    $category = $request->input('category');
    $location = $request->input('location');

    $date = new \DateTime($dateString);
    $formattedDate = $date->format('Y-m-d');
    
    $purchases = Purchase::with(['project', 'location', 'purchaseCategory'])
        ->when($dateString, function ($query, $dateString) {
            return $query->where('purchase_date', $dateString);
        })
        ->when($category, function ($query, $category) {
            return $query->where('purchase_category', $category);
        })
        ->when($location, function ($query, $location) {
            return $query->where('project_location', $location);
        })
        ->latest()
        ->get();

    return view('purchases.search', compact('formattedDate', 'purchases', 'location'));
}




/**
 * Display the specified resource.
 *
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */
public function show($id)
{
    // Logic to fetch and display a specific purchase
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
        return view('purchases.create', compact('projectnames', 'locationnames', 'purchasecategory', 'users', 'statenames'));
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
            // 'file_field' => 'required|mimes:csv,txt,xls,xlsx,pdf|max:2048',
            'purchase_category' => 'required',
            'product_image' => 'required|max:2048',
        ]);

        $name = $request->file('product_image')->getClientOriginalName();
        $extension = $request->file('product_image')->getClientOriginalExtension();
        $path = $request->file('product_image')->store('public/product_image');

        $p = explode('/', $path);
        $filepath = 'storage/product_image/' . $p[2];

        $dateString = $request['purchase_date'];
        $date = new \DateTime($dateString);
        $formattedDate = $date->format('Y-m-d');
        
        Purchase::create([
            
            'project_name' => $request['project_name'],
            'project_location' => $request['project_location'],
            'purchase_date' => $formattedDate,
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
        ]);

        return redirect()->route('purchases.index')->with('success', 'Purchase created successfully.');
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

        return view('purchases.edit', compact('purchase', 'locationnames', 'purchasecategory', 'users', 'projectnames', 'statenames'));
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



    //     echo  $request['purchase_date'];
    //     $dateformat=$request['purchase_date'];
    //  echo  date_format($dateformat,"Y-m-d");
    //     exit;

    $dateString = $request['purchase_date'];
    $date = new \DateTime($dateString);
    $formattedDate = $date->format('Y-m-d');
    
    // echo $formattedDate;
    // exit;
    



        if ($request->hasFile('product_image_new')) {
            $name = $request->file('product_image_new')->getClientOriginalName();
            $extension = $request->file('product_image_new')->getClientOriginalExtension();
            $path = $request->file('product_image_new')->store('public/product_image');

            $p = explode('/', $path);
            $filepath = 'storage/product_image/' . $p[2];

         


            $purchase->update([
                'product_name' => $request['product_name'],
                'project_name' => $request['project_name'],
                'project_location' => $request['project_location'],
                'purchase_date' => $formattedDate,
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
            ]);
        } else {
            // $purchase->update($request->all());
            $purchase->update([
                'product_name' => $request['product_name'],
                'project_name' => $request['project_name'],
                'project_location' => $request['project_location'],
                'purchase_date' => $formattedDate,
                'purchase_category' => $request['purchase_category'],
                // 'product_image' => $filepath,
                'total_amount' => $request['total_amount'],
                'subcontractor' => $request['subcontractor'],
                'state' => $request['state'],
                'first_name' => $request['first_name'],
                'last_name' => $request['last_name'],
                'email' => $request['email'],
                'phone' => $request['phone_number'],
                'userid' => $request['userid'],
            ]);
        }

        return redirect()->route('purchases.index')->with('success', 'Purchase updated successfully.');
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

        return redirect()->route('purchases.index')->with('success', 'Purchase deleted successfully.');
    }
}
