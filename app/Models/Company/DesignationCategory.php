<?php

namespace App\Models\Company;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Company\Designation;

class DesignationCategory extends Model
{
    use HasFactory;
    protected $table = 'designation_categories';
    protected $fillable = [
        'name',
        'user_id',
        'slug',
        'status'
    ];

    public function designation() {
        return $this->hasMany(Designation::class, 'cate_id', 'id');
    }
}
