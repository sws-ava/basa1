@extends('layouts/admin_layout')


@section('title', 'Редактирование решений для рисерча')

@section('content')
    <div class="container-fluid pb-4">
        <div class="row">
            <div class="col-12">
                <h1>Редактирование решений для рисерча</h1>
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
        <form method="POST" action="{{ route('researchSolutions.update', $company_id) }}">
            @csrf
            @method('PUT')

            <div class="row">
                @csrf
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-body">

                            <input hidden type="text" name="company_id" value="{{ $company_id }}">
                            <div class="row">
                                @foreach ($research_solutions_items as $item)
                                    <div class="form-group d-flex align-items-baseline col-md-6">
                                        <input name="q[]" value="{{ $item->research_solutions_items_id }}"
                                            class="mr-2" type="checkbox"
                                            id="exampleInputSelect{{ $item->research_solutions_items_id }}"
                                            @if ($research_solutions_q) @foreach ($research_solutions_q as $q)
                                        @if ($item->research_solutions_items_id == $q)
                                            checked @endif
                                            @endforeach
                                @endif>
                                <label for="exampleInputSelect{{ $item->research_solutions_items_id }}"
                                    class="d-block">{{ $item->research_solutions_items_name }}</label>
                            </div>
                            @endforeach
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                @for ($i = 0; $i < 3; $i++)
                                    <div class="form-group d-flex align-items-baseline">
                                        <input class="form-control" type="text" name="own[]"
                                            value="{{ $research_solutions_own[$i] }}" placeholder="Свой вариант">

                                    </div>
                                @endfor
                            </div>
                        </div>

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
