<template>
  <v-container fill-height fluid>
    <v-row justify="center">
      <v-col cols="12" md="4">
        <MaterialCard class="v-card-profile">
          <v-avatar slot="offset" class="mx-auto d-block elevation-6" size="130">
            <img :src="user.photo_url" />
          </v-avatar>

          <v-card-text class="text-center">
            <h5 class="mb-3">{{user.role.title}}</h5>
            <h2 class="mb-4">{{ user.name + ' ' + user.family }}</h2>
            <v-chip class="ma-2" text-color="white" dark label>
              <v-icon left>mdi-cellphone-sound</v-icon>
              {{ user.mobile }}
            </v-chip>
            <v-chip class="ma-2" text-color="white" dark label>
              <v-icon left>mdi-email-outline</v-icon>
              {{user.email}}
            </v-chip>
          </v-card-text>
        </MaterialCard>
      </v-col>
      <v-col cols="12" md="8">
        <material-card color text="برای ویرایش اطلاعات جدید را وارد کنید">
          <v-form>
            <v-container class="py-0">
              <v-row>
                <v-col cols="12" md="4">
                  <v-text-field label="نام کاربری (غیرفعال)" disabled v-model="user.username" />
                </v-col>

                <v-col cols="12" md="4">
                  <v-text-field class="purple-input" label="نام" v-model="user.name" />
                </v-col>

                <v-col cols="12" md="4">
                  <v-text-field label="فامیل" class="purple-input" v-model="user.family" />
                </v-col>

                <v-col cols="12" md="3">
                  <v-text-field label="شماره همراه" class="purple-input" v-model="user.mobile" />
                </v-col>

                <v-col cols="12" md="6">
                  <v-text-field label="ایمیل" class="purple-input" v-model="user.email" />
                </v-col>

                <v-col cols="12" md="3">
                  <v-text-field label="گذرواژه" class="purple-input" v-model="user.password" />
                </v-col>

                <v-col cols="12" class="text-center">
                  <v-btn color @click="update">ویرایش اطلاعات کاربر</v-btn>
                </v-col>
              </v-row>
            </v-container>
          </v-form>
        </material-card>
      </v-col>
      <v-col cols="12" md="12">
        <material-card class="mt-1" color text="آدرس های کاربر">
          <v-btn @click="dialog = true" color class="add-address">
            <v-icon left>mdi-plus</v-icon>افزودن
          </v-btn>
          <v-form>
            <v-container class="py-0">
              <v-row>
                <v-col cols="12" md="6" v-for="address in addresses" :key="address.id">
                  <v-card class="mx-auto" dark>
                    <v-card-title>
                      <span style="font-size:16px">
                        <v-chip class="ma-2" text-color="white" dark label>
                          <v-icon left>mdi-account-circle-outline</v-icon>
                          {{address.name}} {{address.family}}
                        </v-chip>
                      </span>
                      <span style="font-size:16px">
                        <v-chip class="ma-2" text-color="white" dark label>
                          <v-icon left>mdi-cellphone-sound</v-icon>
                          {{address.mobile}}
                        </v-chip>
                      </span>
                      <span style="font-size:16px" v-if="address.phone">
                        <v-chip class="ma-2" text-color="white" dark label>
                          <v-icon left>mdi-phone-classic</v-icon>
                          {{address.phone}}
                        </v-chip>
                      </span>
                    </v-card-title>

                    <v-card-text>
                      <v-tooltip bottom>
                        <template v-slot:activator="{ on }">
                          <v-chip class="ma-2" text-color="white" v-on="on" dark label>
                            <v-icon left>mdi-crosshairs-gps</v-icon>
                            {{address.province_name}}
                          </v-chip>
                        </template>
                        <span>استان</span>
                      </v-tooltip>

                      <v-tooltip bottom>
                        <template v-slot:activator="{ on }">
                          <v-chip class="ma-2" text-color="white" v-on="on" dark label>
                            <v-icon left>mdi-city-variant-outline</v-icon>
                            {{address.county_name}}
                          </v-chip>
                        </template>
                        <span>شهرستان</span>
                      </v-tooltip>

                      <v-tooltip bottom>
                        <template v-slot:activator="{ on }">
                          <v-chip class="ma-2" text-color="white" v-on="on" dark label>
                            <v-icon left>mdi-city</v-icon>
                            {{address.city_name}}
                          </v-chip>
                        </template>
                        <span>شهر</span>
                      </v-tooltip>

                      <div class="mt-3 mr-3">
                        <p>آدرس : {{address.address}}</p>
                        <p>کدپستی : {{address.postal_code}}</p>
                      </div>
                    </v-card-text>
                    <v-icon
                      color="success"
                      style="position: absolute;top: 0;"
                      v-if="address.default"
                    >mdi-check-decagram</v-icon>
                    <v-tooltip top>
                      <template v-slot:activator="{ on }">
                        <v-btn
                          dark
                          v-on="on"
                          class="edit-address pr-0 pl-0"
                          @click="editItem(address)"
                        >
                          <v-icon>mdi-circle-edit-outline</v-icon>
                        </v-btn>
                      </template>
                      <span>ویرایش آدرس</span>
                    </v-tooltip>
                  </v-card>
                </v-col>
              </v-row>
            </v-container>
          </v-form>
        </material-card>
      </v-col>
    </v-row>
    <!-- dialog for create or update address -->
    <v-dialog v-model="dialog" max-width="1000px">
      <v-card>
        <v-card-title>
          <span>{{ formTitle }}</span>
        </v-card-title>

        <v-card-text>
          <v-container>
            <v-row>
              <v-col cols="12" sm="6" md="4">
                <v-select
                  :items="provinces"
                  v-model="selectedProvince"
                  label="استان"
                  clearable
                  @change="countyInit"
                ></v-select>
              </v-col>
              <v-col cols="12" sm="6" md="4">
                <v-select
                  :disabled="selectedProvince === null"
                  :items="counties"
                  v-model="selectedCounty"
                  label="شهرستان"
                  clearable
                  @change="cityInit"
                ></v-select>
              </v-col>
              <v-col cols="12" sm="6" md="4">
                <v-select
                  :disabled="selectedCounty === null"
                  :items="cities"
                  v-model="selectedCity"
                  label="شهر"
                  :error="errors.city_id != null"
                  :error-messages="errors.city_id"
                  clearable
                ></v-select>
              </v-col>
              <v-col cols="12" sm="6" md="3">
                <v-text-field
                  v-model="editedItem.name"
                  label="نام"
                  :error="errors.name != null"
                  :error-messages="errors.name"
                  clearable
                ></v-text-field>
              </v-col>
              <v-col cols="12" sm="6" md="3">
                <v-text-field
                  v-model="editedItem.family"
                  :error="errors.family != null"
                  :error-messages="errors.family"
                  label="فامیل"
                  clearable
                ></v-text-field>
              </v-col>
              <v-col cols="12" sm="6" md="3">
                <v-text-field
                  v-model="editedItem.mobile"
                  :error="errors.mobile != null"
                  :error-messages="errors.mobile"
                  label="شماره همراه"
                  clearable
                ></v-text-field>
              </v-col>
              <v-col cols="12" sm="6" md="3">
                <v-text-field
                  v-model="editedItem.phone"
                  :error="errors.phone != null"
                  :error-messages="errors.phone"
                  label="تلفن ثابت"
                  clearable
                ></v-text-field>
              </v-col>
              <v-col cols="12" sm="6" md="3">
                <v-text-field
                  v-model="editedItem.postal_code"
                  :error="errors.postal_code != null"
                  :error-messages="errors.postal_code"
                  label="کدپستی"
                  clearable
                ></v-text-field>
              </v-col>
              <v-col cols="12" sm="9" md="9">
                <v-text-field
                  v-model="editedItem.address"
                  label="آدرس"
                  :error="errors.address != null"
                  :error-messages="errors.address"
                  clearable
                ></v-text-field>
              </v-col>
              <v-col cols="12" sm="6" md="3" style="position: absolute;bottom: 5px;">
                <v-switch
                  color="success"
                  v-model="editedItem.default"
                  label="بعنوان پیشفرض"
                  :value="editedItem.default"
                  class="ma-0 pa-0"
                  ripple
                ></v-switch>
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
  </v-container>
</template>

<script>
import MaterialCard from "~/components/common/material-card.vue";
export default {
  components: {
    MaterialCard
  },
  validate({ params }) {
    return /^\d+$/.test(params.id);
  },
  data() {
    return {
      id: this.$route.params.id,
      user: {
        id: 0,
        email: "",
        family: "",
        mobile: "",
        name: "",
        photo_url: "",
        role: {
          id: 0,
          label: "",
          title: "",
          description: ""
        }
      },
      rules: [
        value =>
          !value ||
          value.size < 200000 ||
          "تصویر میبایست کمتر از 200 کیلوبایت باشد!"
      ],
      dialog: false,
      addresses: [],
      provinces: [],
      selectedProvince: null,
      counties: [],
      selectedCounty: null,
      cities: [],
      selectedCity: null,
      errors: {},
      editedIndex: -1,
      editedItem: {
        id: 0,
        user_id: 0,
        city_id: 0,
        name: "",
        family: "",
        mobile: "",
        phone: "",
        address: "",
        postal_code: "",
        default: 1
      },
      defaultItem: {
        id: 0,
        user_id: 0,
        city_id: 0,
        name: "",
        family: "",
        mobile: "",
        phone: "",
        address: "",
        postal_code: "",
        default: 1
      }
    };
  },
  computed: {
    formTitle() {
      return this.editedIndex === -1 ? "آدرس جدید" : "ویرایش آدرس";
    }
  },

  watch: {
    dialog(val) {
      val || this.close();
    }
  },
  async created() {
    await this.initials();
    await this.initAddresses();
    await this.provinceInit();
  },
  methods: {
    // get user info by id param
    async initials() {
      await this.$axios
        .get(`api/panel/users/${this.id}/info`)
        .then(response => {
          this.user = response.data.data;
        })
        .catch(err => {
          this.$toast.error(err);
        });
    },

    // get user info by id param
    async initAddresses() {
      await this.$axios
        .get(`api/panel/addresses/${this.id}`)
        .then(response => {
          this.addresses = response.data.data;
        })
        .catch(err => {
          this.$toast.error(err);
        });
    },

    // get province list data from server
    async provinceInit() {
      if (this.provinces != []) {
        await this.$axios
          .get(`api/panel/provinces`)
          .then(response => {
            this.provinces = response.data.data;
          })
          .catch(err => {
            console.log(err);
          });
      }
    },

    // get county list data from server
    async countyInit() {
      this.counties = [];
      let url = `api/panel/counties`;
      if (this.selectedProvince) {
        url += `?province_id=${this.selectedProvince}`;
      }
      await this.$axios
        .get(url)
        .then(response => {
          this.counties = response.data.data;
        })
        .catch(err => {
          console.log(err);
        });
    },

    // get county list data from server
    async cityInit() {
      this.cities = [];
      let url = `api/panel/cities`;
      if (this.selectedCounty) {
        url += `?county_id=${this.selectedCounty}`;
      }
      await this.$axios
        .get(url)
        .then(response => {
          this.cities = response.data.data;
        })
        .catch(err => {
          console.log(err);
        });
    },

    // update user info by this method
    async update() {
      let data = {
        name: this.user.name,
        family: this.user.family,
        mobile: this.user.mobile,
        email: this.user.email
      };
      if (this.user.password) {
        data.password = this.user.password;
      }
      await this.$axios
        .post(`api/panel/users/${this.id}/info`, data)
        .then(response => {
          this.user.password = "";
          this.$toast.success(response.data.message);
        })
        .catch(err => {
          this.$toast.error(err);
        });
    },

    // Show Dialog for Update User Data
    editItem(item) {
      this.editedIndex = this.addresses.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.selectedProvince = item.province_id;
      this.selectedCounty = item.county_id;
      this.selectedCity = item.city_id;
      this.countyInit();
      this.cityInit();
      this.errors = {};
      this.dialog = true;
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
        this.updateAddress();
        // new item
      } else {
        this.storeAddress();
      }
    },

    async storeAddress() {
      this.errors = {};
      let data = {
        city_id: this.selectedCity,
        mobile: this.editedItem.mobile,
        name: this.editedItem.name,
        family: this.editedItem.family,
        postal_code: this.editedItem.postal_code,
        address: this.editedItem.address,
        default: this.editedItem.default
      };

      if (this.editedItem.phone !== "") data.phone = this.editedItem.phone;

      await this.$axios
        .post(`api/panel/addresses/${this.id}`, data)
        .then(response => {
          if (response.data.success) {
            this.$toast.success(response.data.message);
            this.addresses.push(response.data.data);
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

    async updateAddress() {
      this.errors = {};
      let id = this.addresses[this.editedIndex].id;
      let data = {
        city_id: this.selectedCity,
        mobile: this.editedItem.mobile,
        name: this.editedItem.name,
        family: this.editedItem.family,
        postal_code: this.editedItem.postal_code,
        address: this.editedItem.address,
        default: this.editedItem.default
      };

      if (this.editedItem.phone !== "") data.phone = this.editedItem.phone;

      await this.$axios
        .patch(`api/panel/addresses/${this.id}/${id}`, data)
        .then(response => {
          if (response.data.success) {
            this.$toast.success(response.data.message);
            this.$set(this.addresses, this.editedIndex, this.editedItem);
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

<style lang="scss">
.add-address {
  position: absolute;
  top: 0px;
  left: 30px;
  z-index: 20;
}

.edit-address {
  position: absolute;
  left: 25px;
  bottom: 20px;
}
</style>
