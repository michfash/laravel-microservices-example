@extends('frontend.layouts.app')

@section('title', 'Laravel Micro-services Example - Frontend Service Users')

@section('content')
    <div class="row mb-4">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-home"></i>
                </div>
                <div class="card-body">
                    <h2>List of Users</h2>
                </div>
            </div><!--card-->
        </div><!--col-->
    </div><!--row-->

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    There are <i class="">{{ $usersCount }}</i> users!
                </div>
                <div class="table-responsive">
                    <table class="table" id="users-table">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <td>{{ $user['id'] }}</td>
                                <td>{{ $user['name'] }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div><!--table-responsive-->
            </div><!--card-->
        </div><!--col-->
    </div><!--row-->
@endsection

@push('after-scripts')
    <script>
        console.log('This is a test console output! Frontend Service -> Homepage');
    </script>
@endpush
