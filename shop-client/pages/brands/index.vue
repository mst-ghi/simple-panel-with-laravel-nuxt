<template>
  <div>
    <Header title="لیست برند های ثبت شده در سیستم">
      <v-chip class="ma-2" text-color="white" dark label>
        <v-icon left>mdi-alert-decagram-outline</v-icon>
        تعداد کل برند ها : {{brand_count}}
      </v-chip>
    </Header>
    <v-data-table
      :headers="headers"
      :items="desserts"
      :loading="loading"
      :hide-default-footer="true"
      class="elevation-1"
      fixed-header
      calculate-widths
    >
      <!-- Top Template -->
      <template v-slot:top>
        <v-toolbar flat color="dark">
          <v-dialog v-model="dialog" max-width="900px">
            <template v-slot:activator="{ on }">
              <v-btn v-if="$can('brand_store')" class="ma-2 white--text" v-on="on">
                <v-icon left dark>mdi-plus-outline</v-icon>برند جدید
              </v-btn>
            </template>
            <v-card>
              <v-card-title>
                <span class="headline">{{ formTitle }}</span>
              </v-card-title>

              <v-card-text>
                <v-container>
                  <v-row>
                    <v-col cols="12" sm="12" md="12" class="text-center">
                      <v-row>
                        <v-col cols="12" sm="0" md="3" lg="3"></v-col>
                        <v-col cols="12" sm="12" md="3" lg="3" v-if="editedIndex !== -1">
                          <p>تصویر فعلی</p>
                          <v-img
                            v-if="editedItem.photo_url"
                            :src="editedItem.photo_url"
                            :lazy-src="editedItem.photo_url"
                            aspect-ratio="1"
                            class="grey lighten-2"
                            max-width="150"
                            max-height="150"
                            style="margin:5px"
                          >
                            <template v-slot:placeholder>
                              <v-row class="fill-height ma-0" align="center" justify="center">
                                <v-progress-circular indeterminate color="grey lighten-5"></v-progress-circular>
                              </v-row>
                            </template>
                          </v-img>
                        </v-col>
                        <v-col cols="12" sm="12" md="3" lg="3">
                          <p>تصویر جدید</p>
                          <v-img
                            v-if="imageUrl"
                            :src="imageUrl"
                            :lazy-src="imageUrl"
                            aspect-ratio="1"
                            class="grey lighten-2"
                            max-width="150"
                            max-height="150"
                            style="margin:5px;"
                          >
                            <template v-slot:placeholder>
                              <v-row class="fill-height ma-0" align="center" justify="center">
                                <v-progress-circular indeterminate color="grey lighten-5"></v-progress-circular>
                              </v-row>
                            </template>
                          </v-img>
                        </v-col>
                        <v-col cols="12" sm="0" md="3" lg="3"></v-col>
                      </v-row>
                    </v-col>
                    <v-col cols="12" sm="6" md="4">
                      <v-text-field
                        v-model="editedItem.slug"
                        label="عنوان (en)"
                        :error="errors.slug != null"
                        :error-messages="errors.slug"
                        clearable
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6" md="4">
                      <v-text-field
                        v-model="editedItem.title"
                        label="عنوان (fa)"
                        :error="errors.title != null"
                        :error-messages="errors.title"
                        clearable
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6" md="4">
                      <v-text-field
                        label="انتخاب تصویر"
                        :error="errors.photo != null"
                        :error-messages="errors.photo"
                        clearable
                        @click="pickFile"
                        v-model="imageName"
                      ></v-text-field>
                      <input
                        type="file"
                        style="display: none"
                        ref="image"
                        accept="image/*"
                        @change="onFilePicked"
                      />
                    </v-col>
                  </v-row>
                </v-container>
              </v-card-text>

              <v-card-actions>
                <div class="flex-grow-1"></div>
                <v-btn color="blue darken-1" text @click="close">بیخیال</v-btn>
                <v-btn color="blue darken-1" text @click="save">ذخیره</v-btn>
              </v-card-actions>
            </v-card>
          </v-dialog>
          <div class="flex-grow-1"></div>
        </v-toolbar>
      </template>
      <!-- End Template -->

      <!-- Photo Template -->
      <template v-slot:item.photo_url="{ item }">
        <v-img
          :src="item.photo_url"
          :lazy-src="item.photo_url"
          aspect-ratio="1"
          class="grey lighten-2"
          max-width="50"
          max-height="50"
          style="margin:5px"
        >
          <template v-slot:placeholder>
            <v-row class="fill-height ma-0" align="center" justify="center">
              <v-progress-circular indeterminate color="grey lighten-5"></v-progress-circular>
            </v-row>
          </template>
        </v-img>
      </template>
      <!-- End Template -->

      <!-- Status Template -->
      <template v-slot:item.status="{ item }">
        <v-chip
          :color="statusColor(item.status)"
          dark
          label
          style="font-size: 11px !important"
        >{{ item.status ? 'فعال' : 'غیرفعال' }}</v-chip>
      </template>
      <!-- End Template -->

      <!-- Actions Template -->
      <template v-slot:item.action="{ item }">
        <v-icon
          dense
          v-if="$can('brand_update')"
          class="ml-2"
          @click="editItem(item)"
        >mdi-circle-edit-outline</v-icon>
        <v-icon
          dense
          v-if="$can('brand_destroy')"
          @click.stop="deleteAction(item)"
        >mdi-delete-alert-outline</v-icon>
      </template>
      <!-- End Template -->

      <!-- No Data Template -->
      <template v-slot:no-data>
        <v-btn color="primary" @click="initialize">تازه سازی</v-btn>
      </template>
      <!-- End Template -->

      <!-- Footer Template -->
      <template v-slot:footer>
        <br />
      </template>
      <!-- End Template -->
    </v-data-table>

    <!-- Destroy Dialog -->
    <v-dialog v-model="destroy" max-width="290">
      <v-card>
        <div class="text-center">
          <v-icon class="mt-4" size="90">mdi-delete-empty</v-icon>
        </div>
        <v-card-text class="destroy-text">میخوای حذفش کنی؟</v-card-text>
        <v-card-actions>
          <div class="destroy-btn">
            <v-btn dark class="destroy-yes" color="darken-1" @click="deleteItem">آره</v-btn>
            <v-btn dark color="darken-1" @click="destroy = false">بیخیال!</v-btn>
          </div>
        </v-card-actions>
      </v-card>
    </v-dialog>
    <!-- End Dialog -->
  </div>
</template>

<script>
import Header from "~/components/header.vue";
export default {
  components: {
    Header
  },
  data() {
    return {
      errors: {},
      destroy: false,
      loading: true,
      dialog: false,
      brand_count: 0,
      rules: [
        value =>
          !value ||
          value.size < 200000 ||
          "تصویر میبایست کمتر از 200 کیلوبایت باشد"
      ],
      headers: [
        {
          text: "شناسه",
          align: "right",
          sortable: true,
          value: "id"
        },
        {
          text: "تصویر",
          align: "right",
          sortable: true,
          value: "photo_url"
        },
        {
          text: "اسلاگ (en)",
          align: "right",
          sortable: true,
          value: "slug"
        },
        {
          text: "عنوان (fa)",
          value: "title",
          align: "right",
          sortable: true
        },
        {
          text: "وضعیت",
          value: "status",
          align: "right"
        },
        { text: "عملیات", value: "action", align: "center", sortable: false }
      ],
      desserts: [],
      editedIndex: -1,
      editedItem: {
        id: 0,
        photo_url: "",
        slug: "",
        title: "",
        status: 1
      },
      defaultItem: {
        id: 0,
        photo_url: "",
        slug: "",
        title: "",
        status: 1
      },
      itemDestroy: {},
      imageName: "",
      imageUrl: "",
      imageFile: ""
    };
  },
  computed: {
    formTitle() {
      return this.editedIndex === -1 ? "برند جدید" : "ویرایش برند";
    }
  },

  watch: {
    dialog(val) {
      val || this.close();
    }
  },

  async created() {
    await this.initialize();
  },

  methods: {
    // Get Province List Data From Server
    async initialize() {
      this.loading = true;
      this.desserts = [];
      await this.$axios
        .get(`api/panel/brands`)
        .then(response => {
          this.brand_count = response.data.brand_count;
          this.desserts = response.data.data;
        })
        .catch(err => {
          console.log(err);
        });
      this.loading = false;
    },

    // Show Province Edit Dialog
    editItem(item) {
      this.editedIndex = this.desserts.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.errors = {};
      this.imageUrl = "";
      this.imageName = "";
      this.imageFile = "";
      this.dialog = true;
    },

    // Show Destroy Dialog
    deleteAction(item) {
      this.itemDestroy = item;
      this.destroy = true;
    },

    // Province Destroy Action
    async deleteItem() {
      this.destroy = false;
      await this.$axios
        .delete(`api/panel/brands/${this.itemDestroy.id}`)
        .then(response => {
          if (response.data.success) {
            // toast success message
            this.$toast.success(response.data.message);
            // delete item from list data
            this.$delete(
              this.desserts,
              this.desserts.indexOf(this.itemDestroy)
            );
          } else {
            // toast error message
            this.$toast.error(response.data.message);
          }
        })
        .catch(err => {
          // toast error message
          this.$toast.error(err);
        });
    },

    // Close create or update dialog
    close() {
      this.dialog = false;
      setTimeout(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      }, 300);
    },

    // image file refrences
    pickFile() {
      this.$refs.image.click();
    },

    // pick image file
    onFilePicked(e) {
      const files = e.target.files;
      if (files[0] !== undefined) {
        this.imageName = files[0].name;
        if (this.imageName.lastIndexOf(".") <= 0) {
          return;
        }
        const fr = new FileReader();
        fr.readAsDataURL(files[0]);
        fr.addEventListener("load", () => {
          this.imageUrl = fr.result;
          this.imageFile = files[0];
        });
      } else {
        this.imageName = "";
        this.imageFile = "";
        this.imageUrl = "";
      }
    },

    // save button in create or update dilaog bind to this method
    async save() {
      // update item
      if (this.editedIndex > -1) {
        await this.update();

        // new item
      } else {
        await this.store();
      }
    },

    // Store new Province Action
    async store() {
      let form = new FormData();
      form.append("slug", this.editedItem.slug);
      form.append("title", this.editedItem.title);
      form.append("status", this.editedItem.status);
      form.append("photo", this.imageFile);
      await this.$axios
        .post(`api/panel/brands`, form, {
          headers: {
            "Content-Type": "multipart/form-data"
          }
        })
        .then(response => {
          if (response.data.success) {
            this.$toast.success(response.data.message);
            this.desserts.push(response.data.data);
            this.brand_count++;
            this.close();
          } else {
            this.$toast.error(response.data.message);
          }
        })
        .catch(err => {
          if (err.response.status == 422) {
            this.errors = err.response.data.errors;
            this.$toast.error(err.response.data.message);
          } else {
            this.$toast.error(err);
          }
        });
    },

    // Update Exist Province
    async update() {
      let id = this.desserts[this.editedIndex].id;

      let form = new FormData();
      form.append("slug", this.editedItem.slug);
      form.append("title", this.editedItem.title);
      form.append("status", this.editedItem.status);
      form.append("_method", "PATCH");
      if (this.imageFile !== "") form.append("photo", this.imageFile);

      await this.$axios
        .post(`api/panel/brands/${id}`, form, {
          headers: {
            "Content-Type": "multipart/form-data"
          }
        })
        .then(response => {
          if (response.data.success) {
            this.$toast.success(response.data.message);
            this.$set(this.desserts, this.editedIndex, response.data.data);
            this.close();
          } else {
            this.$toast.error(response.data.message);
          }
        })
        .catch(err => {
          if (err.response.status == 422) {
            this.errors = err.response.data.errors;
            this.$toast.error(err.response.data.message);
          } else {
            this.$toast.error(err);
          }
        });
    },

    // set status field color
    statusColor(status) {
      if (status === 1) return "green";
      else if (status === 0) return "orange";
    }
  }
};
</script>

<style lang="scss" scoped>
.headline {
  font-size: 1.3rem !important;
  font-family: Samim-web !important;
  font-weight: normal;
}
.v-label {
  font-size: small !important;
}
.destroy-text {
  text-align: center;
  padding-top: 12px !important;
}
.destroy-btn {
  width: 100%;
  text-align: center;
}
.destroy-yes {
  font-size: initial;
  font-weight: 600 !important;
}
</style>
