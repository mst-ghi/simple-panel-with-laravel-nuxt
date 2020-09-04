<template>
  <div>
    <Header title="لیست دسته بندی های ثبت شده در سیستم">
      <v-chip class="ma-2" text-color="white" dark label>
        <v-icon left>mdi-alert-decagram-outline</v-icon>
        تعداد دسته بندی ها : {{category_count}}
      </v-chip>
    </Header>
    <v-data-table
      :headers="headers"
      :items="desserts"
      :loading="loading"
      :items-per-page="options.per_page"
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
              <v-btn v-if="$can('category_store')" class="ma-2 white--text" v-on="on">
                <v-icon left dark>mdi-plus-outline</v-icon>دسته بندی جدید
              </v-btn>
            </template>
            <v-card>
              <v-card-title>
                <span class="headline">{{ formTitle }}</span>
              </v-card-title>

              <v-card-text>
                <v-container>
                  <v-row>
                    <v-col cols="12" sm="6" md="4">
                      <v-select
                        :items="categories"
                        v-model="selectedCategory"
                        label="پرنت"
                        :error="errors.parent_id != null"
                        :error-messages="errors.parent_id"
                        clearable
                      ></v-select>
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

      <!-- Latitude Template -->
      <template v-slot:item.depth="{ item }">
        <v-chip text-color="white" dark label style="font-size: 11px !important">{{ item.depth }}</v-chip>
      </template>
      <!-- End Template -->

      <!-- Latitude Template -->
      <template v-slot:item.path="{ item }">
        <v-chip text-color="white" dark label style="font-size: 11px !important">{{ item.path }}</v-chip>
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
          v-if="$can('category_update')"
          class="ml-2"
          @click="editItem(item)"
        >mdi-circle-edit-outline</v-icon>
        <v-icon
          dense
          v-if="$can('category_destroy')"
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

        <v-toolbar flat color="dark">
          <div class="flex-grow-1"></div>
          <v-pagination
            dark
            v-model="options.page"
            :length="meta.last_page"
            :next-icon="$vuetify.icons.next"
            :prev-icon="$vuetify.icons.prev"
            :total-visible="options.visible"
            :value="options.current"
            @input="onPageChange"
          ></v-pagination>
        </v-toolbar>
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
      category_count: 0,
      Category_count: 0,
      city_count: 0,
      meta: {},
      options: {
        visible: 7,
        current: 1,
        page: 1,
        per_page: 30
      },
      headers: [
        {
          text: "شناسه",
          align: "right",
          sortable: true,
          value: "id"
        },
        {
          text: "پرنت",
          align: "right",
          sortable: true,
          value: "parent_name"
        },
        {
          text: "عنوان (en)",
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
          text: "عمق در شاخه",
          value: "depth",
          align: "right",
          sortable: true
        },
        {
          text: "path",
          value: "path",
          align: "right",
          sortable: true
        },
        {
          text: "وضعیت",
          value: "status",
          align: "right",
          sortable: true
        },
        { text: "عملیات", value: "action", align: "center", sortable: false }
      ],
      desserts: [],
      editedIndex: -1,
      editedItem: {
        id: 0,
        parent_id: "",
        parent_name: "",
        slug: "",
        title: "",
        depth: "",
        path: "",
        status: 1
      },
      defaultItem: {
        id: 0,
        parent_id: "",
        parent_name: "",
        slug: "",
        title: "",
        depth: "",
        path: "",
        status: 1
      },
      itemDestroy: {},
      categories: [],
      selectedCategory: null
    };
  },
  computed: {
    formTitle() {
      return this.editedIndex === -1 ? "دسته بندی جدید" : "ویرایش دسته بندی";
    }
  },

  watch: {
    dialog(val) {
      val || this.close();
    }
  },

  async created() {
    await this.initialize();
    await this.categoryInit();
  },

  methods: {
    // Get category List Data From Server
    async initialize() {
      this.loading = true;
      this.desserts = [];
      await this.$axios
        .get(
          `api/panel/categories?per_page=${this.options.per_page}&page=${this.options.current}`
        )
        .then(response => {
          this.category_count = response.data.category_count;
          this.meta = response.data.meta;
          this.desserts = response.data.data;
        })
        .catch(err => {
          console.log(err);
        });
      this.loading = false;
    },

    // get category list data from server
    async categoryInit() {
      if (this.categories != []) {
        await this.$axios
          .get(`api/panel/categories`)
          .then(response => {
            this.categories = response.data.data;
          })
          .catch(err => {
            console.log(err);
          });
      }
    },

    // change page by click in paginate buttons
    async onPageChange(perPage) {
      this.loading = true;
      this.options.current = perPage;
      await this.initialize();
    },

    // Show Destroy Dialog
    deleteAction(item) {
      this.itemDestroy = item;
      this.destroy = true;
    },

    // Category Destroy Action
    async deleteItem() {
      this.destroy = false;
      await this.$axios
        .delete(`api/panel/categories/${this.itemDestroy.id}`)
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

    // Show Category Edit Dialog
    async editItem(item) {
      this.editedIndex = this.desserts.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.selectedCategory = item.parent_id;
      this.errors = {};
      await this.categoryInit();
      this.dialog = true;
    },

    // Close create or update dialog
    close() {
      this.dialog = false;
      setTimeout(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      }, 300);
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

    // Store new Category Action
    async store() {
      let data = {
        slug: this.editedItem.slug,
        title: this.editedItem.title
      };
      if (this.selectedCategory !== null) {
        data.parent_id = this.selectedCategory;
      }
      await this.$axios
        .post(`api/panel/categories`, data)
        .then(response => {
          if (response.data.success) {
            this.$toast.success(response.data.message);
            this.desserts.push(response.data.data);
            this.category_count++;
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

    // Update Exist Category
    async update() {
      let id = this.desserts[this.editedIndex].id;
      let item = this.editedItem;
      let data = {
        slug: this.editedItem.slug,
        title: this.editedItem.title
      };
      if (this.selectedCategory !== null) {
        data.parent_id = this.selectedCategory;
      }
      await this.$axios
        .patch(`api/panel/categories/${id}`, data)
        .then(response => {
          if (response.data.success) {
            this.$toast.success(response.data.message);
            this.$set(this.desserts, this.editedIndex, item);
            this.selectedCategory = null;
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
