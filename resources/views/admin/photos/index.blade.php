@extends('layouts/admin_layout')


@section('title', 'Фотографии')


@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                @if ($file_cat == 1)
                    <h1>Фотографии фокус комнат</h1>
                @elseif ($file_cat == 2)
                    <h1>Фотографии Hall-test</h1>
                @else
                    <h1>Фотографии</h1>
                @endif
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-12">
                <a href="/administrator/company/{{ $company_id }}">К компании</a>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-4">
                            @if ($file_cat == 1)
                                <a href="{{ route('companyPhoto.create', ['company' => $company_id, 'cat' => 1]) }}"
                                    type="submit" class="btn btn-block btn-success"
                                    style=" display: inline; width: max-content;   max-width: 280px; margin-right: auto;"
                                    class="d-block mb-4">
                                    <i class="fas fa-plus mr-2"></i>
                                    Добавить фото
                                </a>
                            @elseif ($file_cat == 2)
                                <a href="{{ route('companyPhoto.create', ['company' => $company_id, 'cat' => 2]) }}"
                                    type="submit" class="btn btn-block btn-success"
                                    style=" display: inline; width: max-content;   max-width: 280px; margin-right: auto;"
                                    class="d-block mb-4">
                                    <i class="fas fa-plus mr-2"></i>
                                    Добавить фото
                                </a>
                            @else
                            @endif
                        </div>

                        <div class="row">
                            @if ($photos->count() > 0)
                                @foreach ($photos as $photo)
                                    @if ($photo->path)
                                        <div class="col-md-6 col-lg-4 col-xl-3  mb-4 ">
                                            <div class="card-footer h-100">
                                                <a class="d-block text-center" href="/storage/{{ $photo->path }}"
                                                    data-toggle="lightbox" data-title="{{ $photo->description }}">
                                                    <img src="/storage/{{ $photo->path }}" class="img-fluid mb-2"
                                                        alt="white sample" style="    max-height: 180px;">
                                                </a>

                                                <div class="d-flex justify-content-around mb-2">
                                                    <a href="{{ route('companyPhoto.edit', $photo->id) }}"
                                                        class="btn btn-block btn-warning" style="width:max-content;">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>
                                                    <form class="" method="POST"
                                                        action="{{ route('companyPhoto.destroy', $photo->id) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-block btn-danger delete-btn"
                                                            style="width:max-content;">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                                <div class="">{{ $photo->description }}</div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            @else
                                нет фото
                            @endif
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
@endsection
