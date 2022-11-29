<template>
    <form-request :submit-url="submitUrl" @load="load" @success="fetch" confirm-dialog sync-on-success>
        <card>
            <template v-slot:header>Basic Information</template>

            <div class="row">
                <selector class="col-sm-12 col-md-12"
                v-model="item.specialization_ids"
                name="specialization_ids[]"
                label="Specialization"
                :items="specializations"
                item-value="id"
                item-text="name"
                empty-text="None"
                placeholder="Please Select A Specialization"
                multiple
                ></selector>
            
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

                <selector class="col-sm-12 col-md-6"
                v-model="item.position_id"
                name="position_id"
                label="Positon"
                :items="positions"
                item-value="id"
                item-text="name"
                empty-text="None"
                placeholder="Please select a Position"
                ></selector>

                <contact-number
                v-model="item.contact_number"
                type="mobile"
                label="Contact Number"
                name="contact_number"
                class="col-sm-12 col-md-6"
                ></contact-number>                

                <selector class="col-sm-12 col-md-6"
                v-if="showManagerList"
                v-model="item.manager_id"
                name="manager_ids[]"
                multiple
                label="Manager Name"
                :items="managers"
                item-value="id"
                item-text="fullname"
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
            this.specializations = data.specializations ? data.specializations : this.specializations;

        },
    },

    data() {
        return {
            item: {},
            positions: [],
            managers: [],
            specializations: [],
            showManagerList: false
        }
    },

    watch: {
        'item.position_id'(val) {
            console.log(val);
            this.showManagerList = false;
            if(val == 2) {
                this.showManagerList = true;
            }
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