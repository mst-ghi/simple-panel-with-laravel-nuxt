<template>
    <div class="photos">
        <template v-for="photo in photos">
            <div @click="Select(photo)" :key="photo.id" class="photo" :id="'photo-' + photo.id"
                 v-bind:style="{ backgroundImage: 'url(' + photo.url + ')' }">
                <i class="fa fa-trash-o photo-trash" v-on:click="Remove(photo.id)"></i>
            </div>
        </template>

        <drop-zone id="photo-upload" class="upload" :options="Options"
                   @removedfile="Remove"
                   @vdropzone-success="Upload"
                   v-show="photos.length < maxFiles">
        </drop-zone>
    </div>
</template>

<script>
    import vue2DropZone from 'vue2-dropzone'

    export default {
        name: 'photo',
        components: {
            DropZone: vue2DropZone
        },
        props: {
            maxFiles: {
                default: 1
            },
            id: {
                type: Number,
                default: 0
            },
            url: {
                type: String,
                default: ''
            },
            photos: {
                type: Array,
                default: function () {
                    return []
                }
            },
            uploadUrl: {
                type: String,
                default: 'common/photo'
            }
        },
        watch: {
            id: function (newID, oldID) {
                if (oldID == 0) {
                    this.photos.forEach(function (photo, index) {
                        if (photo.id == newID) {
                            this.Select(photo);
                        }
                    }, this);
                }
            }
        },
        data: function () {
            return {
                photo_id: this.id,
                photo_url: this.url,
                selected_id: this.id,
                selected_url: this.url,
                Options: {
                    url: this.uploadUrl,
                    thumbnailWidth: 200,
                    thumbnailHeight: 200,
                    maxFilesize: 0.2,
                    headers: {
                        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                    },
                    maxFiles: this.maxFiles,
                    uploadMultiple: false,
                    addRemoveLinks: true,
                    useCustomSlot: true,
                    dictDefaultMessage: "<i class='fa fa-camera fa-2x'></i>",
                    dictFileTooBig: "تصویر نباید بزرگتر از 200 کیلوبایت باشد.",
                    dictResponseError: "سرور پاسخگو نیست",
                    dictCancelUpload: "حذف",
                    dictRemoveFile: "حذف",
                    dictUploadCanceled: "لغو",
                    parallelUploads: 1,
                    acceptedFiles: 'image/jpeg',
                    init: function () {
                        this.on("addedfile", function (file) {
                            $(".dz-default").html('<i class="fa fa-spinner fa-spin fa-2x"></i>');
                        });
                        this.on("success", function (file, response) {
                            this.removeFile(file);
                        });
                        this.on("complete", function (file, response) {
                            this.removeFile(file);
                            $(".dz-default").html('<i class="fa fa-camera fa-2x"></i>');
                        });
                        this.on("error", function (file, error) {

                            if (typeof (error) == 'string') {
                                $.toast({
                                    heading: 'خطا',
                                    text: error,
                                    position: 'top-left',
                                    loaderBg: '#ff6849',
                                    icon: 'error',
                                    hideAfter: 2500,
                                    stack: 6
                                });
                            } else {
                                $.toast({
                                    heading: 'خطا',
                                    text: error.errors.file[0],
                                    position: 'top-left',
                                    loaderBg: '#ff6849',
                                    icon: 'error',
                                    hideAfter: 2500,
                                    stack: 6
                                });
                            }

                            this.removeFile(file);
                        });
                    }
                }
            }
        },
        methods: {
            setURL: function (value, selected = false) {
                this.photo_url = value;
                this.$emit('update:url', value);

                if (selected) {
                    this.$emit('update:selected_url', value)
                }
            },
            setID: function (value, selected = false) {
                this.photo_id = value;
                this.$emit('update:id', value);

                if (selected) {
                    this.$emit('update:selected_id', value)
                }
            },
            Upload: function (file, response) {
                this.setID(response.photo_id);
                this.setURL(response.photo_url);

                this.photos.push({
                    id: response.photo_id,
                    url: response.photo_url
                });

                this.Toast('موفقیت', 'عکس با موفقیت آپلود شد', 'success');
            },
            Remove: function (id) {

                this.photos.forEach(function (photo, index) {
                    if (photo.id == id) {
                        this.photos.splice(index, 1);
                    }
                }, this);

                if (this.photo_id == id) {
                    this.Select(this.photos[0]);
                }

            },
            Select: function (photo) {

                if (photo === undefined) {
                    this.setID(0, true);
                    this.setURL('', true);
                    return false;
                }

                this.setID(photo.id, true);
                this.setURL(photo.url, true);

                if (this.maxFiles == 1) {

                    if (!this.photos.length) {
                        this.setID(0, true);
                        this.setURL('', true);
                    }

                    return false;
                }

                $('.photos .photo').removeClass('photo-active');
                $("#photo-" + photo.id).addClass('photo-active');
            }
        },
        created: function () {
        }
    }
</script>
<style>
    .upload .dz-preview, .upload .dz-processing {
        display: none !important;
    }

    .upload .dz-default, .upload .dz-message {
        display: block !important;
    }

    .upload .dz-default i {
        top: 55px;
        position: relative;
        display: inline;
    }

    .upload .dz-message {
        margin: 0em 0 !important;
    }

    .photos .upload {
        width: 150px;
        height: 150px !important;
        background-color: #f3f3f3;
        border: 2px solid #e3e3e3;
        color: #5e5e5e;
        border-radius: 3px;
        text-align: center;
        cursor: pointer;
        padding: 0;
        display: inline-block;
    }

    .photos {
        width: 100%;
    }

    .photos .photo {
        display: inline-block !important;
        width: 150px;
        height: 150px;
        border-radius: 3px;
        background-size: cover !important;
        border: 2px solid #e3e3e3;
        background: #F3F3F3 no-repeat center center;
        margin: 2px;
    }

    .photo-active {
        border: 3px solid #c00c1a !important;
    }

    .photo-trash {
        background-color: rgba(0, 0, 0, 0.6);
        color: white;
        position: relative;
        top: 2px;
        right: 2px;
        border-radius: 3px;
        cursor: pointer;
        font-size: 20px;
        padding: 4px;
    }
</style>