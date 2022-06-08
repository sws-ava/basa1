<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Company;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CompanyMoreController extends Controller
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = Company::find($id);

        $filials = json_decode($company->filials);
        if (!$filials) {
            $filials = [];
        }
        $work_cities = json_decode($company->work_cities);
        if (!$work_cities) {
            $work_cities = [];
        }
        $work_regions = json_decode($company->work_regions);
        if (!$work_regions) {
            $work_regions = [];
        }

        $cities = DB::table('geo_city')->orderBy('name', 'asc')->get();
        $regions = DB::table('geo_regions')->orderBy('name', 'asc')->get();
        // dd($filials);

        return view('admin.companyMore.edit', [
            'company_id' => $id,
            'company' => $company,
            'filials' => $filials,
            'work_cities' => $work_cities,
            'work_regions' => $work_regions,
            'cities' => $cities,
            'regions' => $regions
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, Company $company)
    {



        // dd($request);
        $company = Company::find($id);
        $company->entity = $request->entity;
        $company->foundation = $request->foundation;
        $company->legal_form = $request->legal_form;
        $company->ownership = $request->ownership;
        $company->inn = $request->inn;
        $company->ogrn = $request->ogrn;
        $company->filials = $request->filials;
        $company->work_cities = $request->work_cities;
        $company->work_regions = $request->work_regions;
        $company->fb = $request->fb;
        $company->tw = $request->tw;
        $company->tg = $request->tg;
        $company->insta = $request->insta;
        $company->whatsup = $request->whatsup;
        $company->vk = $request->vk;
        $company->shtat = $request->shtat;
        $company->analit = $request->analit;
        $company->managers = $request->managers;
        $company->noshtat = $request->noshtat;
        $company->largeText = $request->largeText;
        $company->save();


        $companyUpdate = Company::where('id', $id)->first();
        $companyUpdate->touch();

        return redirect('/administrator/companyMore/' . $id . '/edit')->withSuccess('Данные обновлены');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
