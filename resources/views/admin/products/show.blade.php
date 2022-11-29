@extends('admin.master')

@section('meta:title', $item->name )

@section('content')
    
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="font-weight-bold">{{ $item->name }}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">Products</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">{{ $item->name }}</a></li>
                </ol>
            </div>
        </div>
    </section>
    
    <page-pagination fetch-url="{{ route('admin.products.fetch-pagination', $item->id) }}"></page-pagination>

    <section class="content">
        <ul class="nav nav-pills frm-tabs">
            <li class="nav-item frm-tabs__item"><a class="frm-tabs__link nav-link active" data-target="#tab1" href="javascript:void(0)" data-toggle="tab">Information</a></li>
            <li class="nav-item frm-tabs__item"><a @click="initList('table-1')" class="frm-tabs__link nav-link" data-target="#tab2" href="javascript:void(0)" data-toggle="tab">Activity Logs</a></li>
        </ul>
        {{-- <div class="card">
            <div class="card-header p-2">
            </div><!-- /.card-header -->
            <div class="card-body"> --}}
                <div class="tab-content">
                    <div class="tab-pane show active" id="tab1">
                        <product-view
                        fetch-url="{{ route('admin.products.fetch-item', $item->id) }}"
                        submit-url="{{ route('admin.products.update', $item->id) }}"
                        ></product-view>
                    </div>
                    <div class="tab-pane" id="tab2">
                        <div class="card">
                            <div class="card-header bg--white">
                                <h4>List of Activity Logs</h4>
                            </div>
                            <div class="card-body">
                                <activity-log-table 
                                ref="table-1"
                                disabled
                                no-action
                                fetch-url="{{ route('admin.activity-logs.fetch.products', $item->id) }}"
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