@extends('layouts/admin_layout')


@section('title', 'Редактирование руководителя')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1>Редактирование руководителя</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4 class="mb-0"><i class="icon fa fa-check"></i>{{ session('success') }}</h4>
                        <a href="/administrator/company/{{ $heads['heads_company_id'] }}">К компании</a>
                    </div>
                @endif
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-12">
                <a href="/administrator/company/{{ $heads['heads_company_id'] }}">К компании</a>
            </div>
        </div>
        <form method="POST" action="{{ route('head.update', $heads) }}">
            @csrf
            @method('PUT')

            <div class="row">
                @csrf
                <!-- left column -->
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-body">
                            <input type="number" hidden name="heads_company_id" value="{{ $heads['heads_company_id'] }}">
                            <input type="number" hidden name="heads_id_val" value="{{ $heads['heads_id'] }}">
                            <div class="form-group">
                                <select name="heads_cat" id="" class="form-control">
                                    @if ($heads->heads_cat == 1)
                                        <option selected value="1">Руководитель компании</option>
                                        <option value="2">Заместитель руководителя компании</option>
                                    @else
                                        <option value="1">Руководитель компании</option>
                                        <option selected value="2">Заместитель руководителя компании</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="text" value="{{ $heads->heads_first_name }}" name="heads_first_name"
                                    class="form-control" placeholder="Имя" required>
                            </div>
                            <div class="form-group">
                                <input type="text" value="{{ $heads->heads_second_name }}" name="heads_second_name"
                                    class="form-control" placeholder="Отчество">
                            </div>
                            <div class="form-group">
                                <input type="text" value="{{ $heads->heads_last_name }}" name="heads_last_name"
                                    class="form-control" placeholder="Фамилия" required>
                            </div>
                            <div class="form-group">
                                <input type="text" value="{{ $heads->heads_phone }}" name="heads_phone"
                                    class="form-control" placeholder="Телефон">
                            </div>
                            <div class="form-group">
                                <input type="mail" value="{{ $heads->heads_mail }}" name="heads_mail"
                                    class="form-control" placeholder="email"
                                    pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$">
                            </div>
                            <div class="form-group">
                                <input type="text" value="{{ $heads->heads_fb }}" name="heads_fb" class="form-control"
                                    placeholder="facebook">
                            </div>
                            <div class="form-group">
                                <input type="text" value="{{ $heads->heads_insta }}" name="heads_insta"
                                    class="form-control" placeholder="instagram">
                            </div>
                            <div class="form-group">
                                <input type="text" value="{{ $heads->heads_vk }}" name="heads_vk" class="form-control"
                                    placeholder="vkontakte">
                            </div>
                        </div>
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
