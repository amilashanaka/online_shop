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
          <h3 class="card-title">Edit Users</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fas fa-times"></i></button>
          </div>
        </div>
        <div class="card-body">
        	<div class="col-md-12">
            	@include('admin.layouts.errors')
        	</div>
           	<div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#info" data-toggle="tab">Basic Info</a></li>
                                <li class="nav-item"><a class="nav-link"  href="#password" data-toggle="tab">Password</a></li>

                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="info">

                			<form method="post" action="{{ url('admin/users/'.$form_data->id) }}">
            				@csrf



				                <div class="form-group">
				                  <label>Name</label>
				                  <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $form_data->name }}" required="" >
				                </div>

				                <div class="form-group">
				                  <label>Email</label>
				                  <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $form_data->email }}" required="" >
				                </div>

				                <div class="form-group">
				                  <label>Status</label>
				                  <select class="form-control select2" name="status" style="width: 100%;">
				                    <option value="1">Active</option>
				                    <option value="0">Inactive</option>
				                  </select>
				                </div>

				                <div class="form-group">
				                  <button class="btn btn-lg btn-dark rounded px-5">Update</button>
				                </div>
				            </form>
                            </div>


                            <div class="tab-pane" id="password">
                			<form method="post" action="{{ url('admin/users/password/'.$form_data->id) }}">
            				@csrf
				                <div class="form-group">
				                  <label>Password</label>
				                  <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="" required="" >
				                </div>

				                <div class="form-group">
				                  <label>Confirm Password</label>
				                  <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" value="" required="" >
				                </div>

				                <div class="form-group">
				                  <button class="btn btn-lg btn-dark rounded px-5">Update</button>
				                </div>

</form>
                            </div>

                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>

            </div>
            {{-- </div> --}}
          </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </section>
    <!-- /.content -->
  </div>

@endsection
