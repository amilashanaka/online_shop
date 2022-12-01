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
            <h3>Products List</h3>
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
                                    
                                    <a href="{{ url('admin/products/create')}}" class="btn btn-block btn-success" onclick="">Add New Product</a>
                                  
                                </h3>
                            </div>
                         
                            <!-- /.card-header -->
                            <div class="card-body">
                              <table id="example1" class="table table-bordered table-striped">
                                  <thead>
                                    <tr>
                                      <th>#</th>
                                      <th>Name</th>
                                      <th>Category</th>
                                      <th>Brand</th>
                                      <th>Price</th>
                                      <th>Discounted Price</th>
                                      <th>TTL Price</th>
                                      <th>Commission</th>
                                      <th>Action</th>
                                    </tr>
                                  </thead>
                                  <tbody class="brand-table-body">
                                    @foreach($table_data as $key => $value)
                                      <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $value->name }}</td>
                                        <td>
                                          <p>{{ $value->category->name }}</p>
                                          <p>{{ $value->sub_category->name }}</p>
                                        </td>
                                        <td>{{ $value->brand->name }}</td>
                                        <td>{{ $value->product_sku->price }}</td>
                                        <td>{{ $value->product_sku->discount_price }}</td>
                                        <td>{{ $value->product_sku->ttl_price }}</td>
                                        <td>{{ $value->product_sku->commission }}</td>
                                        <td><a class="btn btn-md btn-primary" href="{{ url('admin/products/'.$value->id) }}">Edit</a></td>
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