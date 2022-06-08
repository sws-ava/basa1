<?php

namespace App\Http\Controllers;

use App\Models\Admin\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $companiesCount = Company::count();
        $topCompaniesCount = Company::where('isTop', 1)->count();

        return view('admin/admin', [
            'companiesCount' => $companiesCount,
            'topCompaniesCount' => $topCompaniesCount,
        ]);
    }
}
