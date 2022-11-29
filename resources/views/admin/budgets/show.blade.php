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
                    <li class="breadcrumb-item"><a href="{{ route('admin.budgets.index') }}">Budgets</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">{{ $item->name }}</a></li>
                </ol>
            </div>
        </div>
    </section>
    
    <page-pagination fetch-url="{{ route('admin.budgets.fetch-pagination', $item->id) }}"></page-pagination>

    <section class="content">
        <ul class="nav nav-pills frm-tabs">
            <li class="nav-item frm-tabs__item"><a class="frm-tabs__link nav-link active" data-target="#tab1" href="javascript:void(0)" data-toggle="tab">Information</a></li>
            <li class="nav-item frm-tabs__item"><a @click="initList('table-1')" class="frm-tabs__link nav-link" data-target="#tab2" href="javascript:void(0)" data-toggle="tab">Activity Logs</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane show active" id="tab1">
                <budget-view
                fetch-url="{{ route('admin.budgets.fetch-item', $item->id) }}"
                submit-url="{{ route('admin.budgets.update', $item->id) }}"
                ></budget-view>
            </div>
            <div class="tab-pane" id="tab2">
                        <activity-log-table 
                        ref="table-1"
                        disabled
                        no-action
                        fetch-url="{{ route('admin.activity-logs.fetch.budgets', $item->id) }}"
                        ></activity-log-table>

            </div>
        </div>
    </section>
</div>

@endsection