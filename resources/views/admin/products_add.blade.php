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
          <h3 class="card-title">Add Products</h3>
        </div>
        <div class="card-body"  x-data="categoryList()" x-init="await changeCategory()">
           <div class="row">
              <div class="col-md-12">
             
              <form method="post" action="{{ !$form_data?url('admin/products'):url('admin/products/'.$form_data->id) }}" enctype="multipart/form-data" >
              
              @csrf

              @include('admin.layouts.errors')



                <div class="form-group">
                  <label>Product Name</label>
                  <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $form_data != ''? $form_data->name: old('name')}}" required="" placeholder="Product Name">
                </div>
              
                <div class="row">  
                  <div class="form-group col-md-4">
                    <label>Category</label>
                    <select class="form-control" name="category_id" x-model="category_id" @change="changeCategory">
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                          <option value="{{$category->id}}"  {{$form_data && $form_data->category_id == $category->id?'selected' : ''}}>{{$category->name}}</option>
                        @endforeach
                    </select>
                  </div>

                  <div class="form-group col-md-4">
                    <label>Sub Categories</label>
                    <select class="form-control" name="sub_category_id" x-model="sub_category_id" @change="changeSubCategory">
                        <option value="">Select Sub Category</option>
                        <template x-for="sub_category in sub_categories">
                            <option :value="sub_category.id" x-text="sub_category.name"  :selected="sub_category.id === sub_category_id"></option>
                        </template>
                    </select>
                  </div>

                  <div class="form-group col-md-4">
                    <label>Brand</label>
                    <select class="form-control" name="brand_id" x-model="brand_id">
                        <option value="">Select Brand</option>
                        <template x-for="brand in brands">
                            <option :value="brand.id" x-text="brand.name"  :selected="brand.id === brand_id"></option>
                        </template>
                    </select>
                  </div>
                </div>

              
                <div class="row">

                    <div class="form-group col-md-4">
                      <label>Actual Price</label>
                      <input type="text" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ $form_data->product_sku->price ?? old('price')}}" required="" placeholder="Actual Price">
                    </div>

                    <div class="form-group col-md-4">
                      <label>Discounted Price</label>
                      <input type="text" class="form-control @error('discount_price') is-invalid @enderror" name="discount_price" value="{{ $form_data->product_sku->discount_price ?? old('discount_price')}}" required="" placeholder="Disocunted Price">
                    </div>

                    <div class="form-group col-md-4">
                      <label>Company Commission</label>
                      <input type="text" class="form-control @error('commission') is-invalid @enderror" name="commission" value="{{ $form_data->product_sku->commission ?? old('commission')}}" required="" placeholder="Company Commission">
                    </div>

                </div>

              
                <div class="row">

                    <div class="form-group col-md-6">
                      <label>Seller</label>
                      <select class="form-control" name="seller_id">
                        <option value="">Select Seller</option>
                        @foreach($sellers as $seller)
                          <option value="{{$seller->id}}"  {{$form_data && $form_data->seller_id == $seller->id?'selected' : ''}}>{{$seller->name}}</option>
                        @endforeach
                    </select>
                    </div>

                    <div class="form-group col-md-6">
                      <label>Stock</label>
                      <input type="number" class="form-control @error('stock') is-invalid @enderror" name="stock" value="{{ $form_data->product_sku->stock ?? (old('stock') ?? 1)}}" required="">
                    </div>

                </div>


                <div class="form-group">
                  <label>Product Description</label>
                  <textarea class="textarea form-control @error('description') is-invalid @enderror" name="description" placeholder="Product Description" style="width: 100%;">
                      {{ $form_data->description ?? old('description')}}
                  </textarea>  
                </div>

                <div class="form-group">
                  <label>Product Keywords</label>
                  <select name="keywords[]" id="keywords" multiple>
                    @if($form_data)
                    @foreach($form_data->product_keywords as $value)
                      <option value="{{ $value->name }}" selected>{{ $value->name }}</option>
                    @endforeach
                    @endif
                  </select>
                </div>



                <div class="form-group col-xl-8 col-md-12">
                  <label for="exampleInputEmail1">Add up to 5 Images *</label>
                  <div class="row">
                    <div class="col-md-2">
                      <div class="image-upload">
                        <label for="pro_img">
                            <img 
                              id="pro_image_preview_1" 
                              src="{{$form_data && $form_data->product_medias->first()?$form_data->product_medias->first()->image:asset('images/no-preview.png')}}" 
                              style="width: 100px; height: 80px;cursor: pointer;" 
                            />
                        </label>
                        <input id="pro_img" type="file" style="display: none;" name="media[]" />
                        <input type='hidden' id="temp_img_1" name='temp_image[]' value='{{$form_data && $form_data->product_medias->first()?$form_data->product_medias->first()->image:''}}'>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="image-upload">
                        <label for="pro_img_2">
                            <img 
                              id="pro_image_preview_2" 
                              src="{{$form_data && $form_data->product_medias->get(1)?$form_data->product_medias->get(1)->image:asset('images/no-preview.png')}}" 
                              style="width: 100px; height: 80px;cursor: pointer;" 
                            />
                        </label>
                        <input id="pro_img_2" type="file" style="display: none;"  name="media[]"/>
                        <input type='hidden' id="temp_img_2"  name='temp_image[]' value='{{$form_data && $form_data->product_medias->get(1)?$form_data->product_medias->get(1)->image:''}}'>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="image-upload">
                        <label for="pro_img_3">
                            <img 
                             id="pro_image_preview_3" 
                              src="{{$form_data && $form_data->product_medias->get(2)?$form_data->product_medias->get(2)->image:asset('images/no-preview.png')}}" 
                              style="width: 100px; height: 80px;cursor: pointer;"
                            />
                        </label>
                        <input id="pro_img_3" type="file" style="display: none;"  name="media[]"/>
                        <input type='hidden' id="temp_img_3"  name='temp_image[]' value='{{$form_data && $form_data->product_medias->get(2)?$form_data->product_medias->get(2)->image:''}}'>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="image-upload">
                        <label for="pro_img_4">
                            <img 
                             id="pro_image_preview_4" 
                              src="{{$form_data && $form_data->product_medias->get(3)?$form_data->product_medias->get(3)->image:asset('images/no-preview.png')}}" 
                              style="width: 100px; height: 80px;cursor: pointer;"
                            />
                        </label>
                        <input id="pro_img_4" type="file" style="display: none;"  name="media[]"/>
                        <input type='hidden' id="temp_img_4"  name='temp_image[]' value='{{$form_data && $form_data->product_medias->get(3)?$form_data->product_medias->get(3)->image:''}}'>
                      </div>
                    </div> 
                    <div class="col-md-2">
                      <div class="image-upload">
                        <label for="pro_img_5">
                            <img 
                             id="pro_image_preview_5" 
                              src="{{$form_data && $form_data->product_medias->get(4)?$form_data->product_medias->get(4)->image:asset('images/no-preview.png')}}" 
                              style="width: 100px; height: 80px;cursor: pointer;" 
                            />
                        </label>
                        <input id="pro_img_5" type="file" style="display: none;"  name="media[]"/>
                        <input type='hidden' id="temp_img_5"  name='temp_image[]' value='{{$form_data && $form_data->product_medias->get(4)?$form_data->product_medias->get(4)->image:''}}'>
                      </div>
                    </div>
                  </div>
                   

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

  
 <script>
    var sub_categories_json = @json($sub_categories);
    var brands_json = @json($brands);
    function categoryList() {
        return {
          category_id: @json($form_data?$form_data->category_id:''),
          sub_category_id:  @json($form_data?$form_data->sub_category_id:''),
          brand_id:  @json($form_data?$form_data->brand_id:''),
          sub_categories: [],
          brands: [],
          changeCategory() {
            this.sub_categories = sub_categories_json.filter((i) => {
              return i.category_id == this.category_id;
            });
            this.brands = brands_json.filter((i) => {
              return i.sub_category_id == this.sub_category_id;
            });
          },
          changeSubCategory() {
            this.brands = brands_json.filter((i) => {
              return i.sub_category_id == this.sub_category_id;
            });
          }
        };
    }
       
  </script>

@endsection