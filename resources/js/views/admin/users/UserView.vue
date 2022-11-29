<template>
    <form-request :submit-url="submitUrl" @load="load" @success="fetch" confirm-dialog sync-on-success>
        <card>
            <template v-slot:header>Basic Information</template>
            <div class="row">
                <div class="form-group col-sm-12 col-md-6">
                    <label>First Name</label>
                    <input v-model="item.first_name" name="first_name" type="text" class="form-control input-sm">
                </div>

                <div class="form-group col-sm-12 col-md-6">
                    <label>Last Name</label>
                    <input v-model="item.last_name" name="last_name" type="text" class="form-control input-sm">
                </div>

                <div class="form-group col-sm-12 col-md-6">
                    <label>Email Address</label>
                    <input v-model="item.email" name="email" type="text" class="form-control input-sm">
                </div>

                <contact-number
                v-model="item.contact_number"
                type="mobile"
                label="Contact Number"
                name="contact_number"
                class="col-sm-12 col-md-6"
                ></contact-number>                

                <selector class="col-sm-12 col-md-6"
                v-model="item.manager_id"
                name="manager_id"
                label="Manager Name"
                :items="managers"
                item-value="id"
                item-text="first_name"
                empty-text="None"
                placeholder="Please select a Manager Name"
                ></selector>
                
                <image-picker
                class="form-group col-sm-12 col-md-12 mt-2"
                :value="item.renderImage"
                label="Avatar"
                name="image_path"
                placeholder="Choose a File"
                ></image-picker>
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
                :message="'Are you sure you want to archive User #' + item.id + '?'"
                :alt-message="'Are you sure you want to restore User #' + item.id + '?'"
                :disabled="loading"
                @load="load"
                @success="fetch"
                ></action-button>
                <action-button type="submit" :disabled="loading" class="frm-btn">Save Changes</action-button>
            </div>
        </div>

        <loader :loading="loading"></loader>

    </form-request>
</template>

<script type="text/javascript">
import CrudMixin from '../../../mixins/crud.js';

import ActionButton from '../../../components/buttons/ActionButton.vue';
import Select from '../../../components/inputs/Select.vue';
import ImagePicker from '../../..//components/inputs/ImagePicker.vue'
import ContactNumber from '../../../components/inputs/ContactNumber.vue';

export default {
    methods: {
        fetchSuccess(data) {
            this.item = data.item ? data.item : this.item;
            this.positions = data.positions ? data.positions : this.positions;
            this.managers = data.managers ? data.managers : this.managers;

        },
    },

    data() {
        return {
            item: [],
            positions: [],
            managers: [],

        }
    },

    components: {
        'action-button': ActionButton,
        'selector': Select,
        'image-picker': ImagePicker,
        'contact-number': ContactNumber,        
    },

    mixins: [ CrudMixin ],
}
</script>