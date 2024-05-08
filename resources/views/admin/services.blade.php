@extends('layouts.master')
@section('css')

@section('title')
Services
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">Services</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item">
                    <div>
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal" style="font-size: 18px; font-family:Amiri;line-height: 1.2;"><i class="fa fa-cogs"></i> -
                            Add New Service
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
                <h5 class="modal-title" id="exampleModalLabel">Add Service</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('storeService')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="text" name="service_name" class="form-control" placeholder="Service Name  ">
                    </br>
                    <input type="text" name="jop_name" class="form-control" placeholder="Job Name">
                    </br>
                    <label style="font-size: 13px; font-weight: bold;" class="ml-3"> Service Image (Optional) </label>
                    <input type="file" name="image" class="form-control">
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
                                <th>Service Name</th>
                                <th>Job Name</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($services as $service)
                            <tr>
                                <td>{{$service->service_name}}</td>
                                <td>{{$service->jop_name}}</td>

                                @if($service->image !==null)
                                <td>
                                    <img src="{{ asset($service->image) }}" style="width:40px;height:40px" alt="">
                                </td>
                                @else
                                <td>
                                    <span class="bg-danger p-1 text-light rounded">
                                        Not Available
                                    </span>
                                </td>
                                @endif
                                @if($service->active ==0)
                                <th>
                                <span class="bg-danger p-2 text-light rounded">
                                    Inactive
                                </span>
                                </th>
                                @else
                                <th>
                                <span class="bg-primary p-2 text-light rounded">
                                      Active  
                                </span>
                                </th>
                                @endif
                                <td>
                                    <a class="btn @if($service->active==0) btn-primary @else btn-dark @endif btn-sm" href="{{route('activeService',$service->id)}}">
                                        @if($service->active==0)
                                        <i class="fa fa-check"></i>
                                        @else
                                        <i class="fa fa-times"></i>
                                        @endif

                                    </a>
                                    

                                    <!-- Button trigger modal update -->

                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#edit{{$service->id}}">
                                        <i class="fa fa-edit"></i>
                                    </button>

                                    <!--  edit Modal -->
                                    <div class="modal fade" id="edit{{$service->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Edit Service</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{route('updateService',$service->id)}}" method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        <label style="font-size: 15px; font-weight: bold;"> Service Name </label>
                                                        <input type="text" name="service_name" class="form-control" value="{{$service->service_name}}">
                                                        </br>
                                                        <label style="font-size: 15px; font-weight: bold;"> Job Name </label>
                                                        <input type="text" name="jop_name" class="form-control" value="{{ $service->jop_name}}">
                                                        </br>
                                                        <label style="font-size: 15px; font-weight: bold;"> Service Image </label>
                                                        <input type="file" name="image" class="form-control" value="{{ $service->image}}">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Edit</button>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Button trigger modal delete -->
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete{{$service->id}}">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                    <div class="modal fade" id="delete{{$service->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Delete Service</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{route('deleteService',$service->id)}}" method="post">
                                                    @csrf
                                                    <h4 class="modal-body">
                                                        Are you sure you want to delete this service?
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
