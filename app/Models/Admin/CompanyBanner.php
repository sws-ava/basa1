<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyBanner extends Model
{
    use HasFactory;
    protected $fillable = ['company_banner_id', 'company_banner_name'];
    protected $primaryKey = 'company_banner_id';
}
