@extends('admin.master')


@section('content')
    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-8">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Division list</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Row</th>
                                            <th>Division Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($divisions as $key => $division)
                                            <tr>
                                                <td width="10%">{{ ++$key }}</td>
                                                <td>{{ $division->division_name }}</td>
                                                <td width="25%">
                                                    <div class="row">
                                                        <a href="{{ route('manageDivision.edit', $division->id) }}" class="btn btn-info ml-2"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                                        <form method="POST" action="{{ route('manageDivision.destroy', $division->id) }}" id="form" data-id="{{ $division->id }}" class="form-inline">
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
                            <h3 class="box-title">Add Division</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                {{-- start form --}}
                                <form method="POST" action="{{ route('manageDivision.store') }}" enctype="multipart/form-data">
                                    @csrf
                                    @method('POST')
                                    <div class="form-group">
                                        <h5>Divison Name <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="division_name" id="division_name" class="form-control">
                                            @error('division_name')
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
