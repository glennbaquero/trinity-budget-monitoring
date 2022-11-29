<template>
  <form @submit.prevent="processForm">  
    <div class="row no-gutters">
        <div class="col-12">
            <div class="row no-gutters equal">
                <div class="col-md-3 d-flex">
                    <div class="card" style="width: 100%">
                        <h4 class="card-header bg--green">Image</h4>
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="card-avatar mr-3">
                                    <img id="imagePreview" class="img-fit cover" :src="item.renderImage">
                                </div>
                                <div class="message">
                                <h4 class="font-weight-bold mb-1" v-html="item.first_name + ' ' + item.last_name"></h4>
                                    <h5 class=""> {{ position }} </h5>
                                </div>
                            </div>
                            <div class="frm-input__file-hldr">
                                <div class="frm-input__file">
                                    <label for="imageUpload" class="mb-4 custom-file-upload">Choose File</label>
                                </div>
                                <p class="font--14 mb-3 clr--light-gray">or</p>
                                <p class="font--14 clr--light-gray">Drop image file <span class="clr--btn-red font--12">(max 2mb)</span></p>
                                <input type="file" id="imageUpload" ref="file" accept="image/*" class="fileuploadBtn" v-on:change="handleFileUpload()" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-9 pl-2 d-flex">
                    <div class="card" style="width: 100%">
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

                                <div class="form-group col-md-6 px-3">
                                    <label class="font--12 clr--light-gray font-weight-bold">Position</label>
                                    <input v-model="position" name="position" type="text" class="form-control input-sm" readonly>
                                </div>

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
                <div class="col-12 text-right mt-3 px-0">
                    <label class="frm-btn align-r" data-toggle="modal" data-target="#modalValidation">Edit</label>
                </div>
            </div>
        </div>
    </div>
            
    <loading :active.sync="isLoading" 
     :is-full-page="fullPage"
     color="#47c94d"
     ></loading>
        <!-- Modal -->
    <div class="modal fade" id="modalValidation" >
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <div class="d-flex align-items-center justify-content-center mb-2">
                        <img src="images/question-mark.svg" class="mr-3">
                        <h1 class="font-weight-bold">Save all changes made</h1>
                    </div>
                    <p>Once the changes has been applied there is no turning back</p>
                    <div class="col-12 text-center mt-5">
                        <label class="frm-btn btn--gray align-r mr-2" data-dismiss="modal">Cancel</label>
                        <label type="submit" class="frm-btn align-r" data-toggle="modal" data-target="#modalSuccess" data-dismiss="modal">Proceed</label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Modal -->
     <div class="modal fade" id="modalSuccess">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <div class="d-flex align-items-center justify-content-center mb-2">
                        <img src="images/check-mark.svg" class="mr-3">
                        <h1 class="font-weight-bold">Succefully updated</h1>
                    </div>
                    <p>The record has successfully updated and save all changes</p>
                    <button class="frm-btn align-r"> Done </button>
                </div>
            </div>
        </div>
    </div>
</div>

    </form>
</template>

<script>
import CrudMixin from 'Mixins/crud.js';
import ArrayHelpers from 'Mixins/array.js';
import ResponseMixin from 'Mixins/response.js';
import Loading from 'vue-loading-overlay';
import ErrorResponse from 'Mixins/errorResponse';
import 'vue-loading-overlay/dist/vue-loading.css'; 
import RegexValidation from 'Mixins/regex.js';

import ActionButton from 'Components/buttons/ActionButton.vue';
import Select from 'Components/inputs/Select.vue';
import ImagePicker from 'Components/inputs/ImagePicker.vue'
import ContactNumber from 'Components/inputs/ContactNumber.vue';
import FileDropzone from 'Components/inputs/FileDropzone.vue';

export default {
    props: {
        submitUrl: String
    },

    methods: {
        fetchSuccess(data) {
            this.item = data.item ? data.item : this.item;
            this.position = data.position ? data.position : this.position;
            this.images = data.images ? data.images : this.images;

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
        handleFiles() {
            let uploadedFiles = this.$refs.files.files;

            for(var i = 0; i < uploadedFiles.length; i++) {
                this.files.push(uploadedFiles[i]);
            }
            this.getImagePreviews();
        },
        getImagePreviews(){
            for( let i = 0; i < this.files.length; i++ ){
                if ( /\.(jpe?g|png|gif)$/i.test( this.files[i].name ) ) {
                    let reader = new FileReader();
                    reader.addEventListener("load", function(){
                        this.$refs['preview'+parseInt(i)][0].src = reader.result;
                    }.bind(this), false);
                    reader.readAsDataURL( this.files[i] );
                }else{
                    this.$nextTick(function(){
                        this.$refs['preview'+parseInt(i)][0].src = '/img/generic.png';
                    });
                }
            }
        },
        removeFile( key ){
            this.files.splice( key, 1 );
            this.getImagePreviews();
        },        

        processForm() {

            this.isLoading = true;
            let data = new FormData;
            data.append("image_path", this.file);
            data.append("first_name", this.item.first_name);
            data.append("last_name", this.item.last_name);
            data.append("email", this.item.email);
            data.append("contact_number", this.item.contact_number);

            axios.post(this.submitUrl, data)        
                .then(response => {
                    this.isLoading = false;
                    window.location.reload();
                })
                .catch(errors => {
                    this.isLoading = false;
                })
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
            files: [],               
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
        'file-dropzone': FileDropzone,
         Loading

    },

    mixins: [ CrudMixin, ArrayHelpers, ErrorResponse ],
}
</script>

<style scoped>
    input[type="file"]{
        opacity: 0;
        width: 100%;
        height: 200px;
        position: absolute;
        cursor: pointer;
    }
    .filezone {
        outline: 2px dashed grey;
        outline-offset: -10px;
        background: #ccc;
        color: dimgray;
        padding: 10px 10px;
        min-height: 200px;
        position: relative;
        cursor: pointer;
    }
    .filezone:hover {
        background: #c0c0c0;
    }

    .filezone p {
        font-size: 1.2em;
        text-align: center;
        padding: 50px 50px 50px 50px;
    }
    div.file-listing img{
        max-width: 90%;
    }

    div.file-listing{
        margin: auto;
        padding: 10px;
        border-bottom: 1px solid #ddd;
    }

    div.file-listing img{
        height: 100px;
    }
    div.success-container{
        text-align: center;
        color: green;
    }

    div.remove-container{
        text-align: center;
    }

    div.remove-container a{
        color: red;
        cursor: pointer;
    }

    a.submit-button{
        display: block;
        margin: auto;
        text-align: center;
        width: 200px;
        padding: 10px;
        text-transform: uppercase;
        background-color: #CCC;
        color: white;
        font-weight: bold;
        margin-top: 20px;
    }
</style>