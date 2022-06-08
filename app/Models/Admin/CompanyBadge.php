<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyBadge extends Model
{
    use HasFactory;
    protected $fillable = [
        'company_badges_company_id',
        'company_badges_rik_now',
        'company_badges_rik_middle',
        'company_badges_rik_member',
        'company_badges_array',
        'company_badges_array_desc',
        'company_badges_blacklist',
    ];
    protected $primaryKey = 'company_badges_company_id';
}
