<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Company;
use App\Models\Admin\CompanyPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CompanyPhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $photos = CompanyPhoto::where('category', $request->cat)->where('company', $request->company)->get();

        return view('admin.photos.index', [
            'company_id' => $request->company,
            'file_cat' => $request->cat,
            'photos' => $photos,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('admin.photos.create', [
            'company_id' => $request->company,
            'file_cat' => $request->cat,
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

        // dd($request->photos);
        foreach ($request->photos as $item) {
            $title = $item['title'];
            if (!isset($item['photo']) && $title == null || !isset($item['photo'])) {
            } else {
                if (isset($item['photo'])) {
                    if ($request->category == 1) {
                        $path = $item['photo']->store($request->company_id . '/focus/', 'public');
                    } elseif ($request->category == 2) {
                        $path = $item['photo']->store($request->company_id . '/hall/', 'public');
                    } else {
                        return redirect()->back();
                    }
                } else {
                    $path = '';
                }

                $photo = new CompanyPhoto();
                $photo->category = $request->category;
                $photo->company = $request->company_id;
                $photo->description = $title;
                $photo->path = $path;
                $photo->save();

                $companyUpdate = Company::where('id', $request->company_id)->first();
                $companyUpdate->touch();
            }
        }
        return redirect('/administrator/companyPhoto?company=' . $request->company_id . '&cat=' . $request->category)->withSuccess('Файл успешно добавлен');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin\CompanyPhoto  $companyPhoto
     * @return \Illuminate\Http\Response
     */
    public function show(CompanyPhoto $companyPhoto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\CompanyPhoto  $companyPhoto
     * @return \Illuminate\Http\Response
     */
    public function edit(CompanyPhoto $companyPhoto)
    {
        // dd($companyPhoto);
        return view('admin.photos.edit', [
            'photo' => $companyPhoto,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin\CompanyPhoto  $companyPhoto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CompanyPhoto $companyPhoto)
    {

        if ($request->file()) {

            Storage::disk('public')->delete($companyPhoto->path);

            if ($request->category == 1) {
                $path = $request->file('photo')->store($request->company_id . '/focus/', 'public');
            } elseif ($request->category == 2) {
                $path = $request->file('photo')->store($request->company_id . '/hall/', 'public');
            } else {
                return redirect()->back();
            }

            $companyPhoto->description = $request->title;
            $companyPhoto->path = $path;
            $companyPhoto->save();
        } else {
            $companyPhoto->description = $request->title;
            $companyPhoto->save();
        }
        $companyUpdate = Company::where('id', $request->company_id)->first();
        $companyUpdate->touch();

        return redirect('/administrator/companyPhoto/' . $companyPhoto->id . '/edit')->withSuccess('Файл успешно обновлен');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\CompanyPhoto  $companyPhoto
     * @return \Illuminate\Http\Response
     */
    public function destroy(CompanyPhoto $companyPhoto)
    {
        // dd($companyPhoto);
        Storage::disk('public')->delete($companyPhoto->path);
        $companyPhoto->delete();


        $companyUpdate = Company::where('id', $companyPhoto->company)->first();
        $companyUpdate->touch();

        return redirect('/administrator/companyPhoto?company=' . $companyPhoto->company . '&cat=' . $companyPhoto->category)->withSuccess('Файл успешно удален');
    }
}
