@extends('layouts.backend.index')
@section('content')
<style type="text/css">

    label.cabinet{
    display: block;
    cursor: pointer;
}
label.cabinet input.file{
    position: relative;
    height: 100%;
    width: auto;
    opacity: 0;
    -moz-opacity: 0;
  filter:progid:DXImageTransform.Microsoft.Alpha(opacity=0);
  margin-top:-30px;
}


#upload-demo{
    width: 558px;
    height: 220px;
  padding-bottom:25px;
}
figure figcaption {
    position: absolute;
    bottom: 0;
    color: #fff;
    width: 100%;
    padding-left: 9px;
    padding-bottom: 5px;
    text-shadow: 0 0 10px #000;
}
.course-image-container{
    width: 400px;
    height: 200px;
    border: 1px solid #e4eaec;;
    position: relative;
}
.course-image-container img{
    width: 370px;
    height: 150px;
    position: absolute;  
    top: 0;  
    bottom: 0;  
    left: 0;  
    right: 0;  
    margin: auto;
}
.remove-lp{
    font-size: 16px;
    color: red;
    float: right;
    padding-right: 2px;
}
</style>
<div class="page-header">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.jobs') }}">jobs</a></li>
    <li class="breadcrumb-item active">Add</li>
  </ol>
  <h1 class="page-title">Add job</h1>
</div>

<div class="page-content">

<div class="panel">
  <div class="panel-body">
    <form method="POST" action="{{ route('admin.savejob') }}" id="jobForm" enctype="multipart/form-data">
      {{ csrf_field() }}
      <input type="hidden" name="job_id" value="{{ $job->id }}">
      <input type="hidden" name="old_job_image" value="{{ $job->job_image }}">
      <div class="row">
      
        <div class="form-group col-md-7">
          <label class="form-control-label">job Title <span class="required">*</span></label>
          <input type="text" class="form-control" name="job_title" 
            placeholder="job Title" value="{{ $job->job_title }}" />
            @if ($errors->has('job_title'))
                <label class="error" for="job_title">{{ $errors->first('job_title') }}</label>
            @endif
        </div>

        <div class="form-group col-md-5">
          <label class="form-control-label">Job Link <span class="required">*</span></label>
          <input type="text" class="form-control" name="job_link" 
            placeholder="job link" value="{{ $job->job_link }}" />
            @if ($errors->has('job_link'))
                <label class="error" for="job_link">{{ $errors->first('job_link') }}</label>
            @endif
        </div>

        
      <div class="form-group col-md-5">
        <label class="form-control-label">Status</label>
        <div>
          <div class="radio-custom radio-default radio-inline">
            <input type="radio" id="inputBasicActive" name="is_active" value="1" @if($job->is_active) checked @endif />
            <label for="inputBasicActive">Active</label>
          </div>
          <div class="radio-custom radio-default radio-inline">
            <input type="radio" id="inputBasicInactive" name="is_active" value="0" @if(!$job->is_active) checked @endif/>
            <label for="inputBasicInactive">Inactive</label>
          </div>
        </div>
      </div>

      </div>

      <div class="row">
            <div class="form-group col-md-7">
                <label class="form-control-label">Description</label>
                <textarea name="description">
                    {{ $job->description }}
                </textarea>
            </div>

            <div class="form-group col-md-5">
                <label class="form-control-label">job Image</label>
                
                <label class="cabinet center-block">
                    <figure class="course-image-container">
                        <i data-toggle="tooltip" data-original-title="Delete" data-id="job_image" class="fa fa-trash remove-lp" data-content="{{  Crypt::encryptString(json_encode(array('model'=>'jobs', 'field'=>'job_image', 'pid' => 'id', 'id' => $job->id, 'photo'=>$job->job_image))) }}" style="display: @if(Storage::exists($job->job_image)){{ 'block' }} @else {{ 'none' }} @endif"></i>
                        <img src="@if(Storage::exists($job->job_image)){{ Storage::url($job->job_image) }}@else{{ asset('backend/assets/images/job_image.jpeg') }}@endif" class="gambar img-responsive" id="job_image-output" name="job_image-output" />
                        <input type="file" class="item-img file center-block" name="job_image" id="job_image" />
                    </figure>
                </label>
                <input type="hidden" name="job_image_base64" id="job_image_base64">
                <span style="font-size: 10px;">
                    Supported File Formats: jpg,jpeg,png 
                    <br>Dimesnion: 825px X 326px
                    <br> Max File Size: 1MB
                </span>

            </div>

        </div>

      <hr>
      <div class="form-group row">
        <div class="col-md-4">
          <button type="submit" class="btn btn-primary">Submit</button>
          <button type="reset" class="btn btn-default btn-outline">Reset</button>
        </div>
      </div>
      
    </form>
  </div>
</div>

       
      <!-- End Panel Basic -->
</div>


<div class="modal fade" id="cropImagePop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Edit Photo</h4>
            </div>
            <div class="modal-body">
                <div id="upload-demo" class="center-block"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" id="cropImageBtn" class="btn btn-primary">Crop</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')
<script type="text/javascript">
    $(document).ready(function()
    { 
        //image crop start
        $(".gambar").attr("src", @if(Storage::exists($job->job_image))"{{ Storage::url($job->job_image) }}" @else "{{ asset('backend/assets/images/job_image.jpeg') }}" @endif);

        var $uploadCrop,
        tempFilename,
        rawImg,
        imageId;

        function readFile(input, id) {    
            
            var file_name = input.files[0].name;
            var extension = (input.files[0].name).split('.').pop();
            var allowed_extensions = ["jpg", "jpeg", "png"];
            var fsize = input.files[0].size;
            toastr.options.closeButton = true;
            toastr.options.timeOut = 5000;

            if (input.files && input.files[0]) {

                if ($.inArray(extension, allowed_extensions) == -1) {
                    toastr.error("Image format mismatch");
                    return false;
                } else if(fsize > 1048576) {
                    toastr.error("Image size exceeds");
                    return false;
                } 
                $('.input-group-file input').attr('value', file_name);
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('.upload-demo').addClass('ready');

                    $('#cropImageBtn').attr('data-id', id);

                    $('#cropImagePop').modal('show');
                    rawImg = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $uploadCrop = $('#upload-demo').croppie({
            viewport: {
                width: 558,
                height: 220,
            },
            enforceBoundary: true,
            enableExif: true
        });

        $('#cropImagePop').on('shown.bs.modal', function(){
            // alert('Shown pop');
            $uploadCrop.croppie('bind', {
                url: rawImg
            }).then(function(){
                console.log('jQuery bind complete');
            });
        });

        $('.item-img').on('change', function () { imageId = $(this).data('id'); tempFilename = $(this).val();
         readFile(this, $(this).attr('id')); });
        $('#cropImageBtn').on('click', function (ev) {
            var data_id = $(this).attr('data-id');
            $uploadCrop.croppie('result', {
                type: 'base64',
                format: 'jpeg',
                size: {width: 825, height: 326}
            }).then(function (resp) {
                $("#"+data_id+"_base64").val(resp);
                $("#"+data_id+"-output").attr("src", resp);
                $("#cropImagePop").modal("hide");
            });
        });
        //image crop end

        $('.remove-lp').click(function(event)
        {
            event.preventDefault();
            var this_id = $(this);
            var current_id = $(this).attr('data-id');

            alertify.confirm('Are you sure want to delete this image?', function () {
                var url = "{{ url('delete-photo') }}";
                var data_content = this_id.attr('data-content');
                 $.ajax({
                    type: "POST",
                    url: url,
                    data: {data_content: data_content, _token: "{{ csrf_token() }}"},
                    success: function (data) {
                        $("#"+current_id+"-output").attr("src", "{{ asset('backend/assets/images/job_image.jpeg') }}");
                        this_id.hide();
                    }
                });
            }, function () {    
                return false;
            });

            
        });

        tinymce.init({ 
            selector:'textarea',
            menubar:false,
            statusbar: false,
            height: 280,
            content_style: "#tinymce p{color:#76838f;}"
        });

        $("#jobForm").validate({
            rules: {
                job_title: {
                    required: true
                }
            },
            messages: {
                job_title: {
                    required: 'The job title field is required.'
                }
            }
        });
    });
</script>
@endsection