<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Company;
use App\Models\Admin\FieldWorks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FieldWorksController extends Controller
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
     * @param  \App\Models\Admin\FieldWorks  $fieldWorks
     * @return \Illuminate\Http\Response
     */
    public function show(FieldWorks $fieldWorks)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\FieldWorks  $fieldWorks
     * @return \Illuminate\Http\Response
     */
    public function edit($fieldWorks)
    {

        $field_works_items = DB::table('field_works_items')->get();

        $field_works =  DB::table('field_works')
            ->where('field_works_company_id', $fieldWorks)
            ->first();
        if ($field_works) {
            $field_works = json_decode($field_works->field_works_items);
        } else {
            $field_works = [];
        }
        return view('admin.fieldWorks.edit', [
            'field_works_items' => $field_works_items,
            'company_id' => $fieldWorks,
            'field_works' => $field_works
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin\FieldWorks  $fieldWorks
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FieldWorks $fieldWorks)
    {
        FieldWorks::destroy($request->company_id);
        $fieldWorks = FieldWorks::updateOrCreate(
            [
                'field_works_company_id' => $request->company_id,
                'field_works_items' => json_encode($request->q)
            ]
        );
        $companyUpdate = Company::where('id', $request->company_id)->first();
        $companyUpdate->touch();

        return redirect('/administrator/fieldWorks/' . $request->company_id . '/edit')->withSuccess('Данные обновлены');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\FieldWorks  $fieldWorks
     * @return \Illuminate\Http\Response
     */
    public function destroy(FieldWorks $fieldWorks)
    {
        //
    }
}
