@extends('admin.master')

@section('meta:title', 'Activity Logs')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="font-weight-bold">Activity Logs</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Activity Logs</a></li>
                </ol>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="card">
            <div class="card-header bg--white">
                <h4>Activity Logs</h4>
            </div>
            <div class="card-body">
                <activity-log-table 
                fetch-url="{{ route('admin.activity-logs.fetch') }}"
                :filter-types="{{ $filterTypes }}"
                actionable
                show-subject
                ></activity-log-table>
            </div>
        </div>
    </section>
</div>

@endsection