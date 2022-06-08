@extends('layouts/admin_layout')


@section('title', 'Все значки')


@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1>Все значки</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body table-responsive p-0">
              <table class="table table-hover text-nowrap">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Img</th>
                    <th>Название</th>
                    <th>Описание</th>
                    <th>Порядок</th>
                    <th></th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($badges as $badge )
                        <tr>
                            <td>{{ $badge['id'] }}</td>
                            <td>
                                <img style="max-width: 50px;" src="{{ $badge['img'] }}" alt="">
                            </td>
                            <td>{{ $badge['title'] }}</td>
                            <td>{{ $badge['description'] }}</td>
                            <td>{{ $badge['order'] }}</td>
                            <td>
                                <a  href="{{ route('badge.edit', $badge['id']) }}" class="btn btn-block btn-warning">
                                    <i class="fas fa-pencil-alt mr-2"></i>
                                    Редактировать
                                </a>
                            </td>
                            <td>
                                <form  method="POST" action="{{ route('badge.destroy', $badge['id'])  }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-block btn-danger delete-btn">
                                        <i class="fas fa-trash mr-2"></i>
                                        Удалить
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
</div>
@endsection
