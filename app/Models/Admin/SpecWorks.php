<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecWorks extends Model
{
    use HasFactory;

    protected $fillable = ['spec_works_company_id', 'spec_works_items'];
    protected $primaryKey = 'spec_works_company_id';
}
