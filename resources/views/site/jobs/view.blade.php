@extends('layouts.frontend.index')
@section('content')
<!-- content start -->
    <div class="container-fluid p-0 home-content">
        <!-- banner start -->
        <div class="subpage-slide-blue">
            <div class="container">
                <h1>JOB</h1>
            </div>
        </div>
        <!-- banner end -->
        
        <!-- breadcrumb start -->
            <div class="breadcrumb-container">
                <div class="container">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('jobs') }}">Jobs</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $job->job_title }}</li>
                  </ol>
                </div>
            </div>
        
        <!-- breadcrumb end -->
        
        <div class="container">

        <!-- <div class="card mb-3">
        
  <img class="card-img-top" src="@if(Storage::exists($job->job_image)){{ Storage::url($job->job_image) }}@else{{ asset('backend/assets/images/job_image.jpeg') }}@endif" alt="Card image cap">
  <div class="card-body">
    <h5 class="card-title">Card title</h5>
    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
    <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
  </div> -->
<!-- </div> -->
            <div class="row mt-4">
                <!-- job main start -->
                <div class="col-xl-9 col-lg-9 col-md-8">
                    
                        <div class="cv-course-container">
                            <h5>{{ $job->job_title }}</h5>
                            
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-4 col-sm-4 col-12">
                                    <div class="instructor-clist m-0 pt-1">
                                        <div>
                                            <i class="fas fa-edit"></i>&nbsp;
                                            <span><i class="d-md-none d-sm-none d-lg-inline-block">Posted on</i> <b>{{ $job->created_at->diffForHumans() }}</b></span>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-xl-6 col-lg-6 col-md-8 col-sm-8 col-12">
                                    <div class="float-sm-right">
                                        <button type="button" class="btn btn-sm social-btn-sm facebook-btn">
                                                    <i class="fab fa-facebook-f"></i>&nbsp;&nbsp;
                                                    <span>Share</span>
                                        </button>
                                        <button type="button" class="btn btn-sm social-btn-sm twitter-btn">
                                                    <i class="fab fa-twitter"></i>&nbsp;&nbsp;
                                                    <span>Tweet</span>
                                        </button>
                                        <button type="button" class="btn btn-sm social-btn-sm google-btn">
                                                    <i class="fab fa-pinterest"></i>&nbsp;&nbsp;
                                                    <span>Tweet</span>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="course-image my-3">
                                <img src="@if(Storage::exists($job->job_image)){{ Storage::url($job->job_image) }}@else{{ asset('backend/assets/images/job_image.jpeg') }}@endif">
                            </div>

                            <p>{!! $job->description !!}</p>

                            <a href="{{$job->job_link}}">Click here to see the job</a>
                            
                            <hr class="mb-5 mt-4">
                        </div>
                        
                </div>
                <!-- job main end -->

                <!-- job sidebar start -->
                <div class="col-xl-3 col-lg-3 col-md-4 d-none d-md-block">
                    <h6 class="mt-4 underline-heading">JOB ARCHIVES</h6>
                    <ul class="ul-no-padding">
                        @foreach ($archieves as $archieve)
                        <li class="my-2"> 
                            {{ $archieve->month_name.' '.$archieve->year.' ('.$archieve->job_count.')' }}
                        </li>
                        @endforeach
                    </ul>

                    <h6 class="mt-4 underline-heading">RELATED JOBS</h6>
                    <ul class="ul-no-padding">
                        @foreach ($jobs as $job)
                        <li class="my-2"> 
                            <a href="{{ route('job.view', $job->job_slug) }}">{{ $job->job_title }}</a>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <!-- job sidebar end -->
            </div>
        </div>
        
    <!-- content end -->
@endsection

@section('javascript')
<script type="text/javascript">

</script>
@endsection