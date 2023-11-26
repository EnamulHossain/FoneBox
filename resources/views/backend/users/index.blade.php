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
      <form action="{{route('users.store')}}" method="post"> @csrf 
        <div class="modal-body">
            <input type="text" name="name" placeholder="Name" class="form-control my-4">
            <input type="email" name="email" placeholder="Email" class="form-control my-4">
            <input type="password" name="password" placeholder="Password" class="form-control my-4">

            <div class="form-group">
                  <label for="exampleCustomSelect">Select Role</label>
                  <select type="select" id="exampleCustomSelect" name="role" class="form-select mb-4" id="roleSelect">
                      <option value="" hidden>Select</option>
                      @forelse ($roles as $role)
                          <option value="{{ $role->name }}" data-areas="{{ json_encode($role->areas) }}">{{ $role->name }}</option>
                      @empty
                          <option>No Role Found</option>
                      @endforelse
                  </select>
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
      @can('user-create')
        <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#Create">Add User</a>
        <!-- <a href="{{route('users.create')}}" class="btn btn-primary">Create</a> -->
      @endcan
    </div>
    <div class="col-12">
      <div class="table-responsive card p-2">
        <table id="myDataTables" class="table table-responsive">
          <thead class="">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col">Roles</th>
              <th scope="col">Email</th>
              <th scope="col" class="text-center">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($users as $user)
            <tr>
              <th scope="row">{{$loop->iteration}}</th>
              <td>{{$user->name}}</td>
              <td>
                    @foreach ($roles as $role)
                    @if($user->hasRole($role->name)==$role->name)
                        <button class="btn btn-outline-info  fw-bold py-0 px-1">{{$role->name}}</button>
                    @endif
                    @endforeach
                <!-- @foreach($user->roles as $role)
                    <span class="badge badge-info mr-1">
                        {{ $role->name }}
                    </span>
                @endforeach -->
              </td>
              <td>{{$user->email}}</td>
              <td class="text-center">
                @if(!($user->email=='admin@gmail.com'))
                  @can('user-edit')
                  <a href="#" class="btn btn-outline-success fw-bold py-0 px-1" data-bs-toggle="modal" data-bs-target="#Edit{{$user->id}}">Edit</a>
                  <!-- <a href="{{route('users.edit',$user->id)}}" class="btn btn-outline-success fw-bold py-0 px-1">Edit</a> -->
                  @endcan
                  @can('user-delete')
                  <a href="#" class="btn btn-outline-danger fw-bold py-0 px-1" data-bs-toggle="modal" data-bs-target="#Delete{{$user->id}}">Delete</a>
                  @endcan
                @endif
              </td>
            </tr>
            <!-- Edit -->
            <div class="modal fade" id="Edit{{$user->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form action="{{route('users.update',$user->id)}}" method="post"> @csrf @method('put')
                    <div class="modal-body">
                        <input type="text" name="name" value="{{$user->name}}" class="form-control my-4">
                        <input type="email" name="email" value="{{$user->email}}" class="form-control my-4">

                        <div class="form-group">
                            <label for="exampleCustomSelect">Select Role</label>
                            <select multiple="" type="select" id="exampleCustomMutlipleSelect" class="form-select mb-4" name="roles[]" onchange="updateDropdowns(this)">
                                <!-- <option value="" hidden>Select</option> -->
                                @foreach ($roles as $role)
                                    <option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>{{ $role->name }}</option>
                                @endforeach
                            </select>
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
            <div class="modal fade" id="Delete{{$user->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Delete</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form action="{{route('users.destroy',$user->id)}}" method="post"> @csrf @method('delete')
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