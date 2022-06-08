<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Company;
use Illuminate\Http\Request;

class CompanySearch extends Controller
{
    public function companySearch(Request $request)
    {
        if ($request->queryString == '') {

            $comapnies = Company::get();
            return $comapnies;
        } else {
            $comapnies = Company
                ::where('name', 'LIKE', "%$request->queryString%")
                ->get();
            return $comapnies;
        }
    }
}
