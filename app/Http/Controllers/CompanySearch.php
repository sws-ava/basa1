<?php

namespace App\Http\Controllers;

use App\Models\Admin\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompanySearch extends Controller
{
    public function defaultSearch(Request $request)
    {

        if ($request->queryString == '') {
            $companies = [];
        } else {
            $companies = Company
                ::where('companies.name', 'LIKE', "%$request->queryString%")
                ->where('companies.show', 1)
                // ->orWhere('companies.short', 'LIKE', "%$request->queryString%")
                // ->orWhere('companies.largeText', 'LIKE', "%$request->queryString%")
                // ->orWhere('companies.entity', 'LIKE', "%$request->queryString%")
                // ->orWhere('companies.index', 'LIKE', "%$request->queryString%")
                // ->orWhere('companies.email', 'LIKE', "%$request->queryString%")
                // ->orWhere('companies.site', 'LIKE', "%$request->queryString%")
                // ->orWhere('companies.phone', 'LIKE', "%$request->queryString%")
                // ->orWhere('companies.fb', 'LIKE', "%$request->queryString%")
                // ->orWhere('companies.tw', 'LIKE', "%$request->queryString%")
                // ->orWhere('companies.tg', 'LIKE', "%$request->queryString%")
                // ->orWhere('companies.insta', 'LIKE', "%$request->queryString%")
                // ->orWhere('companies.whatsup', 'LIKE', "%$request->queryString%")
                // ->orWhere('companies.vk', 'LIKE', "%$request->queryString%")
                // ->orWhere('companies.inn', 'LIKE', "%$request->queryString%")
                // ->orWhere('companies.ogrn', 'LIKE', "%$request->queryString%")
                ->leftJoin('geo_regions', 'geo_regions.id', '=', 'companies.district_id')
                ->leftJoin('geo_city', 'geo_city.id', '=', 'companies.city_id')
                ->leftJoin('company_badges', 'company_badges.company_badges_company_id', '=', 'companies.id')
                ->select(
                    'companies.*',
                    'company_badges.company_badges_rik_now AS raiting',
                    'geo_regions.name AS districtName',
                    'geo_city.name AS cityName'
                )
                ->limit(5)
                ->orderBy('sort_num', 'desc')
                // ->orderBy('isTop', 'desc')
                // ->orderBy('raiting', 'desc')
                ->get();

            $cities = DB::table('geo_city')
                ->where('name', 'LIKE', "%$request->queryString%")
                ->get();

            // $regions = DB::table('geo_regions')
            //     ->where('name', 'LIKE', "%$request->queryString%")
            //     ->get();

            $heads = DB::table('heads')
                // ->where('heads_first_name', 'LIKE', "%$request->queryString%")
                // ->orWhere('heads_second_name', 'LIKE', "%$request->queryString%")
                ->orWhere('heads_last_name', 'LIKE', "%$request->queryString%")
                ->where('companies.show', 1)
                ->leftJoin('companies', 'heads.heads_company_id', '=', 'companies.id')
                ->leftJoin('geo_regions', 'geo_regions.id', '=', 'companies.district_id')
                ->leftJoin('geo_city', 'geo_city.id', '=', 'companies.city_id')
                ->select(
                    'heads.*',
                    'companies.name',
                    'geo_regions.name AS districtName',
                    'geo_city.name AS cityName'
                )
                ->limit(5)
                ->get();

            $field_works = DB::table('field_works_items')
                ->where('field_works_item_name', 'LIKE', "%$request->queryString%")
                ->get();


            $res_solutions = DB::table('research_solutions_items')
                ->where('research_solutions_items_name', 'LIKE', "%$request->queryString%")
                ->get();

            $spec = DB::table('spec_items')
                ->where('spec_item_name', 'LIKE', "%$request->queryString%")
                ->get();
            $resources = DB::table('resources_items')
                ->where('resources_items_name', 'LIKE', "%$request->queryString%")
                ->get();

            $work_cities = DB::table('geo_city')
                ->where('name', 'LIKE', "%$request->queryString%")
                ->get();



            $work_regions = DB::table('geo_regions')
                ->where('name', 'LIKE', "%$request->queryString%")
                ->get();

            return ([
                'companies' => $companies,
                'cities' => $cities,
                // 'regions' => $regions,
                'heads' => $heads,
                'field_works' => $field_works,
                'res_solutions' => $res_solutions,
                'spec' => $spec,
                'resources' => $resources,
                'work_cities' => $work_cities,
                'work_regions' => $work_regions,
            ]);
        }
    }

    public function defaultSearchForm(Request $request)
    {

        if ($request->queryString == '') {
            $companies = [];
        } else {
            $companies = Company
                ::where('companies.name', 'LIKE', "%$request->queryString%")
                ->where('companies.show', 1)
                ->orWhere('companies.short', 'LIKE', "%$request->queryString%")
                ->orWhere('companies.largeText', 'LIKE', "%$request->queryString%")
                ->orWhere('companies.entity', 'LIKE', "%$request->queryString%")
                ->leftJoin('geo_regions', 'geo_regions.id', '=', 'companies.district_id')
                ->leftJoin('geo_city', 'geo_city.id', '=', 'companies.city_id')
                ->leftJoin('company_badges', 'company_badges.company_badges_company_id', '=', 'companies.id')
                ->select(
                    'companies.*',
                    'company_badges.company_badges_rik_now AS raiting',
                    'geo_regions.name AS districtName',
                    'geo_city.name AS cityName'
                )
                ->limit(3)
                ->orderBy('isTop', 'desc')
                ->orderBy('raiting', 'desc')
                ->get();

            $cities = DB::table('geo_city')
                ->where('name', 'LIKE', "%$request->queryString%")
                ->get();

            $regions = DB::table('geo_regions')
                ->where('name', 'LIKE', "%$request->queryString%")
                ->get();

            return ([
                'companies' => $companies,
                'cities' => $cities,
                'regions' => $regions,
            ]);
        }
    }

    public function defaultAdminSearch(Request $request)
    {

        if ($request->queryString == '') {
            $companies = [];
        } else {
            $companies = Company
                ::where('companies.name', 'LIKE', "%$request->queryString%")
                // ->where('companies.show', 1)
                ->orWhere('companies.short', 'LIKE', "%$request->queryString%")
                ->orWhere('companies.largeText', 'LIKE', "%$request->queryString%")
                ->orWhere('companies.entity', 'LIKE', "%$request->queryString%")
                ->orWhere('companies.index', 'LIKE', "%$request->queryString%")
                ->orWhere('companies.email', 'LIKE', "%$request->queryString%")
                ->orWhere('companies.site', 'LIKE', "%$request->queryString%")
                ->orWhere('companies.phone', 'LIKE', "%$request->queryString%")
                ->orWhere('companies.fb', 'LIKE', "%$request->queryString%")
                ->orWhere('companies.tw', 'LIKE', "%$request->queryString%")
                ->orWhere('companies.tg', 'LIKE', "%$request->queryString%")
                ->orWhere('companies.insta', 'LIKE', "%$request->queryString%")
                ->orWhere('companies.whatsup', 'LIKE', "%$request->queryString%")
                ->orWhere('companies.vk', 'LIKE', "%$request->queryString%")
                ->orWhere('companies.inn', 'LIKE', "%$request->queryString%")
                ->orWhere('companies.ogrn', 'LIKE', "%$request->queryString%")
                ->leftJoin('geo_regions', 'geo_regions.id', '=', 'companies.district_id')
                ->leftJoin('geo_city', 'geo_city.id', '=', 'companies.city_id')
                ->leftJoin('company_badges', 'company_badges.company_badges_company_id', '=', 'companies.id')
                ->select(
                    'companies.*',
                    'company_badges.company_badges_rik_now AS raiting',
                    'geo_regions.name AS districtName',
                    'geo_city.name AS cityName'
                )
                ->limit(5)
                ->orderBy('sort_num', 'desc')
                // ->orderBy('isTop', 'desc')
                // ->orderBy('raiting', 'desc')
                ->get();

            $cities = DB::table('geo_city')
                ->where('name', 'LIKE', "%$request->queryString%")
                ->get();

            // $regions = DB::table('geo_regions')
            //     ->where('name', 'LIKE', "%$request->queryString%")
            //     ->get();

            $heads = DB::table('heads')
                ->where('heads_first_name', 'LIKE', "%$request->queryString%")
                ->orWhere('heads_second_name', 'LIKE', "%$request->queryString%")
                ->orWhere('heads_last_name', 'LIKE', "%$request->queryString%")
                // ->where('companies.show', 1)
                ->leftJoin('companies', 'heads.heads_company_id', '=', 'companies.id')
                ->leftJoin('geo_regions', 'geo_regions.id', '=', 'companies.district_id')
                ->leftJoin('geo_city', 'geo_city.id', '=', 'companies.city_id')
                ->select(
                    'heads.*',
                    'companies.name',
                    'geo_regions.name AS districtName',
                    'geo_city.name AS cityName'
                )
                ->limit(5)
                ->get();

            $field_works = DB::table('field_works_items')
                ->where('field_works_item_name', 'LIKE', "%$request->queryString%")
                ->get();


            $res_solutions = DB::table('research_solutions_items')
                ->where('research_solutions_items_name', 'LIKE', "%$request->queryString%")
                ->get();

            $spec = DB::table('spec_items')
                ->where('spec_item_name', 'LIKE', "%$request->queryString%")
                ->get();
            $resources = DB::table('resources_items')
                ->where('resources_items_name', 'LIKE', "%$request->queryString%")
                ->get();

            $work_cities = DB::table('geo_city')
                ->where('name', 'LIKE', "%$request->queryString%")
                ->get();



            $work_regions = DB::table('geo_regions')
                ->where('name', 'LIKE', "%$request->queryString%")
                ->get();

            return ([
                'companies' => $companies,
                'cities' => $cities,
                // 'regions' => $regions,
                'heads' => $heads,
                'field_works' => $field_works,
                'res_solutions' => $res_solutions,
                'spec' => $spec,
                'resources' => $resources,
                'work_cities' => $work_cities,
                'work_regions' => $work_regions,
            ]);
        }
    }
}
