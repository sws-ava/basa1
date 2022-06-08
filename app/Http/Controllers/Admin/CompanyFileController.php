<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Company;
use App\Models\Admin\CompanyFile;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;

class CompanyFileController extends Controller
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
    public function create(Request $request)
    {
        return view('admin.companyFile.create', [
            'company_id' => $request->company,
            'file_cat' => $request->file_cat
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,  Storage $storage)
    {

        if ($request->file()) {
            $file = new CompanyFile();
            if ($request->category == 1) {
                $path = $request->file('file')->store($request->company_id . '/presentation/', 'public');
            } elseif ($request->category == 2) {
                $path = $request->file('file')->store($request->company_id . '/review/', 'public');
            } else {
                return redirect()->back();
            }


            $file->category = $request->category;
            $file->company = $request->company_id;
            $file->title = $request->title;
            $file->file = $path;
            $file->save();


            $companyUpdate = Company::where('id', $request->company_id)->first();
            $companyUpdate->touch();

            $redirect = CompanyFile::where('file', $path)->first();

            return redirect('/administrator/companyFile/' . $redirect->id . '/edit')->withSuccess('Файл успешно добавлен');
        } else {
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin\CompanyFile  $companyFile
     * @return \Illuminate\Http\Response
     */
    public function show(CompanyFile $companyFile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\CompanyFile  $companyFile
     * @return \Illuminate\Http\Response
     */
    public function edit(CompanyFile $companyFile)
    {

        return view('admin.companyFile.edit', [
            'companyFile' => $companyFile,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin\CompanyFile  $companyFile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CompanyFile $companyFile)
    {
        // dd($companyFile);

        if ($request->file()) {
            if ($request->category == 1) {
                $path = $request->file('file')->store($request->company_id . '/presentation/', 'public');
            } elseif ($request->category == 2) {
                $path = $request->file('file')->store($request->company_id . '/review/', 'public');
            } else {
                return redirect()->back();
            }
            Storage::disk('public')->delete($companyFile->file);
            $companyFile->category = $request->category;
            $companyFile->company = $request->company_id;
            $companyFile->title = $request->title;
            $companyFile->file = $path;
            $companyUpdate = Company::where('id', $request->company_id)->first();
            $companyUpdate->touch();
            $companyFile->save();


            return redirect('/administrator/companyFile/' . $companyFile->id . '/edit')->withSuccess('Файл успешно обовлен');
        } else {
            $companyFile->category = $request->category;
            $companyFile->company = $request->company_id;
            $companyFile->title = $request->title;
            $companyFile->save();
            $companyUpdate = Company::where('id', $request->company_id)->first();
            $companyUpdate->touch();
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\CompanyFile  $companyFile
     * @return \Illuminate\Http\Response
     */
    public function destroy(CompanyFile $companyFile)
    {
        // dd($companyFile);
        Storage::disk('public')->delete($companyFile->file);
        $companyFile->delete();
        $companyUpdate = Company::where('id', $companyFile->company)->first();
        $companyUpdate->touch();
        return redirect('/administrator/company/' . $companyFile->company)->withSuccess('Файл успешно удален');
    }
}
