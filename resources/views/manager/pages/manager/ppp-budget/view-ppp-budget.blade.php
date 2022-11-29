@extends('web.master')

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
					<a href="manager/ppp-budget" class="font-weight-bold font--22"><i class="fa fa-chevron-left btn--back"></i>Sample Name</a>
				</div>
				<div class="col text-right">
					<p class="clr--light-gray font--12">Manager > PPP Budget > Sample Name</p>
				</div>
			</div>

			<div class="row no-gutters">
				<div class="col-12">
					<div class="card">
					  	<h4 class="card-header bg--green">PPP Request Details</h4>
					  	<div class="card-body py-4 px-2">
				    		<div class="form-row">
							    <div class="form-group col-md-4 px-3">
							      	<div class="form-group col-12 px-0">
								      	<label class="font--12 clr--light-gray font-weight-bold">PPP Name</label>
								      	<input type="text" class="form-control" value="Name">
								    </div>
								    <div class="form-group col-12 px-0">
								      	<label class="font--12 clr--light-gray font-weight-bold">Line of Business</label>
								      	<input type="text" class="form-control" value="Name">
								    </div>
								    <div class="form-group col-12 px-0">
							    		<label class="font--12 clr--light-gray font-weight-bold">Description</label>
							    		<textarea class="form-control textarea">sample description</textarea>
								    </div>
							    </div>
							    <div class="form-group col-md-4 px-3">
						    		<div class="form-group col-12 px-0">
							    		<label class="font--12 clr--light-gray font-weight-bold">Date Period</label>
								      	<div class="input-with-icon">
								      		
								      		<input type="text" class="form-control" value="Jan. 28, 2020 - Feb 26, 2020">
								      		<img src="images/calendar-icon.svg">
								      	</div>
								    </div>
								    <div class="form-group col-12 px-0">
							    		<label class="font--12 clr--light-gray font-weight-bold">Brand</label>
							    		<select class="form-control">
							    			<option>selected brand</option>
							    			<option>other brand</option>
							    		</select>
								    </div>
								    <div class="form-group col-12 px-0">
								      	<label class="font--12 clr--light-gray font-weight-bold">Amount</label>
								      	<input type="text" class="form-control" value="Php 300,000">
								    </div>
							    </div>
							    <div class="form-group col-md-4 px-3">
						    		<div class="form-group col-12 px-0">
								      	<label class="font--12 clr--light-gray font-weight-bold">Attachments</label>
								      	<a href="" class="d-flex align-items-center font--14 link mb-2">
								  			<img src="images/file-icon.svg" class="mr-2">
										    Jeremy Magalona.docs
								  		</a>
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