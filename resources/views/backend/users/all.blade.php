@extends('admin.master')


@section('content')
    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Total User <span class="badge badge-pill badge-danger">{{ count($users) }}</span> </h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Row</th>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $key => $user)
                                            <tr>
                                                <td>{{ ++$key }}</td>
                                                <td>
                                                    <img class="card-img-top" style="border-radius: 50%" src="{{ !empty($user->profile_photo_path) ? asset('storage/' .$user->profile_photo_path) : asset('upload/no_image.jpg') }}" height="80px" width="80px" alt="Avatar">
                                                </td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->phone}}</td>
                                                <td>
                                                    @if($user->UserOnline())
                                                        <span class="badge badge-pill badge-success">Online</span>
                                                    @else
                                                        <span class="badge badge-pill badge-danger">
                                                            {{ Carbon\Carbon::parse($user->last_seen)->diffForHumans() }}
                                                        </span>
                                                    @endif
                                                </td>
                                                <td width="20%">
                                                    <div class="row">
                                                        <a href="{{ route('subcategory.edit', $user->id) }}" class="btn btn-info ml-2"><i class="fa fa-pencil" aria-hidden="true"></i></a>

                                                        <form method="POST" action="{{ route('subcategory.destroy', $user->id) }}" id="form" data-id="{{ $user->id }}" class="form-inline">
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

                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
@endsection
