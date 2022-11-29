<template>
	<div>
		<div class="row no-gutters">
			<form @submit.prevent="sendRequest">
			<div class="col-12 px-0">
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
					  		<div class="col-md-4 px-0">
						      	<label class="font--12 clr--light-gray font-weight-bold">PPP Name</label>
						      	<select class="form-control" v-model="payloads.ppp_request_id">
						      		<option v-for="ppp in pppRequests" :value="ppp.id">{{ ppp.name }}</option>
						      	</select>
					  		</div>
				  		</div>
				  	</div>
				</div>
			</div>
			<div class="col-12 px-0">
				<div class="card">
				  	<h4 class="card-header bg--gray">Details</h4>
				  	<div class="card-body py-4 px-2">
			    		<div class="form-row">
						    <div class="form-group col-md-4 px-3">
						      	<label class="font--12 clr--light-gray font-weight-bold">Purchase Order Name</label>
						      	<input type="text" class="form-control" v-model="payloads.name">
						    </div>
						    <div class="form-group col-md-4 px-3">
					    		<label class="font--12 clr--light-gray font-weight-bold">Purchase Order Date</label>
						      	<div class="input-with-icon">
						      		<input type="text" class="form-control datepicker" v-model="payloads.po_date" placeholder="Select date">
						      		<img src="images/calendar-icon.svg">
						      	</div>
						    </div>
						    <div class="form-group col-md-4 px-3">
					    		<label class="font--12 clr--light-gray font-weight-bold">Status</label>
					    		<div class="frm-dropdown">
					    			<div class="dropdown">
									  	<button class="form-control dropdown-toggle" :class="status.styleClass" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ status.name }}</button>
									  	<!-- <div class="dropdown-menu" aria-labelledby="dropdownMenuButton"> -->
										    <!-- <p class="dropdown-item pending" @click="statusChanged(1, 'Pending', 'pending')">Pending</p> -->
										    <!-- <p class="dropdown-item approved" @click="statusChanged(2, 'Approved', 'approved')">Approved</p>
										    <p class="dropdown-item denied" @click="statusChanged(3, 'Denied', 'denied')">Denied</p> -->
									  	<!-- </div> -->
									</div>
					    		</div>
						    </div>
						    <div class="form-group col-md-4 px-3">
						      	<label class="font--12 clr--light-gray font-weight-bold">Supplier</label>
						      	<input type="text" class="form-control" v-model="payloads.supplier">
						    </div>
						    <div class="form-group col-md-4 px-3">
						      	<label class="font--12 clr--light-gray font-weight-bold">Request Amount</label>
						      	<input type="text" placeholder="Enter Amount" class="form-control" v-model="payloads.request_amount" @keyup="addComma">
						    </div>
						    <div class="form-group col-md-4 px-3">
						      	<label class="font--12 clr--light-gray font-weight-bold">Transaction Group</label>
						      	<input type="text" class="form-control" v-model="payloads.transaction_group">
						    </div>
						    <div class="form-group col-md-4 px-3">
						      	<label class="font--12 clr--light-gray font-weight-bold">Transaction Currency</label>
						      	<input type="text" class="form-control" v-model="payloads.transaction_currency">
						    </div>
						    <div class="form-group col-md-4 px-3">
						      	<label class="font--12 clr--light-gray font-weight-bold">Country</label>
						      	<input type="text" class="form-control" v-model="payloads.country">
						    </div>
						    <div class="form-group col-md-4 px-3">
						      	<label class="font--12 clr--light-gray font-weight-bold">Exchange Rate</label>
						      	<input type="text" class="form-control" v-model="payloads.exchange_rate" @keyup="addCommaER">
						    </div>
						    <div class="form-group col-md-4 px-3">
						      	<label class="font--12 clr--light-gray font-weight-bold">Program Title</label>
						      	<input type="text" class="form-control" v-model="payloads.program_title">
						    </div>
						    <div class="form-group col-md-4 px-3">
						      	<label class="font--12 clr--light-gray font-weight-bold">Purpose</label>
						      	<input type="text" class="form-control" v-model="payloads.purpose">
						    </div>
						</div>
				  	</div>
				</div>
			</div>
	
			<div class="col-12 px-0">
				<div class="frm-accordion">
					<div id="accordion">
				    	<div class="card">
						  	<h4 data-toggle="collapse" data-parent="#accordion" href="#description" aria-expanded="false" class="card-header">Description</h4>
						  	<div id="description" class="collapse">
						  		<div class="card-body px-2">
						  			<div class="form-group col-12 px-3">
								      	<textarea class="form-control textarea" v-model="payloads.description"></textarea>
								    </div>
					        	</div>
						  	</div>
						</div>
	
						<div class="card">
						  	<h4 data-toggle="collapse" data-parent="#accordion" href="#objective" aria-expanded="false" class="card-header">Objective</h4>
						  	<div id="objective" class="collapse">
						  		<div class="card-body px-2">
					        		<div class="form-group col-12 px-3">
								      	<textarea class="form-control textarea" v-model="payloads.objective"></textarea>
								    </div>
					        	</div>
						  	</div>
						</div>

						<div class="card">
						  	<h4 data-toggle="collapse" data-parent="#accordion" href="#scheme" aria-expanded="false" class="card-header">Scheme</h4>
						  	<div id="scheme" class="collapse">
						  		<div class="card-body px-2">
					        		<div class="form-group col-12 px-3">
								      	<textarea class="form-control textarea" v-model="payloads.scheme"></textarea>
								    </div>
					        	</div>
						  	</div>
						</div>

						<div class="card">
						  	<h4 data-toggle="collapse" data-parent="#accordion" href="#mechanics" aria-expanded="false" class="card-header">Mechanics</h4>
						  	<div id="mechanics" class="collapse">
						  		<div class="card-body px-2">
					        		<div class="form-group col-12 px-3">
								      	<textarea class="form-control textarea" v-model="payloads.mechanics"></textarea>
								    </div>
					        	</div>
						  	</div>
						</div>

						<div class="card">
						  	<h4 data-toggle="collapse" data-parent="#accordion" href="#additional_notes" aria-expanded="false" class="card-header">Additional Notes</h4>
						  	<div id="additional_notes" class="collapse">
						  		<div class="card-body px-2">
					        		<div class="form-group col-12 px-3">
								      	<textarea class="form-control textarea" v-model="payloads.additional_notes"></textarea>
								    </div>
					        	</div>
						  	</div>
						</div>

						<div class="card">
						  	<h4 data-toggle="collapse" data-parent="#accordion" href="#additional_instruction" aria-expanded="false" class="card-header">Additional Instructions</h4>
						  	<div id="additional_instruction" class="collapse">
						  		<div class="card-body px-2">
					        		<div class="form-group col-12 px-3">
								      	<textarea class="form-control textarea" v-model="payloads.additional_instruction"></textarea>
								    </div>
					        	</div>
						  	</div>
						</div>
						
					</div>
				</div>
	
			</div>
			<div class="col-12 px-0">					
				<div class="card">
				  	<h4 class="card-header bg--gray">Attachments</h4>
				  	<div class="card-body">
				  		<a href="" class="d-flex align-items-center font--14 link mb-2" v-if="!hideFiles" v-for="file in attachedFile">
				  			<img src="images/file-icon.svg" class="mr-2">
						    {{ file }}
				  		</a>
				  		<input type="file" class="font--14" id="files" @change="fileChanged" multiple>
				  	</div>
				</div>
			</div>
			
			<div class="col-12 text-right mt-3 px-0" v-if="showButtons">
				<button class="frm-btn btn--gray align-r mr-2">Cancel</button>
				<button class="frm-btn align-r" type="button" data-toggle="modal" data-target="#modalValidation">Create</button>
			</div>

			<!-- Modal -->
			<div class="modal fade" id="modalValidation" v-if="showButtons">
			  	<div class="modal-dialog modal-dialog-centered" role="document">
			    	<div class="modal-content">
			      		<div class="modal-body text-center">
			      			<div class="d-flex align-items-center justify-content-center mb-2">
			      				<img src="images/question-mark.svg" class="mr-3">
			      				<h1 class="font-weight-bold">Create Purchase Order</h1>
			      			</div>
			      			<p>Are you sure you want to add this new PO to the record</p>
			        		<div class="col-12 text-center mt-5">
								<button class="frm-btn btn--gray align-r mr-2" @click="cancel">Cancel</button>
								<button class="frm-btn align-r" type="submit" data-toggle="modal">Proceed</button>
							</div>
			      		</div>
			    	</div>
			  	</div>
			</div>
			</form>
			<div class="col-12" v-if="!showButtons">					
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
			<div class="col-12"  v-if="!showButtons && payloads.resubmitted_at || payloads.denied_at">					
				<div class="card">
				  	<h4 class="card-header bg--gray">Reason</h4>
				  	<div class="card-body">
				      	<textarea placeholder="Sample description" class="form-control textarea" v-model="payloads.reason" disabled></textarea>
				  	</div>
				</div>
			</div>
		</div>	
		

		
		<div class="col-12 text-right mt-3 px-0" v-if="!showButtons">
			<action-button
			v-if="!showButtons"
			:iconVisibility="false"
			small 
			color="frm-btn align-r btn--red"
			alt-color="frm-btn align-r bg--gray"
			:show-alt="payloads.deleted_at"
			:action-url="payloads.archiveUrl"
			:alt-action-url="payloads.restoreUrl"
			icon=""
			alt-icon=""
			confirm-dialog
			label="Archive"
			alt-label="Restore"
			title="Archive"
			alt-title="Restore"
			:message="'Are you sure you want to archive PO Request with ID ' + payloads.number + '?'"
			:alt-message="'Are you sure you want to restore PO Request with ID ' + payloads.number + '?'"
			@success="sync"
			></action-button>

      		<a href="/sales/po-request" class="frm-btn align-r btn--action bg--gray btn" v-if="!showButtons && payloads.denied_at">CANCEL</a>


	      	<a :href="payloads.download_url" class="frm-btn align-r btn--action bg--gray btn" v-if="payloads.super_admin_approved_at"> Download PO </a>


			<action-button
			v-if="!showButtons && payloads.can_resubmit"
			:disabled="disableSentButton"
			:iconVisibility="false"
			small 
			color="frm-btn align-r bg--gray"
			alt-color="frm-btn align-r bg--gray"
			icon=""
			alt-icon=""
			confirm-dialog
			label="Resubmit"
			title="Resubmit"
			:message="'Are you sure you want to resubmit this PO Request with ID ' + payloads.number + '?'"
			@success="updateDeniedRequest()"
			></action-button>
			<!-- <button class="frm-btn align-r btn--red">Archive</button> -->
		</div>

		<loading :active.sync="isLoading" 
		 :is-full-page="true"
		 color="#47c94d"
		 ></loading>
	</div>
</template>
<script>
	import ActionButton from 'Components/buttons/SaleRepActionButton.vue';
	import ResponseMixin from 'Mixins/response.js';
	import Loading from 'vue-loading-overlay';
	export default {
		props: {
			name: String,
			userImage: {
				default: 'http://placehold.it/64x64',
				type: String
			},
			pppRequests: Array,
			storeUrl: String,
			poRequest: Object,
			fileAttached: Array,
			showButtons: Boolean,
			pppData: {
				default: {},
				type: Object
			}
		},

		mixins: [ ResponseMixin ],

	    components: {
	        'action-button': ActionButton,
	        Loading
	    },
	    
		data() {
			return {
				isLoading: false,
				payloads: {},

				ppp: {
					total_balance: 0
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
			this.init();
			this.statusChanged(1, 'Pending', 'pending')
			$('.datepicker').flatpickr({
				minDate: 'today'
			})

			$("#description").collapse('hide');
			$("#objective").collapse('hide');
			$("#scheme").collapse('hide');
			$("#mechanics").collapse('hide');
			$("#additional_notes").collapse('hide');
			$("#additional_instruction").collapse('hide');
		},

		watch: {
			'payloads.ppp_request_id'(val) {
				_.each(this.pppRequests, (ppp) => {
					if(val === ppp.id) {
						this.ppp = ppp;
					}
				})
			}
		},

		methods: {

			addComma(ev) {
				if(ev.which >= 37 && ev.which <= 40) return;

			  	this.payloads.request_amount = this.payloads.request_amount.replace(/\D/g, '')
                         													.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
			},

			addCommaER(ev) {
				if(ev.which >= 37 && ev.which <= 40) return;

			  	this.payloads.exchange_rate = this.payloads.exchange_rate.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
			},

			sync() {
				window.location.reload();
			},

			init() {
				this.payloads = this.poRequest ? this.poRequest : this.payloads;
				this.ppp = this.pppData ? this.pppData : { total_balance: 0 };
				this.hideFiles = this.fileAttached ? false : true;

				if(!_.isEmpty(this.payloads)) {
					this.payloads.request_amount = this.payloads.request_amount.replace('.00','');
					this.payloads.request_amount = this.payloads.request_amount.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
					this.payloads.exchange_rate = this.payloads.exchange_rate.replace('.00','');
					this.payloads.exchange_rate = this.payloads.exchange_rate.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
				}

				if(!_.isEmpty(this.poRequest)) {
					switch(this.poRequest.status) {
						case 1:
							this.statusChanged(1, 'Pending', 'pending')
							this.status.styleClass = 'Pending'
							this.status.name = 'pending'
							break;
						case 2:
							this.statusChanged(2, 'Approved', 'approved')
							this.status.styleClass = 'Approved'
							this.status.name = 'approved'
							break;
						default:
							this.statusChanged(3, 'Denied', 'denied')
							this.status.styleClass = 'Denied'
							this.status.name = 'denied'
							break;
					}
				}
				if(!_.isEmpty(this.fileAttached)) {
					_.each(this.fileAttached, (file) => {
						this.attachedFile.push(file.name);
					})
				}
			},

			statusChanged(id, name, styleClass) {
				this.payloads.status = id;
				this.status.name = name;
				this.status.styleClass = styleClass;
			},

			cancel() {
				$('#modalValidation').modal('toggle');
			},

			fileChanged(e) {

				var fileInput = document.getElementById('files');   
				var filename = fileInput.files[0].name;
				_.each(fileInput.files, (file) => {
					this.attachedFile.push(file.name)
				});

	            var files = e.target.files || e.dataTransfer.files;

	            if(!files.length)
	                return;

	            this.payloads.files = files;

		        this.hideFiles = false
	        },

	        updateDeniedRequest() {
	        	if(!_.isEmpty(this.poRequest)) {
	        		this.disableSentButton = true;
	        		var payloads = new FormData();

		        	payloads.append('ppp_request_id', this.payloads.ppp_request_id)
		        	payloads.append('country', this.payloads.country)
		        	payloads.append('name', this.payloads.name)
		        	payloads.append('po_date', this.payloads.po_date)
		        	payloads.append('program_title', this.payloads.program_title)
		        	payloads.append('purpose', this.payloads.purpose)
		        	payloads.append('request_amount', this.payloads.request_amount.replace(/,/g,''))
		        	payloads.append('transaction_currency', this.payloads.transaction_currency)
		        	payloads.append('transaction_group', this.payloads.transaction_group)
		        	payloads.append('exchange_rate', this.payloads.exchange_rate.replace(/,/g,''))
		        	payloads.append('supplier', this.payloads.supplier)
		        	payloads.append('status', this.payloads.status)
		        	
		        	payloads.append('description', this.payloads.description)
		        	payloads.append('objective', this.payloads.objective)
		        	payloads.append('scheme', this.payloads.scheme)
		        	payloads.append('mechanics', this.payloads.mechanics)
		        	payloads.append('additional_notes', this.payloads.additional_notes)
		        	payloads.append('additional_instruction', this.payloads.additional_instruction)

	        	if(this.payloads.files) {
	        		for( var i = 0; i < this.payloads.files.length; i++ ){
				        let file = this.payloads.files[i];
				        payloads.append('files[' + i + ']', file);
				    }
	        	}
	        		axios.post(this.poRequest.resubmitUrl, payloads)
	        			.then(response => {
	        				var options = { fade : true }
	        				this.runToastr(response.data.message, 'Success', 'success', options);
	        				setTimeout(() => {
		        				this.sync();
		        			}, 2000)
	        			}).catch(error => {
			        		this.disableSentButton = false;
	        				this.parseError(error)
	        			})
	        	}
	        },

	        sendRequest() {
	        	this.isLoading = true;
	        	var payloads = new FormData();

	        	payloads.append('ppp_request_id', this.payloads.ppp_request_id)
	        	payloads.append('country', this.payloads.country)
	        	payloads.append('name', this.payloads.name)
	        	payloads.append('po_date', this.payloads.po_date)
	        	payloads.append('program_title', this.payloads.program_title)
	        	payloads.append('purpose', this.payloads.purpose)
	        	payloads.append('request_amount', this.payloads.request_amount)
	        	payloads.append('transaction_currency', this.payloads.transaction_currency)
	        	payloads.append('transaction_group', this.payloads.transaction_group)
	        	payloads.append('exchange_rate', this.payloads.exchange_rate)
	        	payloads.append('supplier', this.payloads.supplier)
	        	payloads.append('status', this.payloads.status)
	        	
	        	payloads.append('description', this.payloads.description)
	        	payloads.append('objective', this.payloads.objective)
	        	payloads.append('scheme', this.payloads.scheme)
	        	payloads.append('mechanics', this.payloads.mechanics)
	        	payloads.append('additional_notes', this.payloads.additional_notes)
	        	payloads.append('additional_instruction', this.payloads.additional_instruction)

	        	if(this.payloads.files) {
	        		for( var i = 0; i < this.payloads.files.length; i++ ){
				        let file = this.payloads.files[i];
				        payloads.append('files[' + i + ']', file);
				    }
	        	}
	        	$('#modalValidation').modal('toggle');
	        	axios.post(this.storeUrl, payloads)
	        		.then(response => {
        				var options = { fade : true }
        				this.runToastr(response.data.message, 'Success', 'success', options);
	        			setTimeout(() => {
		        			window.location.href = 'sales/po-request'
	        			}, 2000)
			        	this.isLoading = false;
	        		}).catch(error => {
	        			this.parseError(error)
			        	this.isLoading = false;
	        		})
	        }
		}
	}
</script>
