<template>
  <form @submit.prevent="processForm">	
  		<div class="col-12 px-0">
			<div class="card">
				<h4 class="card-header bg--gray">Fill up the following fields</h4>
			  	<div class="card-body px-2">
			  		<div class="form-row">
					    <div class="form-group col-md-4 px-3">
					    	<div class="form-group"> 
						    	<label class="font--12 clr--light-gray font-weight-bold">Current Password</label>
						    	<div class="input-with-icon">
							      	<input v-model="current_password" class="form-control" type="password" placeholder="Current Password">
						        	<i class="fa fa-eye-slash showPass" aria-hidden="true"></i>
							    </div>
							</div>
						    <div class="form-group col-12 px-0">
						      	<label class="font--12 clr--light-gray font-weight-bold">New Password</label>
						      	 <div class="ticket__input--icon active showPass">
	                            </div> 
						      	<div class="input-with-icon">
							      	<input v-model="new_password" class="form-control" type="password" placeholder="New Password">
						        	<i class="fa fa-eye-slash showPass" aria-hidden="true"></i>
							    </div>
						    </div>
						    <div class="form-group col-12 px-0">
						      	<label class="font--12 clr--light-gray font-weight-bold">Confirm New Password</label>
						      	<div class="input-with-icon">
							      	<input v-model="new_password_confirmation" class="form-control" type="password" placeholder="Confirm New Password">
						        	<i class="fa fa-eye-slash showPass" aria-hidden="true"></i>
							    </div>
						    </div>
					    </div>
					</div>
			  	</div>
			</div>
			<div class="col-12 text-right mt-4 px-0">
                                <button type="submit" class="frm-btn align-r">Save Change</button>

			</div>
		</div>
   			
                <loading :active.sync="isLoading" 
                 :is-full-page="fullPage"
                 color="#47c94d"
                 ></loading>
 </form>
</template>

<script type="text/javascript">
import CrudMixin from 'Mixins/crud.js';
import ArrayHelpers from 'Mixins/array.js';
import ResponseMixin from 'Mixins/response.js';
import Loading from 'vue-loading-overlay';
import ErrorResponse from 'Mixins/errorResponse';
import 'vue-loading-overlay/dist/vue-loading.css'; 
import RegexValidation from 'Mixins/regex.js';

import ActionButton from '../../../components/buttons/ActionButton.vue';
export default {
     props: {
        submitUrl: String
    },

    methods: {
        fetchSuccess(data) {
            this.item = data.item ? data.item : this.item;
        },

        processForm() {

            this.isLoading = true;
			
			var data = {
				current_password: this.current_password,	
				new_password: this.new_password,				
				new_password_confirmation: this.new_password_confirmation,

			}         
			   
			axios.post(this.submitUrl, data)		
				.then(response => {
					this.isLoading = false;
					this.current_password = null;
					this.new_password = null;
					this.new_password_confirmation = null;
					swal.fire("Process: ", "Password Successfully Changed!", "success");
					
				})
				.catch(errors => {
					this.isLoading = false;					
					var message = this.parseResponse(errors, 'error');
					swal.fire("", message , "error");
				})

        },         
    },

    data() {
        return {
            item: [],
			current_password: null,
			new_password: null,
			new_password_confirmation: null,               
            isLoading: false,
            fullPage: true,
        }
    },

    components: {
        'action-button': ActionButton,
         Loading

    },

    mixins: [ CrudMixin, ArrayHelpers, ErrorResponse ],
}
</script>