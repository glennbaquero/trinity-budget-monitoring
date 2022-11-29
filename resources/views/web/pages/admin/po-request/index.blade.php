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
					<h1 class="font-weight-bold">Purchase Order Request</h1>
				</div>
				<div class="col text-right">
					<p class="clr--light-gray font--12">Admin > PO Request</p>
				</div>
			</div>

			<div class="row no-gutters">
				<div class="col-12">

					<ul class="nav frm-tabs" id="myTab" role="tablist">
					  	<li class="frm-tabs__item">
					    	<a class="frm-tabs__link active" id="pending-tab" data-toggle="tab" href="#pending" role="tab" aria-controls="pending" aria-selected="true">Pending</a>
					  	</li>
					  	<li class="frm-tabs__item">
					    	<a class="frm-tabs__link" id="approved-tab" data-toggle="tab" href="#approved" role="tab" aria-controls="approved" aria-selected="false">Approved</a>
					  	</li>
					  	<li class="frm-tabs__item">
					    	<a class="frm-tabs__link" id="denied-tab" data-toggle="tab" href="#denied" role="tab" aria-controls="denied" aria-selected="false">Denied</a>
					  	</li>
					  	<li class="frm-tabs__item">
					    	<a class="frm-tabs__link" id="resubmitted-tab" data-toggle="tab" href="#resubmitted" role="tab" aria-controls="resubmitted" aria-selected="false">Resubmitted</a>
					  	</li>
					</ul>


					<div class="tab-content" id="myTabContent">
					  	<div class="tab-pane fade show active" id="pending" role="tabpanel" aria-labelledby="pending-tab">
					  		<div class="card">
							  	<h4 class="card-header bg--white">Pending PO Request</h4>
							  	<div class="card-body frm-tbl">
							  		<div class="table-responsive">
								    	<table class="table table-striped">
								            
								            <!-- Header Slot -->
								            <slot name="header">
								            	<thead>
												    <tr>
												      	<th scope="col">PO Name</th>
												      	<th scope="col">Description</th>
												      	<th scope="col">Request Amount</th>
												      	<th scope="col">Person in Charge</th>
												      	<th scope="col">Actions</th>
												    </tr>
											  	</thead>
								            </slot>

								            <!-- Body Slot -->
								            <tbody>
											    <tr>
											      	<td>John Doe</td>
											      	<td>Sample</td>
											      	<td>150,000</td>
											      	<td class="d-flex">
											      		<div class="tbl-avatar mr-2">
											  				<img src="http://placehold.it/25x15" class="img-fit cover">
											  			</div>
											  			<p>Jeremy Magalona</p>
											  		</td>
											      	<td class="text-center">
											      		<a href="admin/view-po-request" class="btn--action bg--btn-blue"><span class="btn-label"><i class="fa fa-eye"></i></span>View</a>
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
										    		<div class="d-inline-block">
														<ul class="pagination">
															<!-- Previous -->
															<li class="page-item">
																<a class="page-link" >
																	<span><i class="fa fa-angle-double-left prevIcon"></i>Prev</span>
																</a>
															</li>
															
															<!-- Next -->
															<li class="page-item">
																<a class="page-link" >
																	<span>Next<i class="fa fa-angle-double-right nextIcon"></i></span>
																</a>
															</li>
														</ul>
													</div>
										    	</div>
										    </div>
									    </div>
								  	</div>
							  	</div>
							</div>
					  	</div>


					  	<div class="tab-pane fade" id="approved" role="tabpanel" aria-labelledby="approved-tab">
					  		...
					  	</div>
					  	<div class="tab-pane fade" id="denied" role="tabpanel" aria-labelledby="denied-tab">
					  		...
					  	</div>
					  	<div class="tab-pane fade" id="resubmitted" role="tabpanel" aria-labelledby="resubmitted-tab">
					  		...
					  	</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection