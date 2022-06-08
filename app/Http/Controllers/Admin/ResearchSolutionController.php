<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Company;
use App\Models\Admin\ResearchSolution;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResearchSolutionController extends Controller
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
     * @param  \App\Models\Admin\ResearchSolution  $researchSolution
     * @return \Illuminate\Http\Response
     */
    public function show(ResearchSolution $researchSolution)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\ResearchSolution  $researchSolution
     * @return \Illuminate\Http\Response
     */
    public function edit($researchSolution)
    {
        $research_solutions_items = DB::table('research_solutions_items')->get();

        $research_solutions =  DB::table('research_solutions')
            ->where('research_solutions_id', $researchSolution)
            ->first();

        // dd($research_solutions);
        if ($research_solutions) {
            if ($research_solutions->research_solutions_items) {
                $research_solutions_q = json_decode($research_solutions->research_solutions_items);
            } else {
                $research_solutions_q = [];
            }
            if ($research_solutions->research_solutions_own) {

                $research_solutions_own = json_decode($research_solutions->research_solutions_own);
            } else {
                $research_solutions_own = ['', '', ''];
            }
        } else {
            $research_solutions_q = [];
            $research_solutions_own = ['', '', ''];
        }


        return view('admin.researchSolutions.edit', [
            'company_id' => $researchSolution,
            'research_solutions_items' => $research_solutions_items,
            'research_solutions_q' => $research_solutions_q,
            'research_solutions_own' => $research_solutions_own,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin\ResearchSolution  $researchSolution
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        ResearchSolution::destroy($request->company_id);
        $researchSolution = ResearchSolution::updateOrCreate(
            [
                'research_solutions_id' => $request->company_id,
                'research_solutions_items' => json_encode($request->q),
                'research_solutions_own' => json_encode($request->own)
            ]
        );

        $companyUpdate = Company::where('id', $request->company_id)->first();
        $companyUpdate->touch();

        return redirect('/administrator/researchSolutions/' . $request->company_id . '/edit')->withSuccess('Данные обновлены');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\ResearchSolution  $researchSolution
     * @return \Illuminate\Http\Response
     */
    public function destroy(ResearchSolution $researchSolution)
    {
        //
    }
}
