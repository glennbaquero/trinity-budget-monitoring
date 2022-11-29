@extends('manager.master')

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
					<h1 class="font-weight-bold">Export Management</h1>
				</div>
				<div class="col text-right">
					<p class="clr--light-gray font--12">Manager > Export Management</p>
				</div>
			</div>

			<div class="row no-gutters">
				<div class="col-9">
					<ul class="nav frm-tabs" id="myTab" role="tablist">
					  	<li class="frm-tabs__item">
					    	<a class="frm-tabs__link active" id="ppp-request-tab" data-toggle="tab" href="#ppp-request" role="tab" aria-controls="ppp-request" aria-selected="true">PPP Requests</a>
					  	</li>
					  	<li class="frm-tabs__item">
					    	<a class="frm-tabs__link" id="po-request-tab" data-toggle="tab" href="#po-request" role="tab" aria-controls="po-request" aria-selected="false">PO Requests</a>
					  	</li>
					</ul>
				</div>
				<div class="col-3 text-right">
				</div>
				<div class="col-12">
					<div class="tab-content" id="myTabContent">
					  	<div class="tab-pane fade show active" id="ppp-request" role="tabpanel" aria-labelledby="ppp-request-tab">
					  		<export-ppp-report-table
								fetch-url="{{ route('manager.ppp-request.fetch') }}"
								export-url="{{ route('manager.ppp.export') }}"
					  		></export-ppp-report-table>
					  		{{-- <div class="card">
					  			<div class="card-header bg--white d-flex align-items-center s-padding">
							  		<div class="col-3 px-0">
							  			<h4>List of Approved PPP</h4>
							  		</div>
							  		<div class="col-9 d-flex align-items-center justify-content-end px-0">
							  			<label>Date
								  			<div class="input-with-icon">
										      	<input class="form-control" type="text" value="Jan 22, 2020 - Jan 28, 2020">
									        	<i class="fa fa-caret-down date" aria-hidden="true"></i>
										    </div>
										</label>						  				
							  		</div>
							  	</div>
							  	<div class="card-body frm-tbl">
							  		<div class="table-responsive max-height--52vh">
								    	<table class="table table-striped">
								            
								            <!-- Header Slot -->
								            <slot name="header">
								            	<thead>
												    <tr>
												      	<th scope="col">PPP Name</th>
												      	<th scope="col">Line of Business</th>
												      	<th scope="col">Date Period</th>
												      	<th scope="col">Brand</th>
												      	<th scope="col" class="text-left">Amount</th>
												    </tr>
											  	</thead>
								            </slot>

								            <!-- Body Slot -->
								            <tbody>
											   <tr>
											      	<td>Sample Name</td>
											      	<td>Sample</td>
											      	<td>Jan 5 - Feb 26</td>
											      	<td>Sample</td>
											      	<td>150,000</td>
											    </tr>
											    <tr>
											      	<td>Sample Name</td>
											      	<td>Sample</td>
											      	<td>Jan 5 - Feb 26</td>
											      	<td>Sample</td>
											      	<td>150,000</td>
											    </tr>
											    <tr>
											      	<td>Sample Name</td>
											      	<td>Sample</td>
											      	<td>Jan 5 - Feb 26</td>
											      	<td>Sample</td>
											      	<td>150,000</td>
											    </tr>
											</tbody>
								        </table>
								    </div>
							  	</div>
							</div> --}}
					  	</div>
					  	<div class="tab-pane fade" id="po-request" role="tabpanel" aria-labelledby="po-request-tab">
					  		<export-po-report-table
								fetch-url="{{ route('manager.po-request.fetch') }}"
								export-url="{{ route('manager.po.export') }}"
					  		></export-po-report-table>
					  	</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection