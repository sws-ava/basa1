@extends('layouts/admin_layout')


@section('title', 'Добавить файл')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1>Добавление файла</h1>
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
                <a href="/administrator/company/{{ $company_id }}">К компании</a>
            </div>
        </div>
        <div class="row">
            <!-- left column -->
            <div class="col-md-8">
                <!-- general form elements -->
                <div class="card card-primary">
                    <!-- form start -->
                    <form method="POST" action="{{ route('companyFile.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <input type="number" hidden name="company_id" value="{{ $company_id }}">
                            <input type="number" hidden name="category" value="{{ $file_cat }}">
                            <br><br>
                            <div class="form-group">
                                <label for="">Название файла</label>
                                <input type="text" name="title" class="form-control" placeholder="Название файла">
                            </div>
                            <div class="form-group">
                                <input type="file" name="file" class="">
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary">Добавить</button>
                        </div>
                    </form>
                </div>
            </div>
            <!--/.col (left) -->
        </div>
    </div>
@endsection
