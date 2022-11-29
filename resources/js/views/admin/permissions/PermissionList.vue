<template>				
	<form-request :submit-url="submitUrl" @load="load" confirm-dialog sync-on-success>
		<card>
			<template v-for="(category, key) in categories">
				
				<div class="row">
					<div class="col-sm-12">
						<h4 class="font-weight-bold">
							<i :class="category.icon" class="mr-2"></i>
							{{ category.name }}
							<small>({{ category.description }})</small>
						</h4>
					</div>
				</div>

				<div class="row">
					<div v-for="(permission) in category.permissions" class="form-group col-sm-12 col-md-4 mt-3">
						<div class="custom-control custom-checkbox">
							<input v-model="permission_ids" name="permissions[]" type="checkbox" class="custom-control-input" :id="'permission-' + permission.id" :value="permission.id">
							<label class="custom-control-label" :for="'permission-' + permission.id">{{ permission.description }}</label>
						</div>
					</div>
				</div>

				<hr v-if="key < (categories.length - 1)">

			</template>
		</card>
		<div class="row mb-5">
	    	<div class="col-sm-12 text-right">                
                <action-button type="submit" :disabled="loading" :loading="loading" class="btn-primary btn-primary-action">Change Permissions</action-button>
	    	</div>
	    </div>

		<loader :loading="loading"></loader>

	</form-request>
</template>

<script type="text/javascript">
import CrudMixin from '../../../mixins/crud.js';

export default {
	methods: {
		fetchSuccess(data) {
			this.categories = data.categories ? data.categories : this.categories;
			this.permission_ids = data.permission_ids ? data.permission_ids : this.permission_ids;
		}
	},

	data() {
		return {
			categories: {},
			permission_ids: [],
		}
	},

	mixins: [ CrudMixin ],
}
</script>