@extends('layouts/admin_layout')


@section('title', 'Редактирование ресурсов')

@section('content')
    <div class="container-fluid pb-4">
        <div class="row">
            <div class="col-12">
                <h1>Редактирование ресурсов</h1>
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
        <form method="POST" action="{{ route('companyResources.update', $company_id) }}">
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
                            @foreach ($resources_cats as $cat)
                                <div class="row mb-4">
                                    <div class="col-12 mb-2 ">
                                        <h4 style="font-weight: 700;">{{ $cat->resources_cats_name }}</h4>
                                    </div>
                                    @foreach ($resources_items as $item)
                                        @if ($cat->resources_cats_id == $item->resources_items_cat)
                                            @if ($item->resources_items_type == 'checkbox')
                                                <div class="form-group d-flex align-items-baseline col-12">
                                                    <input name="q[]" value="{{ $item->resources_items_id }}"
                                                        class="mr-2" type="checkbox"
                                                        @if ($resources_arr) @foreach ($resources_arr as $r)
                                                            @if ($item->resources_items_id == $r)
                                                            checked @endif
                                                        @endforeach
                                            @endif


                                            id="exampleInputSelect{{ $item->resources_items_id }}">
                                            <label for="exampleInputSelect{{ $item->resources_items_id }}"
                                                class="d-block">{{ $item->resources_items_name }}</label>
                                </div>
                            @else
                                <div class="col-12">
                                    <div class="form-group d-md-flex  align-items-baseline">
                                        @if ($item->resources_items_id == 3)
                                            <label class="col-12 col-md-auto"
                                                for="exampleInputEmail1">{{ $item->resources_items_name }}:</label>
                                            <input type="text" name="company_resources_operators"
                                                value="{{ $company_resources_operators }}"
                                                class="form-control  col-12 col-md-3"
                                                placeholder="{{ $item->resources_items_name }}" maxlength="3">
                                        @elseif ($item->resources_items_id == 4)
                                            <label class="col-12 col-md-auto"
                                                for="exampleInputEmail1">{{ $item->resources_items_name }}:</label>
                                            <input type="text" name="company_resources_work_hours"
                                                value="{{ $company_resources_work_hours }}"
                                                class="form-control  col-12 col-md-3"
                                                placeholder="{{ $item->resources_items_name }}" maxlength="3">
                                        @elseif ($item->resources_items_id == 5)
                                            <label class="col-12 col-md-auto"
                                                for="exampleInputEmail1">{{ $item->resources_items_name }}:</label>
                                            <input type="text" name="company_resources_focus_rooms"
                                                value="{{ $company_resources_focus_rooms }}"
                                                class="form-control  col-12 col-md-3"
                                                placeholder="{{ $item->resources_items_name }}" maxlength="250">
                                        @elseif ($item->resources_items_id == 16)
                                            <label class="col-12 col-md-auto"
                                                for="exampleInputEmail1">{{ $item->resources_items_name }}:</label>
                                            <input type="text" name="company_resources_placements"
                                                value="{{ $company_resources_placements }}"
                                                class="form-control  col-12 col-md-3"
                                                placeholder="{{ $item->resources_items_name }}" maxlength="250">
                                        @elseif ($item->resources_items_id == 17)
                                            <label class="col-12 col-md-auto"
                                                for="exampleInputEmail1">{{ $item->resources_items_name }}:</label>
                                            <input type="text" name="company_resources_placements_area"
                                                value="{{ $company_resources_placements_area }}"
                                                class="form-control  col-12 col-md-3"
                                                placeholder="{{ $item->resources_items_name }}" maxlength="250">
                                        @elseif ($item->resources_items_id == 19)
                                            <label class="col-12 col-md-auto"
                                                for="exampleInputEmail1">{{ $item->resources_items_name }}:</label>
                                            <input type="text" name="company_resources_tablets"
                                                value="{{ $company_resources_tablets }}"
                                                class="form-control  col-12 col-md-3"
                                                placeholder="{{ $item->resources_items_name }}" maxlength="250">
                                        @elseif ($item->resources_items_id == 20)
                                            <label class="col-12 col-md-auto"
                                                for="exampleInputEmail1">{{ $item->resources_items_name }}:</label>
                                            <input type="text" name="company_resources_tablets_more"
                                                value="{{ $company_resources_tablets_more }}"
                                                class="form-control  col-12 col-md-3"
                                                placeholder="{{ $item->resources_items_name }}" maxlength="250">
                                        @elseif ($item->resources_items_id == 29)
                                            <label class="col-12 col-md-auto"
                                                for="exampleInputEmail1">{{ $item->resources_items_name }}:</label>
                                            <input type="text" name="company_resources_interviewers"
                                                value="{{ $company_resources_interviewers }}"
                                                class="form-control  col-12 col-md-3"
                                                placeholder="{{ $item->resources_items_name }}" maxlength="250">
                                        @elseif ($item->resources_items_id == 30)
                                            <div class="form-group d-md-flex  align-items-center">
                                                <label
                                                    class="col-12 col-md-auto">{{ $item->resources_items_name }}:</label>
                                                <select name="company_resources_regions[]"
                                                    class="select2 form-control  col-12 col-md-5" multiple="multiple"
                                                    data-placeholder="{{ $item->resources_items_name }}"
                                                    style="width: 100%;">


                                                    @if ($company_regions)
                                                        @foreach ($company_regions as $cr)
                                                            @foreach ($regions as $r)
                                                                @if ($r->id == $cr)
                                                                    <option selected value="{{ $r->id }}">
                                                                        {{ $r->name }}</option>
                                                                @else
                                                                    <option value="{{ $r->id }}">
                                                                        {{ $r->name }}
                                                                    </option>
                                                                @endif
                                                            @endforeach
                                                        @endforeach
                                                    @else
                                                        @foreach ($regions as $r)
                                                            <option value="{{ $r->id }}">
                                                                {{ $r->name }}
                                                            </option>
                                                        @endforeach
                                                    @endif
                                                    {{-- @if ($company_regions)
                                                        @foreach ($company_regions as $cr)
                                                            @if ($r->id == $cr)
                                                                <option selected value="{{ $r->id }}">
                                                                    {{ $r->name }}</option>
                                                            @else
                                                                <option value="{{ $r->id }}">
                                                                    {{ $r->name }}
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    @else
                                                        <option value="{{ $r->id }}">
                                                            {{ $r->name }}
                                                        </option>
                                                    @endif --}}

                                                    {{-- @endforeach --}}
                                                </select>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endif
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
