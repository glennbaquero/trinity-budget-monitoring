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
					<h1 class="font-weight-bold">Dashboard</h1>
				</div>
				<div class="col text-right">
					<p class="clr--light-gray font--12">Sales > PPP Available Budget</p>
				</div>
			</div>

			<div class="row no-gutters">
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
										      	<th scope="col" class="text-left">PO Date</th>
										    </tr>
									  	</thead>
						            </slot>

						            <!-- Body Slot -->
						            <tbody>
									    <tr>
									      	<td><span class="dot clr--blue"></span>Advertisements</td>
									      	<td>35% - 285k</td>
									      	<td>Jan 5 - Feb 26</td>
									    </tr>
									    <tr>
									      	<td><span class="dot clr--red"></span>Social Media</td>
									      	<td>35% - 285k</td>
									      	<td>Jan 5 - Feb 26</td>
									    </tr>
									    <tr>
									      	<td><span class="dot clr--green"></span>Tarpaulins</td>
									      	<td>35% - 285k</td>
									      	<td>Jan 5 - Feb 26</td>
									    </tr>
									</tbody>
						        </table>
						    </div>
					  	</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection