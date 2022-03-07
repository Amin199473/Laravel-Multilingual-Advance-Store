@extends('admin.master')


@section('content')
    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Edit District</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                {{-- start form --}}
                                <form method="POST" action="{{ route('manageDistrict.update',$district->id) }}">
                                    @csrf
                                    @method('PUT')

                                    <div class="form-group">
                                        <h5>Divisions <span class="text-danger">*</span></h5>
                                        <select name="division_id" id="division_id" class="form-control" aria-invalid="false">
                                            <option value="">Select Division</option>
                                            @foreach ($divisions as $division )
                                                <option value="{{ $division->id }}" {{ $district->division_id == $division->id ? 'selected' : ''}}>{{ $division->division_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('division_id')
                                            <span class="text-danger"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <h5>District Name <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="district_name" value="{{ $district->district_name }}" id="district_name" class="form-control">
                                            @error('district_name')
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
@endsection
