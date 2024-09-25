@extends('admin.layout.master')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ $media->name }} </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Home</a></li>
                        <li class="breadcrumb-item active">Media Group With Details</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div>
                <a href="{{route('admin.media_group.add')}}" style="color: #FFF">
                    <button class="btn btn-info" >
                        <i class="nav-icon fas fa-plus"></i> Add New Group Media
                    </button>
                </a>
            </div>
            <br>
            <div class="card card-info">


                <!-- /.card-header -->
                <div class="card-body">
                    <h2 class="mb-4">Images</h2>
                    <div class="row">
                        

                        @foreach ($media->gallerys as $gall )
                            
                        

                        <div class="col-md-12 col-lg-6 col-xl-4">
                            
                            <div class="card mb-2 bg-gradient-dark">
                                <h5 style="background: #17a2b8" class="card-title text-center text-white p-2">{{ $gall->name }}</h5>
                             <img class="card-img-top" src="{{ asset('uploads/images/media/gallery/' . $gall->photo) }}">

                            </div>
                        </div>

                        @endforeach
                    </div>

                </div>




            </div>
            <div class="card card-info">
                <div class="card-body">
                    <h2 class="mb-5">Files</h2>
                    <div class="row">
                        
    
                        @foreach ($media->files as $file )
                            
                        
    
                        <div class="col-md-12 col-lg-6 col-xl-4">
                            <div class="card mb-2 bg-gradient-dark">
                            <div class="card-img-overlay d-flex flex-column justify-content-end">
                           
                              <a style="    
                              display: flex;
                              gap: 5px;
                              align-items: center;
                              justify-content: center;" target="_blank" href="{{ asset('uploads/images/media/files/'.$file->file) }}"> 
                                <i class="fa fa-file  nav-icon" style="color: #1e9db1;"></i>   <h5 style="padding: 0;
                                margin: 0;">{{ $file->name }}</h5></a>
                      
                            </div>
                            </div>
                        </div>
    
                        @endforeach
                    </div>
    
                </div>
            </div>



            <div class="card card-info">  
                <!-- /.card-header -->
                <div class="card-body">
                    <h2 class="mb-4">Images</h2>
                    <div class="row">
                        
                        @foreach ($media->gallerys as $gall )
                            
                        
                            <div class="col-md-12 col-lg-6 col-xl-4">
                                <div class="card mb-2 bg-gradient-dark">
                                    <h5 style="background: #17a2b8;" class="card-title text-center p-2 text-white">{{ $gall->name }}</h5>
                                    <iframe width="100%" height="315" src="https://www.youtube.com/embed/Zw4S_ZCAhag?si=tyuWWrPXgKMfNSYD" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                                
                                

                            
                                </div>
                            </div>

                        @endforeach
                    </div>

                </div>
            </div>








        </div>
    </section>

@endsection


