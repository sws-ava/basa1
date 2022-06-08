@extends('layouts/admin_layout')


@section('title', 'Редактирование баннер компании')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1>Редактирование баннер компании</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4 class="mb-0"><i class="icon fa fa-check"></i>{{ session('success') }}</h4>
                        <a href="/administrator/company/{{ $company_id }}">К компании</a>
                    </div>
                @endif
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-12">
                <a href="/administrator/company/{{ $company_id }}">К компании</a>
            </div>
        </div>
        <!-- form start -->



        <div class="row">
            @csrf
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-primary pb-4">
                    <div class="card-body">

                        <div class="col-md-4">
                            @if ($banner)
                                <img class="mb-4 " style="max-width: 300px; max-height: 200px;"
                                    src="/storage/{{ $banner->company_banner_name }}" alt="">
                                <form class="" method="POST"
                                    action="{{ route('companyBanner.destroy', $banner->company_banner_id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class=" mb-4 btn btn-block btn-danger delete-btn"
                                        style="    max-width: 180px;">
                                        <i class="fas fa-trash mr-2"></i>
                                        Удалить баннер
                                    </button>
                                </form>
                            @endif
                        </div>
                        <form method="POST" action="{{ route('companyBanner.update', $company_id) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="text" hidden name="company_id" value="{{ $company_id }}">


                            <div class="form-group col-md-6 col-lg-4 col-xl-3 mb-2">
                                <label class="d-block">Добавить баннер:</label>
                                <input name="banner" class="mr-2" type="file">

                            </div>


                    </div>
                    <!-- /.card-body -->
                    <div class="col-md-4 text-right">

                        <button type="submit" class="btn btn-primary">Сохранить</button>
                    </div>
                </div>
            </div>
            <!--/.col (left) -->
        </div>
        </form>
    </div>
@endsection
