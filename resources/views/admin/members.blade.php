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
            <h3>Member List</h3>
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
                            </div>
                         
                            <!-- /.card-header -->
                            <div class="card-body">
                              <table id="example1" class="table table-bordered table-striped">
                                  <thead>
                                    <tr>
                                      <th>#</th>
                                      <th>Name</th>
                                      <th>Email</th>
                                      <th>Member ID</th>
                                      <th>Phone</th>
                                      <th>Wallet ID</th>
                                      <th></th>
                                    </tr>
                                  </thead>
                                  <tbody class="brand-table-body">
                                    @foreach($table_data as $key => $value)
                                      <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $value->name }}</td>
                                        <td>{{ $value->email }}</td>
                                        <td>{{ $value->member_id }}</td>
                                        <td>{{ $value->phone }}</td>
                                        <td>{{ $value->wallet_id }}</td>
                                        <td>
                                         {{--  <a href="{{ url('admin/members/'.$value->id)}}" class="btn btn-sm btn-info">Edit</a>
                                          <a href="{{ url('admin/members/update-password/'.$value->id)}}" class="btn btn-sm btn-warning">reset password</a> --}}
                                        </td>
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