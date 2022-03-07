@extends('admin.master')




@section('content')
    <section class="content">

        <!-- Basic Forms -->
        <div class="box">
            <div class="box-header with-border">
                <h4 class="box-title">Add product</h4>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col">
                        {{-- Start Form --}}
                        <form method="POST" action="{{ route('product.store') }}" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            {{-- 1st row --}}
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Select Brand<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <select name="brand_id" id="brand_id" class="form-control">
                                                <option value="">Select Your brand</option>
                                                @foreach ($brands as $brand)
                                                    <option value="{{ $brand->id }}">{{ $brand->brand_name_en }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Select Category<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <select name="category_id" id="category_id" class="form-control">
                                                <option value="">Select Category</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->category_name_en }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Select subCategory<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <select name="subcategory_id" id="subcategory_id" class="form-control" aria-invalid="false">
                                                <option value="">Select SubCategory</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- 2th row --}}
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Select SubsubCategory<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <select name="subsubcategory_id" id="subsubcategory_id" class="form-control">
                                                <option value="">Select SubSubCategory</option>

                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Product Name En<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="product_name_en" id="product_name_en" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Product Name Persian<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="product_name_persian" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- 3th row --}}
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Product Code<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="product_code" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Product Qty<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="product_qty" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Product Tags En<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="product_tags_en" value="" data-role="tagsinput" placeholder="add tags" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- 4th row --}}
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Product Tags Persian<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="product_tags_persian" value="" data-role="tagsinput" placeholder="add tags" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Product Size En<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="product_size_en" value="" data-role="tagsinput" placeholder="add tags" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Product Size Persian<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="product_size_persian" value="" data-role="tagsinput" placeholder="add tags" />
                                        </div>
                                    </div>
                                </div>
                            </div>



                            {{-- 5th row --}}
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Product Color en<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="product_color_en" data-role="tagsinput" placeholder="add tags" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Product Color Persian<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="product_color_persian" data-role="tagsinput" placeholder="add tags" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Product Selling price<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="selling_price" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>


                            {{-- 6th row --}}
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Product Discount Price<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="discount_price" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Product Thumbnail<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="file" name="product_thumbnail" id="product_thumbnail" class="form-control">
                                            <img src="" id="main_thumbnail" style="width: 100px;" alt="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Multi Image<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="file" name="multi_img[]" id="multiImg" class="form-control" multiple>
                                            <div class="row" id="preview_img">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- 7th row --}}
                            <div class="row">
                                <div class="col-md-6">
                                    <h5>Short Description English<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <textarea name="short_description_en" id="short_description_en" class="form-control" placeholder="Short Description English"></textarea>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <h5>Short Description Persain<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <textarea name="short_description_persian" id="short_description_persian" class="form-control" placeholder="Short Description Persian"></textarea>
                                    </div>
                                </div>
                            </div>

                            {{-- 8th row --}}
                            <div class="row pt-4">
                                <div class="col-md-6">
                                    <h5>Long Description English<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <textarea id="editor1" name="long_description_en" rows="10" cols="80"> Long Description English.</textarea>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <h5>Long Description persian<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <textarea id="editor2" name="long_description_persian" rows="10" cols="80">Long Description persian.</textarea>
                                    </div>
                                </div>
                            </div>
                            <hr>

                            {{-- 9th row --}}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h5>Checkbox Group <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <fieldset>
                                                <input type="checkbox" name="hot_deals" id="hot_deals" value="1" aria-invalid="false">
                                                <label for="hot_deals">Hot Deals</label>
                                            </fieldset>
                                            <fieldset>
                                                <input type="checkbox" name="featured" id="featured" value="1" aria-invalid="false">
                                                <label for="featured">Featured</label>
                                            </fieldset>
                                            <fieldset>
                                                <input type="checkbox" name="status" id="status" value="1" aria-invalid="false" checked>
                                                <label for="status">Status</label>
                                            </fieldset>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h5>Checkbox Group <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <fieldset>
                                                <input type="checkbox" name="special_offer" id="special_offer" value="1" aria-invalid="false">
                                                <label for="special_offer">Special Offer</label>
                                            </fieldset>
                                            <fieldset>
                                                <input type="checkbox" name="special_deals" id="special_deals" value="1" aria-invalid="false">
                                                <label for="special_deals">Special Deals</label>
                                            </fieldset>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="text-xs-right pt-4">
                                <input type="submit" class="btn btn-rounded btn-info" value="Add New">
                            </div>
                        </form>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->

    </section>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    {{-- Ajax Request --}}
    <script>
        $(document).ready(function() {
            // first Ajax Request for get subCategory
            $('select[name="category_id"]').on('change', function() {
                var category_id = $(this).val();
                if (category_id) {
                    $.ajax({
                        type: "get",
                        url: "{{ route('subsubcategory.create') }}",
                        data: {
                            "category_id": category_id
                        },
                        dataType: "json",
                        success: function(response) {
                            // $('select[name="subsubcategory_id"]').html('');
                            var clear = $('select[name="subcategory_id"]').empty();
                            $.each(response, function(key, value) {
                                $('select[name="subcategory_id"]').append(
                                    '<option value="' + value.id + '">' + value.subcategory_name_en + '</option>'
                                );
                            });
                        }
                    });
                } else {
                    alert('danger');
                }
            });

            // second Ajax Request for get subsubCategory
            $('select[name="subcategory_id"]').on('click', function() {
                var subcategory_id = $(this).val();
                if (subcategory_id) {
                    $.ajax({
                        type: "get",
                        url: "{{ route('getSubSubCategory') }}",
                        data: {
                            "subcategory_id": subcategory_id
                        },
                        dataType: "json",
                        success: function(response) {
                            var clear = $('select[name="subsubcategory_id"]').empty();
                            $.each(response, function(key, value) {
                                $('select[name="subsubcategory_id"]').append(
                                    '<option value="' + value.id + '">' + value.subsubcategory_name_en + '</option>'
                                );
                            });
                        }
                    });
                } else {
                    alert('danger');
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#product_thumbnail').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#main_thumbnail').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0'])
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#multiImg').on('change', function() { //on file input change
                if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
                {
                    var data = $(this)[0].files; //this file data
                    $.each(data, function(index, file) { //loop though each file
                        if (/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)) { //check supported file type
                            $('#preview_img').html('');
                            var fRead = new FileReader(); //new filereader
                            fRead.onload = (function(file) { //trigger function on successful read
                                return function(e) {
                                    var img = $('<img/>').addClass('thumb').attr('src', e.target.result).width(80)
                                        .height(80); //create image element
                                    $('#preview_img').append(img); //append image to output element
                                };
                            })(file);
                            fRead.readAsDataURL(file); //URL representing the file's data.
                        }
                    });

                } else {
                    alert("Your browser doesn't support File API!"); //if File API is absent
                }
            });
        });
    </script>
@endsection
