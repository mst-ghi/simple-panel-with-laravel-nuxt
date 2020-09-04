<template>
  <div>
    <Header title="لیست کاربران سیستم">
      <v-chip class="ma-2" text-color="white" dark label>
        <v-icon left>mdi-alert-decagram-outline</v-icon>
        تعداد کل کاربران : {{meta.total}}
      </v-chip>
    </Header>
    <v-data-table
      :headers="headers"
      :items="desserts"
      :items-per-page="options.per_page"
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
              <v-btn class="ma-2 white--text" v-on="on" v-if="$can('user_store')">
                <v-icon left dark>mdi-account-plus</v-icon>کاربر جدید
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
                      <v-text-field
                        v-model="editedItem.username"
                        label="نام کاربری"
                        :disabled="editedIndex > -1 ? true : false"
                        :error="errors.username != null"
                        :error-messages="errors.username"
                        clearable
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6" md="4">
                      <v-text-field
                        v-model="editedItem.name"
                        label="نام"
                        :error="errors.name != null"
                        :error-messages="errors.name"
                        clearable
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6" md="4">
                      <v-text-field
                        v-model="editedItem.family"
                        :error="errors.family != null"
                        :error-messages="errors.family"
                        label="فامیل"
                        clearable
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6" md="4">
                      <v-text-field
                        v-model="editedItem.mobile"
                        :error="errors.mobile != null"
                        :error-messages="errors.mobile"
                        label="شماره همراه"
                        clearable
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6" md="4">
                      <v-text-field
                        v-model="editedItem.email"
                        :error="errors.email != null"
                        :error-messages="errors.email"
                        label="ایمیل"
                        clearable
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6" md="4">
                      <v-text-field
                        v-model="editedItem.password"
                        label="گذرواژه"
                        :error="errors.password != null"
                        :error-messages="errors.password"
                        clearable
                        :disabled="editedIndex > -1 ? true : false"
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

      <!-- Actions Template -->
      <template v-slot:item.action="{ item }">
        <nuxt-link v-if="$can('user_show_info')" :to="`/users/${item.id}`">
          <v-icon dense class="mr-2">mdi-face-profile</v-icon>
        </nuxt-link>
        <v-icon
          v-if="$can('user_update')"
          dense
          class="mr-2"
          @click="editItem(item)"
        >mdi-circle-edit-outline</v-icon>
        <v-icon
          v-if="$can('user_update_role')"
          dense
          class="mr-2"
          @click="getRole(item)"
        >mdi-account-badge-horizontal-outline</v-icon>
        <v-icon
          v-if="$can('user_destroy')"
          dense
          @click.stop="deleteAction(item)"
        >mdi-delete-alert-outline</v-icon>
      </template>
      <!-- End Template -->

      <!-- No Data Template -->
      <template v-slot:no-data>
        <v-btn color="primary" @click="initialize">تازه سازی</v-btn>
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

      <!-- User Role Template -->
      <template v-slot:item.role="{ item }">
        <v-chip text-color="white" dark label style="font-size: 11px !important">{{ item.role }}</v-chip>
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
            :total-visible="7"
            @input="onPageChange"
          ></v-pagination>
        </v-toolbar>
      </template>
      <!-- End Template -->
    </v-data-table>

    <!-- User Destroy Dialog -->
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

    <!-- Role Update Dialog -->
    <v-dialog v-model="role" max-width="460">
      <v-card>
        <v-card-text class="role-text">
          <p class="pb-3">
            نقش کاربری
            <b>"{{editedItem.username}}"</b> را انتخاب کنید
          </p>
          <v-row>
            <v-col cols="12" sm="6" md="4" v-for="role in roles" :key="role.id">
              <v-switch
                color="success"
                v-model="selectedRole"
                :label="role.title"
                :value="role.id"
                class="ma-0 pa-0"
                ripple
              ></v-switch>
            </v-col>
          </v-row>
        </v-card-text>
        <v-card-actions>
          <div class="destroy-btn">
            <v-btn color="green darken-1" text @click="role = false">بیخیال!</v-btn>
            <v-btn class="destroy-yes" color="green darken-1" text @click="syncRole">ذخیره</v-btn>
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
    return await app.$can("user_list");
  },
  components: {
    Header
  },
  data() {
    return {
      errors: {
        username: null,
        name: null,
        family: null,
        mobile: null,
        email: null,
        password: null
      },
      destroy: false, // destory Dialog
      dialog: false, // update or create Dialog
      role: false, // update role Dialog
      loading: true, // datatable loading
      totalDesserts: 0,
      options: {
        current: 1,
        page: 1,
        per_page: 18
      },
      meta: {
        total: 0
      },
      headers: [
        {
          text: "شناسه",
          align: "right",
          sortable: true,
          value: "id"
        },
        {
          text: "نام کاربری",
          align: "right",
          sortable: true,
          value: "username"
        },
        {
          text: "نام",
          value: "name",
          align: "right",
          sortable: true
        },
        {
          text: "فامیل",
          value: "family",
          align: "right",
          sortable: true
        },
        {
          text: "شماره همراه",
          value: "mobile",
          align: "right",
          sortable: true
        },
        {
          text: "ایمیل",
          value: "email",
          align: "right",
          sortable: true
        },
        {
          text: "نقش کاربری",
          value: "role",
          align: "right",
          sortable: true
        },
        { text: "وضعیت", value: "status", align: "center" },
        { text: "عملیات", value: "action", align: "center", sortable: false }
      ],
      desserts: [],
      editedIndex: -1,
      editedItem: {
        id: 0,
        username: "",
        name: "",
        family: "",
        mobile: "",
        email: "",
        password: "",
        status: 1
      },
      defaultItem: {
        id: 0,
        photo_url: "",
        username: "",
        name: "",
        family: "",
        mobile: "",
        email: "",
        password: "",
        status: 1
      },
      roles: [],
      selectedRole: 0,
      userRole: {},
      itemDestroy: {}
    };
  },
  computed: {
    formTitle() {
      return this.editedIndex === -1 ? "کاربر جدید" : "ویرایش کاربر";
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
    // Get List of Users Data
    async initialize() {
      this.loading = true;
      this.desserts = [];
      await this.$axios
        .get(
          `api/panel/users?per_page=${this.options.per_page}&page=${this.options.current}`
        )
        .then(response => {
          this.meta = response.data.meta;
          this.desserts = response.data.data;
        })
        .catch(err => {
          console.log(err);
        });
      this.loading = false;
      await this.initRoles();
    },

    // Get List Of Roles
    async initRoles() {
      await this.$axios
        .get("api/panel/roles")
        .then(response => {
          this.roles = response.data.data;
        })
        .catch(err => {
          this.$toast.error(err);
        });
    },

    // change page by click in paginate buttons
    onPageChange(perPage) {
      this.loading = true;
      this.options.current = perPage;
      this.initialize();
    },

    // Show Dialog for Update User Data
    editItem(item) {
      this.editedIndex = this.desserts.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.emptyErrors();
      this.dialog = true;
    },

    // Show Destroy Dialog
    deleteAction(item) {
      this.itemDestroy = item;
      this.destroy = true;
    },

    // delete user actions, this is call after deleteAction method
    async deleteItem() {
      this.destroy = false;
      await this.$axios
        .delete(`api/panel/users/${this.itemDestroy.id}`)
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

    // Show Role Dialog
    async getRole(item) {
      this.editedIndex = this.desserts.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.selectedRole = item.roles[0].id;
      this.role = true;
    },

    // update user role
    async syncRole() {
      await this.$axios
        .post(`api/panel/users/${this.editedItem.id}/role`, {
          role: this.selectedRole
        })
        .then(response => {
          if (response.data.success) {
            this.$toast.success(response.data.message);
            this.desserts.forEach(user => {
              if (user.id === this.editedItem.id)
                user.roles[0].id = this.selectedRole;
            });
            this.role = false;
          } else {
            this.$toast.error(response.data.message);
          }
        })
        .catch(err => {
          this.$toast.error(err);
        });
    },

    // close create or update dialog
    close() {
      this.dialog = false;
      setTimeout(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      }, 300);
    },

    // Create or Update dialog, save button bind to this method
    save() {
      // update item
      if (this.editedIndex > -1) {
        this.update();

        // new item
      } else {
        this.store();
      }
    },

    // store user action
    async store() {
      await this.$axios
        .post(`api/panel/users`, this.editedItem)
        .then(response => {
          if (response.data.success) {
            this.$toast.success(response.data.message);
            this.desserts.push(response.data.data);
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

    // update user action
    async update() {
      let id = this.desserts[this.editedIndex].id;
      let item = this.editedItem;
      await this.$axios
        .patch(`api/panel/users/${id}`, item)
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
    },

    emptyErrors() {
      this.errors = {};
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
.role-text {
  text-align: center;
  padding-top: 12px !important;
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
.v-label {
  font-size: small !important;
}
</style>
