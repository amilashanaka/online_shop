 <!-- import header -->
@extends('admin.layouts.master')
<!-- import header -->

@section('content')

 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            &nbsp;
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Add Brands</h3>

       
        </div>
        <div class="card-body">
           <div class="row">
              <div class="col-md-12">

              @if($form_data == '')
                <form action="{{ url('admin/brands') }}" method="post" enctype="multipart/form-data" >
              @else
                <form enctype="multipart/form-data" method="post" action="{{ url('admin/brands/'.$form_data->id) }}">
              @endif
              
              @csrf

              @include('admin.layouts.errors')

                <div class="form-group">
                  <label>Brand Name</label>
                  <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $form_data != ''? $form_data->name: old('name')}}" required="" placeholder="Brand Name">
                </div>

                <div class="form-group">
                  <label>Sub Categories</label>
                  <select class="form-control select2" multiple name="sub_category_id[]" style="width: 100%;" required>
                    @foreach($categories as $category)
                      <option value="{{ $category->id }}" {{$form_data && in_array($category->id, $form_data->sub_categories->pluck('id')->toArray())?'selected':''}}>{{ $category->name }}</option>
                    @endforeach
                  </select>
                </div>

                <div class="form-group">
                  <label for="exampleInputFile">Brand Image</label>
                    <input type="hidden" name="img_temp" id="img_temp" value="{{ $form_data->logo ?? ''}}">
                    <input type="file" class="form-control @error('img') is-invalid @enderror" name="logo" id="img">
                    <br>
                    <img id="image_preview" src="{{ $form_data->logo ?? asset('images/no-preview.png')}}" style="width: 100px; height: 100%;" />
                </div>

                <div class="form-group">
                  <label>Status</label>
                  <select class="form-control select2" name="status" style="width: 100%;">
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                  </select>
                </div>

                <div class="form-group">
                  <button class="btn btn-lg btn-dark rounded px-5">Submit</button>
                </div>
                
                
              </form>
            </div>
          </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </section>
    <!-- /.content -->
  </div>

@endsection