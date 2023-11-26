@extends('layouts.backend')
                 
@section('css')
@endsection   
@section('content')

  <div class="row py-2">
    <div class="col-6">
        <nav aria-label="breadcrumb" class="">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Blog Edit Form</li>
          </ol>
        </nav>
    </div>
    <div class="col-6 text-end">
        @can('blog-list')<a href="{{route('blogs.index')}}" class="btn btn-primary">Blog List</a>@endcan
    </div>
  </div>
  
  <div class="row justify-content-center">
    <div class="col-12 py-2">
    <form action="{{route('blogs.update',$blog->id)}}" method="post" class="card p-3" enctype="multipart/form-data"> @csrf @method('put')
    

        <div class="row">
          <h3 class="text-center">Blog Edit Form</h3> <hr>
        
            <div class="col-md-6 mb-3">
                <label class="form-label">Title</label>
                <input type="text" name="title" value="{{$blog->title}}" class="form-control" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Image</label>&nbsp;&nbsp;&nbsp;
                 @if($blog->image)<img src="{{asset('/images/blogs/'.$blog->image)}}" style="width:30px;height:auto;" class="img-fluid" alt="{{$blog->title}}">@endif
                <input type="file" name="image" class="form-control">
            </div>
            <div class="col-12 mb-3">
                <label class="form-label">Description</label>
                <textarea id="editor" name="detail" id="" cols="30" rows="5" class="form-control">{{$blog->detail}}</textarea>
            </div>
            <div class="col-12 mb-3">
                <a href="{{route('blogs.index')}}" class="btn btn-secondary">Back</a>
                <button type="submit" class="btn btn-success px-5">Save Changes</button>
            </div>
            
        </div>

    </form>
    </div>
  </div>

@endsection
@section('js')
<!-- editor -->
<script src="https://cdn.ckeditor.com/ckeditor5/35.4.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create( document.querySelector('#editor')
          ,{ckfinder:{uploadUrl:'{{route('blog_editor_store').'?_token='.csrf_token()}}'}} 
        )
        .catch( error => {
            console.error( error );
        } );
</script>
@endsection