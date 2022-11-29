@extends('web.pages.manager.master')

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
					<h1 class="font-weight-bold">User Information</h1>
				</div>
				<div class="col text-right">
					<p class="clr--light-gray font--12">Dashboard > Breadcrumbs</p>
				</div>
			</div>

			<div class="row no-gutters">
				<div class="col-12">
					<ul class="nav frm-tabs" id="myTab" role="tablist">
					  	<li class="frm-tabs__item">
					    	<a class="frm-tabs__link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true">Profile Details</a>
					  	</li>
					  	<li class="frm-tabs__item">
					    	<a class="frm-tabs__link" id="change-pw-tab" data-toggle="tab" href="#change-pw" role="tab" aria-controls="change-pw" aria-selected="true">Change Password</a>
					  	</li>
					</ul>

					<div class="tab-content" id="myTabContent">
					  	<div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
					  		{{-- <div class="row no-gutters">
					  			<div class="col-md-3">
									<div class="card">
										<h4 class="card-header bg--green">Image</h4>
									  	<div class="card-body">
									  		<div class="d-flex align-items-center">
									  			<div class="card-avatar mr-3">
										  			<img id="imagePreview" src="http://placehold.it/64x64" class="img-fit cover">
										  		</div>
											    <div class="message">
											        <h4 class="font-weight-bold mb-1">Jeremy Magalona</h4>
											        <h5 class="">Sales Representative</h5>
											    </div>
									  		</div>
									  		<div class="frm-input__file-hldr">
												<div class="frm-input__file">
													<label for="imageUpload" class="mb-4 custom-file-upload">Choose File</label>
												</div>
												<p class="font--14 mb-3 clr--light-gray">or</p>
												<p class="font--14 clr--light-gray">Drop image file <span class="clr--btn-red font--12">(max 2mb)</span></p>
												<input type="file" id="imageUpload" class="fileuploadBtn" required>
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
											      		<option>Manager</option>
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
										<button class="frm-btn">Edit</button>
										{{-- <button class="frm-btn btn--gray mr-2">Cancel</button> --}}
								{{-- 		<button class="frm-btn" data-toggle="modal" data-target="#modalValidation">Save Changes</button>
									</div>
								</div>
					  		</div> --}} 

					  		<manager-user-view
					  		:editable="false"
					  		fetch-url="{{ route('manager.profiles.fetch') }}"
					  		submit-url="{{ route('manager.profiles.update') }}"
					  		></manager-user-view>																																																		

					  	</div>
					  	<div class="tab-pane fade" id="change-pw" role="tabpanel" aria-labelledby="change-pw-tab">
					  		{{-- <div class="col-12 px-0">
								<div class="card">
									<h4 class="card-header bg--gray">Fill up the following fields</h4>
								  	<div class="card-body py-2 px-2">
								  		<div class="form-row">
										    <div class="form-group col-md-4 px-3">
										    	<div class="form-group">
											    	<label class="font--12 clr--light-gray font-weight-bold">Current Password</label>
											    	<div class="input-with-icon">
												      	<input class="form-control" type="password" placeholder="Password">
											        	<i class="fa fa-eye-slash showPass" aria-hidden="true"></i>
												    </div>
												</div>
											    <div class="form-group col-12 px-0">
											      	<label class="font--12 clr--light-gray font-weight-bold">New Password</label>
											      	<div class="input-with-icon">
												      	<input class="form-control" type="password" placeholder="Password">
											        	<i class="fa fa-eye-slash showPass" aria-hidden="true"></i>
												    </div>
											    </div>
											    <div class="form-group col-12 px-0">
											      	<label class="font--12 clr--light-gray font-weight-bold">Retype Password</label>
											      	<div class="input-with-icon">
												      	<input class="form-control" type="password" placeholder="Password">
											        	<i class="fa fa-eye-slash showPass" aria-hidden="true"></i>
												    </div>
											    </div>
													    </div>
										</div>
								  	</div>
								</div>
								<div class="col-12 text-right mt-4 px-0">
									<button class="frm-btn align-r" data-toggle="modal" data-target="#modalValidation">Save Changes</button>
								</div>
							</div> --}}

							 <change-password-form submit-url="{{ route('manager.profiles.change-password') }}"></change-password-form>



					  	</div>
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