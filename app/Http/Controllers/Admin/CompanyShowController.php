<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Company;

class CompanyShowController extends Controller
{
    public function show(Request $request, Company $company)
    {
        // dd($request);
        $company = Company::find($request->company_id);
        $company->show = $request->show;
        $company->save();

        $companyUpdate = Company::where('id', $request->company_id)->first();
        $companyUpdate->touch();
        return redirect()->back();
    }
}
