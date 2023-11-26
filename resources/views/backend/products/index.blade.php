@extends('layouts.backend')
          
@section('css')
       
<!--myDataTables-->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css" />
<style>
  td{padding:0px 10px !important;}
</style>

@endsection

@section('content')
  <div class="row">
    <div class="col-12 text-end py-2">
      @can('role-create')
      <a href="{{route('products.create')}}" class="btn btn-primary">Add product</a>
      @endcan
    </div>
    <div class="col-12">
      <div class="table-responsive card p-2">
        <table id="myDataTables" class="table table-responsive">
          <thead class="">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Title</th>
              <th scope="col">Image</th>
              <th scope="col">Size Variant</th>
              <th scope="col">Price</th>
              <th scope="col" class="text-center">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($products as $product)
            <tr>
              <th scope="row">{{$loop->iteration}}</th>
              <td>{{$product->title}}</td>
              <td>
                @if($product->image)
                <a href="#" data-bs-toggle="modal" data-bs-target="#Image{{$product->id}}" class="text-center">
                  <div><img src="{{asset('/images/products/'.$product->image)}}" class="img-fluid w-20" alt="{{$product->title}}"></div>
                  <div><span class="">click me</span></div>
                </a>
                @endif
              </td>
              <td>
              @foreach($product_variants as $product_variant)
                @if($product_variant->product_id==$product->id)
                <span class="badge bg-label-primary">{{$product_variant->size->size_name}} </span>
                @endif
              @endforeach
              </td>
              <td>{{$product->price}}</td>
              <td class="text-center">
                <a href="{{route('products.edit',$product->id)}}" class="btn btn-outline-success fw-bold py-0 px-1">Edit</a>
                <a href="#" class="btn btn-outline-danger fw-bold py-0 px-1" data-bs-toggle="modal" data-bs-target="#Delete{{$product->id}}">Delete</a>
              </td>
            </tr>
            <!-- Delete -->
            <div class="modal fade" id="Delete{{$product->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body text-center">
                    <form action="{{route('products.destroy',$product->id)}}" method="post"> @csrf @method('delete')
                      <button type="submit" class="btn btn-danger">Yes</button>
                    </form>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                  </div>
                </div>
              </div>
            </div>
            <!-- Image -->
            <div class="modal fade" id="Image{{$product->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body text-center">
                    <div class="row">
                      <div class="col-md-6">
                        <h3>Main Image</h3>
                        <hr>
                        <img src="{{asset('/images/products/'.$product->image)}}" class="img-fluid w-100" alt="{{$product->title}}">
                      </div>
                      <div class="col-md-6">
                        <div class="row justify-content-center">
                          <h3>Optional Images</h3>
                          <hr>
                          <div class="row">
                          @foreach($product_images as $product_image)
                          @if($product_image->product_id==$product->id)
                          <div class="col-md-6">
                          <img src="{{asset('/images/products/'.$product_image->image2)}}" class="img-fluid w-100" alt="{{$product->title}}">
                          </div>
                          @endif
                          @endforeach
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  </div>
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