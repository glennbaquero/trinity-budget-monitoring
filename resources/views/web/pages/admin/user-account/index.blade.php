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
					<h1 class="font-weight-bold">Sales Agent</h1>
				</div>
				<div class="col text-right">
					<p class="clr--light-gray font--12">Admin > User Account Management</p>
				</div>
			</div>

			<div class="row no-gutters">
				<div class="col-12 text-right">
					<a href="admin/add-user-acc" class="frm-btn mb-4">Create New</a>
				</div>
				<div class="col-12">
					<div class="card">
					  	<h4 class="card-header bg--white">List of Sales Agents</h4>
					  	<div class="card-body frm-tbl">
					  		<div class="table-responsive">
						    	<table class="table table-striped">
						            
						            <!-- Header Slot -->
						            <slot name="header">
						            	<thead>
										    <tr>
										      	<th scope="col">First Name</th>
										      	<th scope="col">Last Name</th>
										      	<th scope="col">Email</th>
										      	<th scope="col">Contact Information</th>
										      	<th scope="col">Manager</th>
										      	<th scope="col">Actions</th>
										    </tr>
									  	</thead>
						            </slot>

						            <!-- Body Slot -->
						            <tbody>
									    <tr>
									      	<td>Sample</td>
									      	<td>Name</td>
									      	<td>sammacaraeg0015@gmail.com</td>
									      	<td>09999999999</td>
									      	<td>Manager Name</td>
									      	<td>
									      		<a href="admin/edit-user-acc" class="btn--action bg--btn-yellow"><img src="images/edit-icon.svg"></a>
									      		<a href="#" class="btn--action bg--btn-red"><img src="images/delete-icon.svg"></a>
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
			</div>
		</div>
	</div>
</div>

@endsection