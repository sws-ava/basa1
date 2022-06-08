@extends('layouts/admin_layout')


@section('title', 'Добавить значок')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1>Добавление значка</h1>
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
            <div class="col-md-6">
                <!-- general form elements -->
                <div class="card card-primary">
                    <!-- form start -->
                    <form method="POST" action="{{ route('head.store') }}">
                        @csrf
                        <div class="card-body">
                            <input type="number" hidden name="heads_company_id" value="{{ $company_id }}">
                            <div class="form-group">
                                <select name="heads_cat" id="" class="form-control">
                                    <option value="1">Руководитель компании</option>
                                    <option value="2">Заместитель руководителя компании</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="text" name="heads_first_name" class="form-control" placeholder="Имя"
                                    required>
                            </div>
                            <div class="form-group">
                                <input type="text" name="heads_second_name" class="form-control" placeholder="Отчество">
                            </div>
                            <div class="form-group">
                                <input type="text" name="heads_last_name" class="form-control" placeholder="Фамилия"
                                    required>
                            </div>
                            <div class="form-group">
                                <input type="text" name="heads_phone" class="form-control" value="{{ $phoneVal }}"
                                    placeholder="Телефон">
                            </div>
                            <div class="form-group">
                                <input type="mail" name="heads_mail" class="form-control" placeholder="email"
                                    pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$">
                            </div>
                            <div class="form-group">
                                <input type="text" name="heads_fb" class="form-control" placeholder="facebook">
                            </div>
                            <div class="form-group">
                                <input type="text" name="heads_insta" class="form-control" placeholder="instagram">
                            </div>
                            <div class="form-group">
                                <input type="text" name="heads_vk" class="form-control" placeholder="vkontakte">
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Добавить</button>
                        </div>
                    </form>
                </div>
            </div>
            <!--/.col (left) -->
        </div>
    </div>
@endsection
