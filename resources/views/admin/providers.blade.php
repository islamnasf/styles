@extends('layouts.master')
@section('css')

@section('title')
Providers
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">Providers</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item">
                    <div>
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal" style="font-size: 18px; font-family:Amiri;line-height: 1.2;"><i class="fa fa-user"></i> -
                            Add New Providers
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
                <h5 class="modal-title" id="exampleModalLabel">Add Provider</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.providers.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="text" name="first_name" class="form-control" placeholder="First Name">
                    </br>
                    <input type="text" name="last_name" class="form-control" placeholder="Last Name">
                    </br>
                    <input type="text" name="username" class="form-control" placeholder="Username">
                    </br>
                    <input type="text" name="phone" class="form-control" placeholder="Phone">
                    </br>
                    <input type="password" name="password" class="form-control" placeholder="Password">
                    </br>
                    <input type="text" name="years_experience" class="form-control" placeholder="Years of Experience">
                    </br>
                    <label style="font-size: 13px; font-weight: bold;" class="ml-3"> Service </label>
                    <select name="service_id" class="form-control">
                        @foreach ($services as $service)
                        <option value="{{ $service->id }}">{{ $service->service_name }}</option>
                        @endforeach
                    </select> </br>
                    <label style="font-size: 13px; font-weight: bold;" class="ml-3">Location</label>
                    <select name="location_id" class="form-control">
                        @foreach ($locations as $location)
                        <option value="{{ $location->id }}">{{ $location->title }}</option>
                        @endforeach
                    </select> </br>
                    <label style="font-size: 13px; font-weight: bold;" class="ml-3">Avatar (Optional)</label>
                    <input type="file" name="avater" class="form-control">
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
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Username</th>
                                <th>Phone</th>
                                <th>Years of Experience</th>
                                <th>Location </th>
                                <th>Service </th>
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
                                <td>{{$provider->years_experience}}</td>
                                @if($provider->location_id !==null)
                                <td>{{$provider->locations->title}}</td>
                                @else
                                <td>
                                </td>
                                @endif
                                @if($provider->service_id !==null)
                                <td>{{$provider->services->jop_name}}</td>
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
                                    <a class="btn @if($provider->active==0) btn-primary @else btn-dark @endif btn-sm" href="{{route('admin.providers.toggle-status',$provider->id)}}">
                                        @if($provider->active==0)
                                        <i class="fa fa-check"></i>
                                        @else
                                        <i class="fa fa-times"></i>
                                        @endif

                                    </a>


                                    <!-- Button trigger modal update -->

                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#edit{{$provider->id}}">
                                        <i class="fa fa-edit"></i>
                                    </button>

                                    <!--  edit Modal -->
                                    <div class="modal fade" id="edit{{$provider->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Edit Provider</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form  action="{{route('updateProviders',$provider->id)}}" method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT') 
                                                        <input type="text" name="first_name" class="form-control" placeholder="First Name" value="{{ $provider->first_name }}">
                                                        </br>
                                                        <input type="text" name="last_name" class="form-control" placeholder="Last Name" value="{{ $provider->last_name }}">
                                                        </br>
                                                        <input type="text" name="username" class="form-control" placeholder="Username" value="{{ $provider->username }}">
                                                        </br>
                                                        <input type="text" name="phone" class="form-control" placeholder="Phone" value="{{ $provider->phone }}">
                                                        </br>
                                                        <input type="password" name="password" class="form-control" placeholder="Password" value="{{ $provider->password }}">
                                                        </br>
                                                        <input type="text" name="years_experience" class="form-control" placeholder="Years of Experience" value="{{ $provider->years_experience }}">
                                                        </br>
                                                        <label style="font-size: 13px; font-weight: bold;" class="ml-3"> Service </label>
                                                        <select name="service_id" class="form-control">
                                                            @foreach ($services as $service)
                                                            <option value="{{ $service->id }}" @if($provider->service_id == $service->id) selected @endif>{{ $service->service_name }}</option>
                                                            @endforeach
                                                        </select> </br>
                                                        <label style="font-size: 13px; font-weight: bold;" class="ml-3">Location</label>
                                                        <select name="location_id" class="form-control">
                                                            @foreach ($locations as $location)
                                                            <option value="{{ $location->id }}" @if($provider->location_id == $location->id) selected @endif>{{ $location->title }}</option>
                                                            @endforeach
                                                        </select> </br>
                                                        <label style="font-size: 13px; font-weight: bold;" class="ml-3">Avatar (Optional)</label>
                                                        <input type="file" name="avater" class="form-control">
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
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete{{$provider->id}}">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                    <div class="modal fade" id="delete{{$provider->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Delete Prvider</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{route('admin.providers.destroy',$provider->id)}}" method="post">
                                                    @csrf
                                                    <h4 class="modal-body">
                                                        Are you sure you want to delete this provider?
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