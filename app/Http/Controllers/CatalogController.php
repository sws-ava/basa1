<?php

namespace App\Http\Controllers;

use App\Http\Filters\CompanyFilter;
use App\Models\Admin\Company;
use App\Models\Admin\CompanyBadge;
use App\Models\Admin\CompanyFile;
use App\Models\Admin\CompanyPhoto;
use App\Models\Badge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CatalogController extends Controller
{
    public function index(CompanyFilter $request)
    {


        DB::statement(DB::raw('SET SQL_BIG_SELECTS=1'));
        DB::statement(DB::raw('set max_join_size = 20000000000'));

        $companies = Company::leftJoin('company_badges', 'company_badges.company_badges_company_id', '=', 'companies.id')
            ->leftJoin('company_resources', 'company_resources.company_resources_id', '=', 'companies.id')
            ->leftJoin('field_works', 'field_works.field_works_company_id', '=', 'companies.id')
            ->leftJoin('research_solutions', 'research_solutions.research_solutions_id', '=', 'companies.id')
            ->leftJoin('spec_works', 'spec_works.spec_works_company_id', '=', 'companies.id')
            ->filter($request)
            ->where('show', 1)
            ->select(
                'companies.*',
                'field_works.field_works_items',
                'spec_works.spec_works_items',
                'research_solutions.research_solutions_items',
                'company_resources.*',


                'companies.updated_at AS upd_at',
                'company_badges.company_badges_rik_now AS raiting',
                'company_badges.company_badges_array AS badges_array',
                'company_badges.company_badges_array_desc AS badges_array_descs',
                'company_resources.company_resources_focus_rooms AS focus',
                DB::raw("CONCAT_WS(' ', companies.work_cities, companies.filials, companies.city_id) AS all_area"),
            )
            // ->orderBy('companies.isTop', 'desc')
            // ->orderBy('company_badges.company_badges_rik_now', 'desc')
            // ->orderBy('companies.name', 'asc')
            ->orderBy('companies.sort_num', 'desc')
            ->orderBy('companies.name', 'asc')
            ->paginate(10);
        // dd($companies);

        $heads = DB::table('heads')->orderBy('heads_cat')->get();

        $company_badges = CompanyBadge::get();



        $badges = DB::table('badges')->get();

        $regions = DB::table('geo_regions')
            ->orderBy('name', 'asc')
            ->get();

        $cities = DB::table('geo_city')
            ->orderBy('name', 'asc')
            ->get();

        $field_works_items = DB::table('field_works_items')->get();
        $research_solutions_items = DB::table('research_solutions_items')->get();
        $spec_works_items = DB::table('spec_items')->get();
        $resources_items = DB::table('resources_items')->get();

        return  view('catalog', [
            'companies' => $companies,
            'heads' => $heads,
            'badges' => $badges,
            'regions' => $regions,
            'cities' => $cities,
            'company_badges' => $company_badges,
            'field_works_items' => $field_works_items,
            'research_solutions_items' => $research_solutions_items,
            'spec_works_items' => $spec_works_items,
            'resources_items' => $resources_items,
        ]);
    }

















    public function showCompany(Request $request, $id)
    {

        DB::statement(DB::raw('SET SQL_BIG_SELECTS=1'));
        DB::statement(DB::raw('set max_join_size = 20000000000'));
        $company = DB::table('companies')
            ->where('id', $id)
            ->leftJoin('company_badges', 'company_badges.company_badges_company_id', '=', 'companies.id')
            ->select([
                'company_badges.*',
                'companies.*',
            ])
            ->first();

        $updated_at_arr = explode(' ', $company->updated_at);
        $company->updated_at = str_replace('-', '.', $updated_at_arr[0]);


        if ($company === null || $company->show != 1) {
            return redirect('/');
        }

        $heads = DB::table('heads')
            ->orderBy('heads_cat')
            ->where('heads_company_id', $id)
            ->get();
        if (count($heads) < 1) {
            $heads = [];
        }


        $regions = DB::table('geo_regions')
            ->orderBy('name', 'asc')
            ->get();
        $cities = DB::table('geo_city')
            ->orderBy('name', 'asc')
            ->get();


        $filials = json_decode($company->filials);
        if (!$filials) {
            $filials = [];
        }


        $badges = Badge::get();


        $company_badges = CompanyBadge::where('company_badges_company_id', $id)->first();

        if ($company_badges == null) {
            $company_badges_blacklist = null;
            $company_badges_rik_now = null;
            $company_badges_rik_middle = null;
            $company_badges_rik_member = null;
            $company_badges_array = [];
            $company_badges_array_desc = [];
        } else {
            $company_badges_blacklist = $company_badges->company_badges_blacklist;
            $company_badges_rik_now = $company_badges->company_badges_rik_now;
            $company_badges_rik_middle = $company_badges->company_badges_rik_middle;
            $company_badges_rik_member = $company_badges->company_badges_rik_member;
            $company_badges_array = json_decode($company_badges->company_badges_array);
            $company_badges_array_desc = json_decode($company_badges->company_badges_array_desc);
            if ($company_badges_array) {
                $company_badges_array = $company_badges_array;
            } else {
                $company_badges_array = [];
            }
            if ($company_badges_array_desc) {
                $company_badges_array_desc = $company_badges_array_desc;
            } else {
                $company_badges_array_desc = [];
            }
        }

        $accordion_or_one_block = $a = $b = $c = 0;
        $spec_works_items_all = DB::table('spec_items')->get();

        $spec_works_items = DB::table('spec_items')->select('spec_item_id', 'spec_item_cat_id', 'spec_item_name')->get();

        $spec_works_items_soc = DB::table('spec_items')->where('spec_item_cat_id', 1)->select('spec_item_id', 'spec_item_cat_id', 'spec_item_name')->get();
        $spec_works_items_pol = DB::table('spec_items')->where('spec_item_cat_id', 2)->select('spec_item_id', 'spec_item_cat_id', 'spec_item_name')->get();
        $spec_works_items_mar = DB::table('spec_items')->where('spec_item_cat_id', 3)->select('spec_item_id', 'spec_item_cat_id', 'spec_item_name')->get();
        $spec_cats = DB::table('spec_cats')->get();
        $spec_works =  DB::table('spec_works')
            ->where('spec_works_company_id', $id)
            ->first();
        if ($spec_works) {
            $spec_works = json_decode($spec_works->spec_works_items);

            if ($spec_works != null) {
                foreach ($spec_works_items_all as $all) {
                    foreach ($spec_works as $spec_work) {
                        if ($spec_work == $all->spec_item_id && $all->spec_item_cat_id == 1) {
                            $a = 1;
                        }
                        if ($spec_work == $all->spec_item_id && $all->spec_item_cat_id  == 2) {
                            $b = 1;
                        }
                        if ($spec_work == $all->spec_item_id && $all->spec_item_cat_id  == 3) {
                            $c = 1;
                        }
                    }
                }
            } else {
                $spec_works = null;
            }
        } else {
            $spec_works = null;
        }
        $accordion_or_one_block = $b + $a + $c;


        $field_works_items = DB::table('field_works_items')->get();
        $field_works =  DB::table('field_works')
            ->where('field_works_company_id', $id)
            ->first();
        if ($field_works) {

            $field_works = json_decode($field_works->field_works_items);
            if ($field_works == null) {
                $field_works = [];
            }
        } else {
            $field_works = [];
        }


        $research_solutions_items = DB::table('research_solutions_items')->get();

        $research_solutions =  DB::table('research_solutions')
            ->where('research_solutions_id', $id)
            ->first();


        if ($research_solutions) {
            $research_solutions_q = json_decode($research_solutions->research_solutions_items);

            if ($research_solutions_q) {
                $research_solutions_q = $research_solutions_q;
            } else {
                $research_solutions_q = [];
            }
            if ($research_solutions->research_solutions_own != '[null,null,null]') {
                $research_solutions_own = json_decode($research_solutions->research_solutions_own);
            } else {
                $research_solutions_own = [];
            }
        } else {
            $research_solutions_q = [];
            $research_solutions_own = [];
        }



        $resources_cats = DB::table('resources_cats')->get();
        $resources_items = DB::table('resources_items')->get();
        $resources = DB::table('company_resources')
            ->where('company_resources_id', $id)
            ->first();

        $cati = $focus = $focus = $hall = $capi = $cawi = $bree = array();

        $focus['rooms'] = null;
        $hall["company_resources_placements"] = null;
        $hall["company_resources_placements_area"] = null;
        $capi["company_resources_tablets"] = null;
        $capi["company_resources_tablets_more"] = null;
        $bree["company_resources_interviewers"] = null;
        $bree["company_resources_regions"] = null;
        $cati["company_resources_operators"] = null;
        $cati["company_resources_work_hours"] = null;

        if ($resources) {
            $cati['arr'] = $focus['arr'] = $focus['arr'] = $hall['arr'] = $capi['arr'] = $cawi['arr'] = $bree['arr'] = array();
            if ($resources->company_resources_checkbox_array && $resources->company_resources_checkbox_array != 'null') {
                $company_resources_checkbox_array = json_decode($resources->company_resources_checkbox_array);
                foreach ($company_resources_checkbox_array as $arr_item) {
                    foreach ($resources_items as $resources_item) {
                        if ($arr_item == $resources_item->resources_items_id) {
                            if ($resources_item->resources_items_cat == 1) {
                                array_push($cati['arr'], $arr_item);
                            } elseif ($resources_item->resources_items_cat == 2) {
                                array_push($focus['arr'], $arr_item);
                            } elseif ($resources_item->resources_items_cat == 3) {
                                array_push($hall['arr'], $arr_item);
                            } elseif ($resources_item->resources_items_cat == 4) {
                                array_push($capi['arr'], $arr_item);
                            } elseif ($resources_item->resources_items_cat == 5) {
                                array_push($cawi['arr'], $arr_item);
                            }
                        }
                    }
                }
            } else {
                $company_resources_checkbox_array = null;
                // $cati['arr'] = $focus['arr'] = $hall['arr'] = $capi['arr'] = $cawi['arr'] = $bree['arr'] = [];
            }

            $focus['rooms'] = $resources->company_resources_focus_rooms;
            $hall["company_resources_placements"] = $resources->company_resources_placements;
            $hall["company_resources_placements_area"] = $resources->company_resources_placements_area;
            $capi["company_resources_tablets"] = $resources->company_resources_tablets;
            $capi["company_resources_tablets_more"] = $resources->company_resources_tablets_more;
            $bree["company_resources_interviewers"] = $resources->company_resources_interviewers;
            $bree["company_resources_regions"] = json_decode($resources->company_resources_regions);
            $cati["company_resources_operators"] = $resources->company_resources_operators;
            $cati["company_resources_work_hours"] = $resources->company_resources_work_hours;
        } else {

            $cati['arr'] = $focus['arr'] = $hall['arr'] = $capi['arr'] = $cawi['arr'] = $bree['arr'] = [];
            $focus['rooms'] = null;
            $hall["company_resources_placements"] = null;
            $hall["company_resources_placements_area"] = null;
            $capi["company_resources_tablets"] = null;
            $capi["company_resources_tablets_more"] = null;
            $bree["company_resources_interviewers"] = null;
            $bree["company_resources_regions"] = null;
            $cati["company_resources_operators"] = null;
            $cati["company_resources_work_hours"] = null;
        }

        // dd($bree);


        $res = $resources;
        if ($resources) {
            if ($resources->company_resources_checkbox_array) {
                $resources_arr = json_decode($resources->company_resources_checkbox_array);
            } else {
                $resources_arr = [];
            }

            $company_resources_focus_rooms = $res->company_resources_focus_rooms;
            $company_resources_placements = $res->company_resources_placements;
            $company_resources_placements_area = $res->company_resources_placements_area;
            $company_resources_tablets = $res->company_resources_tablets;
            $company_resources_tablets_more = $res->company_resources_tablets_more;
            $company_resources_interviewers = $res->company_resources_interviewers;
            $company_resources_work_hours = $res->company_resources_work_hours;
            $company_resources_operators = $res->company_resources_operators;

            if ($resources->company_resources_regions) {
                $company_regions = json_decode($res->company_resources_regions);
            } else {
                $company_regions = [];
            }
        } else {
            $resources_arr = [];
            $company_resources_focus_rooms = null;
            $company_resources_placements = null;
            $company_resources_placements_area = null;
            $company_resources_tablets = null;
            $company_resources_tablets_more = null;
            $company_resources_interviewers = null;
            $company_resources_operators = null;
            $company_resources_work_hours = null;
            $company_regions = [];
        }



        $logo = DB::table('company_logos')
            ->where('company_logo_id', $id)
            ->first();
        if (!$logo) {
            $logo = [];
        }


        $photos = CompanyPhoto::where('company', $id)->get();
        $photos_focus_rooms = CompanyPhoto::where('company', $id)->where('category', 1)->get();
        $photos_hall_test = CompanyPhoto::where('company', $id)->where('category', 2)->get();

        $reviews = CompanyFile::where('company', $id)->where('category', 2)->get();
        $presentations = CompanyFile::where('company', $id)->where('category', 1)->get();


        return view(
            'showCompany',
            [
                'company' => $company,
                'heads' => $heads,
                'filials' => $filials,
                'regions' => $regions,
                'cities' => $cities,
                'badges' => $badges,
                'photos' => $photos,
                'photos_focus_rooms' => $photos_focus_rooms,
                'photos_hall_test' => $photos_hall_test,
                'reviews' => $reviews,
                'presentations' => $presentations,
                'company_badges' => $company_badges,
                'company_badges_array' => $company_badges_array,
                'company_badges_array_desc' => $company_badges_array_desc,
                'company_badges_blacklist' => $company_badges_blacklist,
                'company_badges_rik_member' => $company_badges_rik_member,
                'accordion_or_one_block' => $accordion_or_one_block,
                'a' => $a,
                'b' => $b,
                'c' => $c,
                'spec_works' => $spec_works,
                'spec_cats' => $spec_cats,
                'spec_works_items' => $spec_works_items,
                'spec_works_items_soc' => $spec_works_items_soc,
                'spec_works_items_pol' => $spec_works_items_pol,
                'spec_works_items_mar' => $spec_works_items_mar,
                'field_works' => $field_works,
                'field_works_items' => $field_works_items,
                'research_solutions_own' => $research_solutions_own,
                'research_solutions_q' => $research_solutions_q,
                'research_solutions_items' => $research_solutions_items,
                'resources_cats' => $resources_cats,
                'resources_items' => $resources_items,
                'resources' => $resources,
                'resources_arr' => $resources_arr,
                'company_resources_focus_rooms' => $company_resources_focus_rooms,
                'company_resources_placements' => $company_resources_placements,
                'company_resources_placements_area' => $company_resources_placements_area,
                'company_resources_tablets' => $company_resources_tablets,
                'company_resources_tablets_more' => $company_resources_tablets_more,
                'company_resources_interviewers' => $company_resources_interviewers,
                'company_resources_operators' => $company_resources_operators,
                'company_resources_work_hours' => $company_resources_work_hours,
                'company_regions' => $company_regions,
                'logo' => $logo,
                'cati' => $cati,
                'focus' => $focus,
                'hall' => $hall,
                'capi' => $capi,
                'cawi' => $cawi,
                'bree' => $bree,
            ]
        );
    }

    public function redirect()
    {
        return redirect('/');
    }

    public function redirectToLogin()
    {
        return redirect('/login');
    }
}
