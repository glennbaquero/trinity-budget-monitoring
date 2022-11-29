@extends('web.pages.sales.master')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row mb-2">
            <div class="col-sm-6">
                <a href="{{ route('web.po-request.index') }}" class="font-weight-bold font--22"><h1 class="font-weight-bold"><i class="fa fa-chevron-left btn--back"></i>Purchase Order Request</h1></a>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Sales Agent</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)">PO Request</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Create</a></li>
                </ol>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <po-request-create
			name="{{ auth()->guard('web')->user()->renderName() }}"
			user-image="{{ auth()->guard('web')->user()->renderImagePath() }}"
			:ppp-requests="{{ $ppp_requests }}"
			store-url="{{ route('web.po-request.store') }}"
			:show-buttons="true"
		></po-request-create>
    </section>
	<div class="modal fade" id="modalSuccess">
	  	<div class="modal-dialog modal-dialog-centered" role="document">
	    	<div class="modal-content">
	      		<div class="modal-body text-center">
	      			<div class="d-flex align-items-center justify-content-center mb-2">
	      				<img src="images/check-mark.svg" class="mr-3">
	      				<h1 class="font-weight-bold">Succefully created!</h1>
	      			</div>
	      			<p>Newly created PO request has been added to the list</p>
	      		</div>
	    	</div>
	  	</div>
	</div>
</div>


@endsection