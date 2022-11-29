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
					<a href="admin/ppp-request" class="font-weight-bold font--22"><i class="fa fa-chevron-left btn--back"></i>Sample Name</a>
					<span class="frm-status denied">Denied</span>
				</div>
				<div class="col text-right">
					<p class="clr--light-gray font--12">Admin > PPP Request > View PPP Request</p>
				</div>
			</div>

			<div class="row no-gutters">
				<div class="col-12 d-flex align-items-center justify-content-end px-0 mb-2">
					<label class="font--12 clr--light-gray font-weight-bold">Status</label>
		    		<div class="col-4 pr-0">
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
				</div>
				<div class="col-12">
					<div class="card">
					  	<h4 class="card-header bg--green">Details</h4>
					  	<div class="card-body py-4 px-2">
				    		<div class="form-row">
							    <div class="form-group col-md-4 px-3">
							      	<div class="form-group col-md-12 px-0">
								      	<label class="font--12 clr--light-gray font-weight-bold">PPP Name</label>
								      	<input type="text" class="form-control" value="PO Name 1">
								    </div>
								    <div class="form-group col-md-12 px-0">
								      	<label class="font--12 clr--light-gray font-weight-bold">Line of Business</label>
								      	<input type="text" class="form-control" value="PO Name 1">
								    </div>
								    <div class="form-group col-md-12 px-0">
								      	<label class="font--12 clr--light-gray font-weight-bold">Description</label>
								      	<textarea placeholder="Sample description" class="form-control textarea"></textarea>
								    </div>
							    </div>
							    <div class="form-group col-md-4 px-3">
							      	<div class="form-group col-md-12 px-0">
								      	<label class="font--12 clr--light-gray font-weight-bold">Date Period</label>
								      	<div class="input-with-icon">
								      		<input type="text" class="form-control" placeholder="Select date" value="January 22, 2020">
								      		<img src="images/calendar-icon.svg">
								      	</div>
								    </div>
								    <div class="form-group col-md-12 px-0">
								      	<label class="font--12 clr--light-gray font-weight-bold">Brand</label>
								      	<select class="form-control">
								      		<option selected="">Sample</option>
								      	</select>	
								    </div>
								    <div class="form-group col-md-12 px-0">
								      	<label class="font--12 clr--light-gray font-weight-bold">Amount</label>
								      	<input type="text" class="form-control" value="PO Name 1">
								    </div>
							    </div>
							    <div class="form-group col-md-4 px-3">
							      	<div class="form-group col-md-12 px-0">
							      		<label class="font--12 clr--light-gray font-weight-bold">Attachments</label>
								      	<a href="" class="d-flex align-items-center font--14 link mb-2">
								  			<img src="images/file-icon.svg" class="mr-2">
										    Jeremy Magalona.docs
								  		</a>
								  		<a href="" class="d-flex align-items-center font--14 link">
								  			<img src="images/file-icon.svg" class="mr-2">
										    Jeremy Magalona.docs
								  		</a>
								    </div>
							    </div>
							</div>
					  	</div>
					</div>
				</div>


				<div class="col-12">					
					<div class="card">
					  	<h4 class="card-header bg--gray">Reason</h4>
					  	<div class="card-body">
					      	<textarea placeholder="Sample description" class="form-control textarea"></textarea>
					  	</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection