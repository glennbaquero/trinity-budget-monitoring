@extends('admin.master')

@section('meta:title', 'Pages')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="font-weight-bold">Pages</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Pages</a></li>
                </ol>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row mb-2">
            <div class="col-sm-6">
                <ul class="nav nav-pills frm-tabs">
                    <li class="nav-item frm-tabs__item"><a @click="initList('table-1')" class="frm-tabs__link nav-link active" data-target="#tab1" href="javascript:void(0)" data-toggle="tab">Active</a></li>
                    <li class="nav-item frm-tabs__item"><a @click="initList('table-2')" class="frm-tabs__link nav-link" data-target="#tab2" href="javascript:void(0)" data-toggle="tab">Archived</a></li>
                    <li class="nav-item frm-tabs__item"><a @click="initList('table-3')" class="frm-tabs__link nav-link" data-target="#tab3" href="javascript:void(0)" data-toggle="tab">Activity Logs</a></li>
                </ul>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('admin.pages.create') }}" class="frm-btn">
                    Create
                </a>
            </div>
        </div>

        {{-- <div class="card">
            <div class="card-header p-2">

            </div><!-- /.card-header -->
            <div class="card-body"> --}}
                <div class="tab-content">
                    <div class="tab-pane show active" id="tab1">
                        <div class="card">
                            <div class="card-header bg--white">
                                <h4>List of Active Pages</h4>
                            </div>
                            <div class="card-body">
                                <page-table 
                                ref="table-1"
                                fetch-url="{{ route('admin.pages.fetch') }}"
                                ></page-table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab2">
                        <div class="card">
                            <div class="card-header bg--white">
                                <h4>List of Archived Pages</h4>
                            </div>
                            <div class="card-body">
                                <page-table 
                                ref="table-2"
                                disabled
                                fetch-url="{{ route('admin.pages.fetch-archive') }}"
                                ></page-table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab3">
                        <div class="card">
                            <div class="card-header bg--white">
                                <h4>Activity Logs</h4>
                            </div>
                            <div class="card-body">
                                <activity-log-table 
                                ref="table-3"
                                disabled
                                show-subject
                                fetch-url="{{ route('admin.activity-logs.fetch.pages') }}"
                                ></activity-log-table>
                            </div>
                        </div>
                    </div>
                </div>
            {{-- </div>
        </div> --}}
    </section>
</div>

@endsection