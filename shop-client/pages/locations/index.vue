<template>
  <div>
    <Header title="لیست استان های ثبت شده در سیستم">
      <div>
        <nuxt-link to="/locations" v-if="$can('province_list')">
          <v-chip class="ma-2" text-color="white" dark label>
            <v-icon left>mdi-crosshairs-gps</v-icon>
            استان ها : {{province_count}}
          </v-chip>
        </nuxt-link>
        <nuxt-link to="/locations/counties" v-if="$can('county_list')">
          <v-chip class="ma-2" text-color="white" dark label>
            <v-icon left>mdi-city-variant-outline</v-icon>
            شهرستان ها : {{county_count}}
          </v-chip>
        </nuxt-link>
        <nuxt-link to="/locations/cities" v-if="$can('city_list')">
          <v-chip class="ma-2" text-color="white" dark label>
            <v-icon left>mdi-city</v-icon>
            شهر ها : {{city_count}}
          </v-chip>
        </nuxt-link>
      </div>
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
              <v-btn v-if="$can('province_store')" class="ma-2 white--text" v-on="on">
                <v-icon left dark>mdi-plus-outline</v-icon>استان جدید
              </v-btn>
            </template>
            <v-card>
              <v-card-title>
                <span class="headline">{{ formTitle }}</span>
              </v-card-title>

              <v-card-text>
                <v-container>
                  <v-row>
                    <v-col cols="12" sm="6" md="6">
                      <v-text-field
                        v-model="editedItem.en_name"
                        label="عنوان (en)"
                        :error="errors.en_name != null"
                        :error-messages="errors.en_name"
                        clearable
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6" md="6">
                      <v-text-field
                        v-model="editedItem.name"
                        label="عنوان (fa)"
                        :error="errors.name != null"
                        :error-messages="errors.name"
                        clearable
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6" md="4">
                      <v-text-field
                        v-model="editedItem.area_code"
                        label="پیش شماره"
                        :error="errors.area_code != null"
                        :error-messages="errors.area_code"
                        clearable
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6" md="4">
                      <v-text-field
                        v-model="editedItem.latitude"
                        label="عرض جغرافیایی"
                        :error="errors.latitude != null"
                        :error-messages="errors.latitude"
                        clearable
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6" md="4">
                      <v-text-field
                        v-model="editedItem.longitude"
                        label="طول جغرافیایی"
                        :error="errors.longitude != null"
                        :error-messages="errors.longitude"
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
      <template v-slot:item.latitude="{ item }">
        <v-chip text-color="white" dark label style="font-size: 11px !important">{{ item.latitude }}</v-chip>
      </template>
      <!-- End Template -->

      <!-- Longitude Template -->
      <template v-slot:item.longitude="{ item }">
        <v-chip
          text-color="white"
          dark
          label
          style="font-size: 11px !important"
        >{{ item.longitude }}</v-chip>
      </template>
      <!-- End Template -->

      <!-- Actions Template -->
      <template v-slot:item.action="{ item }">
        <v-icon
          dense
          v-if="$can('province_update')"
          class="ml-2"
          @click="editItem(item)"
        >mdi-circle-edit-outline</v-icon>
        <v-icon
          dense
          v-if="$can('province_destroy')"
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
          <v-chip class="ma-2" text-color="white" dark label>
            <v-icon left>mdi-alert-decagram-outline</v-icon>
            تعداد کل استان ها : {{province_count}}
          </v-chip>
          <div class="flex-grow-1"></div>
          <div class="text-center">
            <v-pagination
              dark
              v-model="options.page"
              :length="meta.last_page"
              :next-icon="$vuetify.icons.next"
              :prev-icon="$vuetify.icons.prev"
              :total-visible="7"
              @input="onPageChange"
            ></v-pagination>
          </div>
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
  async validate({ app }) {
    return await app.$can("province_list");
  },
  components: {
    Header
  },
  data() {
    return {
      errors: {},
      destroy: false,
      loading: true,
      dialog: false,
      province_count: 0,
      county_count: 0,
      city_count: 0,
      meta: {},
      options: {
        current: 1,
        page: 1,
        per_page: 35
      },
      headers: [
        {
          text: "شناسه",
          align: "right",
          sortable: true,
          value: "id"
        },
        {
          text: "عنوان (en)",
          align: "right",
          sortable: true,
          value: "en_name"
        },
        {
          text: "عنوان (fa)",
          value: "name",
          align: "right",
          sortable: true
        },
        {
          text: "پیش شماره",
          value: "area_code",
          align: "right"
        },
        {
          text: "عرض جغرافیایی",
          value: "latitude",
          align: "right"
        },
        {
          text: "طول جغرافیایی",
          value: "longitude",
          align: "right"
        },
        { text: "عملیات", value: "action", align: "center", sortable: false }
      ],
      desserts: [],
      editedIndex: -1,
      editedItem: {
        id: 0,
        en_name: "",
        name: "",
        area_code: "",
        latitude: "",
        longitude: ""
      },
      defaultItem: {
        id: 0,
        en_name: "",
        name: "",
        area_code: "",
        latitude: "",
        longitude: ""
      },
      itemDestroy: {}
    };
  },
  computed: {
    formTitle() {
      return this.editedIndex === -1 ? "استان جدید" : "ویرایش استان";
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
        .get(
          `api/panel/provinces?per_page=${this.options.per_page}&page=${this.options.current}`
        )
        .then(response => {
          this.province_count = response.data.province_count;
          this.county_count = response.data.county_count;
          this.city_count = response.data.city_count;
          this.meta = response.data.meta;
          this.desserts = response.data.data;
        })
        .catch(err => {
          console.log(err);
        });
      this.loading = false;
    },

    // change page by click in paginate buttons
    async onPageChange(perPage) {
      this.loading = true;
      this.options.current = perPage;
      await this.initialize();
    },

    // Show Province Edit Dialog
    editItem(item) {
      this.editedIndex = this.desserts.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.errors = {};
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
        .delete(`api/panel/provinces/${this.itemDestroy.id}`)
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
      await this.$axios
        .post(`api/panel/provinces`, this.editedItem)
        .then(response => {
          if (response.data.success) {
            this.$toast.success(response.data.message);
            this.desserts.push(response.data.data);
            this.province_count++;
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
      let item = this.editedItem;
      await this.$axios
        .patch(`api/panel/provinces/${id}`, item)
        .then(response => {
          if (response.data.success) {
            this.$toast.success(response.data.message);
            this.$set(this.desserts, this.editedIndex, item);
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
