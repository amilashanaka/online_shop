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
          <h3 class="card-title">Add Sub Categories</h3>

         
        </div>
        <div class="card-body">
           <div class="row">
              <div class="col-md-12">

              
              <form action="{{ !$form_data?url('admin/sub-categories'):url('admin/sub-categories/'.$form_data->id) }}" method="post">
              
              @csrf

              @include('admin.layouts.errors')

                <div class="form-group col-md-6">
                  <label>Category</label>
                  <select class="form-control select2" name="category_id">
                      @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                      @endforeach
                  </select>
                </div>

                <div class="form-group col-md-6">
                  <label>Sub Category Name</label>
                  <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $form_data->name ?? old('name')}}" required="" placeholder="Sub Category Name">
                </div>

                <div class="form-group col-md-6">
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