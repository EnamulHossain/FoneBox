@extends('layouts.backend')
          
@section('css')
       
<!--myDataTables-->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css" />
<style>
  td{padding:0px 10px !important;}
</style>

@endsection
    
@section('content')
  
  <div class="row py-2">
    <div class="col-6">
        <nav aria-label="breadcrumb" class="">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Blog List</li>
          </ol>
        </nav>
    </div>
    <div class="col-6 text-end">
        @can('blog-create')<a href="{{route('blogs.create')}}" class="btn btn-primary">Add New Blog</a>@endcan
    </div>
  </div>
  
  <div class="row">
    <div class="col-12">
      <div class="table-responsive card p-2">
        <table id="myDataTables" class="table table-responsive">
          <thead class="">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Title</th>
              <th scope="col">Image</th>
              <th scope="col" class="text-center">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($blogs as $blog)
            <tr>
              <th scope="row">{{$loop->iteration}}</th>
              <td>{{$blog->title}}</td>
              <td>
                @if($blog->image)<img src="{{asset('/images/blogs/'.$blog->image)}}" style="width:60px;height:auto;" class="img-fluid" alt="{{$blog->title}}">@endif
              </td>
              <td class="text-center">
                  <a href="#" class="btn btn-outline-primary fw-bold py-0 px-1 my-1" data-bs-toggle="modal" data-bs-target="#View{{$blog->id}}">View</a>
                  @can('blog-edit')
                  <a href="{{route('blogs.edit',$blog->id)}}" class="btn btn-outline-success fw-bold py-0 px-1">Edit</a>
                  @endcan
                  @can('blog-delete')
                  <a href="#" class="btn btn-outline-danger fw-bold py-0 px-1 my-1" data-bs-toggle="modal" data-bs-target="#Delete{{$blog->id}}">Delete</a>
                  @endcan
              </td>
            </tr>
            <!-- View -->
            <div class="modal fade" id="View{{$blog->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-xl">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title" id="exampleModalLabel">{{$blog->title}}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                    <div class="modal-body">
                        @if($blog->image) <img src="{{asset('/images/blogs/'.$blog->image)}}" class="img-fluid rounded pb-4" alt="{{$blog->title}}"> @endif
                        {!!$blog->detail!!}
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
              </div>
            </div>
            <!-- Delete -->
            <div class="modal fade" id="Delete{{$blog->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Delete</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form action="{{route('blogs.destroy',$blog->id)}}" method="post"> @csrf @method('delete')
                    <div class="modal-body text-center text-danger fs-3">
                        Are you sure ?
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-danger">Yes</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
  
@endsection

@section('js')

<!--myDataTables-->
<script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
<script> $(document).ready( function () { $('#myDataTables').DataTable(); } ); </script>
   
@endsection