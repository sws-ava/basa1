<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FieldWorks extends Model
{
    use HasFactory;

    protected $fillable = ['field_works_company_id', 'field_works_items'];
    protected $primaryKey = 'field_works_company_id';
}
