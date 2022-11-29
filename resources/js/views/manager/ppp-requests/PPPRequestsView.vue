<template>
	<div>
		<div class="row no-gutters">
			<div class="col-12">
				<div class="card">
				  	<h4 class="card-header bg--gray">Details</h4>
				  	<div class="card-body py-4 px-2">
			    		<div class="form-row">

						    <div class="form-group col-md-4 px-3">
						      	<div class="form-group col-12 px-0">
							      	<label class="font--12 clr--light-gray font-weight-bold">PPP Name</label>
							      	<input type="text" class="form-control" placeholder="Name" v-model="payloads.name" :disabled="!payloads.denied_at  && item != undefined">
							    </div>
							    <div class="form-group col-12 px-0">
							      	<label class="font--12 clr--light-gray font-weight-bold">Line of Business</label>
							      	<input :disabled="!payloads.denied_at  && item != undefined" type="text" class="form-control" placeholder="Name" v-model="payloads.line_business">
							    </div>
							    <div class="form-group col-12 px-0">
						    		<label class="font--12 clr--light-gray font-weight-bold">Description</label>
						    		<textarea :disabled="!payloads.denied_at  && item != undefined" class="form-control textarea" placeholder="type here" v-model="payloads.description"></textarea>
							    </div>
						    </div>
						    <div class="form-group col-md-4 px-3">
					    		<div class="form-group col-12 px-0">
						    		<label class="font--12 clr--light-gray font-weight-bold">Date Period</label>
							      	<div class="input-with-icon">
							      		
							      		<input :disabled="!payloads.denied_at  && item != undefined" type="text" class="form-control datepicker" placeholder="Select dates" v-model="payloads.period">
							      		<img src="images/calendar-icon.svg">
							      	</div>
							    </div>
							    <div class="form-group col-12 px-0">
						    		<label class="font--12 clr--light-gray font-weight-bold">Brand</label>
						    		<select class="form-control" v-model="payloads.product_id" :disabled="!payloads.denied_at  && item != undefined">
						    			<option v-for="product in products" :value="product.id"> {{ product.name }} </option>
						    		</select>
							    </div>
							    <div class="form-group col-12 px-0">
							      	<label class="font--12 clr--light-gray font-weight-bold">Amount</label>
							      	<input :disabled="!payloads.denied_at  && item != undefined" type="text" class="form-control" placeholder="Name" v-model="payloads.requested_amount" @keyup="addComma">
							    </div>
						    </div>
						    <div class="form-group col-md-4 px-3">
						    	<div class="form-group col-12 px-0">
						    		<label class="font--12 clr--light-gray font-weight-bold">Budget</label>
						    		<select class="form-control" v-model="payloads.budget_id" :disabled="!payloads.denied_at  && item != undefined">
						    			<option v-for="budget in budgets" :value="budget.id"> {{ budget.name }} </option>
						    		</select>
							    </div>
					    		<div class="form-group col-12 px-0">
							      	<label class="font--12 clr--light-gray font-weight-bold">Attachments</label>
							      	<input :disabled="!payloads.denied_at  && item != undefined" type="file" class="font--14" id="files" multiple @change="fileChanged">
					      	      	<a v-if="!canEdit" v-for="attachment in payloads.attachments" :href="attachment.file_path" class="d-flex align-items-center font--14 link mb-2" target="_blank">
					      	  			<img src="images/file-icon.svg" class="mr-2">
					      			    {{ attachment.name }}
					      	  		</a>
							    </div>
						    </div>
						</div>
				  	</div>
				</div>
			</div>
			<div class="col-12"  v-if="payloads.resubmitted_at || payloads.denied_at">					
				<div class="card">
				  	<h4 class="card-header bg--gray">Reason</h4>
				  	<div class="card-body">
				      	<textarea placeholder="Sample description" class="form-control textarea" v-model="payloads.reason" disabled></textarea>
				  	</div>
				</div>
			</div>
			<div class="col-12 text-right mt-4" v-if="canEdit">
				<button class="frm-btn align-r" data-toggle="modal" data-target="#modalValidation" :disabled="disableButton">SUBMIT</button>
			</div>

			<div class="col-12 text-right mt-4" v-if="payloads.denied_at">
				<a class="frm-btn btn--gray align-r mr-2">Cancel</a>
				<button class="frm-btn align-r" @click="resubmit" :disabled="disableButton">RESUBMIT</button>
			</div>
		</div>

		<loading :active.sync="isLoading" 
		 :is-full-page="true"
		 color="#47c94d"
		 ></loading>
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
							<button class="frm-btn align-r" data-toggle="modal" @click="store">Proceed</button>
							<!-- <button class="frm-btn align-r" data-toggle="modal" @click="update" v-if="proceedShow">Proceed</button> -->
						</div>
		      		</div>
		    	</div>
		  	</div>
		</div>

	</div>
</template>
<script>
	import ResponseMixin from 'Mixins/response.js';
	import Loading from 'vue-loading-overlay';
	export default {
		props: {
			budgets: Array,
			productsArray: Array,
			storeUrl: String,
			item: Object,
			canEdit: {
				default: true,
				type: Boolean
			},
			disabled: {
				default: false,
				type: Boolean
			}
		},

		mixins: [ ResponseMixin ],

		components: { Loading },

		data() {
			return {
				isLoading: false,
				payloads: {},
				products: [],

				modal: {
					title: 'Create New PPP Budget',
					body: 'Are you sure you want to add this ppp budget in the current record'
				},
				disableButton: false
			}
		},

		computed: {
			proceedShow() {
				var canResubmit = false;

				if(!_.isEmpty(this.item)) {
					if(this.payloads.denied_at) {
						canResubmit = true;
					}
				}

				return canResubmit;
			}
		},

		watch: {
			'payloads.budget_id'(val) {
				this.products = [];
				// _.each(this.budgets, (budget) => {
					// if(budget.id === val) {
						// _.each(budget.specializations, (specialization) => {
							_.each(this.productsArray, (product) => {
								if(product.specialization_id === val) {
									this.products.push(product);
								}
							});
						// })
					// }
				// })
			}
		},

		mounted() {
			$('.datepicker').flatpickr({
				minDate: 'today',
				mode: 'range'
			});

			this.setupPayloads();
		},

		methods: {

			addComma(ev) {
				if(ev.which >= 37 && ev.which <= 40) return;

			  	this.payloads.requested_amount = this.payloads.requested_amount.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
			},

			setupPayloads() {
				this.payloads = this.item ? this.item : this.payloads;
				if(!_.isEmpty(this.payloads)) {
					this.payloads.requested_amount = this.payloads.requested_amount.replace('.00','');
					this.payloads.requested_amount = this.payloads.requested_amount.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
				}
			},

			close() {
				$('#modalValidation').modal('toggle');
			},

			fileChanged(e) {

				var fileInput = document.getElementById('files');   
				var filename = fileInput.files[0].name;

	            var files = e.target.files || e.dataTransfer.files;

	            if(!files.length)
	                return;

	            this.payloads.files = files;

		        this.hideFiles = false
	        },

			store() {
				this.isLoading = true;
				this.disableButton = true;

				var data = new FormData();
				if(this.payloads.period) {
					var splittedData = this.payloads.period.split('to');
					data.append('period_start_at', splittedData[0]);
					data.append('period_end_at', splittedData[1]);
				}

				data.append('name', this.payloads.name);
				data.append('budget_id', this.payloads.budget_id);
				data.append('product_id', this.payloads.product_id);
				data.append('requested_amount', this.payloads.requested_amount.replace(/,/g,''));
				data.append('line_business', this.payloads.line_business);
				data.append('description', this.payloads.description);

				if(this.payloads.files) {
					for( var i = 0; i < this.payloads.files.length; i++ ){
				        let file = this.payloads.files[i];
				        data.append('files[' + i + ']', file);
				    }
				}
				

				axios.post(this.storeUrl, data)
					.then(response => {
						$('#modalValidation').modal('toggle');
						$('#modalSuccess').modal('toggle');
	        			setTimeout(() => {
		        			window.location.href = 'manager/ppp-budget'
	        			}, 2000)
						this.isLoading = true;
					}).catch(error => {
	        			this.parseError(error)
	        			this.disableButton = false
						this.isLoading = false;
	        		})
			},

			update() {
				this.disableButton = true;
				var data = { reason : this.payloads.reason }
				axios.post(this.storeUrl, data)
					.then(response => {
						$('#modalValidation').modal('toggle');
						$('#modalSuccess').modal('toggle');
	        			setTimeout(() => {
		        			window.location.reload();
	        			}, 2000)
					}).catch(error => {
	        			this.parseError(error)
	        			this.disableButton = false
	        		})
			},

			resubmit() {
				this.modal.title = 'Resubmit Changes';
				this.modal.body = 'All the changes made will be saved and resubmitted';
				$('#modalValidation').modal('toggle');
			}
		}
	}
</script>