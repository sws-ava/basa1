<?php

namespace App\Http\Filters;

use Illuminate\Support\Facades\DB;

class companyFilter extends QueryFilter
{
    public function district_id($id = null)
    {
        // dd($id);
        return $this->builder->when($id, function ($query) use ($id) {
            $query->where('district_id', $id);
        });
    }

    public function city_id($id = null)
    {
        $arr = explode(',', $id);
        foreach ($arr as $row) {
            $this->builder->where('city_id', $row);
        }
        return $this->builder;


        // return $this->builder->when($id, function ($query) use ($id) {
        //     $query->where('city_id', $id);
        // });
    }

    public function text($str = '')
    {
        if ($str != '') {
            return $this->builder
                ->where('short', 'LIKE', "%$str%")
                ->orWhere('largeText', 'LIKE', "%$str%");
        }
    }
    public function ogrn($ogrn = '')
    {
        if ($ogrn != '') {
            return $this->builder
                ->where('ogrn', 'LIKE', "%$ogrn%");
        }
    }
    public function inn($inn = '')
    {
        if ($inn != '') {
            return $this->builder
                ->where('inn', 'LIKE', "%$inn%");
        }
    }
    public function name($name = '')
    {
        if ($name != '') {
            return $this->builder
                ->where('name', 'LIKE', "%$name%");
            // ->orWhere('entity', 'LIKE', "%$name%");
        }
    }
    public function focus($focus = null)
    {
        if ($focus == 1) {
            return $this->builder
                ->where('company_resources.company_resources_focus_rooms', '>', 0);
        }
    }
    public function cati($cati = null)
    {
        if ($cati == 1) {
            return $this->builder
                ->where(function ($query) {
                    $query->where('company_resources.company_resources_checkbox_array', 'LIKE',  '%"1"%')
                        ->orWhere('company_resources.company_resources_checkbox_array', 'LIKE',  '%"2"%');
                });
        }
    }
    public function online($online = null)
    {
        if ($online == 1) {
            return $this->builder
                ->where(function ($query) {
                    $query->where('company_resources.company_resources_checkbox_array', 'LIKE',  '%"21"%')
                        ->orWhere('company_resources.company_resources_checkbox_array', 'LIKE',  '%"22"%');
                });
        }
    }
    public function field_works($field_works = null)
    {
        $arr = explode(',', $field_works);
        foreach ($arr as $row) {
            $this->builder->where('field_works.field_works_items', 'LIKE',  "%\"$row\"%");
        }
        return $this->builder;
    }


    public function work_cities($work_cities = null)
    {
        $arr = explode(',', $work_cities);

        foreach ($arr as $row) {
            // $this->builder->where('work_cities', 'LIKE',  "%\"$row\"%");
            $this->builder
                ->where(DB::raw("CONCAT_WS(' ', companies.work_cities, companies.filials, companies.city_id)"), 'LIKE',  "%\"$row\"%");
        }
        return $this->builder;
    }


    public function work_regions($work_regions = null)
    {
        $arr = explode(',', $work_regions);
        foreach ($arr as $row) {
            $this->builder->where('work_regions', 'LIKE',  "%\"$row\"%");
        }
        return $this->builder;
    }

    // public function work_regions($work_regions = null)
    // {
    //     $arr = explode(',', $work_regions);
    //     foreach ($arr as $row) {
    //         $this->builder->where('work_regions', 'LIKE',  "%\"$row\"%");
    //     }
    //     return $this->builder;
    // }
    public function res_solutions($res_solutions = null)
    {
        $arr = explode(',', $res_solutions);
        foreach ($arr as $row) {
            $this->builder->where('research_solutions.research_solutions_items', 'LIKE',  "%\"$row\"%");
        }
        return $this->builder;
    }
    public function spec($spec = null)
    {
        $arr = explode(',', $spec);
        foreach ($arr as $row) {
            $this->builder->where('spec_works.spec_works_items', 'LIKE',  "%\"$row\"%");
        }
        return $this->builder;
    }
    public function resources($resources = null)
    {

        $arr = explode(',', $resources);
        foreach ($arr as $row) {

            if ($row == '3') {
                $this->builder->where('company_resources.company_resources_operators', '>',  0);
            } elseif ($row == '4') {
                $this->builder->where('company_resources.company_resources_work_hours', '>',  0);
            } elseif ($row == '5') {
                $this->builder->where('company_resources.company_resources_focus_rooms', '>', 0);
            } elseif ($row == '16') {
                $this->builder->where('company_resources.company_resources_placements', '>', 0);
            } elseif ($row == '17') {
                $this->builder->where('company_resources.company_resources_placements_area', '!=', '');
            } elseif ($row == '19') {
                $this->builder->where('company_resources.company_resources_tablets', '>', 0);
            } elseif ($row == '20') {
                $this->builder->where('company_resources.company_resources_tablets_more', '!=', '');
            } elseif ($row == '29') {
                $this->builder->where('company_resources.company_resources_interviewers', '>', 0);
            } elseif ($row == '30') {
                $this->builder->where('company_resources.company_resources_regions', '!=', 'null');
            } else {
                $this->builder->where('company_resources.company_resources_checkbox_array', 'LIKE',  "%\"$row\"%");
            }
        }
        return $this->builder;
    }
}
