@extends('web.pages.manager.master')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row mb-2">
            <div class="col-sm-6">
                <a href="{{ route('manager.ppp-request.index') }}" class="font-weight-bold font--22"><h1 class="font-weight-bold"><i class="fa fa-chevron-left btn--back"></i>Create PPP</h1></a>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Manager</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)">PPP Budget</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Create</a></li>
                </ol>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <manager-ppp-request-view
			:budgets="{{ $budgets }}"
            :products-array="{{ $products }}"
			store-url="{{ route('manager.ppp-request.store') }}"
		></manager-ppp-request-view>
    </section>
	<div class="modal fade" id="modalSuccess">
	  	<div class="modal-dialog modal-dialog-centered" role="document">
	    	<div class="modal-content">
	      		<div class="modal-body text-center">
	      			<div class="d-flex align-items-center justify-content-center mb-2">
	      				<img src="images/check-mark.svg" class="mr-3">
	      				<h1 class="font-weight-bold">Succefully created!</h1>
	      			</div>
	      			<p>Newly created PPP request has been added to the list</p>
	      		</div>
	    	</div>
	  	</div>
	</div>
</div>

@endsection