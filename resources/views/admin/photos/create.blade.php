@extends('layouts/admin_layout')


@section('title', 'Добавление фото')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1>Добавление фото</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4 class="mb-0"><i class="icon fa fa-check"></i>{{ session('success') }}</h4>
                    </div>
                @endif
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-12">
                <a href="/administrator/companyPhoto?company={{ $company_id }}&cat={{ $file_cat }}">К фото</a>
            </div>
        </div>
        <div class="row">
            <!-- left column -->
            <div class="col-md-8">
                <!-- general form elements -->
                <div class="card card-primary">
                    <!-- form start -->

                    <form method="POST" action="{{ route('companyPhoto.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div id="photoRows">
                                <input type="number" hidden name="company_id" value="{{ $company_id }}">
                                <input type="number" hidden name="category" value="{{ $file_cat }}">
                                <div class="photoLine" rowNum="1">
                                    <div class="form-group">
                                        <label for="">Описание фото</label>
                                        <input maxlength="200" type="text" name="photos[1][title]" class="form-control"
                                            placeholder="Описание фото">
                                    </div>
                                    <div class="form-group">
                                        <input type="file" name="photos[1][photo]" class="">
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div href="" class="btn btn-block btn-success d-block mb-4 addPhotoInput"
                                style=" display: inline; width: max-content;   max-width: 280px; margin-right: auto;">
                                <i class="fas fa-plus"></i>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer text-right">
                                <button type="submit" class="btn btn-primary">Добавить</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!--/.col (left) -->
        </div>
    </div>
@endsection
