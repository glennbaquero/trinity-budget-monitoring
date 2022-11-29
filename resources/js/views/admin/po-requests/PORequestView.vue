<template>
	<div>
		<div class="row no-gutters">
			<form @submit.prevent="updateRequest">
			<div class="col-12">
				<div class="card">
				  	<h4 class="card-header bg--green">Person In-charge</h4>
				  	<div class="card-body">
				  		<div class="d-flex">
				  			<div class="col-md-8 px-0">
					  			<div class="d-flex align-items-center">
						  			<div class="card-avatar">
							  			<img :src="userImage" class="float-left rounded-circle">
							  		</div>
								    <div class="message">
								        <h4 class="font-weight-bold mb-1">{{ name }}</h4>
								        <h5 class="">Sales Representative</h5>
								    </div>
						  		</div>
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
						      	<input type="text" class="form-control" v-model="poRequest.name" disabled>
						    </div>
						    <div class="form-group col-md-4 px-3">
					    		<label class="font--12 clr--light-gray font-weight-bold">Purchase Order Date</label>
						      	<div class="input-with-icon">
						      		<input type="text" class="form-control datepicker" v-model="poRequest.po_date" placeholder="Select date" disabled>
						      		<img src="images/calendar-icon.svg">
						      	</div>
						    </div>
						    <div class="form-group col-md-4 px-3">
					    		<label class="font--12 clr--light-gray font-weight-bold">Status</label>
					    		<div class="frm-dropdown">
					    			<div class="dropdown">
									  	<button class="form-control dropdown-toggle " :class="status.styleClass" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >{{ status.name }}</button>
									  	<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
										    <p class="dropdown-item approved" @click="statusChanged(2, 'Approved', 'approved')">Approved</p>
										    <p class="dropdown-item denied" @click="statusChanged(3, 'Denied', 'denied')">Denied</p>
									  	</div>
									</div>
					    		</div>
						    </div>
						    <div class="form-group col-md-4 px-3">
						      	<label class="font--12 clr--light-gray font-weight-bold">Supplier</label>
						      	<input type="text" class="form-control" v-model="poRequest.supplier" disabled>
						    </div>
						    <div class="form-group col-md-4 px-3">
						      	<label class="font--12 clr--light-gray font-weight-bold">Request Amount</label>
						      	<input type="text" class="form-control" v-model="poRequest.request_amount" disabled>
						    </div>
						    <div class="form-group col-md-4 px-3">
						      	<label class="font--12 clr--light-gray font-weight-bold">Transaction Group</label>
						      	<input type="text" class="form-control" v-model="poRequest.transaction_group" disabled>
						    </div>
						    <div class="form-group col-md-4 px-3">
						      	<label class="font--12 clr--light-gray font-weight-bold">Transaction Currency</label>
						      	<input type="text" class="form-control" v-model="poRequest.transaction_currency" disabled>
						    </div>
						    <div class="form-group col-md-4 px-3">
						      	<label class="font--12 clr--light-gray font-weight-bold">Country</label>
						      	<input type="text" class="form-control" v-model="poRequest.country" disabled>
						    </div>
						    <div class="form-group col-md-4 px-3">
						      	<label class="font--12 clr--light-gray font-weight-bold">Exchange Rate</label>
						      	<input type="text" class="form-control" v-model="poRequest.exchange_rate" disabled>
						    </div>
						    <div class="form-group col-md-4 px-3">
						      	<label class="font--12 clr--light-gray font-weight-bold">Program Title</label>
						      	<input type="text" class="form-control" v-model="poRequest.program_title" disabled>
						    </div>
						    <div class="form-group col-md-4 px-3">
						      	<label class="font--12 clr--light-gray font-weight-bold">Purpose</label>
						      	<input type="text" class="form-control" v-model="poRequest.purpose" disabled>
						    </div>
						</div>
				  	</div>
				</div>
			</div>
	
			<div class="col-12">
				<div class="frm-accordion">
					<div id="accordion">
				    	<div class="card">
						  	<h4 data-toggle="collapse" data-parent="#accordion" href="#description" aria-expanded="false" class="card-header">Description</h4>
						  	<div id="description" class="collapse">
						  		<div class="card-body px-2">
						  			<div class="form-group col-12 px-3">
								      	<textarea class="form-control textarea" v-model="poRequest.description" disabled></textarea>
								    </div>
					        	</div>
						  	</div>
						</div>
	
						<div class="card">
						  	<h4 data-toggle="collapse" data-parent="#accordion" href="#objective" aria-expanded="false" class="card-header">Objective</h4>
						  	<div id="objective" class="collapse">
						  		<div class="card-body px-2">
					        		<div class="form-group col-12 px-3">
								      	<textarea class="form-control textarea" v-model="poRequest.objective" disabled></textarea>
								    </div>
					        	</div>
						  	</div>
						</div>

						<div class="card">
						  	<h4 data-toggle="collapse" data-parent="#accordion" href="#scheme" aria-expanded="false" class="card-header">Scheme</h4>
						  	<div id="scheme" class="collapse">
						  		<div class="card-body px-2">
					        		<div class="form-group col-12 px-3">
								      	<textarea class="form-control textarea" v-model="poRequest.scheme" disabled></textarea>
								    </div>
					        	</div>
						  	</div>
						</div>

						<div class="card">
						  	<h4 data-toggle="collapse" data-parent="#accordion" href="#mechanics" aria-expanded="false" class="card-header">Mechanics</h4>
						  	<div id="mechanics" class="collapse">
						  		<div class="card-body px-2">
					        		<div class="form-group col-12 px-3">
								      	<textarea class="form-control textarea" v-model="poRequest.mechanics" disabled></textarea>
								    </div>
					        	</div>
						  	</div>
						</div>

						<div class="card">
						  	<h4 data-toggle="collapse" data-parent="#accordion" href="#additional_notes" aria-expanded="false" class="card-header">Additional Notes</h4>
						  	<div id="additional_notes" class="collapse">
						  		<div class="card-body px-2">
					        		<div class="form-group col-12 px-3">
								      	<textarea class="form-control textarea" v-model="poRequest.additional_notes" disabled></textarea>
								    </div>
					        	</div>
						  	</div>
						</div>

						<div class="card">
						  	<h4 data-toggle="collapse" data-parent="#accordion" href="#additional_instruction" aria-expanded="false" class="card-header">Additional Instructions</h4>
						  	<div id="additional_instruction" class="collapse">
						  		<div class="card-body px-2">
					        		<div class="form-group col-12 px-3">
								      	<textarea class="form-control textarea" v-model="poRequest.additional_instruction" disabled></textarea>
								    </div>
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
				  		<a v-for="file in fileAttached" :href="renderFilePath(file.file_path)" class="d-flex align-items-center font--14 link mb-2" target="_blank">
				  			<img src="images/file-icon.svg" class="mr-2">
						    {{ file.name }}
				  		</a>
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
						      	<input disabled="" type="text" class="form-control" :value="pppData.line_business">
						    </div>
						    <div class="form-group col-md-4 px-3">
					    		<label class="font--12 clr--light-gray font-weight-bold">Brand</label>
						      	<select class="form-control" disabled="">
						      		<option selected="">{{ pppData.name }}</option>
						      	</select>
						    </div>
						    <div class="form-group col-md-4 px-3">
					    		<label class="font--12 clr--light-gray font-weight-bold">PPP Date</label>
					    		<div class="input-with-icon">
						      		<input disabled="" type="text" class="form-control" placeholder="Select date" :value="pppData.date">
						      		<img src="images/calendar-icon.svg">
						      	</div>
						    </div>
						    <div class="form-group col-md-4 px-3">
						      	<label class="font--12 clr--light-gray font-weight-bold">Description</label>
						      	<textarea style="height: 126px" disabled="" placeholder="Sample description" class="form-control textarea">{{ pppData.description }}</textarea>
						    </div>
						    <div class="form-group col-md-4 px-3">
						      	<div class="form-group col-md-12 px-0">
							      	<label class="font--12 clr--light-gray font-weight-bold">PPP Value</label>
							      	<input disabled="" type="text" class="form-control" :value="pppData.ppp_value">
							    </div>
							    <div class="form-group col-md-12 px-0">
							      	<label class="font--12 clr--light-gray font-weight-bold">PPP Current Balance</label>
							      	<input disabled="" type="text" class="form-control" :value="pppData.ppp_current_balance">
							    </div>
						    </div>
						    <div class="form-group col-md-4 px-3">
						      	<div class="form-group col-md-12 px-0">
							      	<label class="font--12 clr--light-gray font-weight-bold">PPP Total Cash</label>
							      	<input disabled="" type="text" class="form-control" :value="pppData.ppp_total_cash">
							    </div>
							    <div class="form-group col-md-12 px-0">
							      	<label class="font--12 clr--light-gray font-weight-bold">PPP Total Balance</label>
							      	<input disabled="" type="text" class="form-control" :value="pppData.ppp_total_balance">
							    </div>
						    </div>
						</div>
				  	</div>
				</div>
			</div>
			<div class="col-12"  v-if="poRequest.status === 3 || poRequest.resubmitted_at">					
				<div class="card">
				  	<h4 class="card-header bg--gray">Reason</h4>
				  	<div class="card-body">
				      	<textarea placeholder="Sample description" class="form-control textarea" v-model="poRequest.reason"></textarea>
				  	</div>
				</div>
			</div>
			<div class="col-12 text-right mt-4" v-if="poRequest.status === 3 && poRequest.denied_at == null ">
				<button class="frm-btn align-r" data-toggle="modal" data-target="#modalValidation" >SUBMIT</button>
			</div>

			<!-- Modal -->
			<div class="modal fade" id="modalValidation" >
			  	<div class="modal-dialog modal-dialog-centered" role="document">
			    	<div class="modal-content">
			      		<div class="modal-body text-center">
			      			<div class="d-flex align-items-center justify-content-center mb-2">
			      				<img src="images/question-mark.svg" class="mr-3">
			      				<h1 class="font-weight-bold" >{{ modal.title }}</h1>
			      			</div>
			      			<p>{{ modal.message }}</p>
			        		<div class="col-12 text-center mt-5">
								<a class="frm-btn btn--gray align-r mr-2"  @click="cancel">Cancel</a>
								<button class="frm-btn align-r" type="submit" data-toggle="modal" @click="update">Proceed</button>
							</div>
			      		</div>
			    	</div>
			  	</div>
			</div>
			</form>
		</div>

		<div class="modal fade" id="modalSuccess">
		  	<div class="modal-dialog modal-dialog-centered" role="document">
		    	<div class="modal-content">
		      		<div class="modal-body text-center">
		      			<div class="d-flex align-items-center justify-content-center mb-2">
		      				<img src="images/check-mark.svg" class="mr-3">
		      				<h1 class="font-weight-bold" >{{ success.title }}</h1>
		      			</div>
		      			<p>{{ success.message }}</p>
		      		</div>
		    	</div>
		  	</div>
		</div>	
	</div>
</template>
<script>
	import ActionButton from 'Components/buttons/SaleRepActionButton.vue';
	import ResponseMixin from 'Mixins/response.js';
	export default {
		props: {
			name: String,
			userImage: {
				default: 'http://placehold.it/64x64',
				type: String
			},
			pppRequests: Array,
			updateUrl: String,
			poRequest: Object,
			fileAttached: Array,
			pppData: {
				default: {},
				type: Object
			},
		},

		mixins: [ ResponseMixin ],

	    components: {
	        'action-button': ActionButton,
	    },

		data() {
			return {
				isDenied: false,

				modal: {},
				success: {},

				status: {
					name: 'Pending',
					styleClass: 'pending'
				},

				attachedFile: [],
				disableSentButton: false,
			}
		},

		mounted() {
			this.init();
		},

		methods: {

			init() {
				$("#description").collapse('hide');
				$("#objective").collapse('hide');
				$("#scheme").collapse('hide');
				$("#mechanics").collapse('hide');
				$("#additional_notes").collapse('hide');
				$("#additional_instruction").collapse('hide');
				switch(this.poRequest.status) {
					case 1:
						this.status.styleClass = 'pending'
						this.status.name = 'Pending'
						this.modal.title = 'Pending Request Status';
						this.modal.message = 'All the changes made will be saved and submitted';
						break;
					case 2:
						this.status.styleClass = 'approved'
						this.status.name = 'Approved'
						this.modal.title = 'Approved Request Status';
						this.modal.message = 'All the changes made will be saved and submitted';
						break;
					default:
						this.status.styleClass = 'denied'
						this.status.name = 'Denied'
						this.modal.title = 'Deny this PO Request';
						this.modal.message = 'All the changes made will be saved and resubmitted';
						break;
				}
			},

			renderFilePath(item) {
				var splittedItems = item.split('public');
				return 'storage'+splittedItems[1];
			},

			statusChanged(id, name, styleClass) {
				this.poRequest.status = id;
				this.status.name = name;
				this.status.styleClass = styleClass;
				this.isDenied = false;
				switch(id) {
					case 1:
						this.modal.title = 'Pending Request Status';
						this.modal.message = 'All the changes made will be saved and submitted';
						break;
					case 2:
						this.modal.title = 'Approved Request Status';
						this.modal.message = 'All the changes made will be saved and submitted';
						break;
					default:
						this.modal.title = 'Deny this PO Request';
						this.modal.message = 'All the changes made will be saved and resubmitted';
						break;
				}
				if(id === 3) {
					this.isDenied = true;
				} 

				if(id != 3) {
					$('#modalValidation').modal('toggle');
				}
			},

			cancel() {
				$('#modalValidation').modal('toggle');
			},

	        update() {
	        	var data = {
	        		status: this.poRequest.status
	        	}

	        	if(this.poRequest.status === 3) {
	        		data = {
		        		status: this.poRequest.status,
		        		reason: this.poRequest.reason
		        	}
	        	}

	        	axios.post(this.updateUrl, data)
	        		.then(response => {
	        			this.success = response.data;
	        			$('#modalValidation').modal('toggle')
	        			$('#modalSuccess').modal('toggle')
	        			setTimeout(() => {
		        			window.location.reload();
	        			}, 2000)
	        		}).catch(error => {
	        			this.parseError(error)
	        		})
	        }
		}
	}
</script>