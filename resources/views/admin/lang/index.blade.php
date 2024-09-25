@extends('admin.layout.master')

@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Langs</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Langs</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div>
                @if($settings->finish != 1)

                <a href="{{route('admin.lang.add')}}" style="color: #FFF">
                    <button class="btn btn-info" >
                        <i class="nav-icon fas fa-plus"></i> Add New Lang
                    </button>
                </a>
                @endif

            </div>
            <br>
            <div class="card card-info">

                <div class="card-header">
                    <h3 class="card-title">Langs</h3>

                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Code</th>
                            <th>Action</th>

                        </tr>
                        </thead>
                        <tbody>

                        @forelse($langs as $lang)
                            <tr>
                                <td>{{$lang->id}}</td>
                                <td>{{$lang->name }}</td>
                                <td>{{$lang->code }}</td>
                                <td>

                                    @if($lang->code != 'ar')
                                        <a href="{{route('admin.lang.delete' ,  ['id' => $lang->id])}}">
                                            <button class="btn btn-sm btn-danger"><i class="nav-icon fas fa-trash"></i> Remove</button>
                                        </a>
                                    @endif



                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="3"> No Data</td>
                            </tr>
                        @endforelse


                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </section>

@endsection
