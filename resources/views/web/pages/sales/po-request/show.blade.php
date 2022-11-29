@extends('web.pages.sales.master')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row mb-2">
            <div class="col-sm-6">
            	<a href="{{ route('web.po-request.index') }}" class="font-weight-bold font--22"><h1 class="font-weight-bold"><i class="fa fa-chevron-left btn--back"></i>Purchase Order Request</h1></a>
                {{-- <h1 class="font-weight-bold">Purchase Order Request</h1> --}}
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">PO Request Form</a></li>
                </ol>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
    	<po-request-create
			name="{{ $name }}" 
			user-image="{{ $image_path }}"
			:ppp-requests="{{ $ppp_requests }}"
			:po-request="{{ $po_request }}"
			:file-attached="{{ $file_attached }}"
			:ppp-data="{{ $ppp }}"
			store-url="{{ route('web.po-request.resubmit', $po_request->id) }}"
			:show-buttons="false"
		></po-request-create>

    </section>
</div>
@endsection