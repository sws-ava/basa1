<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResearchSolution extends Model
{
    use HasFactory;


    protected $fillable = ['research_solutions_id', 'research_solutions_items', 'research_solutions_own'];
    protected $primaryKey = 'research_solutions_id';
}
