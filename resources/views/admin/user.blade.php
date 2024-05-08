@extends('layouts.master')
@section('css')

@section('title')
users
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">users</h4>
        </div>
        <!-- <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item">
                    <div>
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal" style="font-size: 18px; font-family:Amiri;line-height: 1.2;"><i class="fa fa-user"></i> -
                            Add New Providers
                        </button>
                    </div>
                </li>
            </ol>
        </div> -->
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


<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-bordered p-0" style="text-align:center">
                        <thead>
                            <tr>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Username</th>
                                <th>Phone</th>
                                <th>Location </th>
                                <th>Avatar</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($providers as $provider)
                            <tr>
                                <td>{{$provider->first_name}}</td>
                                <td>{{$provider->last_name}}</td>
                                <td>{{$provider->username}}</td>
                                <td>{{$provider->phone}}</td>
                                @if($provider->location_id !==null)
                                <td>{{$provider->locations->title}}</td>
                                @else
                                <td>
                                </td>
                                @endif
                                @if($provider->avater !==null)
                                <td>
                                    <img src="{{ asset($provider->avater) }}" style="width:40px;height:40px" alt="">
                                </td>
                                @else
                                <td>
                                </td>
                                @endif
                                @if($provider->active ==0)
                                <th>
                                    <span class="bg-danger p-1 text-light rounded">
                                        Inactive
                                    </span>
                                </th>
                                @else
                                <th>
                                    <span class="bg-primary p-1 text-light rounded">
                                        Active
                                    </span>
                                </th>
                                @endif
                                <td>
                                    <!-- <a class="btn @if($provider->active==0) btn-primary @else btn-dark @endif btn-sm" href="{{route('admin.providers.toggle-status',$provider->id)}}">
                                        @if($provider->active==0)
                                        <i class="fa fa-check"></i>
                                        @else
                                        <i class="fa fa-times"></i>
                                        @endif

                                    </a> -->


                                    <!-- Button trigger modal update -->

                                    <!-- <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#edit{{$provider->id}}">
                                        <i class="fa fa-edit"></i>
                                    </button> -->

                            
                                    <!-- Button trigger modal delete -->
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete{{$provider->id}}">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                    <div class="modal fade" id="delete{{$provider->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Delete User</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{route('admin.providers.destroy',$provider->id)}}" method="post">
                                                    @csrf
                                                    <h4 class="modal-body">
                                                        Are you sure you want to delete this User?
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