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
<div class="modal fade" id="Create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{route('permissions.store')}}" method="post"> @csrf 
        <div class="modal-body">
            <input type="text" name="name" placeholder="Name" class="form-control my-4" required>
            <input type="text" name="group_name" placeholder="Group Name" class="form-control my-4">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>

  <div class="row">
    <div class="col-12 text-end py-2">
      @can('permission-create')
      <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#Create">Add Permission</a>
      @endcan
    </div>
    <div class="col-12">
      <div class="table-responsive card p-2">
        <table id="myDataTables" class="table table-responsive">
          <thead class="">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col">Group Name</th>
              <th scope="col" class="text-center">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($permissions as $permission)
            <tr>
              <th scope="row">{{$loop->iteration}}</th>
              <td>{{$permission->name}}</td>
              <td>{{$permission->group_name}}</td>
              <td class="text-center">
                @can('permission-edit')
                <a href="#" class="btn btn-outline-success fw-bold py-0 px-1" data-bs-toggle="modal" data-bs-target="#Edit{{$permission->id}}">Edit</a>
                @endcan
                @can('permission-delete')
                <a href="#" class="btn btn-outline-danger fw-bold py-0 px-1" data-bs-toggle="modal" data-bs-target="#Delete{{$permission->id}}">Delete</a>
                @endcan
              </td>
            </tr>
            <!-- Edit -->
            <div class="modal fade" id="Edit{{$permission->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form action="{{route('permissions.update',$permission->id)}}" method="post"> @csrf @method('put')
                    <div class="modal-body">
                        <input type="text" name="name" value="{{$permission->name}}" class="form-control my-4">
                        <input type="text" name="group_name" value="{{$permission->group_name}}" class="form-control my-4">
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-success">Save changes</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <!-- Delete -->
            <div class="modal fade" id="Delete{{$permission->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Delete</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form action="{{route('permissions.destroy',$permission->id)}}" method="post"> @csrf @method('delete')
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