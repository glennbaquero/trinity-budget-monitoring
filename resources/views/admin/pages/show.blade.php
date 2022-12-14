@extends('admin.master')

@section('meta:title', $item->renderName())

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="font-weight-bold">{{ $item->renderName() }}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.pages.index') }}">Pages</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">{{ $item->renderName() }}</a></li>
                </ol>
            </div>
        </div>
    </section>

    <page-pagination fetch-url="{{ route('admin.pages.fetch-pagination', $item->id) }}"></page-pagination>
    
    <section class="content">
        <ul class="nav nav-pills frm-tabs">
            <li class="nav-item frm-tabs__item"><a class="frm-tabs__link nav-link active" data-target="#tab1" href="javascript:void(0)" data-toggle="tab">Information</a></li>
            <li class="nav-item frm-tabs__item"><a @click="initList('table-1')" class="frm-tabs__link nav-link" data-target="#tab2" href="javascript:void(0)" data-toggle="tab">Page Items</a></li>
            <li class="nav-item frm-tabs__item"><a @click="initList('table-2')" class="frm-tabs__link nav-link" data-target="#tab3" href="javascript:void(0)" data-toggle="tab">Activity Logs</a></li>
        </ul>
        {{-- <div class="card">
            <div class="card-header p-2">
            </div><!-- /.card-header -->
            <div class="card-body"> --}}
                <div class="tab-content">
                    <div class="tab-pane show active" id="tab1">
                        <page-view
                        fetch-url="{{ route('admin.pages.fetch-item', $item->id) }}"
                        submit-url="{{ route('admin.pages.update', $item->id) }}"
                        ></page-view>
                    </div>
                    <div class="tab-pane" id="tab2">
                        <div class="card">
                            <div class="card-header bg--white">
                                <h4>List of Page Items</h4>
                            </div>
                            <div class="card-body">
                                <page-item-table 
                                ref="table-1"
                                hide-parent
                                hide-buttons
                                disabled
                                fetch-url="{{ route('admin.page-items.fetch-page-items', $item->id) }}"
                                ></page-item-table>
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
                                ref="table-2"
                                disabled
                                show-subject
                                fetch-url="{{ route('admin.activity-logs.fetch.pages', $item->id) }}"
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