@extends('layouts.backend')
          
@section('css')
  <!-- Vendors CSS -->
  <link rel="stylesheet" href="{{ asset('/backend/vendor/libs/quill/typography.css') }}">
  <link rel="stylesheet" href="{{ asset('/backend/vendor/libs/quill/katex.css') }}">
  <link rel="stylesheet" href="{{ asset('/backend/vendor/libs/quill/editor.css') }}">
  <link rel="stylesheet" href="{{ asset('/backend/vendor/libs/select2/select2.css') }}">
  <link rel="stylesheet" href="{{ asset('/backend/vendor/libs/dropzone/dropzone.css') }}">
  <link rel="stylesheet" href="{{ asset('/backend/vendor/libs/flatpickr/flatpickr.css') }}">
  <link rel="stylesheet" href="{{ asset('/backend/vendor/libs/tagify/tagify.css') }}" />
@endsection

@section('content')

<form action="{{route('products.update',$product->id)}}" method="post" enctype="multipart/form-data"> @csrf @method('put')

<div class="app-ecommerce pt-2">

  <div class="d-flex flex-wrap justify-content-between align-items-center pb-2">

    <div class="d-flex flex-column justify-content-center">
      <h4 class="pt-2">
        <span class="text-muted fw-light"> <a href="{{route('products.index')}}">Product List</a> /</span><span> Edit Product</span>
      </h4>
    </div>
    <div class="d-flex align-content-center flex-wrap gap-3">
      <button type="submit" class="btn btn-primary">Update product</button>
    </div>

  </div>

    <div class="row">

      <div class="col-12 col-lg-6">

        <div class="card mb-4">
          <div class="card-header">
            <h5 class="card-tile mb-0">Product information</h5>
          </div>
          <div class="card-body">
            <div class="mb-3">
              <label class="form-label" for="ecommerce-product-title">Title</label>
              <input type="text" class="form-control" id="ecommerce-product-title" value="{{$product->title}}" name="title" aria-label="Product title" required>
            </div>
            <!--<div class="mb-3">-->
            <!--  <label class="form-label" for="ecommerce-product-slug">Slug</label>-->
            <!--  <input type="text" class="form-control" id="ecommerce-product-slug" value="{{$product->slug}}" name="slug" aria-label="Product slug">-->
            <!--</div>-->
            <!--<div class="mb-3">-->
            <!--  <label class="form-label" for="ecommerce-product-sub_title">Sub Title</label>-->
            <!--  <input type="text" class="form-control" id="ecommerce-product-sub_title" placeholder="Product sub title" name="sub_title" aria-label="Product sub title">-->
            <!--</div>-->
            <div class="mb-3">
              <label class="form-label" for="ecommerce-product-image">
                Image
                <img src="{{asset('/images/products/'.$product->image)}}" style="width:50px;height:auto;" alt="{{$product->title}}">
              </label>
              <input type="file" class="form-control" id="ecommerce-product-image" name="image" aria-label="Product image">
            </div>
            <div class="mb-3">
              <label class="form-label" for="ecommerce-product-detail">Details</label>
              <textarea name="detail" id="" cols="30" rows="3" class="form-control">{{$product->detail}}</textarea>
            </div>

          </div>
        </div>

      </div>


      <div class="col-12 col-lg-6">
          
        <div class="card mb-4">
          <div class="card-header">
            <h5 class="card-title mb-0">Pricing</h5>
          </div>
          <div class="card-body">
            <div class="mb-3">
              <label class="form-label" for="ecommerce-product-price">Base Price</label>
              <input type="number" class="form-control" id="ecommerce-product-price" value="{{$product->price}}" name="price" aria-label="Product price" required>
            </div>
            <!--<div class="mb-3">-->
            <!--  <label class="form-label" for="ecommerce-product-discount-price">Discounted Price</label>-->
            <!--  <input type="number" class="form-control" id="ecommerce-product-discount-price" placeholder="Discounted Price" name="discount" aria-label="Product discounted price">-->
            <!--</div>-->

            <!-- <div class="form-check mb-2">
              <input class="form-check-input" type="checkbox" value="" id="price-charge-tax" checked>
              <label class="form-label" for="price-charge-tax">
                Charge tax on this product
              </label>
            </div> -->

            <!-- <div class="d-flex justify-content-between align-items-center border-top pt-3">
              <span class="mb-0 h6">In stock</span>
              <div class="w-25 d-flex justify-content-end">
                <label class="switch switch-primary switch-sm me-4 pe-2">
                  <input type="checkbox" class="switch-input" checked="">
                  <span class="switch-toggle-slider">
                    <span class="switch-on">
                      <span class="switch-off"></span>
                    </span>
                  </span>
                </label>
              </div>
            </div> -->

          </div>
        </div>
        
        

        <div class="card mb-4">
          <div class="card-header">
            <div class="row">
              <div class="col-6"><h5 class="card-title mb-0">Variants Product Size</h5></div>
              <div class="col-6 text-end"><span class="btn btn-primary" onclick="addSize()">Add More</span></div>
            </div>
          </div>
          <div class="card-body">
              <div data-repeater-list="group-a">
                <div data-repeater-item>
                  <div class="row">
                    @foreach($product_variants as $product_variant)
                    <div class="col-12 ac">
                      <div class="row mb-2">
                        <div class="col-9">
                          <select name="size_id{{$product_variant->id}}[]" id="" class="form-select">
                            <option value="{{$product_variant->size_id}}" hidden>{{$product_variant->size->size_name}}</option>
                            @foreach($sizes as $size)
                            <option value="{{$size->id}}">{{$size->size_name}}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="col-3 text-end">
                          <!--<span class="btn btn-danger" onclick="deleteSize(this)">Delete</span>-->
                          <a class="btn btn-danger my_delete_btn" href="{{url('/product_variant_delete',$product_variant->id)}}">Delete</a>
                        </div>

                      </div>
                    </div>
                    @endforeach
                    <div class="col-12" id="sizeRepeater">
                      <div class="row mb-2 sizeRepeater">

                        <div class="col-9">
                          <select name="size_id[]" id="" class="form-select">
                            <option value="" hidden>Choose</option>
                            @foreach($sizes as $size)
                            <option value="{{$size->id}}">{{$size->size_name}}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="col-3 text-end">
                          <span class="btn btn-danger" onclick="deleteSize(this)">Delete</span>
                        </div>

                      </div>
                    </div>
                  </div>
                </div>
              </div>
          </div>
        </div>


        <div class="card mb-4">
          <div class="card-header">
            <div class="row">
              <div class="col-6"><h5 class="card-title mb-0">Variants Product Image</h5></div>
              <div class="col-6 text-end"><span class="btn btn-primary" onclick="addImage()">Add More</span></div>
            </div>
          </div>
          <div class="card-body">
              <div data-repeater-list="group-a">
                <div data-repeater-item>
                  <div class="row">

                    <div class="col-12" id="imageRepeater">
                      <div class="row mb-2 imageRepeater">

                        <div class="col-9">
                          <input type="file" name="image2[]" class="form-control">
                        </div>
                        <div class="col-3 text-end">
                          <span class="btn btn-danger" onclick="deleteImage(this)">Delete</span>
                        </div>

                      </div>
                    </div>

                  </div>
                </div>
              </div>
          </div>
        </div>


        <!--<div class="card mb-4">-->
        <!--  <div class="card-header">-->
        <!--    <h5 class="card-title mb-0">Organize</h5>-->
        <!--  </div>-->
        <!--  <div class="card-body">-->
        <!--    <div class="mb-3 col ecommerce-select2-dropdown">-->
        <!--      <label class="form-label mb-1" for="vendor">-->
        <!--        Vendor-->
        <!--      </label>-->
        <!--      <select id="vendor" class="select2 form-select" data-placeholder="Select Vendor">-->
        <!--        <option value="">Select Vendor</option>-->
        <!--        <option value="men-clothing">Men's Clothing</option>-->
        <!--        <option value="women-clothing">Women's-clothing</option>-->
        <!--        <option value="kid-clothing">Kid's-clothing</option>-->
        <!--      </select>-->
        <!--    </div>-->
        <!--    <div class="mb-3 col ecommerce-select2-dropdown">-->
        <!--      <label class="form-label mb-1 d-flex justify-content-between align-items-center" for="category-org">-->
        <!--        <span>Category</span><a href="javascript:void(0);" class="fw-medium">Add new category</a>-->
        <!--      </label>-->
        <!--      <select id="category-org" class="select2 form-select" data-placeholder="Select Category">-->
        <!--        <option value="">Select Category</option>-->
        <!--        <option value="Household">Household</option>-->
        <!--        <option value="Management">Management</option>-->
        <!--        <option value="Electronics">Electronics</option>-->
        <!--        <option value="Office">Office</option>-->
        <!--        <option value="Automotive">Automotive</option>-->
        <!--      </select>-->
        <!--    </div>-->
        <!--    <div class="mb-3 col ecommerce-select2-dropdown">-->
        <!--      <label class="form-label mb-1" for="collection">Collection-->
        <!--      </label>-->
        <!--      <select id="collection" class="select2 form-select" data-placeholder="Collection">-->
        <!--        <option value="">Collection</option>-->
        <!--        <option value="men-clothing">Men's Clothing</option>-->
        <!--        <option value="women-clothing">Women's-clothing</option>-->
        <!--        <option value="kid-clothing">Kid's-clothing</option>-->
        <!--      </select>-->
        <!--    </div>-->
        <!--    <div class="mb-3 col ecommerce-select2-dropdown">-->
        <!--      <label class="form-label mb-1" for="status-org">Status-->
        <!--      </label>-->
        <!--      <select id="status-org" class="select2 form-select" data-placeholder="Published">-->
        <!--        <option value="">Published</option>-->
        <!--        <option value="Published">Published</option>-->
        <!--        <option value="Scheduled">Scheduled</option>-->
        <!--        <option value="Inactive">Inactive</option>-->
        <!--      </select>-->
        <!--    </div>-->
        <!--    <div class="mb-3">-->
        <!--      <label for="ecommerce-product-tags" class="form-label mb-1">Tags</label>-->
        <!--      <input id="ecommerce-product-tags" class="form-control" name="ecommerce-product-tags" value="Normal,Standard,Premium" aria-label="Product Tags" />-->
        <!--    </div>-->
        <!--  </div>-->
        <!--</div>-->

      </div>

    </div>
</div>

</form>

@endsection

@section('js')
    <!-- Vendors JS -->
    <script src="{{ asset('/backend/vendor/libs/quill/katex.js') }}"></script>
    <script src="{{ asset('/backend/vendor/libs/quill/quill.js') }}"></script>
    <script src="{{ asset('/backend/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('/backend/vendor/libs/dropzone/dropzone.js') }}"></script>
    <script src="{{ asset('/backend/vendor/libs/jquery-repeater/jquery-repeater.js') }}"></script>
    <script src="{{ asset('/backend/vendor/libs/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ asset('/backend/vendor/libs/tagify/tagify.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ asset('/backend/js/app-ecommerce-product-add.js') }}"></script>

<script>
    function addImage() {
        var container = document.getElementById('imageRepeater');
        var newRow = container.firstElementChild.cloneNode(true);
        container.appendChild(newRow);
    }
    function deleteImage(button) { 
      var row = button.closest('.imageRepeater'); 
      row.parentNode.removeChild(row); 
    }
    function addSize() {
        var container = document.getElementById('sizeRepeater');
        var newRow = container.firstElementChild.cloneNode(true);
        container.appendChild(newRow);
    }
    function deleteSize(button) { 
      var row = button.closest('.sizeRepeater'); 
      row.parentNode.removeChild(row); 
    }
</script>

<script>
// Assuming you have included jQuery in your project

document.addEventListener('DOMContentLoaded', function () {
    var deleteButtons = document.querySelectorAll('.my_delete_btn');

    deleteButtons.forEach(function (button) {
        button.addEventListener('click', function (event) {
            event.preventDefault();

            var url = button.getAttribute('href');

            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                success: function (response) {
                    if (response.success) {
                        // Remove the deleted product_variant div
                        var productVariantDiv = button.closest('.ac');
                        productVariantDiv.remove();
                    }
                },
                error: function (error) {
                    console.error('Error deleting product_variant:', error);
                }
            });
        });
    });
});
</script>
@endsection