@extends('admin.master')

@section('meta:title', $po_request->name )

@section('content')
    
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="font-weight-bold">{{ $po_request->name }}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.po-requests.index') }}">PO Requests</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">{{ $po_request->name }}</a></li>
                </ol>
            </div>
        </div>
    </section>
    
    {{-- <page-pagination fetch-url="{{ route('admin.ppp-requests.fetch-pagination', $po_request->id) }}"></page-pagination> --}}

    <section class="content">
        <admin-po-requests-view
            name="{{ $name }}"
            user-image="{{ $image_path }}"
            :po-request="{{ $po_request }}"
            :file-attached="{{ $file_attached }}"
            :ppp-data="{{ $ppp }}"
            update-url="{{ route('admin.po-requests.update', $po_request->id) }}"
        ></admin-po-requests-view>
{{--         <div class="card">
            <div class="card-header p-2">
                <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link active" data-target="#tab1" href="javascript:void(0)" data-toggle="tab">PPP Request Details</a></li>
                </ul>
            </div><!-- /.card-header -->
            <div class="card-body">
                <admin-ppp-requests-view
                    :item="{{ $item }}"
                    submit-url="{{ route('admin.ppp-requests.update', $item->id) }}"
                ></admin-ppp-requests-view>
                {<div class="tab-content">
                    <div class="tab-pane show active" id="tab1">
                        <product-view
                        fetch-url="{{ route('admin.products.fetch-item', $item->id) }}"
                        submit-url="{{ route('admin.products.update', $item->id) }}"
                        ></product-view>
                    </div>
                </div> 
            </div>
        </div> --}}
    </section>
</div>

@endsection