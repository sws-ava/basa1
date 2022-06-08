@extends('layouts/admin_layout')


@section('title', 'Редактирование')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1>Редактирование</h1>
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
                <a href="/administrator/company/{{ $companyFile->company }}">К компании</a>
            </div>
        </div>


        <div class="row">
            @csrf
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-body">
                        @if ($companyFile->file)
                            <img class="mb-4 " style="max-width: 100%;
                                width: auto;" src="/storage/{{ $companyFile->file }}" alt="">

                            <form class="ml-4" method="POST"
                                action="{{ route('companyFile.destroy', $companyFile['id']) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-block btn-danger delete-btn"
                                    style="    max-width: 180px;">
                                    <i class="fas fa-trash mr-2"></i>
                                    Удалить файл
                                </button>
                            </form>
                            @endif <form method="POST" action="{{ route('companyFile.update', $companyFile['id']) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <input type="number" hidden name="company_id" value="{{ $companyFile->company }}">
                                <input type="number" hidden name="category" value="{{ $companyFile->category }}">
                                <br><br>
                                <div class="form-group">
                                    <label for="">Название файла</label>
                                    <input type="text" name="title" class="form-control"
                                        value="{{ $companyFile->title }}" placeholder="Название файла">
                                </div>
                                <div class="form-group">
                                    <input type="file" name="file" class="">
                                </div>
                    </div>
                    <!-- /.card-body -->
                    <!-- /.card-body -->
                </div>
            </div>
            <!--/.col (left) -->
        </div>
        <div class="row">
            <div class="col-md-6 text-center">

                <button type="submit" class="btn btn-primary">Сохранить</button>
            </div>
        </div>
        </form>

    </div>
@endsection
