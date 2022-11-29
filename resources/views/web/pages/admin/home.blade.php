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
					<h1 class="font-weight-bold">Dashboard</h1>
				</div>
				<div class="col text-right">
					<p class="clr--light-gray font--12">Admin > Dashboard</p>
				</div>
			</div>

			<div class="row no-gutters equal">
				<div class="col-12">
					<div class="card">
					  	<div class="card-header bg--white d-flex align-items-center s-padding">
					  		<div class="col-2 px-0">
					  			<h4>Budget</h4>
					  		</div>
					  		<div class="col-10 d-flex align-items-center justify-content-end px-0">
					  			<label>Brand
					  				<select class="form-control" disabled="">
					  					<option>Diabetasol</option>
					  				</select>
					  			</label>
					  			<label>Budget Month
					  				<select class="form-control">
					  					<option>January</option>
					  				</select>
					  			</label>
					  			<label>Budget Year
					  				<select class="form-control">
					  					<option>2020</option>
					  					<option>2019</option>
					  				</select>
					  			</label>
					  		</div>
					  	</div>
					  	<div class="card-body">
					    	<chart></chart>
					  	</div>
					</div>
				</div>

				<div class="col-7 d-flex">
					<div class="card">
					  	<div class="card-header bg--white d-flex align-items-center s-padding">
					  		<div class="col-3 px-0">
					  			<h4>PO Available Budget</h4>
					  		</div>
					  		<div class="col-9 d-flex align-items-center justify-content-end px-0">
					  			<label>Product
					  				<select class="form-control">
					  					<option>Diabetasol</option>
					  				</select>
					  			</label>
					  			<label>Budget Year
					  				<select class="form-control">
					  					<option>2020</option>
					  					<option>2019</option>
					  				</select>
					  			</label>
					  		</div>
					  	</div>
					  	<div class="card-body">
					    	<chart></chart>
					    	<div class="text-center">
					    		<label class="font--12 mr-2">Product
					  				<select class="form-control d-unset">
					  					<option>Diabetasol</option>
					  				</select>
					  			</label>
					    	</div>
					  	</div>
					</div>
				</div>

				<div class="col-5 pl-2 d-flex">
					<div class="card">
					  	<h4 class="card-header bg--white">
				  			Breakdown of Budget
					  	</h4>
					  	<div class="card-body frm-tbl">
					    	<div class="table-responsive mb-0">
						    	<table class="table table-striped">
						            
						            <!-- Header Slot -->
						            <slot name="header">
						            	<thead>
										    <tr>
										      	<th scope="col">PO Name</th>
										      	<th scope="col">Percentage</th>
										      	<th scope="col">PO Date</th>
										    </tr>
									  	</thead>
						            </slot>

						            <!-- Body Slot -->
						            <tbody>
									    <tr>
									      	<td>Advertisements</td>
									      	<td>35% - 285k</td>
									      	<td>Jan 5 - Feb 26</td>
									    </tr>
									    <tr>
									      	<td>Social Media</td>
									      	<td>35% - 285k</td>
									      	<td>Jan 5 - Feb 26</td>
									    </tr>
									    <tr>
									      	<td>Social Media</td>
									      	<td>35% - 285k</td>
									      	<td>Jan 5 - Feb 26</td>
									    </tr>
									    <tr>
									      	<td>Social Media</td>
									      	<td>35% - 285k</td>
									      	<td>Jan 5 - Feb 26</td>
									    </tr>
									    <tr>
									      	<td>Social Media</td>
									      	<td>35% - 285k</td>
									      	<td>Jan 5 - Feb 26</td>
									    </tr>
									</tbody>

						        </table>
						    </div>
					  	</div>
					</div>
				</div>

				<div class="col-12">
					<div class="card">
					  	<h4 class="card-header bg--green">Latest Approved PPP Requests</h4>
					  	<div class="card-body frm-tbl">
							<div class="table-responsive">
						    	<table class="table table-striped">
						            
						            <!-- Header Slot -->
						            <slot name="header">
						            	<thead>
										    <tr>
										      	<th scope="col">Name</th>
										      	<th scope="col">Description</th>
										      	<th scope="col">Date Period</th>
										      	<th scope="col">Budget Amount</th>
										      	<th scope="col">Remaining Budget</th>
										      	<th scope="col">Actions</th>
										    </tr>
									  	</thead>
						            </slot>

						            <!-- Body Slot -->
						            <tbody>
									    <tr>
									      	<td>Sample Name</td>
									      	<td>Sample</td>
									      	<td>Jan 5 - Feb 26</td>
									      	<td>150,000</td>
									      	<td>365,000</td>
									      	<td class="text-center">
									      		<a href="#" class="btn--action bg--btn-blue"><span class="btn-label"><i class="fa fa-eye"></i></span>View</a>
									      	</td>
									    </tr>
									    <tr>
									      	<td>Sample Name</td>
									      	<td>Sample</td>
									      	<td>Jan 5 - Feb 26</td>
									      	<td>150,000</td>
									      	<td>365,000</td>
									      	<td class="text-center">
									      		<a href="#" class="btn--action bg--btn-blue"><span class="btn-label"><i class="fa fa-eye"></i></span>View</a>
									      	</td>
									    </tr>
									</tbody>

						        </table>
						    </div>
						  	<div class="card-footer">
						  		<div>
								    <div class="row">
								    	<div class="col-12 col-md-6 d-flex align-items-center">
								    		<p class="mb-0">Showing 1-10 of 100 items</p>
								    	</div>
								    	<div class="col-12 col-md-6 text-sm-left text-md-right">
								    		<a href="" class="link font--14">GO TO PPP REQUEST</a>
								    	</div>
								    </div>
							    </div>
						  	</div>
					  	</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection