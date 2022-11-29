@extends('admin.master')

@section('meta:title', 'PO Requests')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="font-weight-bold">PO Requests</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">PO Requests</a></li>
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
                                    <h4>List of Pending PO Requests</h4>
                                </div>
                                <div class="card-body">
                                    <admin-po-requests-table
                                    ref="table-1"
                                    fetch-url="{{ route('admin.po-requests.fetch', ['tab' => 'pending']) }}"
                                    ></admin-po-requests-table>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab2">
                            <div class="card">
                                <div class="card-header bg--white">
                                    <h4>List of Approved PO Requests</h4>
                                </div>
                                <div class="card-body">
                                    <admin-po-requests-table
                                    ref="table-2"
                                    disabled
                                    fetch-url="{{ route('admin.po-requests.fetch', ['tab' => 'approved']) }}"
                                    ></admin-po-requests-table>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab3">
                            <div class="card">
                                <div class="card-header bg--white">
                                    <h4>List of Denied PO Requests</h4>
                                </div>
                                <div class="card-body">
                                    <admin-po-requests-table
                                    ref="table-3"
                                    disabled
                                    fetch-url="{{ route('admin.po-requests.fetch', ['tab' => 'denied']) }}"
                                    ></admin-po-requests-table>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab4">
                            <div class="card">
                                <div class="card-header bg--white">
                                    <h4>List of Resubmitted PO Requests</h4>
                                </div>
                                <div class="card-body">
                                    <admin-po-requests-table
                                    ref="table-4"
                                    disabled
                                    fetch-url="{{ route('admin.po-requests.fetch', ['tab' => 'resubmitted']) }}"
                                    ></admin-po-requests-table>
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