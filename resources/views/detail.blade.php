@extends('layouts.app')

@section('content')
<body>
    <!-- Page Loader -->
    <div id="loader-wrapper">
        <div id="loader"></div>

        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>

    </div>

    <div class="container-fluid tm-container-content tm-mt-60">
        <div class="row mb-4">
            <h2 class="col-12 tm-text-primary">Detail Foto</h2>
        </div>
        <div class="row tm-mb-90">            
            <div class="col-md-6 col-sm-12">
                <img src="{{asset('user_images/' . $image->image)}}" alt="Image" class="img-fluid">
            </div>
           
            <div class="col-md-6 col-sm-12">
                <div class="tm-bg-gray tm-video-details">                   
                    <div class="d-flex flex-wrap">
                    <div class="tm-bg-gray">
                        <h3 class="tm-text-gray-dark mt-2">Kategori</h3>
                        <p>{{$image->category}}</p> 
                        <div class="tm-bg-gray">
                        <h3 class="tm-text-gray-dark">Keterangan</h3>
                        <p>{{$image->caption}}</p>
                        <button onclick="window.history.back()" class="btn btn-primary h-10 w-10">Kembali</button>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    
    <script src="js/plugins.js"></script>
    <script>
        $(window).on("load", function() {
            $('body').addClass('loaded');
        });
    </script>
</body>
@endsection

