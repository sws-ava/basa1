<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Company;
use App\Models\Admin\SpecWorks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SpecWorksController extends Controller
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
     * @param  \App\Models\Admin\SpecWorks  $specWorks
     * @return \Illuminate\Http\Response
     */
    public function show(SpecWorks $specWorks)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\SpecWorks  $specWorks
     * @return \Illuminate\Http\Response
     */
    public function edit($specWorks)
    {

        $sw_items = DB::table('spec_items')->get();
        $sw_cats = DB::table('spec_cats')->get();
        $s_works =  DB::table('spec_works')
            ->where('spec_works_company_id', $specWorks)
            ->first();
        if ($s_works) {
            $s_works = json_decode($s_works->spec_works_items);
        } else {
            $s_works = [];
        }

        return view('admin.specWorks.edit', [
            'sw_items' => $sw_items,
            'sw_cats' => $sw_cats,
            'company_id' => $specWorks,
            'spec_works' => $s_works
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin\SpecWorks  $specWorks
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SpecWorks $specWorks)
    {
        // dd($request);
        SpecWorks::destroy($request->company_id);
        $specWorks = SpecWorks::updateOrCreate(
            [
                'spec_works_company_id' => $request->company_id,
                'spec_works_items' => json_encode($request->q)
            ]
        );
        $companyUpdate = Company::where('id', $request->company_id)->first();
        $companyUpdate->touch();

        return redirect('/administrator/specWorks/' . $request->company_id . '/edit')->withSuccess('Данные обновлены');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\SpecWorks  $specWorks
     * @return \Illuminate\Http\Response
     */
    public function destroy(SpecWorks $specWorks)
    {
        //
    }
}
