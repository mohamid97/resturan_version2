@extends('admin.layout.master')

@section('content')
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Update Profile Information</h3>
        </div>
        <div class="card-body">
            <div class="col-md-6 offset-md-3 mt-5">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <h2 class="mb-4">Login</h2>
                <form method="POST" action="{{route('admin.auth.update')}}">
                    @csrf
                    <div class="mb-3">
                        <label for="loginEmail" class="form-label">Email address</label>
                        <input type="email" name="email" class="form-control" id="loginEmail" aria-describedby="emailHelp" placeholder="Enter Your Email" value="{{$user->email}}">
                    </div>
                    <div class="mb-3">
                        <label for="loginPassword" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="loginPassword" placeholder="Enter Your Password">
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
    </div>
@endsection
