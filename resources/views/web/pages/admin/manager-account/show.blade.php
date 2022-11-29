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
					<a href="admin/user-acc" class="font-weight-bold font--22"><i class="fa fa-chevron-left btn--back"></i>Edit User Information</a>
				</div>
				<div class="col text-right">
					<p class="clr--light-gray font--12">Admin > User Account > Edit User Information</p>
				</div>
			</div>

			<div class="row no-gutters">
				<div class="col-md-3">
					<div class="card">
						<h4 class="card-header bg--green">Image</h4>
					  	<div class="card-body">
					  		<div class="d-flex align-items-center">
					  			<div class="card-avatar mr-3">
						  			<img src="http://placehold.it/64x64" class="img-fit cover">
						  		</div>
							    <div class="message">
							        <h4 class="font-weight-bold mb-1">Jeremy Magalona</h4>
							        <h5 class="mb-0">Sales Representative</h5>
							    </div>
					  		</div>
					  		<div class="frm-input__file-hldr">
								<div class="frm-input__file">
									<label for="fileupload" class="mb-4 custom-file-upload">Choose File</label>
								</div>
								<p class="font--14 mb-3 clr--light-gray">or</p>
								<p class="font--14 clr--light-gray">Drop image file <span class="clr--btn-red font--12">(max 2mb)</span></p>
								<input type="file" id="fileupload" class="fileuploadBtn" required>
					 		</div>
					  	</div>
					</div>
				</div>
				<div class="col-md-9 pl-2">
					<div class="card">
						<h4 class="card-header bg--gray">Details</h4>
					  	<div class="card-body py-2 px-2">
					  		<div class="form-row">
							    <div class="form-group col-md-6 px-3">
							      	<label class="font--12 clr--light-gray font-weight-bold">First Name</label>
							      	<input type="text" class="form-control" value="Sample">
							    </div>
							    <div class="form-group col-md-6 px-3">
							      	<label class="font--12 clr--light-gray font-weight-bold">Last Name</label>
							      	<input type="text" class="form-control" value="Name">
							    </div>
							    <div class="form-group col-md-6 px-3">
							      	<label class="font--12 clr--light-gray font-weight-bold">Email</label>
							      	<input type="email" class="form-control" value="samplename@gmail.com">
							    </div>
							    <div class="form-group col-md-6 px-3">
							      	<label class="font--12 clr--light-gray font-weight-bold">Position</label>
							      	<select class="form-control">
							      		<option selected="">Manager</option>
							      	</select>
							    </div>
							    <div class="form-group col-md-6 px-3">
							      	<label class="font--12 clr--light-gray font-weight-bold">Contact Information</label>
							      	<input type="text" class="form-control" value="09999999999">
							    </div>
							</div>
					  	</div>
					</div>
					<div class="col-12 text-right mt-4 px-0">
						<button class="frm-btn btn--gray align-r mr-2">Cancel</button>
						<button class="frm-btn align-r" data-toggle="modal" data-target="#modalValidation">Save Changes</button>
					</div>
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
	      				<h1 class="font-weight-bold">Save all changes made</h1>
	      			</div>
	      			<p>Once the changes has been applied there is no turning back</p>
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
	      				<h1 class="font-weight-bold">Succefully updated</h1>
	      			</div>
	      			<p>The record has successfully updated and save all changes</p>
	      		</div>
	    	</div>
	  	</div>
	</div>
</div>

@endsection