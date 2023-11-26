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
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{route('roles.store')}}" method="post"> @csrf 
        <div class="modal-body">
            <input type="text" name="name" placeholder="Name" class="form-control my-4" required>

            
            <div class="form-group">
                  <label for="firstname">Permissions</label>
                  <div class="form-check">
                      <input type="checkbox" class="form-check-input" id="checkAll">
                      <label class="form-check-label">All</label>
                  </div>
                  <div class="row">
                  @foreach ($permissions as $permission)
                    <div class="col-md-3 col-6">
                        <div class="position-relative form-check">
                            <input type="checkbox" class="form-check-input" id="checkbox{{$permission->id}}" name="permissions[]" value="{{$permission->id}}"> 
                            <label class="text-capitalize" for="checkbox{{$permission->id}}">{{$permission->name}}</label>
                        </div>
                    </div>
                  @endforeach
                  </div>
              </div>

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
      @can('role-create')
      <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#Create">Add Role</a>
      @endcan
    </div>
    <div class="col-12">
      <div class="table-responsive card p-2">
        <table id="myDataTables" class="table table-responsive">
          <thead class="">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col" width="700">Permissions</th>
              <th scope="col" class="text-center">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($roles as $role)
            <tr>
              <th scope="row">{{$loop->iteration}}</th>
              <td>{{$role->name}}</td>
              <td>
                <div class="row">
                  @foreach ($role->permissions as $permission)
                  <div class="col-md-3">
                    <button class="btn btn-outline-info fw-bold mb-1 py-0 px-1">{{$permission->name}}</button>
                  </div>
                  @endforeach
                </div>

              </td>
              <td class="text-center">
                @can('role-edit')
                <a href="#" class="btn btn-outline-success fw-bold py-0 px-1" data-bs-toggle="modal" data-bs-target="#Edit{{$role->id}}">Edit</a>
                @endcan
                @can('role-delete')
                <a href="#" class="btn btn-outline-danger fw-bold py-0 px-1" data-bs-toggle="modal" data-bs-target="#Delete{{$role->id}}">Delete</a>
                @endcan
              </td>
            </tr>
            <!-- Edit -->
            <div class="modal fade" id="Edit{{$role->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form action="{{route('roles.update',$role->id)}}" method="post"> @csrf @method('put')
                    <div class="modal-body">
                        <input type="text" name="name" value="{{$role->name}}" class="form-control my-4">

                        <div class="form-group">
                            <label for="firstname">Permissions</label>
                            <div class="row">
                            @foreach($permissions as $permission)
                            <div class="col-md-3 col-6">

                            <div class="position-relative form-check">
                                <label class="form-check-label">
                              
                                <input type="checkbox" class="form-check-input" name="permissions[]" 
                                value="{{$permission->id}}" 
                                {{$role->hasPermissionTo($permission->name) ? 'checked' : '' }} 
                                > 
                                {{$permission->name}}
                              
                              </label>
                            </div>

                            </div>

                            @endforeach
                            </div>
                        </div>

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
            <div class="modal fade" id="Delete{{$role->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Delete</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form action="{{route('roles.destroy',$role->id)}}" method="post"> @csrf @method('delete')
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $("#checkAll").click(function(){
             if($(this).is(':checked')){
                 // check all the checkbox
                 $('input[type=checkbox]').prop('checked', true);
             }else{
                 // un check all the checkbox
                 $('input[type=checkbox]').prop('checked', false);
             }
         });
</script>

<!--myDataTables-->
<script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
<script> $(document).ready( function () { $('#myDataTables').DataTable(); } ); </script>

@endsection