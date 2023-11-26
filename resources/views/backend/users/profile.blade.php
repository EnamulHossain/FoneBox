@extends('layouts.backend')
          
@section('css')

@endsection

@section('content')
          
<h4 class="py-3 mb-4">
  <span class="text-muted fw-light">User Profile /</span> Profile
</h4>


<!-- Header -->
<div class="row">
  <div class="col-12">
    <div class="card mb-4">
      <div class="user-profile-header-banner">
        @if(Auth::user()->cover)
        <img src="{{asset('/images/users/'.Auth::user()->cover)}}" alt="Banner image" class="rounded-top img-fluid w-100">
        @else
        <img src="/backend/img/pages/profile-banner.png" alt="Banner image" class="rounded-top img-fluid w-100">
        @endif
      </div>
      <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-4">
        <div class="flex-shrink-0 mt-n5 mx-sm-0 mx-auto">
          @if(Auth::user()->image)
          <img src="{{asset('/images/users/'.Auth::user()->image)}}" alt="user image" class="d-block h-auto ms-0 ms-sm-4 rounded user-profile-img img-fluid">
          @else
            @if(Auth::user()->gender=='Male')
              <img src="/backend/img/avatars/male.png" alt="user image" class="d-block h-auto ms-0 ms-sm-4 rounded user-profile-img img-fluid">
            @elseif(Auth::user()->gender=='Female')
              <img src="/backend/img/avatars/female.png" alt="user image" class="d-block h-auto ms-0 ms-sm-4 rounded user-profile-img img-fluid">
            @else
              <img src="/backend/img/avatars/others.png" alt="user image" class="d-block h-auto ms-0 ms-sm-4 rounded user-profile-img img-fluid">
            @endif
          @endif
        </div>
        <div class="flex-grow-1 mt-3 mt-sm-5">
          <div class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-4 flex-md-row flex-column gap-4">
            <div class="user-profile-info">
              <h4>{{Auth::user()->name}}</h4>
              <ul class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-2">
                <!-- <li class="list-inline-item fw-medium">
                  <i class='bx bx-pen'></i> UX Designer
                </li> -->
                <li class="list-inline-item fw-medium">
                  <i class='bx bx-map'></i> {{Auth::user()->country}}
                </li>
                <li class="list-inline-item fw-medium">
                  <i class='bx bx-calendar-alt'></i> Joined {{Auth::user()->created_at->format('M Y')}}
                </li>
              </ul>
            </div>
            <a href="javascript:void(0)" class="btn btn-primary text-nowrap" data-bs-toggle="modal" data-bs-target="#Edit">
              <i class='bx bx-user-check me-1'></i>Edit Profile
            </a>

            <!-- Edit -->
            <div class="modal fade" id="Edit" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Edit Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form action="{{url('/profile_update',Auth::user()->id)}}" method="post" enctype="multipart/form-data"> @csrf @method('put')
                  <div class="modal-body">
                    <div class="row">

                      <div class="col-12 mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" value="{{Auth::user()->name}}" required>
                      </div>
                      <div class="col-12 mb-3">
                        <label class="form-label">Mobile</label>
                        <input type="text" name="mobile" class="form-control" value="{{Auth::user()->mobile}}">
                      </div>
                      <div class="col-12 mb-3">
                        <label class="form-label">Profile Image [1*1]</label>
                        <input type="file" name="image" class="form-control">
                      </div>
                      <div class="col-12 mb-3">
                        <label class="form-label">Cover Image [7*2]</label>
                        <input type="file" name="cover" class="form-control">
                      </div>
                      <div class="col-12 mb-3">
                        <label class="form-label">Gender</label>
                        <div class="form-check">
                          <input name="gender" class="form-check-input" type="radio" value="Male" id="Male" {{ (Auth::user()->gender=="Male")?"checked":"" }}/>
                          <label class="form-check-label" for="Male">
                            Male
                          </label>
                        </div>
                        <div class="form-check">
                          <input name="gender" class="form-check-input" type="radio" value="Female" id="Female" {{ (Auth::user()->gender=="Female")?"checked":"" }}/>
                          <label class="form-check-label" for="Female">
                            Female
                          </label>
                        </div>
                        <div class="form-check">
                          <input name="gender" class="form-check-input" type="radio" value="Others" id="Others" {{ (Auth::user()->gender=="Others")?"checked":"" }}/>
                          <label class="form-check-label" for="Others">
                            Others
                          </label>
                        </div>
                      </div>
                      <div class="col-12 mb-3">
                        <label class="form-label">Country</label>
                        <input type="text" name="country" class="form-control" value="{{Auth::user()->country}}">
                      </div>
                      <div class="col-12 mb-3">
                        <label class="form-label">Address</label>
                        <textarea name="address" id="" cols="30" rows="2" class="form-control">{{Auth::user()->address}}</textarea>
                      </div>



                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                  </div>
                  </form>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- User Profile Content -->
<div class="row">

  <div class="col-xl-6 col-lg-6 col-md-6">
    <div class="card mb-4">
      <div class="card-body">
        <small class="text-muted text-uppercase">About</small>
        <ul class="list-unstyled mb-4 mt-3">
          <li class="d-flex align-items-center mb-3"><i class="bx bx-user"></i><span class="fw-medium mx-2">Full Name:</span> <span>{{Auth::user()->name}}</span></li>
          <li class="d-flex align-items-center mb-3"><i class="bx bx-check"></i><span class="fw-medium mx-2">Status:</span> <span>Active</span></li>
          <li class="d-flex align-items-center mb-3"><i class="bx bx-star"></i><span class="fw-medium mx-2">Gender:</span> <span>{{Auth::user()->gender}}</span></li>
          <li class="d-flex align-items-center mb-3"><i class="bx bx-flag"></i><span class="fw-medium mx-2">Country:</span> <span>{{Auth::user()->country}}</span></li>
          <li class="d-flex align-items-center mb-3"><i class="bx bx-detail"></i><span class="fw-medium mx-2">Languages:</span> <span>English</span></li>
        </ul>
      </div>
    </div>
  </div>
  <div class="col-xl-6 col-lg-6 col-md-6">
    <div class="card mb-4">
      <div class="card-body">
        <small class="text-muted text-uppercase">Contacts</small>
        <ul class="list-unstyled mb-4 mt-3">
          <li class="d-flex align-items-center mb-3"><i class="bx bx-phone"></i><span class="fw-medium mx-2">Contact:</span> <span>{{Auth::user()->mobile}}</span></li>
          <li class="d-flex align-items-center mb-3"><i class="bx bx-envelope"></i><span class="fw-medium mx-2">Email:</span> <span>{{Auth::user()->email}}</span></li>
          <li class="d-flex align-items-center mb-3"><i class="bx bx-chat"></i><span class="fw-medium mx-2">Address:</span> <span>{{Auth::user()->address}}</span></li>
        </ul>
      </div>
    </div>
  </div>

</div>
<!--/ User Profile Content -->

@endsection

@section('js')

@endsection