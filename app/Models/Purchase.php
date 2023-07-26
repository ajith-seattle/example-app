<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'project_name',
        'project_location',
        'state',
        'purchase_date',
        'purchase_category',
        'product_image',
        'total_amount',
        'subcontractor',
        'first_name',
        'last_name',
        'email',
        'phone',
        'userid',
        'status'
    ];

 
    public function purchaseCategory()
    {
        return $this->belongsTo(PurchaseCategory::class, 'purchase_category');
    }
    
    

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_name');
    }


    public function location()
{
    return $this->belongsTo(Location::class, 'project_location');
}

public function state()
{
    return $this->belongsTo(State::class, 'state');
}
public function user()
{

    return $this->belongsTo(User::class, 'subcontractor')->where('usertype', 3); 
}
}
