@extends('layouts.admin_layout')

@section('title', 'Атлас - Каталог компаний')


@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1>Атлас - Каталог компаний</h1>
                {{-- @role('admin')
                    admin
                @else
                    user
                    @if (Auth::user()->email_verified_at === null)
                        не верифицирован
                    @else
                        верифицирован
                    @endif
                @endrole --}}
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ $companiesCount }}</h3>

                                <p>Всего компаний</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="/administrator/all_companies" class="small-box-footer">Просмотреть <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{ $topCompaniesCount }}</h3>

                                <p>Компаний в топе</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>

                            <a href="/administrator/all_companies" class="small-box-footer">Просмотреть <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
