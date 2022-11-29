@extends('master.master')

@section('content')


<div class="row no-gutters">
	<div class="col-2">
		@include('web.pages.manager.sidebar')
	</div>
	<div class="col-10 frm-main">
		<div class="frm-main__cntnr">

			{{-- Header --}}
			<div class="row no-gutters mb-4 align-items-center">
				<div class="col">
					<a href="manager/ppp-budget" class="font-weight-bold font--22"><i class="fa fa-chevron-left btn--back"></i>Create PPP</a>
				</div>
				<div class="col text-right">
					<p class="clr--light-gray font--12">Manager > PPP Budget > Create New</p>
				</div>
			</div>

			<div class="row no-gutters">
				<div class="col-12">
					<div class="card">
					  	<h4 class="card-header bg--gray">Details</h4>
					  	<div class="card-body py-4 px-2">
				    		<div class="form-row">
							    <div class="form-group col-md-4 px-3">
							      	<div class="form-group col-12 px-0">
								      	<label class="font--12 clr--light-gray font-weight-bold">PPP Name</label>
								      	<input type="text" class="form-control" placeholder="Name">
								    </div>
								    <div class="form-group col-12 px-0">
								      	<label class="font--12 clr--light-gray font-weight-bold">Line of Business</label>
								      	<input type="text" class="form-control" placeholder="Name">
								    </div>
								    <div class="form-group col-12 px-0">
							    		<label class="font--12 clr--light-gray font-weight-bold">Description</label>
							    		<textarea class="form-control textarea" placeholder="type here"></textarea>
								    </div>
							    </div>
							    <div class="form-group col-md-4 px-3">
						    		<div class="form-group col-12 px-0">
							    		<label class="font--12 clr--light-gray font-weight-bold">Date Period</label>
								      	<div class="input-with-icon">
								      		
								      		<input type="text" class="form-control" placeholder="Select dates">
								      		<img src="images/calendar-icon.svg">
								      	</div>
								    </div>
								    <div class="form-group col-12 px-0">
							    		<label class="font--12 clr--light-gray font-weight-bold">Brand</label>
							    		<select class="form-control">
							    			<option></option>
							    		</select>
								    </div>
								    <div class="form-group col-12 px-0">
								      	<label class="font--12 clr--light-gray font-weight-bold">Amount</label>
								      	<input type="text" class="form-control" placeholder="Name">
								    </div>
							    </div>
							    <div class="form-group col-md-4 px-3">
						    		<div class="form-group col-12 px-0">
								      	<label class="font--12 clr--light-gray font-weight-bold">Attachments</label>
								      	<input type="file" class="font--14">
								    </div>
							    </div>
							</div>
					  	</div>
					</div>
				</div>
				<div class="col-12 text-right mt-4">
					<button class="frm-btn btn--gray align-r mr-2">Cancel</button>
					<button class="frm-btn align-r" data-toggle="modal" data-target="#modalValidation">SUBMIT</button>
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
	      				<h1 class="font-weight-bold">Create New PPP Budget</h1>
	      			</div>
	      			<p>Are you sure you want to add this ppp budget in the current record</p>
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
	      				<h1 class="font-weight-bold">Succefully created!</h1>
	      			</div>
	      			<p>Newly created PPP request has been added to the list</p>
	      		</div>
	    	</div>
	  	</div>
	</div>
</div>

@endsection