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
							  			<img :src="userImage" class="img-fit">
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
						      	<input type="text" class="form-control" v-model="payloads.name" disabled>
						    </div>
						    <div class="form-group col-md-4 px-3">
					    		<label class="font--12 clr--light-gray font-weight-bold">Purchase Order Date</label>
						      	<div class="input-with-icon">
						      		<input type="text" class="form-control datepicker" v-model="payloads.po_date" placeholder="Select date" disabled>
						      		<img src="images/calendar-icon.svg">
						      	</div>
						    </div>
						    <div class="form-group col-md-4 px-3">
					    		<label class="font--12 clr--light-gray font-weight-bold">Status</label>
					    		<div class="frm-dropdown">
					    			<div class="dropdown">
									  	<button class="form-control dropdown-toggle " :class="status.styleClass" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ status.name }}</button>
									  	<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
										    <p class="dropdown-item approved" @click="statusChanged(2, 'Approved', 'approved')">Approved</p>
										    <p class="dropdown-item denied" @click="statusChanged(3, 'Denied', 'denied')">Denied</p>
									  	</div>
									</div>
					    		</div>
						    </div>
						    <div class="form-group col-md-4 px-3">
						      	<label class="font--12 clr--light-gray font-weight-bold">Supplier</label>
						      	<input type="text" class="form-control" v-model="payloads.supplier" disabled>
						    </div>
						    <div class="form-group col-md-4 px-3">
						      	<label class="font--12 clr--light-gray font-weight-bold">Request Amount</label>
						      	<input type="text" class="form-control" v-model="payloads.request_amount" disabled>
						    </div>
						    <div class="form-group col-md-4 px-3">
						      	<label class="font--12 clr--light-gray font-weight-bold">Transaction Group</label>
						      	<input disabled type="text" class="form-control" v-model="payloads.transaction_group">
						    </div>
						    <div class="form-group col-md-4 px-3">
						      	<label class="font--12 clr--light-gray font-weight-bold">Transaction Currency</label>
						      	<input disabled type="text" class="form-control" v-model="payloads.transaction_currency">
						    </div>
						    <div class="form-group col-md-4 px-3">
						      	<label class="font--12 clr--light-gray font-weight-bold">Country</label>
						      	<input disabled type="text" class="form-control">
						    </div>
						    <div class="form-group col-md-4 px-3">
						      	<label class="font--12 clr--light-gray font-weight-bold">Exchange Rate</label>
						      	<input disabled type="text" class="form-control" v-model="payloads.exchange_rate">
						    </div>
						    <div class="form-group col-md-4 px-3">
						      	<label class="font--12 clr--light-gray font-weight-bold">Program Title</label>
						      	<input disabled type="text" class="form-control" v-model="payloads.program_title">
						    </div>
						    <div class="form-group col-md-4 px-3">
						      	<label class="font--12 clr--light-gray font-weight-bold">Purpose</label>
						      	<input disabled type="text" class="form-control" v-model="payloads.purpose">
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
								      	<textarea class="form-control textarea" v-model="payloads.description" disabled></textarea>
								    </div>
					        	</div>
						  	</div>
						</div>
	
						<div class="card">
						  	<h4 data-toggle="collapse" data-parent="#accordion" href="#objective" aria-expanded="false" class="card-header">Objective</h4>
						  	<div id="objective" class="collapse">
						  		<div class="card-body px-2">
					        		<div class="form-group col-12 px-3">
								      	<textarea class="form-control textarea" v-model="payloads.objective" disabled></textarea>
								    </div>
					        	</div>
						  	</div>
						</div>

						<div class="card">
						  	<h4 data-toggle="collapse" data-parent="#accordion" href="#scheme" aria-expanded="false" class="card-header">Scheme</h4>
						  	<div id="scheme" class="collapse">
						  		<div class="card-body px-2">
					        		<div class="form-group col-12 px-3">
								      	<textarea class="form-control textarea" v-model="payloads.scheme" disabled></textarea>
								    </div>
					        	</div>
						  	</div>
						</div>

						<div class="card">
						  	<h4 data-toggle="collapse" data-parent="#accordion" href="#mechanics" aria-expanded="false" class="card-header">Mechanics</h4>
						  	<div id="mechanics" class="collapse">
						  		<div class="card-body px-2">
					        		<div class="form-group col-12 px-3">
								      	<textarea class="form-control textarea" v-model="payloads.mechanics" disabled></textarea>
								    </div>
					        	</div>
						  	</div>
						</div>

						<div class="card">
						  	<h4 data-toggle="collapse" data-parent="#accordion" href="#additional_notes" aria-expanded="false" class="card-header">Additional Notes</h4>
						  	<div id="additional_notes" class="collapse">
						  		<div class="card-body px-2">
					        		<div class="form-group col-12 px-3">
								      	<textarea class="form-control textarea" v-model="payloads.additional_notes" disabled></textarea>
								    </div>
					        	</div>
						  	</div>
						</div>

						<div class="card">
						  	<h4 data-toggle="collapse" data-parent="#accordion" href="#additional_instruction" aria-expanded="false" class="card-header">Additional Instructions</h4>
						  	<div id="additional_instruction" class="collapse">
						  		<div class="card-body px-2">
					        		<div class="form-group col-12 px-3">
								      	<textarea class="form-control textarea" v-model="payloads.additional_instruction" disabled></textarea>
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
				  		<a v-if="!hideFiles" v-for="file in fileAttached" :href="renderFilePath(file.file_path)" class="d-flex align-items-center font--14 link mb-2" target="_blank">
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
			<div class="col-12"  v-if="payloads.status === 3">					
				<div class="card">
				  	<h4 class="card-header bg--gray">Reason</h4>
				  	<div class="card-body">
				      	<textarea placeholder="Sample description" class="form-control textarea" v-model="payloads.reason"></textarea>
				  	</div>
				</div>
			</div>
			<div class="col-12 text-right mt-3 px-0"  v-if="payloads.can_approved">
				<a class="frm-btn btn--gray align-r mr-2">Cancel</a>
				<button class="frm-btn align-r" type="button" data-toggle="modal" data-target="#modalValidation" style="width: 18%" v-if="!isDenied">{{ payloads.text.btn }}</button>
				<button class="frm-btn align-r" type="button" data-toggle="modal" data-target="#modalValidation" style="width: 18%" v-if="isDenied">{{ denied.btn }}</button>
			</div>

			<!-- Modal -->
			<div class="modal fade" id="modalValidation" >
			  	<div class="modal-dialog modal-dialog-centered" role="document">
			    	<div class="modal-content">
			      		<div class="modal-body text-center">
			      			<div class="d-flex align-items-center justify-content-center mb-2">
			      				<img src="images/question-mark.svg" class="mr-3">
			      				<h1 class="font-weight-bold" v-if="!isDenied">{{ payloads.text.modal_title }}</h1>
			      				<h1 class="font-weight-bold" v-if="isDenied">{{ denied.modal_title }}</h1>
			      			</div>
			      			<p v-if="!isDenied">{{ payloads.text.modal_message }}</p>
			      			<p v-if="isDenied">{{ denied.modal_message }}</p>
			        		<div class="col-12 text-center mt-5">
								<a class="frm-btn btn--gray align-r mr-2"  @click="cancel">Cancel</a>
								<button class="frm-btn align-r" type="submit">Proceed</button>
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
		      				<h1 class="font-weight-bold" v-if="!isDenied">{{ payloads.text.success_title }}</h1>
		      				<h1 class="font-weight-bold" v-if="isDenied">{{ denied.success_title }}</h1>
		      			</div>
		      			<p v-if="!isDenied">{{ payloads.text.success_message }}</p>
		      			<p v-if="isDenied">{{ denied.success_message }}</p>
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
			}
		},

		mixins: [ ResponseMixin ],

	    components: {
	        'action-button': ActionButton,
	    },

		data() {
			return {
				payloads: {
					status: 1,
					text: {
						modal_title: null
					}
				},
				isDenied: false,
				denied: {
					success_title: 'Successfully denied',
					success_message: 'The PO was succcessfully denied',
					modal_title: 'Update this PO to Denied',
					modal_message: 'The details stated in the PO will be set to denied. This action cannot be undo once done',
					btn: 'Denied PO'
				},

				status: {
					name: 'Pending',
					styleClass: 'pending'
				},
				attachedFile: [],
				hideFiles: true,
				disableSentButton: false,
			}
		},

		mounted() {
			$("#description").collapse('hide');
			$("#objective").collapse('hide');
			$("#scheme").collapse('hide');
			$("#mechanics").collapse('hide');
			$("#additional_notes").collapse('hide');
			$("#additional_instruction").collapse('hide');
			this.init();
			$('.datepicker').flatpickr({
				minDate: 'today'
			})
		},

		methods: {
			sync() {
				window.location.reload();
			},

			init() {
				this.payloads = this.poRequest ? this.poRequest : [];
				this.hideFiles = this.fileAttached ? false : true;
				
				if(!_.isEmpty(this.poRequest)) {
					switch(this.poRequest.status) {
						case 1:
							this.statusChanged(1, 'Pending', 'pending')
							break;
						case 2:
							this.statusChanged(2, 'Approved', 'approved')
							break;
						default:
							this.statusChanged(3, 'Denied', 'denied')
							break;
					}
				}
			},

			renderFilePath(item) {
				var splittedItems = item.split('public');
				return 'storage'+splittedItems[1];
			},

			statusChanged(id, name, styleClass) {
				this.payloads.status = id;
				this.status.name = name;
				this.status.styleClass = styleClass;
				this.isDenied = false;

				if(id === 3) {
					this.isDenied = true;
				} 
			},

			cancel() {
				$('#modalValidation').modal('toggle');
			},

	        updateRequest() {
	        	var data = {
	        		status: this.payloads.status
	        	}

	        	if(this.payloads.status === 3) {
	        		data = {
		        		status: this.payloads.status,
		        		reason: this.payloads.reason
	        		}
	        	}

	        	axios.post(this.updateUrl, data)
	        		.then(response => {
	        			$("#modalSuccess").modal('toggle')
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