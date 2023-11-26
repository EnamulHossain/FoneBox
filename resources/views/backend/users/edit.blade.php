@extends('layouts.app')
          
@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-12 text-end py-2">
      <a href="{{route('users.index')}}" class="btn btn-primary">User List</a>
    </div>
    <div class="col-md-6 col-10 py-2">
    <form action="{{route('users.update',$user->id)}}" method="post" class="card p-3"> @csrf @method('put')
      <h3 class="text-center">User Edit Form</h3> <hr>
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

      <button type="submit" class="btn btn-success">Update</button>
    </form>
    </div>
  </div>
</div>
@endsection