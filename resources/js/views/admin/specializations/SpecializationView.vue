<template>
	<form-request :submit-url="submitUrl" @load="load" @success="fetch" confirm-dialog sync-on-success>
	
		<card>
			<template v-slot:header> Specialization </template>
			<br>
			<div class="row">
				<div class="form-group col-sm-12 col-md-12">
					<label>Name</label>
					<input v-model="item.name" name="name" type="text" class="form-control">
				</div>
			</div>
			<div class="row">
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

import ActionButton from 'Components/buttons/ActionButton.vue';
import Select from 'Components/inputs/Select.vue';
import TextEditor from 'Components/inputs/TextEditor.vue';

export default {
	methods: {
		fetchSuccess(data) {
			this.item = data.item ? data.item : this.item;
		},
	},

	data() {
		return {
			item: [],
		}
	},

	components: {
		'action-button': ActionButton,
		'selector': Select,		
		'text-editor': TextEditor,
	},

	mixins: [ CrudMixin ],
}
</script>