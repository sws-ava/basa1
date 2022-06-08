@extends('layouts/admin_layout')


@section('title', 'Редактирование полевых работ')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1>Редактирование полевых работ</h1>
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
        <form method="POST" action="{{ route('fieldWorks.update', $company_id) }}">
            @csrf
            @method('PUT')

            <div class="row">
                @csrf
                <!-- left column -->
                <div class="col-md-8">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-body">
                            <input type="text" hidden name="company_id" value="{{ $company_id }}">
                            @foreach ($field_works_items as $item)
                                <div class="form-group d-flex align-items-baseline">
                                    <input name="q[]" value="{{ $item->field_works_item_id }}" class="mr-2"
                                        type="checkbox" id="exampleInputSelect{{ $item->field_works_item_id }}"
                                        @if ($field_works) @foreach ($field_works as $fw) @if ($item->field_works_item_id == $fw)
                                            checked @endif
                                        @endforeach
                            @endif
                            >
                            <label for="exampleInputSelect{{ $item->field_works_item_id }}"
                                class="d-block">{{ $item->field_works_item_name }}</label>
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
