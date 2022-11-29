<template>
	<div>
		<div class="row no-gutters">
			<div class="col-12">
			    <div class="form-group col-md-4 px-3">
		    		<label class="font--12 clr--light-gray font-weight-bold">Status</label>
		    		<div class="frm-dropdown">
		    			<div class="dropdown">
						  	<button class="form-control dropdown-toggle " :class="status.styleClass" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ status.name }}</button>
						  	<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
							    <p class="dropdown-item pending" @click="statusChanged(1, 'Pending', 'pending'); showModal()">Pending</p>
							    <p class="dropdown-item approved" @click="statusChanged(2, 'Approved', 'approved'); showModal()">Approved</p>
							    <p class="dropdown-item denied" @click="statusChanged(3, 'Denied', 'denied');">Denied</p>
						  	</div>
						</div>
		    		</div>
			    </div>
				<div class="col-12" id="reason"  v-if="item.status === 3">					
					<div class="card">
					  	<h4 class="card-header bg-green ">Reason</h4>
					  	<div class="card-body">
					      	<textarea placeholder="Sample description" name="reason" class="form-control textarea" v-model="item.reason"></textarea>
					  	</div>
						<button class="frm-btn align-r" data-toggle="modal" data-target="#modalValidation" v-if="show && item.status">SUBMIT</button>
					</div>
				</div>
				<div class="col-12 text-right mt-4" v-if="item.status === 3">
				</div>
				<div class="card">
				  	<h4 class="card-header bg-green ">PPP Request Details</h4>
				  	<div class="card-body py-4 px-2">
			    		<div class="form-row">
							
			    			<div class="form-group col-md-12 px-3">
							    <div class="form-group col-4 px-0">
						    		<label class="font--12 clr--light-gray font-weight-bold">Budget</label>
							      	<input type="text" class="form-control" placeholder="Name" v-model="item.budget_name" disabled>
							    </div>
							</div>

						    <div class="form-group col-md-4 px-3">
						      	<div class="form-group col-12 px-0">
							      	<label class="font--12 clr--light-gray font-weight-bold">PPP Name</label>
							      	<input type="text" class="form-control" placeholder="Name" v-model="item.name" disabled>
							    </div>
							    <div class="form-group col-12 px-0">
							      	<label class="font--12 clr--light-gray font-weight-bold">Line of Business</label>
							      	<input type="text" class="form-control" placeholder="Name" v-model="item.line_business" disabled>
							    </div>
							    <div class="form-group col-12 px-0">
						    		<label class="font--12 clr--light-gray font-weight-bold">Description</label>
						    		<textarea class="form-control textarea" placeholder="type here" v-model="item.description" disabled></textarea>
							    </div>
						    </div>
						    <div class="form-group col-md-4 px-3">
					    		<div class="form-group col-12 px-0">
						    		<label class="font--12 clr--light-gray font-weight-bold">Date Period</label>
							      	<div class="input-with-icon">
							      		<input type="text" class="form-control datepicker" placeholder="Select dates" v-model="item.period" disabled>
							      	</div>
							    </div>
							    <div class="form-group col-12 px-0">
						    		<label class="font--12 clr--light-gray font-weight-bold">Brand</label>
							      	<input type="text" class="form-control" placeholder="Name" v-model="item.product_name" disabled>
							    </div>
							    <div class="form-group col-12 px-0">
							      	<label class="font--12 clr--light-gray font-weight-bold">Amount</label>
							      	<input type="number" class="form-control" placeholder="Name" v-model="item.requested_amount" disabled>
							    </div>
						    </div>
						    <div class="form-group col-md-4 px-3">
					    		<div class="form-group col-12 px-0">
							      	<label class="font--12 clr--light-gray font-weight-bold">Attachments</label>
					      	      	<a v-for="attachment in item.attachments" :href="attachment.file_path" class="d-flex align-items-center font--14 link mb-2" target="_blank">
					      	  			<img src="images/file-icon.svg" class="mr-2">
					      			    {{ attachment.name }}
					      	  		</a>
							    </div>
						    </div>
						</div>
				  	</div>
				</div>
			</div>
		</div>
		<div class="modal fade" id="modalValidation" >
		  	<div class="modal-dialog modal-dialog-centered" role="document">
		    	<div class="modal-content">
		      		<div class="modal-body text-center">
		      			<div class="d-flex align-items-center justify-content-center mb-2">
		      				<img src="images/question-mark.svg" class="mr-3">
		      				<h1 class="font-weight-bold">{{ modal.title }}</h1>
		      			</div>
		      			<p>{{ modal.body }}</p>
		        		<div class="col-12 text-center mt-5">
							<a class="frm-btn btn--gray align-r mr-2" @click="close">Cancel</a>
							<!-- data-target="#modalSuccess" -->
							<button class="frm-btn align-r" data-toggle="modal" @click="update">Proceed</button>
						</div>
		      		</div>
		    	</div>
		  	</div>
		</div>
		<div class="modal fade" id="modalSuccess">
		  	<div class="modal-dialog modal-dialog-centered" role="document">
		    	<div class="modal-content">
		      		<div class="modal-body text-center">
		      			<div class="d-flex align-items-center justify-content-center mb-2">
		      				<img src="images/check-mark.svg" class="mr-3">
		      				<h1 class="font-weight-bold">{{ response.title }}</h1>
		      			</div>
		      			<p>{{ response.message }}</p>
		      		</div>
		    	</div>
		  	</div>
		</div>
	</div>
</template>
<script>
	import Response from 'Mixins/response.js';

	export default {
		props: {
			storeUrl: String,
			item: Object,
		},

		mixins: [ Response ],

		data() {
			return {
				modal: {
					title: 'Create New PPP Budget',
					body: 'Are you sure you want to add this ppp budget in the current record'
				},

				response: {},
				show: true,

				status: {
					statusClass: 'pending',
					name: 'Pending'
				}
			}
		},

		mounted() {
			this.init();
		},

		methods: {

			init() {
				switch(this.item.status) {
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
			},

			close() {
				$('#modalValidation').modal('toggle');
			},

			update() {
				var data = {
					status: this.item.status,
				}

				if(this.item.status === 3) {
					data = {
						status: this.item.status,
						reason: this.item.reason
					}
				}

				axios.post(this.storeUrl, data)
					.then(response => {
						this.response = response.data;
						$('#modalSuccess').modal('toggle');
						$('#modalValidation').modal('toggle');
						this.show = false;

	        			setTimeout(() => {
	        				window.location.reload()
	        			}, 1000)
					}).catch(error => {
						this.parseError(error)
					})
			},

			statusChanged(id, name, styleClass) {
				this.item.status = id;
				this.status.name = name;
				this.status.styleClass = styleClass;

				switch(id) {
					case 1:
						this.modal.title = 'Pending Request Status';
						this.modal.body = 'All the changes made will be saved and resubmitted';
						break;
					case 2:
						this.modal.title = 'Approved Request Status';
						this.modal.body = 'All the changes made will be saved and approved';
						break;
					default:
						this.modal.title = 'Deny this PPP Budget';
						this.modal.body = 'The details stated in the PPP will be send to Admin. This action cannot be undo once done.';

						// this.modal.body = 'The details stated in the PPP will be send to Admin. This action cannot be undo once done.';
						break;
				}
			},

			showModal() {
				$('#modalValidation').modal('toggle');
			}
		}
	}
</script>