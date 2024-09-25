@extends('admin.layout.master')

@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>@lang('sidebar.city_price') </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('admin.index')}}">@lang('main.home') </a></li>
                    <li class="breadcrumb-item active">@lang('sidebar.city_price') </li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<section class="content">
    <div class="container-fluid">

        <div class="card card-info">

            <div class="card-header">
                <h3 class="card-title">@lang('sidebar.all_city_price')</h3>

            </div>
            <!-- /.card-header -->
            <div class="card-body">



<form action="{{ route('admin.city_price_update-govs') }}" method="POST">
    @csrf
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Select</th>
            </tr>
        </thead>
        <tbody>
            @foreach($govs as $gov)
                <tr>
                    <td>{{ $gov->name }}</td>
                    <td>
                        <input type="checkbox" name="govs[]" value="{{ $gov->id }}" {{ $gov->checked ? 'checked' : '' }}>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <button type="submit" class="btn btn-sm btn-info">Check Selected</button>
</form>
            </div>
        </div>
    </div>
</section>
@endsection