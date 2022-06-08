<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Company;

class CompanyTopController extends Controller
{
    public function top(Request $request, Company $company)
    {
        if ($request->top == 0) {
            $request->top = Null;
        }

        $company = Company::find($request->company_id);
        $company->isTop = $request->top;
        $company->save();
        $companyUpdate = Company::where('id', $request->company_id)->first();
        $companyUpdate->touch();
        return redirect()->back();
    }
}
