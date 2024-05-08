@extends('layouts.master')
@section('css')

@section('title')
Regions
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">Regions</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item">
                    <div>
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal" style="font-size: 18px; font-family:Amiri;line-height: 1.2;"><i class="fa fa-map-marker"></i> -
                            Add New Region
                        </button>
                    </div>
                </li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- errors -->
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<!-- end errors -->
<!--  Add Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Region</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('storeLocation') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="text" name="title" class="form-control" placeholder="Region Name">
                    </br>
                    <input type="text" name="description" class="form-control" placeholder="Description">
                    </br>
                    <select name="country_id" class="form-control">
                        @foreach ($countries as $country)
                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                        @endforeach
                    </select>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Add</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-bordered p-0" style="text-align:center">
                        <thead>
                            <tr>
                                <th>Region Name</th>
                                <th>Country</th>
                                <th>Description</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($locations as $location)
                            <tr>
                                <td>{{$location->title}}</td>
                                <td>{{$location->country->name}}</td>
                                <td>{{$location->description}}</td>



                                <td>
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#edit{{$location->id}}">
                                        <i class="fa fa-edit"></i>
                                    </button>

                                    <!--  edit Modal -->
                                    <div class="modal fade" id="edit{{$location->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Edit Region</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{route('updateLocation',$location->id)}}" method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        <label style="font-size: 15px; font-weight: bold;"> Region Name </label>
                                                        <input type="text" name="title" class="form-control" value="{{$location->title}}">
                                                        </br>
                                                        <label style="font-size: 15px; font-weight: bold;"> Description  </label>
                                                        <input type="text" name="description" class="form-control" value="{{ $location->description}}">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Edit</button>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end edit -->
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete{{$location->id}}">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                    <div class="modal fade" id="delete{{$location->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Delete Region</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{route('deleteLocation',$location->id)}}" method="post">
                                                    @csrf
                                                    <h4 class="modal-body">
                                                        Are you sure you want to delete this region?
                                                    </h4>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Delete</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Button trigger modal show -->
                                    <!-- <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#show">
                          <i class="fa fa-eye"></i>
                          </button>
                 -->
                                </td>
                            </tr>
                            @endforeach
                            </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection 
