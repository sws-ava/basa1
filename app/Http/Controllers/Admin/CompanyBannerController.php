<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Company;
use App\Models\Admin\CompanyBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CompanyBannerController extends Controller
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
     * @param  \App\Models\Admin\CompanyBanner  $companyBanner
     * @return \Illuminate\Http\Response
     */
    public function show(CompanyBanner $companyBanner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\CompanyBanner  $companyBanner
     * @return \Illuminate\Http\Response
     */
    public function edit($companyBanner)
    {
        $banner = DB::table('company_banners')
            ->where('company_banner_id', $companyBanner)
            ->first();


        if (!$banner) {
            $banner = [];
        }
        return view('admin.companyBanner.edit', [
            'company_id' => $companyBanner,
            'banner' => $banner
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin\CompanyBanner  $companyBanner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $companyBanner)
    {
        if ($request->file()) {
            $banner = DB::table('company_banners')
                ->where('company_banner_id', $companyBanner)
                ->first();
            if ($banner) {
                Storage::disk('public')->delete($banner->company_banner_name);
            }
            $path = $request->file('banner')->store($companyBanner . '/banner/', 'public');
            CompanyBanner::destroy($request->company_id);

            $companyBanner = CompanyBanner::updateOrCreate(
                [
                    'company_banner_id' => $request->company_id,
                    'company_banner_name' => $path
                ]
            );

            $companyUpdate = Company::where('id', $request->company_id)->first();
            $companyUpdate->touch();

            return redirect()->back()->withSuccess('Логотип успешно обновлен');
        } else {
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\CompanyBanner  $companyBanner
     * @return \Illuminate\Http\Response
     */
    public function destroy(CompanyBanner $companyBanner)
    {
        $banner = DB::table('company_banners')
            ->where('company_banner_id', $companyBanner->company_banner_id)
            ->first();
        if ($banner) {
            Storage::disk('public')->delete($banner->company_banner_name);
        }
        $companyBanner->delete();

        $companyUpdate = Company::where('id', $companyBanner->company_banner_id)->first();
        $companyUpdate->touch();

        return redirect()->back()->withSuccess('Логотип успешно удален');
    }
}
