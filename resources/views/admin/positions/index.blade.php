@extends('admin.master')

@section('meta:title', 'Positions')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="font-weight-bold">Positions</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Positions</a></li>
                </ol>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row mb-2">
            <div class="col-sm-6">
                <ul class="nav nav-pills frm-tabs">
                    <li class="nav-item frm-tabs__item"><a @click="initList('table-1')" class="frm-tabs__link nav-link active" href="#tab1" data-toggle="tab">Active</a></li>
                    <li class="nav-item frm-tabs__item"><a @click="initList('table-2')" class="frm-tabs__link nav-link" href="#tab2" data-toggle="tab">Archived</a></li>
                </ul>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('admin.positions.create') }}" class="frm-btn">
                    Create
                </a>
            </div>
        </div>

        <div class="col-xs-12">
            {{-- <div class="card">
                <div class="card-header p-2">
                </div><!-- /.card-header -->
                <div class="card-body"> --}}
                    <div class="tab-content">
                        <div class="tab-pane show active" id="tab1">
                            <position-table
                            ref="table-1"
                            fetch-url="{{ route('admin.positions.fetch') }}"
                            ></position-table>
                        </div>
                        <div class="tab-pane" id="tab2">
                            <position-table
                            ref="table-2"
                            disabled
                            fetch-url="{{ route('admin.positions.fetch-archive') }}"
                            ></position-table>
                        </div>
                    </div>
                {{-- </div>
            </div> --}}
        </div>
    </section>
</div>

@endsection