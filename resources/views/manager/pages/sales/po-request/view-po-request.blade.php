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
					<p class="clr--light-gray font--12">Dashboard > Breadcrumbs</p>
				</div>
			</div>

			<div class="row no-gutters">
				<div class="col-12">
					<div class="card">
					  	<h4 class="card-header bg--green">Person In-charge</h4>
					  	<div class="card-body">
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
					</div>
				</div>
				<div class="col-12">
					<div class="card">
					  	<h4 class="card-header bg--gray">Details</h4>
					  	<div class="card-body py-4 px-2">
				    		<div class="form-row">
							    <div class="form-group col-md-4 px-3">
							      	<label class="font--12 clr--light-gray font-weight-bold">Purchase Order Name</label>
							      	<input disabled="" type="text" class="form-control" value="PO Name 1">
							    </div>
							    <div class="form-group col-md-4 px-3">
						    		<label class="font--12 clr--light-gray font-weight-bold">Purchase Order Date</label>
							      	<div class="input-with-icon">
							      		<input disabled="" type="text" class="form-control" placeholder="Select date" value="January 22, 2020">
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
							      	<input disabled="" type="text" class="form-control" value="Philippines">
							    </div>
							    <div class="form-group col-md-4 px-3">
							      	<label class="font--12 clr--light-gray font-weight-bold">Request Amount</label>
							      	<input disabled="" type="text" class="form-control" value="Php 300,000">
							    </div>
							    <div class="form-group col-md-4 px-3">
							      	<label class="font--12 clr--light-gray font-weight-bold">Transaction Group</label>
							      	<input disabled="" type="text" class="form-control" value="--">
							    </div>
							    <div class="form-group col-md-4 px-3">
							      	<label class="font--12 clr--light-gray font-weight-bold">Transaction Currency</label>
							      	<input disabled="" type="text" class="form-control" value="Philippines">
							    </div>
							    <div class="form-group col-md-4 px-3">
							      	<label class="font--12 clr--light-gray font-weight-bold">Country</label>
							      	<input disabled="" type="text" class="form-control" value="Philippines">
							    </div>
							    <div class="form-group col-md-4 px-3">
							      	<label class="font--12 clr--light-gray font-weight-bold">Exchange Rate</label>
							      	<input disabled="" type="text" class="form-control" value="--">
							    </div>
							    <div class="form-group col-md-4 px-3">
							      	<label class="font--12 clr--light-gray font-weight-bold">Program Title</label>
							      	<input disabled="" type="text" class="form-control" value="Philippines">
							    </div>
							    <div class="form-group col-md-4 px-3">
							      	<label class="font--12 clr--light-gray font-weight-bold">Purpose</label>
							      	<input disabled="" type="text" class="form-control" value="Philippines">
							    </div>
							</div>
					  	</div>
					</div>
				</div>

				<div class="col-12">
					<div class="frm-accordion">
						<div id="accordion">
					    	<div class="card">
							  	<h4 data-toggle="collapse" data-parent="#accordion" href="#collapse-1" aria-expanded="false" class="card-header">Person In-charge</h4>
							  	<div id="collapse-1" class="collapse">
							  		<div class="card-body">
						        		<p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird</p>
						        	</div>
							  	</div>
							</div>

							<div class="card">
							  	<h4 data-toggle="collapse" data-parent="#accordion" href="#collapse-2" aria-expanded="false" class="card-header">Person In-charge</h4>
							  	<div id="collapse-2" class="collapse">
							  		<div class="card-body">
						        		Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird
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

				<div class="col-12">					
					<div class="card">
					  	<h4 class="card-header bg--green d-flex align-items-center">
					  		PPP Request Details
					  	</h4>
					  	<div class="card-body py-4 px-2">
					  		<div class="form-row">
							    <div class="form-group col-md-4 px-3">
							      	<label class="font--12 clr--light-gray font-weight-bold">Line of Business</label>
							      	<input disabled="" type="text" class="form-control" value="Sample here">
							    </div>
							    <div class="form-group col-md-4 px-3">
						    		<label class="font--12 clr--light-gray font-weight-bold">Brand</label>
							      	<select class="form-control" disabled="">
							      		<option selected="">Sample</option>
							      	</select>
							    </div>
							    <div class="form-group col-md-4 px-3">
						    		<label class="font--12 clr--light-gray font-weight-bold">PPP Date</label>
						    		<div class="input-with-icon">
							      		<input disabled="" type="text" class="form-control" placeholder="Select date" value="January 22, 2020">
							      		<img src="images/calendar-icon.svg">
							      	</div>
							    </div>
							    <div class="form-group col-md-4 px-3">
							      	<label class="font--12 clr--light-gray font-weight-bold">Description</label>
							      	<textarea style="height: 126px" disabled="" placeholder="Sample description" class="form-control textarea"></textarea>
							    </div>
							    <div class="form-group col-md-4 px-3">
							      	<div class="form-group col-md-12 px-0">
								      	<label class="font--12 clr--light-gray font-weight-bold">PPP Value</label>
								      	<input disabled="" type="text" class="form-control" value="Php 300,000">
								    </div>
								    <div class="form-group col-md-12 px-0">
								      	<label class="font--12 clr--light-gray font-weight-bold">PPP Current Balance</label>
								      	<input disabled="" type="text" class="form-control" value="Php 300,000">
								    </div>
							    </div>
							    <div class="form-group col-md-4 px-3">
							      	<div class="form-group col-md-12 px-0">
								      	<label class="font--12 clr--light-gray font-weight-bold">PPP Total Cash</label>
								      	<input disabled="" type="text" class="form-control" value="Php 300,000">
								    </div>
								    <div class="form-group col-md-12 px-0">
								      	<label class="font--12 clr--light-gray font-weight-bold">PPP Total Balance</label>
								      	<input disabled="" type="text" class="form-control" value="Php 300,000">
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
				
				<div class="col-12 text-right mt-3 px-0">
					<button class="frm-btn align-r btn--red">Archive</button>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection