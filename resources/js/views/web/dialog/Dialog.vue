<template>
	<div>
		<div class="modal fade" id="modalValidation" >
		  	<div class="modal-dialog modal-dialog-centered" role="document">
		    	<div class="modal-content">
		      		<div class="modal-body text-center">
		      			<div class="d-flex align-items-center justify-content-center mb-2">
		      				<img src="images/question-mark.svg" class="mr-3">
		      				<h1 class="font-weight-bold">Create New Admin</h1>
		      			</div>
		      			<p>Are you sure you want to add this user in the admin list</p>
		        		<div class="col-12 text-center mt-5">
							<button class="frm-btn btn--gray align-r mr-2">Cancel</button>
							<button class="frm-btn align-r" data-toggle="modal" data-target="#modalSuccess">Proceed</button>
						</div>
		      		</div>
		    	</div>
		  	</div>
		</div>
	</div>
</template>