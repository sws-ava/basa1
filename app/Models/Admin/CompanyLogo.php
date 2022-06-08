<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyLogo extends Model
{
    use HasFactory;
    protected $fillable = ['company_logo_id', 'company_logo_name'];
    protected $primaryKey = 'company_logo_id';
}
