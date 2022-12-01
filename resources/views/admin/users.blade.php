 <!-- import header -->
@extends('admin.layouts.master')
<!-- import header -->

@section('content')

 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
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
          <h3 class="card-title">Add Users</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fas fa-times"></i></button>
          </div>
        </div>
        <div class="card-body">
           <div class="row">
              <div class="col-md-12">

              
              <form id="product-form" action="{{ url('admin/users') }}" method="post" enctype="multipart/form-data" >
              @csrf

              @include('admin.layouts.errors')

                <div class="form-group">
                  <label>Name</label>
                  <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required="" >
                </div>

                <div class="form-group">
                  <label>Email</label>
                  <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required="" >
                </div>

                <div class="form-group">
                  <label>Password</label>
                  <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="" required="" >
                </div>

                <div class="form-group">
                  <label>Confirm Password</label>
                  <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" value="" required="" >
                </div>

                <div class="form-group">
                  <label>Status</label>
                  <select class="form-control select2" name="status" style="width: 100%;">
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                  </select>
                </div>


                <hr>

                <div class="form-group">
                  <button class="btn btn-md btn-dark px-5"><i class="fa fa-save"></i> Save</button>
                </div>
                
                
              </form>
            </div>
          </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
      <div class="card">
          <div class="card-header">
            <h3 class="card-title">User List</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
              </thead>
              <tbody>
                @foreach($table_data as $key => $value)
                  <tr>
                    <td>{{ $key}}</td>
                    <td>{{ $value->name}}</td>
                    <td>{{ $value->email}}</td>
                    <td>{{ $value->status == '1'?'Active':'Inactive'}}</td>
                    <td><a class="btn btn-md btn-primary" href="{{ url('admin/users/'.$value->id.'/edit') }}">Edit</a></td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
      </div>
    </section>
    <!-- /.content -->
  </div>

@endsection