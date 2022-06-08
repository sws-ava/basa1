@extends('layouts/admin_layout')


@section('title', 'Редактирование фото')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1>Редактирование фото</h1>
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
                <a href="/administrator/companyPhoto?company={{ $photo->company }}&cat={{ $photo->category }}">К
                    фото</a>
            </div>
        </div>
        <div class="row">
            <!-- left column -->
            <div class="col-md-8">
                <!-- general form elements -->
                <div class="card card-primary">
                    <!-- form start -->

                    <form method="POST" action="{{ route('companyPhoto.update', $photo->id) }}"
                        enctype="multipart/form-data">

                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div id="photoRows">

                                <a class="d-block text-center" href="/storage/{{ $photo->path }}" data-toggle="lightbox"
                                    data-title="{{ $photo->description }}">
                                    <img src="/storage/{{ $photo->path }}" class="img-fluid mb-2" alt="white sample"
                                        style="    max-height: 180px;">
                                </a>
                                <input type="number" hidden name="company_id" value="{{ $photo->company }}">
                                <input type="number" hidden name="category" value="{{ $photo->category }}">
                                <div class="photoLine" rowNum="1">
                                    <div class="form-group">
                                        <label for="">Описание фото</label>
                                        <input maxlength="200" type="text" name="title" class="form-control"
                                            placeholder="Описание фото" value="{{ $photo->description }}">
                                    </div>
                                    <div class="form-group">
                                        <input type="file" name="photo" class="">
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
                                <button type="submit" class="btn btn-primary">Сохранить</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!--/.col (left) -->
        </div>
    </div>
@endsection
