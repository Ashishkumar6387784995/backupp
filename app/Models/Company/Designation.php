<?php

namespace App\Models\Company;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Company\DesignationCategory;

class Designation extends Model
{
    use HasFactory;
    protected $table = 'designations';
    protected $fillable = [
        'cate_id',
        'user_id',
        'name', 
        'slug',
        'status'
    ];

    public function category() {
        return $this->hasOne(DesignationCategory::class, 'id', 'cate_id');
    }
}
