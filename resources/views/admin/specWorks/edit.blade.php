@extends('layouts/admin_layout')


@section('title', 'Редактирование специализаций компании')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1>Редактирование специализаций компании</h1>
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
        <form method="POST" action="{{ route('specWorks.update', $company_id) }}">
            @csrf
            @method('PUT')

            <div class="row">
                @csrf
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-body">
                            <input type="text" hidden name="company_id" value="{{ $company_id }}">

                            @foreach ($sw_cats as $cat)
                                <div class="row">
                                    <div class="col-12 mb-2 ">
                                        <h4 style="font-weight: 700;">{{ $cat->spec_cat_name }}</h4>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    @foreach ($sw_items as $item)
                                        @if ($cat->spec_cat_id == $item->spec_item_cat_id)
                                            <div
                                                class="form-group d-flex align-items-baseline col-md-6 col-lg-4 col-xl-3 mb-2">
                                                <input name="q[]" value="{{ $item->spec_item_id }}" class="mr-2"
                                                    type="checkbox" id="exampleInputSelect{{ $item->spec_item_id }}"
                                                    @if ($spec_works) @foreach ($spec_works as $sw)
                                                            @if ($item->spec_item_id == $sw)
                                                                checked @endif
                                                    @endforeach
                                        @endif>
                                        <label for="exampleInputSelect{{ $item->spec_item_id }}"
                                            class="d-block">{{ $item->spec_item_name }}</label>
                                </div>
                            @endif
                            @endforeach
                        </div>
                        @endforeach

                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <!--/.col (left) -->
            <div class="col-md-8 text-right">

                <button type="submit" class="btn btn-primary">Сохранить</button>
            </div>
    </div>
    </form>
    </div>
@endsection
