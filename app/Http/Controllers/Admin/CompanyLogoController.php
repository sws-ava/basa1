<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Company;
use App\Models\Admin\CompanyLogo;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;

class CompanyLogoController extends Controller
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
     * @param  \App\Models\Admin\CompanyLogo  $companyLogo
     * @return \Illuminate\Http\Response
     */
    public function show(CompanyLogo $companyLogo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\CompanyLogo  $companyLogo
     * @return \Illuminate\Http\Response
     */
    public function edit($companyLogo)
    {

        $logo = DB::table('company_logos')
            ->where('company_logo_id', $companyLogo)
            ->first();


        if (!$logo) {
            $logo = [];
        }
        return view('admin.companyLogo.edit', [
            'company_id' => $companyLogo,
            'logo' => $logo
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin\CompanyLogo  $companyLogo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $companyLogo, Storage $storage)
    {
        if ($request->file()) {
            $logo = DB::table('company_logos')
                ->where('company_logo_id', $companyLogo)
                ->first();
            if ($logo) {
                Storage::disk('public')->delete($logo->company_logo_name);
            }
            $path = $request->file('logo')->store($companyLogo . '/logo/', 'public');
            CompanyLogo::destroy($request->company_id);

            $companyLogo = CompanyLogo::updateOrCreate(
                [
                    'company_logo_id' => $request->company_id,
                    'company_logo_name' => $path
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
     * @param  \App\Models\Admin\CompanyLogo  $companyLogo
     * @return \Illuminate\Http\Response
     */
    public function destroy(CompanyLogo $companyLogo)
    {
        $logo = DB::table('company_logos')
            ->where('company_logo_id', $companyLogo->company_logo_id)
            ->first();
        if ($logo) {
            Storage::disk('public')->delete($logo->company_logo_name);
        }
        $companyLogo->delete();
        $companyUpdate = Company::where('id', $companyLogo->company_logo_id)->first();
        $companyUpdate->touch();
        return redirect()->back()->withSuccess('Логотип успешно удален');
    }
}
