<?php

namespace App\Models\Admin;

use App\Http\Filters\QueryFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Company extends Model
{
    use HasFactory;


    public function scopeFilter(Builder $builder,  QueryFilter $filter)
    {
        return $filter->apply($builder);
    }
}
