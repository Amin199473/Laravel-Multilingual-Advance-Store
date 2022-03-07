@extends('admin.master')


@section('content')
    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Edit State</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                {{-- start form --}}
                                <form method="POST" action="{{ route('manageState.update',$state->id) }}">
                                    @csrf
                                    @method('PUT')

                                    <div class="form-group">
                                        <h5>Divisions <span class="text-danger">*</span></h5>
                                        <select name="division_id" id="division_id" class="form-control" aria-invalid="false">
                                            <option value="">Select Division</option>
                                            @foreach ($divisions as $division )
                                                <option value="{{ $division->id }}" {{ $division->id == $state->division_id  ? 'selected' : ''}}>{{ $division->division_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('division_id')
                                            <span class="text-danger"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <h5>Districts <span class="text-danger">*</span></h5>
                                        <select name="district_id" id="district_id" class="form-control" aria-invalid="false">
                                            <option value="">Select District</option>
                                            @foreach ($divisions as $division)
                                                @if($division->id == $state->division_id)
                                                    @foreach($division->districts as $district)
                                                        <option value="{{ $district->id }}" {{ $district->id == $state->district_id ? 'selected' : '' }}>{{ $district->district_name }}</option>
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('division_id')
                                            <span class="text-danger"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <h5>State Name <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="state_name" value="{{ $state->state_name }}" id="state_name" class="form-control">
                                            @error('state_name')
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
    <script type="text/javascript">
        $(document).ready(function() {
            $('select[name="division_id"]').on('change', function() {
                var division_id = $(this).val();
                // console.log(division_id);
                if (division_id) {
                    $.ajax({
                        type: "get",
                        url: "{{ route('get.districts') }}",
                        data: {
                            "division_id": division_id
                        },
                        dataType: "json",
                        success: function(response) {
                            // console.log(response);
                            var clear = $('select[name="district_id"]').empty();
                            $.each(response, function(key, value) {
                                $('select[name="district_id"]').append(
                                    '<option value="' + value.id + '">' + value.district_name + '</option>'
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
