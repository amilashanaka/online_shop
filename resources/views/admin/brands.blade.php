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
            <h3>Brands List</h3>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
                <div class="row">
                    <div class="col-12">
                        <!-- /.card -->

                        <div class="card">
                          
                            <div class="card-header">
                                <h3 class="card-title" >
                                    
                                    <a href="{{ url('admin/brands/create')}}" class="btn btn-block btn-success" onclick="">Add New Brand</a>
                                  
                                </h3>
                            </div>
                         
                            <!-- /.card-header -->
                            <div class="card-body">
                              <table id="example1" class="table table-bordered table-striped">
                                  <thead>
                                    <tr>
                                      <th>#</th>
                                      <th>Name</th>
                                      <th>Image</th>
                                      <th>Action</th>
                                    </tr>
                                  </thead>
                                  <tbody class="brand-table-body">
                                    @foreach($table_data as $key => $value)
                                      <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $value->name }}</td>
                                        <td><a target="_blank" href="{{ $value->logo }}"><img style="width: 75px;" src="{{ $value->logo }}"></a></td>
                                        <td><a class="btn btn-md btn-primary" href="{{ url('admin/brands/'.$value->id) }}">Edit</a></td>
                                      </tr>
                                    @endforeach
                                  
                                  </tbody>
                              </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </section>
    <!-- /.content -->
  </div>

@endsection