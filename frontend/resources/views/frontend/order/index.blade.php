@extends('frontend.layouts.app')

@section('title', 'Laravel Micro-services Example - Frontend Service Orders')

@section('content')
    <div class="row mb-4">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-home"></i>
                </div>
                <div class="card-body">
                    <h2>List of Orders</h2>
                </div>
            </div><!--card-->
        </div><!--col-->
    </div><!--row-->

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    There are <i class="">{{ $ordersCount }}</i> orders!
                </div>
                <div class="table-responsive">
                    <table class="table" id="orders-table">
                        <thead>
                        <tr>
                            <th>User</th>
                            <th>Products</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                            <tr>
                                <td>{{ $order['user'] }}</td>
                                <td>{{ $order['products_concat'] }}</td>
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
