<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyResource extends Model
{
    use HasFactory;
    protected $fillable = [
        'company_resources_id',
        'company_resources_checkbox_array',
        'company_resources_focus_rooms',
        'company_resources_placements',
        'company_resources_placements_area',
        'company_resources_tablets',
        'company_resources_tablets_more',
        'company_resources_interviewers',
        'company_resources_operators',
        'company_resources_work_hours',
        'company_resources_regions',
    ];
    protected $primaryKey = 'company_resources_id';
}
