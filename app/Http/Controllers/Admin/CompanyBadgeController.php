<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Company;
use App\Models\Admin\CompanyBadge;
use App\Models\Badge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PHPUnit\Util\Blacklist;

class CompanyBadgeController extends Controller
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
     * @param  \App\Models\Admin\CompanyBadge  $companyBadge
     * @return \Illuminate\Http\Response
     */
    public function show(CompanyBadge $companyBadge)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\CompanyBadge  $companyBadge
     * @return \Illuminate\Http\Response
     */
    public function edit($companyBadge)
    {
        $badges = Badge::get();

        $company_badges = CompanyBadge::where('company_badges_company_id', $companyBadge)->first();

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

        return view('admin.companyBadges.edit', [
            'company_id' => $companyBadge,
            'badges' => $badges,
            'company_badges' => $company_badges,
            'company_badges_blacklist' => $company_badges_blacklist,
            'company_badges_rik_now' => $company_badges_rik_now,
            'company_badges_rik_middle' => $company_badges_rik_middle,
            'company_badges_rik_member' => $company_badges_rik_member,
            'company_badges_array' => $company_badges_array,
            'company_badges_array_desc' => $company_badges_array_desc,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin\CompanyBadge  $companyBadge
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {


        if ($request->company_badges_blacklist == 1) {
            $blacklist = 1;
        } else {
            $blacklist = null;
        }

        if ($request->company_badges_rik_member == 1) {
            $company_badges_rik_member = 1;
        } else {
            $company_badges_rik_member = null;
        }

        CompanyBadge::destroy($request->company_id);
        $specWorks = CompanyBadge::updateOrCreate(
            [
                'company_badges_company_id' => $request->company_id,
                'company_badges_blacklist' => $blacklist,
                'company_badges_rik_now' => str_replace(',', '.', $request->company_badges_rik_now),
                'company_badges_rik_middle' => str_replace(',', '.', $request->company_badges_rik_middle),
                'company_badges_rik_member' => $company_badges_rik_member,
                'company_badges_array' => json_encode($request->q),
                'company_badges_array_desc' => json_encode($request->d),
            ]
        );

        $companyUpdate = Company::where('id', $request->company_id)->first();
        $companyUpdate->touch();

        return redirect()->back()->withSuccess('Данные обновлены');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\CompanyBadge  $companyBadge
     * @return \Illuminate\Http\Response
     */
    public function destroy(CompanyBadge $companyBadge)
    {
        //
    }
}
