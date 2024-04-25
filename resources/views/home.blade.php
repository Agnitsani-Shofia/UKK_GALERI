@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                <div>Gambar</div>
                <div>
                    <!-- <form class="form-inline">
                        <select class="form-control">
                            <option>Oldest</opstion>
                            <option>Latest</opstion>
                        </select>
                    </form> -->
                </div>
            </div>
        </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-md-3">
                            <div class="list-group">
                                <a href="#" class="list-group-item list-group-item-action">Hewan</a>
                                <a href="#" class="list-group-item list-group-item-action">Tumbuhan</a>
                                <a href="#" class="list-group-item list-group-item-action">Buah</a>
                            </div>
                        </div>
                    <div class="col-md-9">

                    <div class="row">
                    <div class="col-md-12">
                        @if($errors->any())
                        @foreach($errors->all() as $error)
                        
                        <div class="alert alert-danger">
                            <strong>Error!</strong> {{$error}}
                        </div>
                        @endforeach
                        @endif
                    <button data-toggle="collapse"  class="btn btn-success" data-target="#demo">Tambah Gambar</button>
                        <div id="demo" class="collapse">
                        <form action="{{route('image-store')}}" method="post" id="image_upload_form" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                            <label for="caption">Keterangan</label>
                            <input type="text" name="caption" class="form-control" placeholder="Tambah Keterangan" id="caption">
                            </div>
                <div class="form-group">
                    <label for="sel1">Pilih Kategori</label>
                        <select name="category" class="form-control" id="category">
                            <option value="" selected disabled>Pilih Kategori</option>
                            <option value="Hewan">Hewan</option>
                            <option value="Tumbuhan">Tumbuhan</option>
                            <option value="Buah">Buah</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Unggah Gambar</label>
                        <div class="preview-zone hidden">
                        <div class="box box-solid">
                            <div class="box-header with-border">
                            <div><b>Pratinjau</b></div>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-danger btn-xs remove-preview">
                                <i class="fa fa-times"></i> Batal
                                </button>
                            </div>
                            </div>
                            <div class="box-body"></div>
                        </div>
                        </div>
                        <div class="dropzone-wrapper">
                        <div class="dropzone-desc">
                            <i class="glyphicon glyphicon-download-alt"></i>
                            <p>Pilih file gambar atau seret ke sini.</p>
                        </div>
                        <input type="file" name="image" class="dropzone">
                        </div>
                        <div id="image_error"></div>
                    </div>

                        <button type="submit" class="btn btn-primary">Kirim</button>
                        </form>
                    </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
    $("#image_upload_form").validate({
  rules: {
    caption: {
      required: true,
      maxlength: 255
    },
    category: {
      required: true,
    },
    image:{
        required:true,
        extensions:"png|jpeg|jpg|bmp"
    }

  },
  messages: {
    caption: {
      required: "Please enter an image caption",
      maxlength: "Max. 255 character allowed."
    },
    category: {
      required: "Please select a category.",
    },
    image: {
      required: "Please upload an image.",
      extension: "Only jpeg, jpg, png, bmp image allowed."
    }
    },
    errorPlacement:function(error,element) {
        if(element.attr('name')=="image"){
            error.insertAfter("#image_error");
        }else{
            error.insertAfter(element);
        }
    }

});

    function readFile(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {

        var validImageType=['image/png', 'image/bmp', 'image/jpeg', 'image/jpg'];

        if(!validImageType.includes(input.files[0]['type'])){
            var htmlPreview =
        '<p>Image preview not available</p>' +
        '<p>' + input.files[0].name + '</p>';
        }else{
            var htmlPreview =
        '<img width="70%" height="300;" src="' + e.target.result + '" />' +
        '<p>' + input.files[0].name + '</p>';
        }

      
      var wrapperZone = $(input).parent();
      var previewZone = $(input).parent().parent().find('.preview-zone');
      var boxZone = $(input).parent().parent().find('.preview-zone').find('.box').find('.box-body');

      wrapperZone.removeClass('dragover');
      previewZone.removeClass('hidden');
      boxZone.empty();
      boxZone.append(htmlPreview);
    };

    reader.readAsDataURL(input.files[0]);
  }
}

function reset(e) {
  e.wrap('<form>').closest('form').get(0).reset();
  e.unwrap();
}

$(".dropzone").change(function() {
  readFile(this);
});

$('.dropzone-wrapper').on('dragover', function(e) {
  e.preventDefault();
  e.stopPropagation();
  $(this).addClass('dragover');
});

$('.dropzone-wrapper').on('dragleave', function(e) {
  e.preventDefault();
  e.stopPropagation();
  $(this).removeClass('dragover');
});

$('.remove-preview').on('click', function() {
  var boxZone = $(this).parents('.preview-zone').find('.box-body');
  var previewZone = $(this).parents('.preview-zone');
  var dropzone = $(this).parents('.form-group').find('.dropzone');
  boxZone.empty();
  previewZone.addClass('hidden');
  reset(dropzone);
});

</script>
@endsection
