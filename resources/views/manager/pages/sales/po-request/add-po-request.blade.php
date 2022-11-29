@extends('web.master')

@section('content')


<div class="row no-gutters">
	<div class="col-2">
		@include('web.pages.sales.sidebar')
	</div>
	<div class="col-10 frm-main">
		<div class="frm-main__cntnr">

			{{-- Header --}}
			<div class="row no-gutters mb-4 align-items-center">
				<div class="col">
					<h1 class="font-weight-bold">Purchase Order Request</h1>
				</div>
				<div class="col text-right">
					<p class="clr--light-gray font--12">Sales > PO Request > Create New</p>
				</div>
			</div>

			<div class="row no-gutters">
				<div class="col-12">
					<div class="card">
					  	<h4 class="card-header bg--green">Person In-charge</h4>
					  	<div class="card-body">
					  		<div class="d-flex">
					  			<div class="col-md-8 px-0">
						  			<div class="d-flex align-items-center">
							  			<div class="card-avatar">
								  			<img src="http://placehold.it/64x64" class="float-left rounded-circle">
								  		</div>
									    <div class="message">
									        <h4 class="font-weight-bold mb-1">Jeremy Magalona</h4>
									        <h5 class="">Sales Representative</h5>
									    </div>
							  		</div>
						  		</div>
						  		<div class="col-md-4 px-0">
							      	<label class="font--12 clr--light-gray font-weight-bold">PPP Name</label>
							      	<select class="form-control">
							      		<option>Advertisement</option>
							      	</select>
						  		</div>
					  		</div>
					  	</div>
					</div>
				</div>
				<div class="col-12">
					<div class="card">
					  	<h4 class="card-header bg--gray">Details</h4>
					  	<div class="card-body py-4 px-2">
				    		<div class="form-row">
							    <div class="form-group col-md-4 px-3">
							      	<label class="font--12 clr--light-gray font-weight-bold">Purchase Order Name</label>
							      	<input type="text" class="form-control">
							    </div>
							    <div class="form-group col-md-4 px-3">
						    		<label class="font--12 clr--light-gray font-weight-bold">Purchase Order Date</label>
							      	<div class="input-with-icon">
							      		<input type="text" class="form-control" placeholder="Select date">
							      		<img src="images/calendar-icon.svg">
							      	</div>
							    </div>
							    <div class="form-group col-md-4 px-3">
						    		<label class="font--12 clr--light-gray font-weight-bold">Status</label>
						    		<div class="frm-dropdown">
						    			<div class="dropdown">
										  	<button class="form-control dropdown-toggle pending" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pending</button>
										  	<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
											    <p class="dropdown-item approved">Approved</p>
											    <p class="dropdown-item denied">Denied</p>
										  	</div>
										</div>
						    		</div>
							    </div>
							    <div class="form-group col-md-4 px-3">
							      	<label class="font--12 clr--light-gray font-weight-bold">Supplier</label>
							      	<input type="text" class="form-control">
							    </div>
							    <div class="form-group col-md-4 px-3">
							      	<label class="font--12 clr--light-gray font-weight-bold">Request Amount</label>
							      	<input type="text" class="form-control">
							    </div>
							    <div class="form-group col-md-4 px-3">
							      	<label class="font--12 clr--light-gray font-weight-bold">Transaction Group</label>
							      	<input type="text" class="form-control">
							    </div>
							    <div class="form-group col-md-4 px-3">
							      	<label class="font--12 clr--light-gray font-weight-bold">Transaction Currency</label>
							      	<input type="text" class="form-control">
							    </div>
							    <div class="form-group col-md-4 px-3">
							      	<label class="font--12 clr--light-gray font-weight-bold">Country</label>
							      	<input type="text" class="form-control">
							    </div>
							    <div class="form-group col-md-4 px-3">
							      	<label class="font--12 clr--light-gray font-weight-bold">Exchange Rate</label>
							      	<input type="text" class="form-control">
							    </div>
							    <div class="form-group col-md-4 px-3">
							      	<label class="font--12 clr--light-gray font-weight-bold">Program Title</label>
							      	<input type="text" class="form-control">
							    </div>
							    <div class="form-group col-md-4 px-3">
							      	<label class="font--12 clr--light-gray font-weight-bold">Purpose</label>
							      	<input type="text" class="form-control">
							    </div>
							</div>
					  	</div>
					</div>
				</div>

				<div class="col-12">
					<div class="frm-accordion">
						<div id="accordion">
					    	<div class="card">
							  	<h4 data-toggle="collapse" data-parent="#accordion" href="#collapse-1" aria-expanded="false" class="card-header">Description</h4>
							  	<div id="collapse-1" class="collapse">
							  		<div class="card-body px-2">
							  			<div class="form-group col-12 px-3">
									      	<textarea class="form-control textarea"></textarea>
									    </div>
						        	</div>
							  	</div>
							</div>

							<div class="card">
							  	<h4 data-toggle="collapse" data-parent="#accordion" href="#collapse-2" aria-expanded="false" class="card-header">Objective</h4>
							  	<div id="collapse-2" class="collapse">
							  		<div class="card-body px-2">
						        		<div class="form-group col-12 px-3">
									      	<textarea class="form-control textarea"></textarea>
									    </div>
						        	</div>
							  	</div>
							</div>
							
						</div>
					</div>

				</div>
				<div class="col-12">					
					<div class="card">
					  	<h4 class="card-header bg--gray">Attachments</h4>
					  	<div class="card-body">
					  		<a href="" class="d-flex align-items-center font--14 link mb-2">
					  			<img src="images/file-icon.svg" class="mr-2">
							    Jeremy Magalona.docs
					  		</a>
					  		<a href="" class="d-flex align-items-center font--14 link mb-2">
					  			<img src="images/file-icon.svg" class="mr-2">
							    Jeremy Magalona.docs
					  		</a>
					  		<input type="file" class="font--14" placeholder="Name">
					  	</div>
					</div>
				</div>
				
				<div class="col-12 text-right mt-3 px-0">
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
	      				<h1 class="font-weight-bold">Create Purchase Order</h1>
	      			</div>
	      			<p>Are you sure you want to add this new PO to the record</p>
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
	      			<p>Newly created PO request has been added to the list</p>
	      		</div>
	    	</div>
	  	</div>
	</div>
</div>

@endsection