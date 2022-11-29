@extends('web.master')

@section('content')


<div class="row no-gutters">
	<div class="col-2">
		@include('web.pages.admin.sidebar')
	</div>
	<div class="col-10 frm-main">
		<div class="frm-main__cntnr">

			{{-- Header --}}
			<div class="row no-gutters mb-4 align-items-center">
				<div class="col">
					<a href="admin/main-budget" class="font-weight-bold font--22"><i class="fa fa-chevron-left btn--back"></i>Create New Budget List</a>
				</div>
				<div class="col text-right">
					<p class="clr--light-gray font--12">Admin > Main Budget > Create New Budget List</p>
				</div>
			</div>

			<div action="#" method="get" class="row no-gutters frm-form__hldr">
				<div class="col-12">
					<div class="card">
					  	<h4 class="card-header bg--gray">Details</h4>
					  	<div class="card-body py-4 px-2">
					    	<div class="width--65">
					    		<div class="form-row">
								    <div class="form-group col-md-6 px-3">
								      	<label class="font--12 clr--light-gray font-weight-bold">Name</label>
								      	<input type="text" class="form-control" placeholder="Name">
								    </div>
								    <div class="form-group col-md-6 px-3">
							    		<label class="font--12 clr--light-gray font-weight-bold">Date Period</label>
								      	<div class="input-with-icon">
								      		
								      		<input type="text" class="form-control" placeholder="Select date">
								      		<img src="images/calendar-icon.svg">
								      	</div>
								    </div>
								    <div class="form-group col-md-6 px-3">
							    		<label class="font--12 clr--light-gray font-weight-bold">Description</label>
							    		<textarea class="form-control textarea" placeholder="type here"></textarea>
								    </div>
								    <div class="form-group col-md-6 px-3">
							    		<label class="font--12 clr--light-gray font-weight-bold">Budget Amount</label>
								      	<input type="text" class="form-control" placeholder="Php">
								    </div>
								</div>
					    	</div>
					  	</div>
					</div>
				</div>
				<div class="col-12 text-right mt-4">
					<button class="frm-btn btn--gray align-r mr-2">Cancel</button>
					<button class="frm-btn align-r" data-toggle="modal" data-target="#modalValidation">Create</button>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal -->
	{{-- <dialog></dialog> --}}
	<div class="modal fade" id="modalValidation" >
	  	<div class="modal-dialog modal-dialog-centered" role="document">
	    	<div class="modal-content">
	      		<div class="modal-body text-center">
	      			<div class="d-flex align-items-center justify-content-center mb-2">
	      				<img src="images/question-mark.svg" class="mr-3">
	      				<h1 class="font-weight-bold">Create New Budget</h1>
	      			</div>
	      			<p>Are you sure you want to add this budget in the current record</p>
	        		<div class="col-12 text-center mt-5">
						<button class="frm-btn btn--gray align-r mr-2">Cancel</button>
						<button class="frm-btn align-r" data-toggle="modal" data-target="#modalSuccess">Proceed</button>
					</div>
	      		</div>
	    	</div>
	  	</div>
	</div>

	<!-- Modal -->
	<div class="modal fade" id="modalSuccess">
	  	<div class="modal-dialog modal-dialog-centered" role="document">
	    	<div class="modal-content">
	      		<div class="modal-body text-center">
	      			<div class="d-flex align-items-center justify-content-center mb-2">
	      				<img src="images/check-mark.svg" class="mr-3">
	      				<h1 class="font-weight-bold">Succefully added budget</h1>
	      			</div>
	      			<p>The new budget was successfully created and added to the record</p>
	      		</div>
	    	</div>
	  	</div>
	</div>
</div>

@endsection