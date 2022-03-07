@extends('admin.master')


@section('content')
    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Edit sub-SubCategory</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                {{-- start form --}}
                                <form method="POST" action="{{ route('subsubcategory.update', $subsubcategory->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <h5>Category<span class="text-danger">*</span></h5>
                                        <select name="category_id" id="category_id" class="form-control" aria-invalid="false">
                                            <option value="">Select Category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}" {{ $category->id == $subsubcategory->category_id ? 'selected' : '' }}>{{ $category->category_name_en }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <span class="text-danger"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <h5>subCategory<span class="text-danger">*</span></h5>
                                        <select name="subcategory_id" id="category_id" class="form-control" aria-invalid="false">
                                            <option value="">Select Category</option>
                                            @foreach ($categories as $category)
                                                @if($category->id == $subsubcategory->category_id)
                                                    @foreach($category->subcategories as $sub)
                                                        <option value="{{ $sub->id }}" {{ $sub->id == $subsubcategory->subcategory_id ? 'selected' : '' }}>{{ $sub->subcategory_name_en }}</option>
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('subcategory_id')
                                            <span class="text-danger"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <h5>sub-subCategory Name English<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="subsubcategory_name_en" value="{{ $subsubcategory->subsubcategory_name_en}}" id="subsubcategory_name_en" class="form-control">
                                            @error('subsubcategory_name_en')
                                                <span class="text-danger"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <h5>sub-subCategory Name Persian<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" id="subsubcategory_name_persian"  value="{{ $subsubcategory->subsubcategory_name_persian}}" name="subsubcategory_name_persian" class="form-control">
                                            @error('subsubcategory_name_persian')
                                                <span class="text-danger"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="text-xs-right">
                                        <input type="submit" class="btn btn-rounded btn-info" value="Update">
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
     {{-- Ajax Request --}}
    <script>
        $(document).ready(function() {
            $('select[name="category_id"]').on('change', function() {
                var category_id = $(this).val();
                if (category_id) {
                    $.ajax({
                        type: "get",
                        url: "{{ route('subsubcategory.create') }}",
                        data: {"category_id": category_id},
                        dataType: "json",
                        success: function(response) {
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
        });
    </script>
@endsection
