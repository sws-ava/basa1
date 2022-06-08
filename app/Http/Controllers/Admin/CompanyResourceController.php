<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Company;
use App\Models\Admin\CompanyResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompanyResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin\CompanyResource  $companyResource
     * @return \Illuminate\Http\Response
     */
    public function show(CompanyResource $companyResource)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\CompanyResource  $companyResource
     * @return \Illuminate\Http\Response
     */
    public function edit($companyResource)
    {

        $resources_items = DB::table('resources_items')->get();
        $resources_cats = DB::table('resources_cats')->get();
        $cities = DB::table('geo_city')->orderBy('name', 'asc')->get();
        $regions = DB::table('geo_regions')->orderBy('name', 'asc')->get();
        $resources =  DB::table('company_resources')
            ->where('company_resources_id', $companyResource)
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
            $company_resources_operators = $res->company_resources_operators;
            $company_resources_work_hours = $res->company_resources_work_hours;

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

        // dd($company_regions);

        return view('admin.companyResources.edit', [
            'company_id' => $companyResource,
            'resources_cats' => $resources_cats,
            'resources_items' => $resources_items,
            'resources_arr' => $resources_arr,
            // 'res' => $res,
            'company_regions' => $company_regions,
            'cities' => $cities,
            'regions' => $regions,
            'company_resources_focus_rooms' => $company_resources_focus_rooms,
            'company_resources_placements' => $company_resources_placements,
            'company_resources_placements_area' => $company_resources_placements_area,
            'company_resources_tablets' => $company_resources_tablets,
            'company_resources_tablets_more' => $company_resources_tablets_more,
            'company_resources_interviewers' => $company_resources_interviewers,
            'company_resources_operators' => $company_resources_operators,
            'company_resources_work_hours' => $company_resources_work_hours,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin\CompanyResource  $companyResource
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // dd($request);
        CompanyResource::destroy($request->company_id);
        $specWorks = CompanyResource::updateOrCreate(
            [
                'company_resources_id' => $request->company_id,
                'company_resources_checkbox_array' => json_encode($request->q),
                'company_resources_focus_rooms' => $request->company_resources_focus_rooms,
                'company_resources_placements' => $request->company_resources_placements,
                'company_resources_placements_area' => $request->company_resources_placements_area,
                'company_resources_tablets' => $request->company_resources_tablets,
                'company_resources_tablets_more' => $request->company_resources_tablets_more,
                'company_resources_interviewers' => $request->company_resources_interviewers,
                'company_resources_operators' => $request->company_resources_operators,
                'company_resources_work_hours' => $request->company_resources_work_hours,
                'company_resources_regions' => json_encode($request->company_resources_regions)
            ]
        );


        $companyUpdate = Company::where('id', $request->company_id)->first();
        $companyUpdate->touch();

        return redirect()->back()->withSuccess('Данные обновлены');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\CompanyResource  $companyResource
     * @return \Illuminate\Http\Response
     */
    public function destroy(CompanyResource $companyResource)
    {
        //
    }
}
