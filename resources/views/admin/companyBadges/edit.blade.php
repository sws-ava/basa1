@extends('layouts/admin_layout')


@section('title', 'Редактирование')

@section('content')
    <div class="container-fluid pb-4 mb-4">
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
        <a class="d-block my-4" href="/administrator/company/{{ $company_id }}">К компании</a>
        <!-- form start -->
        <form method="POST" action="{{ route('companyBadges.update', $company_id) }}">
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

                            @foreach ($badges as $badge)
                                <div class="form-group d-flex align-items-baseline col-12">
                                    <input name="q[]" value="{{ $badge->id }}" class="mr-2" type="checkbox"
                                        id="exampleInputSelect{{ $badge->id }}"
                                        @foreach ($company_badges_array as $array) @if ($badge->id == $array)
                                                checked @endif
                                        @endforeach
                                    >
                                    <label for="exampleInputSelect{{ $badge->id }}" class="d-block">

                                        <img src="{{ $badge['img'] }}" alt=""
                                            style="max-width: 20px; margin: 0 10px; max-height: 20px;" />
                                        {{ $badge->title }}
                                        {{ $badge->description }}</label>


                                </div>
                                <div class="form-group mb-4">
                                    @if ($company_badges_array_desc != null)
                                        @foreach ($company_badges_array_desc as $key => $value)
                                            @if ($badge->id == $key)
                                                <input class="form-control mb-4"
                                                    placeholder="Описание к {{ $badge->title }}" type="text"
                                                    name="d[{{ $badge->id }}]" value="{{ $value }}">
                                            @endif
                                        @endforeach
                                    @else
                                        <input class="form-control mb-4" placeholder="Описание к {{ $badge->title }}"
                                            type="text" name="d[{{ $badge->id }}]" value="">
                                    @endif
                                </div>
                                <br>
                            @endforeach
                            <br>
                            <div class="form-group d-flex align-items-baseline col-12 mt-4">
                                <input name="company_badges_blacklist" id="blacklist" value="1" class="mr-2"
                                    type="checkbox" @if ($company_badges_blacklist) checked @endif>

                                <label for="blacklist" class="d-block">В черном списке 789</label>
                            </div>



                            <div class="form-group d-flex align-items-baseline col-12">
                                <label class="mr-2" for="exampleInputEmail1">Рейтинг РИК текущий (оцениваемый):
                                </label>
                                <input type="text" name="company_badges_rik_now" value="{{ $company_badges_rik_now }}"
                                    class="form-control" maxlength="4" style="width:70px">
                            </div>
                            <div class="form-group d-flex align-items-baseline col-12">
                                <label class="mr-2" for="exampleInputEmail1">Средний рейтинг РИК (оцениваемый):
                                </label>
                                <input type="text" name="company_badges_rik_middle"
                                    value="{{ $company_badges_rik_middle }}" class="form-control" maxlength="4"
                                    style="width:70px">
                            </div>
                            <div class="form-group d-flex align-items-baseline col-12">
                                <input name="company_badges_rik_member" id="company_badges_rik_member" value="1"
                                    class="mr-2" type="checkbox" @if ($company_badges_rik_member) checked @endif>
                                <label for="company_badges_rik_member" class="d-block">Участник РИК
                                    (оценивает)</label>
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
