@extends('admin.master')

@section('meta:title', 'PPP Requests')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="font-weight-bold">PPP Requests</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">PPP Requests</a></li>
                </ol>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="col-xs-12">
            <ul class="nav nav-pills frm-tabs">
                <li class="nav-item frm-tabs__item"><a @click="initList('table-1')" class="frm-tabs__link nav-link active" href="#tab1" data-toggle="tab">Pending</a></li>
                <li class="nav-item frm-tabs__item"><a @click="initList('table-2')" class="frm-tabs__link nav-link" href="#tab2" data-toggle="tab">Approved</a></li>
                <li class="nav-item frm-tabs__item"><a @click="initList('table-3')" class="frm-tabs__link nav-link" href="#tab3" data-toggle="tab">Denied</a></li>
                <li class="nav-item frm-tabs__item"><a @click="initList('table-4')" class="frm-tabs__link nav-link" href="#tab4" data-toggle="tab">Resubmitted</a></li>
            </ul>
            {{-- <div class="card">
                <div class="card-header p-2">
                </div><!-- /.card-header -->
                <div class="card-body"> --}}
                    <div class="tab-content">
                        <div class="tab-pane show active" id="tab1">
                            <div class="card">
                                <div class="card-header bg--white">
                                    <h4>List of Pending PPP Requests</h4>
                                </div>
                                <div class="card-body">
                                    <admin-ppp-requests-table
                                    ref="table-1"
                                    fetch-url="{{ route('admin.ppp-requests.fetch', ['status' => $pending_status, 'for_approval' => $for_approval]) }}"
                                    ></admin-ppp-requests-table>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab2">
                            <div class="card">
                                <div class="card-header bg--white">
                                    <h4>List of Approved PPP Requests</h4>
                                </div>
                                <div class="card-body">
                                    <admin-ppp-requests-table
                                    ref="table-2"
                                    disabled
                                    fetch-url="{{ route('admin.ppp-requests.fetch', ['status' => $approved_status, 'tab' => 'approved_tab']) }}"
                                    ></admin-ppp-requests-table>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab3">
                            <div class="card">
                                <div class="card-header bg--white">
                                    <h4>List of Denied PPP Requests</h4>
                                </div>
                                <div class="card-body">
                                    <admin-ppp-requests-table
                                    ref="table-3"
                                    disabled
                                    fetch-url="{{ route('admin.ppp-requests.fetch', ['status' => 3]) }}"
                                    ></admin-ppp-requests-table>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab4">
                            <div class="card">
                                <div class="card-header bg--white">
                                    <h4>List of Resubmitted PPP Requests</h4>
                                </div>
                                <div class="card-body">
                                    <admin-ppp-requests-table
                                    ref="table-4"
                                    disabled
                                    fetch-url="{{ route('admin.ppp-requests.fetch', ['status' => 4]) }}"
                                    ></admin-ppp-requests-table>
                                </div>
                            </div>
                        </div>
                    </div>
                {{-- </div>
            </div> --}}
        </div>
    </section>
</div>

@endsection