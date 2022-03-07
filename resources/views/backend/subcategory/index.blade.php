@extends('admin.master')


@section('content')
    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-8">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">SubCategory list</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Sl</th>
                                            <th>Parent Category</th>
                                            <th>SubCategory En</th>
                                            <th>SubCategory Persian</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($subcategories as $key => $subcategory)
                                            <tr>
                                                <td>{{ ++$key }}</td>
                                                <td>{{$subcategory->category->category_name_en}}</td>
                                                <td>{{ $subcategory->subcategory_name_en }}</td>
                                                <td>{{ $subcategory->subcategory_name_persian }}</td>
                                                <td width="25%">
                                                    <div class="row">
                                                        <a href="{{ route('subcategory.edit', $subcategory->id) }}" class="btn btn-info ml-2"><i class="fa fa-pencil" aria-hidden="true"></i></a>

                                                        <form method="POST" action="{{ route('subcategory.destroy', $subcategory->id) }}" id="form" data-id="{{ $subcategory->id }}" class="form-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <a href="#" class="btn btn-danger ml-2"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                                        </form>
                                                    </div>

                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>


                <div class="col-4">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Add SubCategory</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                {{-- start form --}}
                                <form method="POST" action="{{ route('subcategory.store') }}">
                                    @csrf
                                    @method('POST')

                                    <div class="form-group">
                                        <h5>Category<span class="text-danger">*</span></h5>
                                        <select name="category_id" id="category_id" class="form-control" aria-invalid="false">
                                            <option value="">Select Category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->category_name_en }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <span class="text-danger"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <h5>subCategory Name English<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="subcategory_name_en" id="subcategory_name_en" class="form-control">
                                            @error('subcategory_name_en')
                                                <span class="text-danger"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <h5>subCategory Name Persian<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" id="subcategory_name_persian" name="subcategory_name_persian" class="form-control">
                                            @error('subcategory_name_persian')
                                                <span class="text-danger"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="text-xs-right">
                                        <input type="submit" class="btn btn-rounded btn-info" value="Add New">
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
@endsection
