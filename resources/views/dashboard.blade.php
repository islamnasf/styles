@extends('layouts.master')
@section('css')
@section('title')
dashboard
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> Home </h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item" class="default-color">Home</li>
                <li class="breadcrumb-item active">Dashboard </li>
            </ol>
        </div>
    </div>
</div>
<div class="row">
        <div class="col-sm-12">
        <img src="{{ URL::asset('assets/images/logo-dark.png') }}" alt="" style=" width:100%; margin-bottom: 20px;" >
        </div>
    </div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row mb-30">
  
    <a href="{{ route('getCategory') }}" class="col-md-4 mb-4"  >
        <div class="card text-center bg-mauve">
            <div class="card-body" style="background-color: #2A132A;">
                <i class="fa fa-list-ul fa-3x mb-2 text-light "></i>
                <h5 class="card-title text-light font-size-lg">Categories </h5>
            </div>
        </div>
    </a>
    <a href="{{ route('getSubCategory') }}" class="col-md-4 mb-4" >
        <div class="card text-center bg-mauve">
            <div class="card-body" style="background-color: #2A132A;">
                <i class="fa fa-sitemap fa-3x mb-2 text-light "></i>
                <h5 class="card-title text-light font-size-lg">SubCategories </h5>
            </div>
        </div>
    </a>
    <a href="{{ route('getGallery') }}" class="col-md-4 mb-4"  >
        <div class="card text-center bg-mauve" >
            <div class="card-body" style="background-color: #2A132A;">
                <i class="fa fa-picture-o fa-3x mb-2 text-light "></i>
                <h5 class="card-title text-light font-size-lg">Gallery </h5>
            </div>
        </div>
    </a>
    <a href="{{ route('admin.providers.index') }}" class="col-md-4 mb-4"  >
        <div class="card text-center bg-mauve" >
            <div class="card-body" style="background-color: #2A132A;">
                <i class="fa fa-user fa-3x mb-2 text-light "></i>
                <h5 class="card-title text-light font-size-lg">Users </h5>
            </div>
        </div>
    </a>
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection 
