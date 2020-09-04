<template>
  <div>
    <Header title="لیست محصولات ثبت شده سیستم">
      <v-chip class="ma-2" text-color="white" dark label>
        <v-icon left>mdi-alert-decagram-outline</v-icon>
        تعداد کل محصولات ها : {{productCount}}
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
          <nuxt-link to="/products/new">
            <v-btn v-if="$can('product_store')" class="ma-2 white--text">
              <v-icon left dark>mdi-plus-outline</v-icon>محصول جدید
            </v-btn>
          </nuxt-link>
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
        <nuxt-link v-if="$can('product_update')" :to="`/products/${item.id}/update`">
          <v-icon dense class="ml-2">mdi-circle-edit-outline</v-icon>
        </nuxt-link>
        <v-icon
          dense
          v-if="$can('product_status')"
          @click.stop="statusAction(item)"
        >mdi-flag-variant-outline</v-icon>
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

    <!-- User status Dialog -->
    <v-dialog v-model="statusDialog" max-width="500">
      <v-card>
        <div class="text-center">
          <v-icon class="mt-4" size="90">mdi-flag-variant-outline</v-icon>
        </div>
        <v-card-text class="destroy-text">{{statusModalTitle}}</v-card-text>
        <v-card-text class="destroy-text">
          <v-row style="padding-right:45%">
            <v-switch
              color="success"
              v-model="itemStatus.status"
              :label="itemStatus.status ? 'فعال' : 'غیرفعال'"
              :value="true"
              class="ma-0 pa-0"
              ripple
            ></v-switch>
          </v-row>
        </v-card-text>
        <v-card-actions>
          <div class="destroy-btn">
            <v-btn dark class="destroy-yes" color="darken-1" @click="statusItem">ثبت</v-btn>
            <v-btn dark color="darken-1" @click="statusDialog = false">بیخیال!</v-btn>
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
    return await app.$can("product_list");
  },
  components: {
    Header
  },
  data() {
    return {
      loading: true,
      totalDesserts: 0,
      productCount: 0,
      meta: {},
      options: {
        visible: 7,
        current: 1,
        page: 1,
        per_page: 30
      },
      desserts: [],
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
          text: "برند",
          align: "right",
          sortable: true,
          value: "brand_title"
        },
        {
          text: "عنوان (en)",
          align: "right",
          sortable: true,
          value: "title_en"
        },
        {
          text: "عنوان (fa)",
          value: "title_fa",
          align: "right",
          sortable: true
        },
        {
          text: "اسلاگ",
          value: "slug",
          align: "right",
          sortable: true
        },
        {
          text: "قیمت",
          value: "price",
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
      statusDialog: false,
      status: false,
      statusModalTitle: "",
      itemStatus: {}
    };
  },

  async created() {
    await this.initialize();
  },

  methods: {
    // Get Role List Data From Server
    async initialize() {
      this.loading = true;
      await this.$axios
        .get(
          `api/panel/products?per_page=${this.options.per_page}&page=${this.options.current}`
        )
        .then(response => {
          this.productCount = response.data.product_count;
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

    // Show statusDialog Dialog
    statusAction(item) {
      this.itemStatus = item;
      this.itemStatus.status = item.status ? true : false;
      this.statusModalTitle = `وضعیت محصول "${item.title_fa}" رو مشخص کن و ثبت بزن`;
      this.statusDialog = true;
    },

    // change status product
    async statusItem() {
      this.statusDialog = false;
      await this.$axios
        .get(
          `api/panel/products/${this.itemStatus.id}/status?flag=${
            this.itemStatus.status ? "1" : "0"
          }`
        )
        .then(response => {
          if (response.data.success) {
            this.$toast.success(response.data.message);
          } else {
            this.$toast.error(response.data.message);
          }
        })
        .catch(err => {
          this.$toast.error(err);
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
