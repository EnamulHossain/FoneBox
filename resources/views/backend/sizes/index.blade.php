@extends('layouts.backend')
          
@section('css')

<!--myDataTables-->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css" />
<style>
  td{padding:0px 10px !important;}
</style>
@endsection

@section('content')

<!-- Create -->
<div class="modal fade" id="Create" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel1">Create Form</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{route('sizes.store')}}" method="post"> @csrf 
        <div class="modal-body">
          <div class="row">
              
            <div class="col mb-3">
              <label for="name" class="form-label">Name</label>
              <input type="text" name="size_name" id="name" class="form-control" placeholder="Enter Name" required>
            </div>
            
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success">Save</button>
        </div>
        </form>
      </div>
    </div>
</div>

  <div class="row">
    <div class="col-12 text-end py-2">
      <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#Create">Add Product Size</a>
    </div>
    <div class="col-12">
      <div class="table-responsive card p-2">
        <table id="myDataTables" class="table table-responsive">
          <thead class="">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col" class="text-center">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($sizes as $size)
            <tr>
              <th scope="row">{{$loop->iteration}}</th>
              <td>{{$size->size_name}}</td>
              <td class="text-center">
                <a href="#" class="btn btn-outline-success fw-bold py-0 px-1" data-bs-toggle="modal" data-bs-target="#Edit{{$size->id}}">Edit</a>
                <a href="#" class="btn btn-outline-danger fw-bold py-0 px-1" data-bs-toggle="modal" data-bs-target="#Delete{{$size->id}}">Delete</a>
              </td>
            </tr>

            <!-- Edit -->
            <div class="modal fade" id="Edit{{$size->id}}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel1">Edit Form</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{route('sizes.update',$size->id)}}" method="post"> @csrf @method('put') 
                    <div class="modal-body">
                      <div class="row">
                          
                        <div class="col mb-3">
                          <label for="name" class="form-label">Name</label>
                          <input type="text" name="size_name" id="name" class="form-control" value="{{$size->size_name}}" required>
                        </div>
                        
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-success">Save changes</button>
                    </div>
                    </form>
                  </div>
                </div>
            </div>
            <!-- Delete -->
            <div class="modal fade" id="Delete{{$size->id}}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel1">Delete</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{route('sizes.destroy',$size->id)}}" method="post"> @csrf @method('delete')
                    <div class="modal-body text-danger fs-2 text-center">
                      Are you sure ?
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
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