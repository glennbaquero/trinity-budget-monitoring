@extends('admin.master')

@section('meta:title', 'Budgets')

@section('content')

<div class="row no-gutters">
    <div class="col-2">
    </div>
    <div class="col-10 frm-main">
        <div class="frm-main__cntnr">

            {{-- Header --}}
            <div class="row no-gutters mb-4 align-items-center">
                <div class="col">
                    <h1 class="font-weight-bold">Dashboard</h1>
                </div>
                <div class="col text-right">
                    <p class="clr--light-gray font--12">Admin > Dashboard</p>
                </div>
            </div>

            <div class="row no-gutters equal">
                <div class="col-12">
                    <div class="card">
                        <h4 class="card-header bg--white">Main Budgets</h4>
                        <div class="card-body">
                            <group-bar-chart 
                                :data="{{ json_encode($data) }}"
                                :date="{{ json_encode($date) }}"
                                update-url="{{ route('admin.analytics.type') }}"
                                :years="{{ json_encode($years) }}"
                                :months="{{ json_encode($months) }}"
                            ></group-bar-chart>
                        </div>
                    </div>
                </div>
            
            <doughnut-chart
                :specializations="{{ $specializations }}"
                :data="{{ json_encode($doughnut_data) }}"
                :bg-color="{{ json_encode($doughnut_data_color) }}"
                :labels="{{ json_encode($doughnut_labels) }}"
                text="{{ $doughnut }}"
                update-url="{{ route('admin.analytics.doughnut-update') }}"
                :table-data="{{ json_encode($table_data) }}"
                :years="{{ json_encode($years) }}"
                po-url="{{ route('admin.po-requests.index') }}"
            ></doughnut-chart>
            {{-- <div class="col-7 d-flex">
                <div class="card">
                </div>
            </div> --}}

                {{-- <div class="col-5 pl-2 d-flex">
                    <div class="card">
                        <h4 class="card-header bg--white">
                            Breakdown of Budget
                        </h4>
                        <div class="card-body frm-tbl">
                            <div class="table-responsive mb-0">
                                <table class="table table-striped">
                                    
                                    <!-- Header Slot -->
                                    <slot name="header">
                                        <thead>
                                            <tr>
                                                <th scope="col">PO Name</th>
                                                <th scope="col">Percentage</th>
                                                <th scope="col">PO Date</th>
                                            </tr>
                                        </thead>
                                    </slot>

                                    <!-- Body Slot -->
                                    <tbody>
                                        @foreach($table_data as $data)
                                        <tr>
                                            <td><span class="dot" style="background: {{ $data['legend'] }}"></span>{{ $data['name'] }}</td>
                                            <td>{{ $data['request_amount'] }}</td>
                                            <td>{{ $data['po_date'] }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div> --}}

                <div class="col-12">
                    <div class="card">
                        <h4 class="card-header bg--green">Latest Approved PPP Requests</h4>
                        <div class="card-body frm-tbl">
                            <div class="table-responsive">
                               <admin-ppp-requests-admin-table
                               ref="table-1"
                               fetch-url="{{ route('admin.ppp-requests-dashboard.fetch', ['status' => 2]) }}"
                               ></admin-ppp-requests-admin-table>
                            </div>
                            <div class="card-footer">
                                <div>
                                    <div class="row">
                                        <div class="col-12 col-md-12 text-sm-left text-md-right">
                                            <a href="{{ route('admin.ppp-requests.index') }}" class="link font--14">GO TO PPP REQUEST</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection