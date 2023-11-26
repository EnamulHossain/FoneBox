<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Requirements</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>
    <div class="container py-3">
        <div class="row justify-content-center">
            <a href="/" class="text-center text-decoration-none fs-1 mb-2">
                <img src="{{ asset('/backend/img/favicon/fonebox.png') }}" style="width:30px;heigth:auto;" class="img-fluid">
                <span class="app-brand-text demo menu-text fw-bold ms-2">{{ config('app.name') }}</span>
            </a>
            <div class="col-md-6">
            <div class="card px-3 py-4">
                <h3>Requirements</h3>
                <hr>
                <div class="form-check"><input class="form-check-input" type="checkbox" disabled checked><label class="form-check-label">Use Laravel 10</label></div>
                <div class="form-check"><input class="form-check-input" type="checkbox" disabled checked><label class="form-check-label">Use Sneat Templete</label></div>
                <div class="form-check"><input class="form-check-input" type="checkbox" disabled ><label class="form-check-label">Light Mode change with Database</label></div>
                <div class="form-check"><input class="form-check-input" type="checkbox" disabled checked><label class="form-check-label">Use Spatie Package</label></div>
                <div class="form-check"><input class="form-check-input" type="checkbox" disabled checked><label class="form-check-label">Profile CRUD</label></div>
                <div class="form-check"><input class="form-check-input" type="checkbox" disabled checked><label class="form-check-label">Blog CRUD with Editor</label></div>
                <div class="form-check"><input class="form-check-input" type="checkbox" disabled ><label class="form-check-label">Service CRUD</label></div>
                <div class="form-check"><input class="form-check-input" type="checkbox" disabled ><label class="form-check-label">Category CRUD</label></div>
                <div class="form-check"><input class="form-check-input" type="checkbox" disabled ><label class="form-check-label">Sub Category CRUD</label></div>
                <div class="form-check"><input class="form-check-input" type="checkbox" disabled ><label class="form-check-label">Brand CRUD</label></div>
                <div class="form-check"><input class="form-check-input" type="checkbox" disabled ><label class="form-check-label">Color CRUD</label></div>
                <div class="form-check"><input class="form-check-input" type="checkbox" disabled checked><label class="form-check-label">Size CRUD</label></div>
                <div class="form-check"><input class="form-check-input" type="checkbox" disabled checked><label class="form-check-label">Product CRUD</label></div>
                <div class="form-check"><input class="form-check-input" type="checkbox" disabled ><label class="form-check-label">Product Variant CRUD</label></div>
                <div class="form-check"><input class="form-check-input" type="checkbox" disabled ><label class="form-check-label">Order CRUD</label></div>
                <div class="form-check"><input class="form-check-input" type="checkbox" disabled ><label class="form-check-label">Product Inventory Manage</label></div>
                <div class="form-check"><input class="form-check-input" type="checkbox" disabled ><label class="form-check-label">Ordered Person Can Rating</label></div>
                <div class="form-check"><input class="form-check-input" type="checkbox" disabled ><label class="form-check-label">Ordered Person Can Comment Just 1 time</label></div>
            </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>