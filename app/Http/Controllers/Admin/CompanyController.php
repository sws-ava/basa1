<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Company;
use App\Models\Admin\CompanyBadge;
use App\Models\Badge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Admin\CompanyFile;


use App\Http\Filters\CompanyFilter;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function all(CompanyFilter $request)
    {
        // $copmanies = Company::paginate(25);
        // return view('admin.company.companies', ['companies' => $copmanies]);




        DB::statement(DB::raw('SET SQL_BIG_SELECTS=1'));
        DB::statement(DB::raw('set max_join_size = 20000000000'));

        $companies = Company::leftJoin('company_badges', 'company_badges.company_badges_company_id', '=', 'companies.id')
            ->leftJoin('company_resources', 'company_resources.company_resources_id', '=', 'companies.id')
            ->leftJoin('field_works', 'field_works.field_works_company_id', '=', 'companies.id')
            ->leftJoin('research_solutions', 'research_solutions.research_solutions_id', '=', 'companies.id')
            ->leftJoin('spec_works', 'spec_works.spec_works_company_id', '=', 'companies.id')
            ->filter($request)
            // ->where('show', 1)
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
            // ->orderBy('companies.sort_num', 'desc')
            // ->orderBy('companies.name', 'asc')
            ->orderBy('companies.id', 'desc')
            ->paginate(15);
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

        return  view('admin.company.companies', [
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



    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $company_countries = DB::table('company_countries')->get();
        $regions = DB::table('geo_regions')->orderBy('name', 'asc')->get();
        $cities = DB::table('geo_city')->orderBy('name', 'asc')->get();



        return view('admin.company.create', [
            'company_countries' => $company_countries,
            'regions' => $regions,
            'cities' => $cities
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $company = new Company();



        $company->name = $request->name;
        $company->short = $request->short;
        $company->country_id = $request->country;
        $company->district_id = $request->region;
        $company->city_id = $request->city;
        $company->address = $request->address;
        $company->index = $request->index;
        $company->email = $request->email;
        $company->site = $request->site;
        $company->show = 0;
        $company->phone = $request->phone;
        $company->sort_num = $request->sort_num;
        $company->work_cities = json_encode([$request->city]);
        $company->work_regions = json_encode([$request->region]);
        $company->save();

        $newId = DB::table('companies')
            ->where('name', '=', $request->name)
            ->where('email', '=', $request->email)
            ->get();
        $id = $newId[0]->id;
        return redirect('/administrator/company/' . $id)->withSuccess('Компания успешно добавлена');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        $field_works_items = DB::table('field_works_items')->get();
        $field_works =  DB::table('field_works')
            ->where('field_works_company_id', $company['id'])
            ->first();
        if ($field_works) {
            $field_works = json_decode($field_works->field_works_items);
        } else {
            $field_works = [];
        }
        $spec_works_items = DB::table('spec_items')->get();
        $spec_cats = DB::table('spec_cats')->get();
        $spec_works =  DB::table('spec_works')
            ->where('spec_works_company_id', $company['id'])
            ->first();
        if ($spec_works) {
            $spec_works = json_decode($spec_works->spec_works_items);
        } else {
            $spec_works = [];
        }
        $heads = DB::table('heads')->where('heads_company_id', $company['id'])->get();
        $country_id = DB::table('company_countries')
            ->where('id', $company['country_id'])
            ->first();
        $district_id = DB::table('geo_regions')
            ->where('id', $company['district_id'])
            ->first();
        $city_id = DB::table('geo_city')
            ->where('id', $company['city_id'])
            ->first();

        $logo = DB::table('company_logos')
            ->where('company_logo_id', $company['id'])
            ->first();
        if (!$logo) {
            $logo = [];
        }

        $cities = DB::table('geo_city')->get();
        $filials = $company->filials;
        if ($filials) {
            $filials = json_decode($filials);
        } else {
            $filials = [];
        }

        $regions = DB::table('geo_regions')->orderBy('name', 'asc')->get();
        $resources_cats = DB::table('resources_cats')->get();
        $resources_items = DB::table('resources_items')->get();
        $resources = DB::table('company_resources')
            ->where('company_resources_id', $company['id'])
            ->first();

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


        $research_solutions_items = DB::table('research_solutions_items')->get();

        $research_solutions =  DB::table('research_solutions')
            ->where('research_solutions_id', $company['id'])
            ->first();


        if ($research_solutions) {
            $research_solutions_q = json_decode($research_solutions->research_solutions_items);
            $research_solutions_own = json_decode($research_solutions->research_solutions_own);
        } else {
            $research_solutions_q = [];
            $research_solutions_own = [];
        }


        $badges = Badge::get();


        $company_badges = CompanyBadge::where('company_badges_company_id', $company['id'])->first();

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

        $banner = DB::table('company_banners')
            ->where('company_banner_id', $company['id'])
            ->first();


        if (!$banner) {
            $banner = [];
        }

        $presentationFiles = CompanyFile::where('company', $company['id'])->get();


        return view('admin.company.index', [
            'company' => $company,
            'country_id' => $country_id,
            'region_id' => $district_id,
            'city_id' => $city_id,
            'field_works' => $field_works,
            'field_works_items' => $field_works_items,
            'spec_works' => $spec_works,
            'spec_cats' => $spec_cats,
            'spec_works_items' => $spec_works_items,
            'heads' => $heads,
            'research_solutions_own' => $research_solutions_own,
            'research_solutions_q' => $research_solutions_q,
            'research_solutions_items' => $research_solutions_items,
            'logo' => $logo,
            'cities' => $cities,
            'filials' => $filials,
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
            'regions' => $regions,
            'company_regions' => $company_regions,
            'badges' => $badges,
            'company_badges' => $company_badges,
            'company_badges_blacklist' => $company_badges_blacklist,
            'company_badges_rik_now' => $company_badges_rik_now,
            'company_badges_rik_middle' => $company_badges_rik_middle,
            'company_badges_rik_member' => $company_badges_rik_member,
            'company_badges_array' => $company_badges_array,
            'company_badges_array_desc' => $company_badges_array_desc,
            'banner' => $banner,
            'presentationFiles' => $presentationFiles,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {

        $company_countries = DB::table('company_countries')->get();
        $regions = DB::table('geo_regions')->orderBy('name', 'asc')->get();
        $cities = DB::table('geo_city')->orderBy('name', 'asc')->get();

        return view('admin.company.edit', [
            'company' => $company,
            'company_countries' => $company_countries,
            'regions' => $regions,
            'cities' => $cities
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        // dd($request);
        $id = $request->company_id;
        $company->name = $request->name;
        $company->short = $request->short;
        $company->country_id = $request->country;
        $company->district_id = $request->region;
        $company->city_id = $request->city;
        $company->address = $request->address;
        $company->index = $request->index;
        $company->email = $request->email;
        $company->site = $request->site;
        $company->phone = $request->phone;
        $company->sort_num = $request->sort_num;
        $company->save();

        return redirect('/administrator/company/' . $id . '/edit')->withSuccess('Данные обновлены');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin\Company  $company
     * @return \Illuminate\Http\Response
     */

    public function hide(Request $request, Company $company)
    {
        // dd($request);
        $company->show = $request->show;
        $company->save();
    }

    // public function update(Request $request, Badge $badge)
    // {
    //     $badge->title = $request->title;
    //     $badge->description = $request->description;
    //     $badge->img = $request->img;
    //     $badge->order = $request->order;
    //     $badge->save();
    //     return redirect()->back()->withSuccess('Значок успешно обновлен');
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        $company->delete();
        return redirect('/administrator/all_companies')->withSuccess('Компания успешно удалена');
    }
}
