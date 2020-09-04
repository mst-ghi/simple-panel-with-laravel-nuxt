<template>
  <div>
    <Header title="لیست نقش های کاربری سیستم">
      <v-chip class="ma-2" text-color="white" dark label>
        <v-icon left>mdi-alert-decagram-outline</v-icon>
        تعداد کل نقش های کاربری : {{totalDesserts}}
      </v-chip>
      <v-chip class="ma-2" text-color="white" dark label>
        <v-icon left>mdi-alert-decagram-outline</v-icon>
        تعداد کل مجوز های سیستم : {{totalPermissions}}
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
              <v-btn v-if="$can('role_store')" class="ma-2 white--text" v-on="on">
                <v-icon left dark>mdi-plus-outline</v-icon>نقش کاربری جدید
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
                        v-model="editedItem.label"
                        label="عنوان (en)"
                        :error="errors.label != null"
                        :error-messages="errors.label"
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
                        v-model="editedItem.description"
                        label="توضیح"
                        :error="errors.description != null"
                        :error-messages="errors.description"
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

      <!-- Actions Template -->
      <template v-slot:item.action="{ item }">
        <v-icon
          dense
          v-if="$can('role_update_permissions')"
          class="ml-2"
          @click="syncPermissionDialog(item)"
        >mdi-alpha-p-circle-outline</v-icon>
        <v-icon
          dense
          v-if="$can('role_update')"
          class="ml-2"
          @click="editItem(item)"
        >mdi-circle-edit-outline</v-icon>
        <v-icon
          dense
          v-if="$can('role_destroy')"
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

    <!-- Permissions Dialog -->
    <v-dialog v-model="sync" max-width="1024" scrollable>
      <v-card>
        <v-card-text class="destroy-text">
          <p style="font-size:18px;">
            مجوز های مربوط به
            <b>"{{editedItem.title}}"</b>
            رو انتخاب کن.
          </p>
          <v-divider></v-divider>
          <v-row>
            <v-col cols="12" sm="6" md="3" v-for="perms in permissions" :key="perms.id">
              <v-switch
                color="success"
                v-model="selectedPerms"
                :label="perms.title"
                :value="perms.id"
                class="ma-0 pa-0"
                ripple
              ></v-switch>
            </v-col>
          </v-row>
        </v-card-text>
        <v-card-actions>
          <div class="destroy-btn">
            <v-btn color="green darken-1" text @click="sync = false">بیخیال!</v-btn>
            <v-btn class="destroy-yes" color="green darken-1" text @click="syncPermission">ذخیره</v-btn>
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
      errors: {
        label: null,
        title: null,
        description: null
      },
      destroy: false,
      sync: false,
      loading: true,
      dialog: false,
      totalDesserts: 0,
      totalPermissions: 0,
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
          value: "label"
        },
        {
          text: "عنوان (fa)",
          value: "title",
          align: "right",
          sortable: true
        },
        {
          text: "توضیح",
          value: "description",
          align: "right"
        },
        { text: "عملیات", value: "action", align: "center", sortable: false }
      ],
      desserts: [],
      editedIndex: -1,
      editedItem: {
        id: 0,
        label: "",
        title: "",
        description: ""
      },
      defaultItem: {
        id: 0,
        label: "",
        title: "",
        description: ""
      },
      itemDestroy: {},
      permissions: [],
      rolePerms: [],
      selectedPerms: []
    };
  },
  computed: {
    formTitle() {
      return this.editedIndex === -1 ? "نقش کاربری جدید" : "ویرایش نقش کاربری";
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
    // Get Role List Data From Server
    async initialize() {
      this.loading = true;
      await this.$axios
        .get(`api/panel/roles`)
        .then(response => {
          this.totalDesserts = response.data.total;
          this.totalPermissions = response.data.total_permissions;
          this.desserts = response.data.data;
        })
        .catch(err => {
          console.log(err);
        });
      this.loading = false;

      await this.getPermissionList();
    },

    // Get Permission List Data
    async getPermissionList() {
      await this.$axios
        .get(`api/panel/permissions`)
        .then(response => {
          this.permissions = response.data.data;
        })
        .catch(err => {
          console.log(err);
        });
    },

    // Show Role Edit Dialog
    editItem(item) {
      this.editedIndex = this.desserts.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.errors = {};
      this.dialog = true;
    },

    // Show Role Permissions Dialog
    async syncPermissionDialog(item) {
      this.editedIndex = this.desserts.indexOf(item);
      this.editedItem = Object.assign({}, item);

      await this.$axios
        .get(`api/panel/roles/${this.editedItem.id}/permissions`)
        .then(response => {
          this.rolePerms = response.data.data;
          this.selectedPerms = [];
          this.permissions.forEach(perm => {
            if (
              this.rolePerms.filter(element => {
                return element.id === perm.id;
              }).length > 0
            ) {
              this.selectedPerms.push(perm.id);
            }
          });
        })
        .catch(err => {
          console.log(err);
        });

      this.sync = true;
    },

    // Sync Role Permission Action
    async syncPermission() {
      await this.$axios
        .post(`api/panel/roles/${this.editedItem.id}/permissions`, {
          permissions: this.selectedPerms
        })
        .then(response => {
          if (response.data.success) {
            this.$toast.success(response.data.message);
            this.sync = false;
          } else {
            this.$toast.error(response.data.message);
          }
        })
        .catch(err => {
          this.$toast.error(err);
        });
    },

    // Show Destroy Dialog
    deleteAction(item) {
      this.itemDestroy = item;
      this.destroy = true;
    },

    // Role Destroy Action
    async deleteItem() {
      this.destroy = false;
      await this.$axios
        .delete(`api/panel/roles/${this.itemDestroy.id}`)
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

    // Store new Role Action
    async store() {
      await this.$axios
        .post(`api/panel/roles`, this.editedItem)
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

    // Update Exist Role
    async update() {
      let id = this.desserts[this.editedIndex].id;
      let item = this.editedItem;
      await this.$axios
        .patch(`api/panel/roles/${id}`, item)
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
