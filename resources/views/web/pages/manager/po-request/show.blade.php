@extends('web.pages.manager.master')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row mb-2">
            <div class="col-sm-6">
                <a href="{{ route('manager.po-request.index') }}" class="font-weight-bold font--22"><h1 class="font-weight-bold"><i class="fa fa-chevron-left btn--back"></i>{{ $po_request->name }}</h1></a>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Manager</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)">PO Request</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">PO Name</a></li>
                </ol>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <manager-po-request-create
			name="{{ $name }}"
			user-image="{{ $image_path }}"
			:po-request="{{ $po_request }}"
			:file-attached="{{ $file_attached }}"
			:ppp-data="{{ $ppp }}"
			update-url="{{ route('manager.po-request.update', $po_request->id) }}"
		></manager-po-request-create>
    </section>

    <div class="modal fade" id="modalSuccess">
	  	<div class="modal-dialog modal-dialog-centered" role="document">
	    	<div class="modal-content">
	      		<div class="modal-body text-center">
	      			<div class="d-flex align-items-center justify-content-center mb-2">
	      				<img src="images/check-mark.svg" class="mr-3">
	      				<h1 class="font-weight-bold">Succefully resubmitted!</h1>
	      			</div>
	      			<p>PPP request has been resubmitted</p>
	      		</div>
	    	</div>
	  	</div>
	</div>
</div>

@endsection