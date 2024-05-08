@extends('layouts.master')
@section('css')

@section('title')
Gallery
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">Gallery</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item">
                    <div>
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal" style="font-size: 18px; font-family:Amiri;line-height: 1.2;"><i class="fa fa-flag"></i> -
                            Add New Gallery
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
                <h5 class="modal-title" id="exampleModalLabel">Add Gallery</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- <div class="modal-body">
                <form action="{{route('storeGallery')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <label style="font-size: 13px; font-weight: bold;" class="ml-3">category</label>
                    <select name="category_id" class="form-control">
                        @foreach ($cats as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                    <label style="font-size: 13px; font-weight: bold;" class="ml-3">sub_category</label>
                    <select name="sub_category_id" class="form-control">
                        @foreach ($subcats as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                    </br>
                    <label style="font-size: 13px; font-weight: bold;" class="ml-3">image (Optional)</label>
                    <input type="file" name="image" class="form-control">

                    </br>
                    <label style="font-size: 13px; font-weight: bold;" class="ml-3">pdf (Optional)</label>
                    <input type="file" name="pdf" class="form-control">
                    </br>
                    <label style="font-size: 13px; font-weight: bold;" class="ml-3">video (Optional)</label>
                    <input type="file" name="video" class="form-control">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div> -->
            <div class="modal-body">
                <form id="galleryForm" action="{{ route('storeGallery') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <label style="font-size: 13px; font-weight: bold;" class="ml-3">category</label>
                    <select id="category" name="category_id" class="form-control">
                        <option value="" selected>select category </option>
                        @foreach ($cats as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>

                    <label style="font-size: 13px; font-weight: bold;" class="ml-3">sub_category</label>
                    <select id="sub_category" name="sub_category_id" class="form-control">
                        <!-- Subcategories will be populated dynamically -->
                    </select>

                    <br>
                    <label style="font-size: 13px; font-weight: bold;" class="ml-3">image (Optional)</label>
                    <input type="file" name="image" class="form-control">
                    <br>
                    <label style="font-size: 13px; font-weight: bold;" class="ml-3">pdf (Optional)</label>
                    <input type="file" name="pdf" class="form-control">
                    <br>
                    <label style="font-size: 13px; font-weight: bold;" class="ml-3">video (Optional)</label>
                    <input type="file" name="video" class="form-control">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>

            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script>
                $(document).ready(function() {
                    $('#category').on('change', function() {
                        var category_id = $(this).val();
                        if (category_id) {
                            $.ajax({
                                url: '{{ url('dashboard/sub/category/show/cat_id') }}',
                                type: 'GET',
                                data: {
                                    _token: '{{ csrf_token() }}',
                                    category_id: category_id
                                },
                                dataType: 'json',
                                success: function(data) {
                                    $('#sub_category').empty();
                                    $.each(data, function(key, value) {
                                        $('#sub_category').append('<option value="' + value.id + '">' + value.name + '</option>'); // Changed to value.id for option value
                                    });
                                }
                            });
                        } else {
                            $('#sub_category').empty();
                        }
                    });
                });
            </script>


        </div>
    </div>
</div>

<!-- // -->


<!-- // -->
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-bordered p-0" style="text-align:center">
                        <thead>
                            <tr>
                                <th>Category Name</th>
                                <th>SubCategory Name</th>
                                <th>Image</th>
                                <th>video</th>
                                <th>pdf</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($galleries as $gallery)
                            <tr>
                                <td>{{$gallery->subCategory->category->name}}</td>
                                <td>{{$gallery->subCategory->name}}</td>
                                @if($gallery->image !==null)
                                <td>
                                    <img src="{{ asset($gallery->image) }}" style="width:40px;height:40px" alt="">
                                </td>
                                @else
                                <td>
                                </td>
                                @endif
                                <td>
                                    @if ($gallery->video != null)
                                    <video width="140" height="80" controls>
                                        <source src='{{asset("$gallery->video")}}' type="video/ogg">.
                                    </video>
                                    @endif
                                </td>
                                <td>
                                    @if ($gallery->pdf != null)
                                    <a href="{{ route('pdfDownload', $gallery->pdf) }}" class='btn btn-ghost-info'>
                                        <i class="fa fa-download"></i>
                                    </a>

                                    @endif
                                </td>
                                <td>
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#edit{{$gallery->id}}">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <!--  edit Modal -->
                                    <div class="modal fade" id="edit{{$gallery->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Edit Gallery</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{route('updateGallery',$gallery->id)}}" method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        </br>
                                                        <label style="font-size: 13px; font-weight: bold;" class="ml-3">image (Optional)</label>
                                                        <input type="file" name="image" class="form-control" value="{{$gallery->image}}">
                                                        </br>
                                                        <label style="font-size: 13px; font-weight: bold;" class="ml-3">pdf (Optional)</label>
                                                        <input type="file" name="pdf" class="form-control" value="{{$gallery->image}}">
                                                        </br>
                                                        <label style="font-size: 13px; font-weight: bold;" class="ml-3">video (Optional)</label>
                                                        <input type="file" name="video" class="form-control" value="{{$gallery->image}}">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Edit</button>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete{{$gallery->id}}">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                    <div class="modal fade" id="delete{{$gallery->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Delete SubCategory</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{route('deleteGallery',$gallery->id)}}" method="post">
                                                    @csrf
                                                    <h4 class="modal-body">
                                                        Are you sure you want to delete this Gallery?
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