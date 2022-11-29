<template>
    <form-request :submit-url="submitUrl" @load="load" @success="fetch" confirm-dialog sync-on-success>
    <div class="row no-gutters">
        <div class="col-12">
            <div class="row no-gutters equal">
                <div class="col-md-3 d-flex">
                    <div class="card">
                        <h4 class="card-header bg--green">Image</h4>
                        <div class="card-body"> 
                           <div class="d-flex align-items-center">
                                <div  class="card-avatar mr-3">
                                    <img class="img-fit cover" :src="item.renderImage">
                                </div>
                                <div class="message">
                                <h4 class="font-weight-bold mb-1" v-html="item.first_name + ' ' + item.last_name"></h4>
                                    <h5 class="" v-html="item.position_id" item-value="id" item-text="name"></h5>
                                </div>
                            </div>
                            <div class="frm-input__file-hldr">
                                <div class="frm-input__file">
                                    <label for="file" class="mb-4 custom-file-upload">Choose File</label>
                                </div>
                                <p class="font--14 mb-3 clr--light-gray">or</p>
                                <p class="font--14 clr--light-gray">Drop image file <span class="clr--btn-red font--12">(max 2mb)</span></p>
                                <input name="image_path" type="file" id="file" ref="file" accept="image/*" class="fileuploadBtn" v-on:change="handleFileUpload()" />
                            </div>         
                            <div class="frm-input__file-hldr">

<!--                                             <img class="img-fit cover" :src="item.image_path">
-->                          
                            </div>                                     
                        </div>
                    </div>
                </div>
                <div class="col-md-9 pl-2 d-flex">
                    <div class="card">
                        <h4 class="card-header bg--gray">Details</h4>
                        <div class="card-body py-2 px-2">
                            <div class="form-row">
                                <div class="form-group col-md-6 px-3">
                                    <label class="font--12 clr--light-gray font-weight-bold">First Name</label>
                                    <input v-model="item.first_name" name="first_name" type="text" class="form-control">
                                </div>
                                <div class="form-group col-md-6 px-3">
                                    <label class="font--12 clr--light-gray font-weight-bold">Last Name</label>
                                    <input v-model="item.last_name" name="last_name" type="text"class="form-control">
                                </div>
                                <div class="form-group col-md-6 px-3">
                                    <label class="font--12 clr--light-gray font-weight-bold">Email</label>
                                    <input v-model="item.email" name="email" type="text" class="form-control">
                                </div>                              

                                <selector class="form-group col-md-6 px-3 font--12 clr--light-gray font-weight-bold"
                                v-model="item.position_id"
                                name="position_id"
                                label="Positon"
                                :items="positions"
                                item-value="id"
                                item-text="name"
                                empty-text="None"
                                placeholder="Please select a Position"
                                :disabled="isDisabled"
                                ></selector>

                                <contact-number
                                v-model="item.contact_number"
                                label="Contact Information"
                                type="mobile"
                                name="contact_number"
                                class="form-group col-md-6 px-3 font--12 clr--light-gray font-weight-bold"
                                ></contact-number>                                          

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 text-right mt-4 px-0">
                    <button type="submit" class="frm-btn align-r">Edit</button>
                </div>
            </div>
        </div>
    </div>
    <loader :loading="loading"></loader>

    </form-request>
</template>

<script type="text/javascript">
import CrudMixin from '../../../mixins/crud.js';

import ActionButton from 'Components/buttons/ActionButton.vue';
import Select from 'Components/inputs/Select.vue';
import ImagePicker from 'Components/inputs/ImagePicker.vue'
import ContactNumber from 'Components/inputs/ContactNumber.vue';


export default {
    methods: {
        fetchSuccess(data) {
            this.item = data.item ? data.item : this.item;
            this.positions = data.positions ? data.positions : this.positions;

        },


        /*
         Handles a change on the file upload
       */
        handleFileUpload(){
        /*
          Set the local file variable to what the user has selected.
        */
            this.file = this.$refs.file.files[0];

        /*
          Initialize a File Reader object
        */
            let reader  = new FileReader();

        /*
          Add an event listener to the reader that when the file
          has been loaded, we flag the show preview as true and set the
          image to be what was read from the reader.
        */
            reader.addEventListener("load", function () {
                  this.showPreview = true;
                  this.item.image_path = reader.result;
                }.bind(this), false);

        /*
          Check to see if the file is not empty.
        */
            if( this.file ){
          /*
            Ensure the file is an image file.
          */
              if ( /\.(jpe?g|png|gif)$/i.test( this.file.name ) ) {
            /*
              Fire the readAsDataURL method which will read the file in and
              upon completion fire a 'load' event which we will listen to and
              display the image in the preview.
            */
                reader.readAsDataURL( this.file );
              }
           }
        },        
    },

    computed: {
    isDisabled: function(){
        return !this.item.position_id;
        }
    },    

    data() {
        return {
            item: {},
            positions: {},                   
            file: '',
            showPreview: false,
            imagePreview: '',
            isLoading: false,
            fullPage: true,
            disabled: true,
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