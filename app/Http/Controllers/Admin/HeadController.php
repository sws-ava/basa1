<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Company;
use App\Models\Admin\Head;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HeadController extends Controller
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
     * @param  \Illuminate\Http\Request  $request
     */
    public function create(Request $request)
    {
        $phoneCountry = Company::where('id', $request->company)->first();
        if ($phoneCountry->country_id == 1) {
            $phoneVal = '+7';
        } elseif ($phoneCountry->country_id == 2) {
            $phoneVal = '+375';
        } elseif ($phoneCountry->country_id == 3) {
            $phoneVal = '+7';
        } elseif ($phoneCountry->country_id == 4) {
            $phoneVal = '+998';
        } elseif ($phoneCountry->country_id == 5) {
            $phoneVal = '+380';
        } else {
            $phoneVal = '';
        }
        return view('admin.head.create', [
            'company_id' => $request->company,
            'phoneVal' => $phoneVal
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $head = new Head();

        $head->heads_company_id = $request->heads_company_id;
        $head->heads_cat = $request->heads_cat;
        $head->heads_first_name = $request->heads_first_name;
        $head->heads_second_name = $request->heads_second_name;
        $head->heads_last_name = $request->heads_last_name;
        $head->heads_phone = $request->heads_phone;
        $head->heads_mail = $request->heads_mail;
        $head->heads_fb = $request->heads_fb;
        $head->heads_insta = $request->heads_insta;
        $head->heads_vk = $request->heads_vk;
        $head->save();


        $companyUpdate = Company::where('id', $request->heads_company_id)->first();
        $companyUpdate->touch();

        return redirect('/administrator/company/' . $request->heads_company_id)->withSuccess('Руководитель успешно добавлен');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin\Head  $head
     * @return \Illuminate\Http\Response
     */
    public function show(Head $head)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * @param  \App\Models\Admin\Head  $head
     * @return \Illuminate\Http\Response
     */
    public function edit(Head $head)
    {
        // dd($head);
        return view('admin.head.edit', ['heads' => $head]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin\Head  $head
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Head $head)
    {

        // dd($request);
        $head->heads_company_id = $request->heads_company_id;
        $head->heads_cat = $request->heads_cat;
        $head->heads_first_name = $request->heads_first_name;
        $head->heads_second_name = $request->heads_second_name;
        $head->heads_last_name = $request->heads_last_name;
        $head->heads_phone = $request->heads_phone;
        $head->heads_mail = $request->heads_mail;
        $head->heads_fb = $request->heads_fb;
        $head->heads_insta = $request->heads_insta;
        $head->heads_vk = $request->heads_vk;
        $head->save();

        $companyUpdate = Company::where('id', $request->heads_company_id)->first();
        $companyUpdate->touch();

        return redirect('/administrator/head/' . $request->heads_id_val . '/edit')->withSuccess('Руководитель успешно отредактирован');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\Head  $head
     * @return \Illuminate\Http\Response
     */
    public function destroy(Head $head)
    {
        $head->delete();
        $companyUpdate = Company::where('id', $head->heads_company_id)->first();
        $companyUpdate->touch();
        return redirect('/administrator/company/' . $head->heads_company_id)->withSuccess('Руководитель успешно удален');
    }
}
