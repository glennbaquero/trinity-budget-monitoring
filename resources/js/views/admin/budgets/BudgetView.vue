<template>
	<form-request :submit-url="submitUrl" @load="load" @success="fetch" confirm-dialog sync-on-success>
	
		<card>
			<template v-slot:header> Budget Details </template>
			<br>
			<div class="row">

				<selector class="col-sm-12 col-md-12"
				v-model="item.specialization_ids"
				name="specialization_ids"
				label="Specialization"
				:items="specializations"
				item-value="id"
				item-text="name"
				empty-text="None"
				placeholder="Please Select A Specialization"
				></selector>

				<div class="form-group col-sm-12 col-md-12">
					<label>Name</label>
					<input v-model="item.name" name="name" type="text" class="form-control">
				</div>

				<date-picker
				v-model="item.period_start_at"
				class="form-group col-sm-12 col-md-6"
				label="Validity Start Date"
				name="period_start_at"
				date-format="Y-m-d"
				placeholder="Choose dates"
				minDate="today"
				:enable-time="false"
				></date-picker>

				<date-picker
				v-model="item.period_end_at"
				class="form-group col-sm-12 col-md-6"
				label="Validity End Date"
				name="period_end_at"
				date-format="Y-m-d"
				placeholder="Choose dates"
				minDate="today"
				:enable-time="false"
				></date-picker>

				<div class="form-group col-sm-12 col-md-6">
					<label>Budget Amount <small>(Php)</small></label>
					<input v-model="item.budget_amount" name="budget_amount" @keyup="addComma" type="text"  class="form-control" :disabled="disableBudgetAmount">
				</div>
				<div class="form-group col-sm-12 col-md-6" v-if="showTextField">
					<label>Add New Amount <small>(Php)</small></label>
					<input name="new_amount" @keyup="addComma" type="text" value="0"  class="form-control">
				</div>

				<text-editor
				v-model="item.description"
				class="col-md-12"
				label="Description"
				name="description"
				row="5"
				></text-editor>			
			</div>
		</card>

		<div class="row mb-5">
	    	<div class="col-sm-12 text-right">
                <action-button
                v-if="item.archiveUrl && item.restoreUrl"
                color="btn-danger btn-secondary-action frm-btn"
                alt-color="btn-warning"
                :action-url="item.archiveUrl"
                :alt-action-url="item.restoreUrl"
                label="Archive"
                alt-label="Restore"
                :show-alt="item.deleted_at"
                confirm-dialog
                title="Archive Item"
                alt-title="Restore Item"
                :message="'Are you sure you want to archive Promo ' + item.name + '?'"
                :alt-message="'Are you sure you want to restore Promo ' + item.name + '?'"
                :disabled="loading"
                @load="load"
                @success="fetch"
                @error="fetch"
                ></action-button>
				<action-button type="submit" :disabled="loading" class="frm-btn">Save Changes</action-button>
	    	</div>
	    </div>

		<loader :loading="loading"></loader>
		
	</form-request>
</template>

<script type="text/javascript">
import { EventBus }from '../../../bus.js';
import CrudMixin from 'Mixins/crud.js';
import VueDirectiveMask from 'vue-directive-mask'

import ActionButton from 'Components/buttons/ActionButton.vue';
import Select from 'Components/inputs/Select.vue';
import TextEditor from 'Components/inputs/TextEditor.vue';
import Datepicker from 'Components/datepickers/Datepicker.vue';

export default {
	methods: {
		fetchSuccess(data) {
			this.item = data.item ? data.item : this.item;
			this.specializations = data.specializations ? data.specializations : this.specializations;

		},
		addComma(ev) {
			if(ev.which >= 37 && ev.which <= 40) return;

		  	this.item.budget_amount = this.item.budget_amount.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
		}
	},

	computed: {
		showTextField() {
			return !_.isEmpty(this.item);
		},

		disableBudgetAmount() {
			return !_.isEmpty(this.item);
		}
	},

	data() {
		return {
			item: [],
			specializations: [],

		}
	},

	components: {
		'action-button': ActionButton,
		'selector': Select,		
		'text-editor': TextEditor,
		'date-picker': Datepicker,		
	},

	mixins: [ CrudMixin ],
}
</script>