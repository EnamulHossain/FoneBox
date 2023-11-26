@extends('layouts.app')
          
@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-12 text-end py-2">
      <a href="{{route('users.index')}}" class="btn btn-primary">User List</a>
    </div>
    <div class="col-md-6 col-10 py-2">
    <form action="{{route('users.store')}}" method="post" class="card p-3"> @csrf 
      <h3 class="text-center">User Create Form</h3> <hr>
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

      <button type="submit" class="btn btn-success">Create</button>
    </form>
    </div>
  </div>
</div>
@endsection