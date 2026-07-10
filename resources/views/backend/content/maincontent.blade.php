@extends('backend.master')

@section('maincontent')

    @section('title')
        {{ env('APP_NAME') }}-Admin
    @endsection
@can('dashboard.view')
@php
    $startOfMonth = \Carbon\Carbon::now()->startOfMonth(); // First day of the month
    $endOfMonth = \Carbon\Carbon::now()->endOfMonth(); // Last day of the month

    $todaySale = DB::table('orders')->where('updated_at',  '>=', \Carbon\Carbon::today()->format('y-m-d'))->where('status', 'Invoiced')->sum('subTotal');
    $totalSaleCurrantMonth = DB::table('orders')->whereBetween('updated_at',  [$startOfMonth, $endOfMonth])->where('status', 'Invoiced')->sum('subTotal');
    
    $totalDelivery = DB::table('orders')->whereBetween('updated_at',  [$startOfMonth, $endOfMonth])->where('status', 'Delivered')->count();
    $notes = DB::table('notes')->orderBy('id','desc')->limit(10)->get();
    
    $recehntorder = DB::table('orders')
        ->join('customers', 'customers.order_id', '=', 'orders.id')
        ->select('orders.*', 'customers.customerPhone', 'customers.customerName', 'customers.customerAddress')
        ->OrderBy('updated_at', 'desc')
        ->limit(5)->get();
@endphp
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-6 col-xl-4">
            <div class="bg-secondary rounded d-flex align-items-center p-4">
                <i class="fa fa-chart-line fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Today Sale</p>
                    <h6 class="mb-0"> TK {{ $todaySale }}</h6>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-4">
            <div class="bg-secondary rounded d-flex align-items-center p-4">
                <i class="fa fa-chart-bar fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Total Sale(Current Month)</p>
                    <h6 class="mb-0">TK {{ $totalSaleCurrantMonth }}</h6>
                </div>
            </div>
        </div>
        
        <div class="col-sm-6 col-xl-4">
            <div class="bg-secondary rounded d-flex align-items-center p-4">
                <i class="fa fa-chart-bar fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Total Delivery (Current Month)</p>
                    <h6 class="mb-0">Total {{ $totalDelivery }}</h6>
                </div>
            </div>
        </div>
        {{-- <div class="col-sm-6 col-xl-3">
            <div class="bg-secondary rounded d-flex align-items-center p-4">
                <i class="fa fa-chart-area fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Today Revenue</p>
                    <h6 class="mb-0">$1234</h6>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="bg-secondary rounded d-flex align-items-center p-4">
                <i class="fa fa-chart-pie fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Total Revenue</p>
                    <h6 class="mb-0">$1234</h6>
                </div>
            </div>
        </div>
        
        --}}
    </div>
</div>
<!-- Sale & Revenue End -->


<!-- Sales Chart Start -->
{{-- 
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-6">
            <div class="bg-secondary text-center rounded p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0">Worldwide Sales</h6>
                    <a href="">Show All</a>
                </div>
                <canvas id="worldwide-sales"></canvas>
            </div>
        </div>
        <div class="col-sm-12 col-xl-6">
            <div class="bg-secondary text-center rounded p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0">Salse & Revenue</h6>
                    <a href="">Show All</a>
                </div>
                <canvas id="salse-revenue"></canvas>
            </div>
        </div>
    </div>
</div>

--}}
<!-- Sales Chart End -->


<!-- Recent Sales Start -->
<div class="container-fluid pt-4 px-4">
    <div class="bg-secondary text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">Recent Salse</h6>
            <a href="{{ url('admin_order/orderall') }}">Show All</a>
        </div>
        <div class="table-responsive">
            <table class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-white">
                        <th scope="col">SL.</th>
                        <th scope="col">Date</th>
                        <th scope="col">Customer</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Status</th>
                     
                    </tr>
                </thead>
                <tbody>
                    @php
                        $sl = 1;
                    @endphp
                    @foreach($recehntorder as $order)
                    <tr>
                        <td>{{ $sl++ }}</td>
                        <td>{{ $order->orderDate }}</td>
                        <td>{{ $order->customerName }}</td>
                 
                        <td>Tk {{ $order->subTotal }}</td>
                        <td>
                           <button class="btn btn-info">
                            {{  $order->status}}
                            </button>
                        </td>
                        
                    </tr>
                    
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Recent Sales End -->


<!-- Widgets Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        {{--
        <div class="col-sm-12 col-md-6 col-xl-4">
            <div class="h-100 bg-secondary rounded p-4">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <h6 class="mb-0">Messages</h6>
                    <a href="">Show All</a>
                </div>
                <div class="d-flex align-items-center border-bottom py-3">
                    <img class="rounded-circle flex-shrink-0" src="{{ asset('public/backend/') }}/img/user.jpg" alt="" style="width: 40px; height: 40px;">
                    <div class="w-100 ms-3">
                        <div class="d-flex w-100 justify-content-between">
                            <h6 class="mb-0">Jhon Doe</h6>
                            <small>15 minutes ago</small>
                        </div>
                        <span>Short message goes here...</span>
                    </div>
                </div>
                <div class="d-flex align-items-center border-bottom py-3">
                    <img class="rounded-circle flex-shrink-0" src="{{ asset('public/backend/') }}/img/user.jpg" alt="" style="width: 40px; height: 40px;">
                    <div class="w-100 ms-3">
                        <div class="d-flex w-100 justify-content-between">
                            <h6 class="mb-0">Jhon Doe</h6>
                            <small>15 minutes ago</small>
                        </div>
                        <span>Short message goes here...</span>
                    </div>
                </div>
                <div class="d-flex align-items-center border-bottom py-3">
                    <img class="rounded-circle flex-shrink-0" src="{{ asset('public/backend/') }}/img/user.jpg" alt="" style="width: 40px; height: 40px;">
                    <div class="w-100 ms-3">
                        <div class="d-flex w-100 justify-content-between">
                            <h6 class="mb-0">Jhon Doe</h6>
                            <small>15 minutes ago</small>
                        </div>
                        <span>Short message goes here...</span>
                    </div>
                </div>
                <div class="d-flex align-items-center pt-3">
                    <img class="rounded-circle flex-shrink-0" src="{{ asset('public/backend/') }}/img/user.jpg" alt="" style="width: 40px; height: 40px;">
                    <div class="w-100 ms-3">
                        <div class="d-flex w-100 justify-content-between">
                            <h6 class="mb-0">Jhon Doe</h6>
                            <small>15 minutes ago</small>
                        </div>
                        <span>Short message goes here...</span>
                    </div>
                </div>
            </div>
        </div>
        
        --}}
        <div class="col-sm-12 col-md-6 col-xl-6">
            <div class="h-100 bg-secondary rounded p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0">Calender</h6>
                    <!--<a href="">Show All</a>-->
                </div>
                <div id="calender"></div>
            </div>
        </div>
        <div class="col-sm-12 col-md-6 col-xl-6">
            <div class="h-100 bg-secondary rounded p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0">To Do List</h6>
                    <!--<a href="">Show All</a>-->
                </div>
                 <form action="{{ route('notes.store') }}" method="POST">
        @csrf
                <div class="d-flex mb-2">
                    <input class="form-control bg-dark border-0" type="text" name="content" placeholder="Enter task">
                    <button type="submit" class="btn btn-primary ms-2">Add</button>
                </div>
                
                </form>
                
                @foreach ($notes as $note)
                    <div class="d-flex align-items-center border-bottom py-2">
                        <input class="form-check-input m-0" type="checkbox">
                        <div class="w-100 ms-3">
                            <div class="d-flex w-100 align-items-center justify-content-between">
                                <span> {{ $note->content }}</span>
                                <form action="{{ route('notes.destroy', $note->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn  btn-sm"><i class="fa fa-times"></i></button>
                                    </form>
                                <!--<button class="btn btn-sm"><i class="fa fa-times"></i></button>-->
                            </div>
                        </div>
                    </div>
                 @endforeach
                <!--<div class="d-flex align-items-center border-bottom py-2">-->
                <!--    <input class="form-check-input m-0" type="checkbox">-->
                <!--    <div class="w-100 ms-3">-->
                <!--        <div class="d-flex w-100 align-items-center justify-content-between">-->
                <!--            <span>Short task goes here...</span>-->
                <!--            <button class="btn btn-sm"><i class="fa fa-times"></i></button>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--</div>-->
                <!--<div class="d-flex align-items-center border-bottom py-2">-->
                <!--    <input class="form-check-input m-0" type="checkbox" checked>-->
                <!--    <div class="w-100 ms-3">-->
                <!--        <div class="d-flex w-100 align-items-center justify-content-between">-->
                <!--            <span><del>Short task goes here...</del></span>-->
                <!--            <button class="btn btn-sm text-primary"><i class="fa fa-times"></i></button>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--</div>-->
                <!--<div class="d-flex align-items-center border-bottom py-2">-->
                <!--    <input class="form-check-input m-0" type="checkbox">-->
                <!--    <div class="w-100 ms-3">-->
                <!--        <div class="d-flex w-100 align-items-center justify-content-between">-->
                <!--            <span>Short task goes here...</span>-->
                <!--            <button class="btn btn-sm"><i class="fa fa-times"></i></button>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--</div>-->
                <!--<div class="d-flex align-items-center pt-2">-->
                <!--    <input class="form-check-input m-0" type="checkbox">-->
                <!--    <div class="w-100 ms-3">-->
                <!--        <div class="d-flex w-100 align-items-center justify-content-between">-->
                <!--            <span>Short task goes here...</span>-->
                <!--            <button class="btn btn-sm"><i class="fa fa-times"></i></button>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--</div>-->
            </div>
        </div>
    </div>
</div>

@endcan
@endsection
