<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Purchase;
// use App\Models\User;
use FPDF;

class PDFController extends Controller
{
    public function generatePdf()
    {
        // Retrieve all purchases from the database
        $purchases = Purchase::all();
    
        if ($purchases->isEmpty()) {
            return response()->json(['message' => 'No data found.'], 404);
        }
    
        // Generate the PDF using FPDF
        $pdf = new Fpdf();
    
        // Add a page to the PDF with landscape orientation
        $pdf->AddPage('L'); // Set the page orientation to landscape
    
        // Set the font and size for the PDF content
        $pdf->SetFont('Arial', 'B', 9);
    
        // Add content to the PDF using the retrieved data from the database
        $pdf->Cell(100, 10, 'Purchases Table:');
        $pdf->Ln();
    
        // Create the table header
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(10, 10, 'No', 1);
        $pdf->Cell(20, 10, 'Date', 1);
        $pdf->Cell(20, 10, 'Project', 1);
        $pdf->Cell(30, 10, 'Location', 1);
        $pdf->Cell(30, 10, 'Category', 1);
        $pdf->Cell(30, 10, 'Name', 1);
        $pdf->Cell(30, 10, 'Phone', 1);
        $pdf->Cell(30, 10, 'Subcontractor', 1);
        $pdf->Cell(30, 10, 'State', 1);
        $pdf->Cell(30, 10, 'Total Amount', 1);
        $pdf->Ln();
    
        // Set the font back to regular
        $pdf->SetFont('Arial', '', 8);
    
        // Initialize the iteration count variable
        $count = 1;
        // Loop through all purchases and add them to the PDF
        foreach ($purchases as $purchase) {
            $name=$purchase->first_name.' '.$purchase->last_name;

            $pdf->Cell(10, 10, $count, 1); // Use $count as the iteration count
            $pdf->Cell(20, 10, $purchase->purchase_date, 1);
            $pdf->Cell(20, 10, $purchase->project->project_name, 1);
            $pdf->Cell(30, 10, $purchase->location->location_name, 1);
            $pdf->Cell(30, 10, $purchase->purchaseCategory->purchase_category, 1);
            $pdf->Cell(30, 10, $name, 1);
            $pdf->Cell(30, 10, $purchase->phone, 1);
            $pdf->Cell(30, 10, $purchase->user->name, 1);
            $pdf->Cell(30, 10, $purchase->State->state_name, 1);
            $pdf->Cell(30, 10, $purchase->total_amount, 1);
            $pdf->Ln(); 
    
            $count++;
        }
    
        $pdf->Output('purchases_table.pdf', 'D'); 
    
        exit;
    }
    
}
