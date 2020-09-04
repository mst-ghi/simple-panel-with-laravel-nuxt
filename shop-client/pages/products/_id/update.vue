<template>
  <v-layout column justify-center align-center>
    <v-flex xs12 sm12 md12>
      <Header title="برای ویرایش محصول اطلاعات مربوطه را با دقت تغییر دهید"></Header>
      <v-card>
        <v-row>
          <v-col cols="12" md="12">
            <v-form>
              <v-container class="py-0">
                <v-row>
                  <v-col cols="12" sm="3" md="3">
                    <v-text-field
                      label="انتخاب تصویر جدید"
                      :error="errors.photo != null"
                      :error-messages="errors.photo"
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
                  <v-col
                    cols="12"
                    sm="12"
                    md="9"
                    lg="9"
                    class="text-center"
                    v-if="product.photo_url !== null"
                  >
                    <v-img
                      :src="product.photo_url"
                      :lazy-src="product.photo_url"
                      aspect-ratio="1"
                      class="grey lighten-2"
                      max-width="150"
                      max-height="150"
                      style="margin:5px; text-align:center"
                    >
                      <template v-slot:placeholder>
                        <v-row class="fill-height ma-0" align="center" justify="center">
                          <v-progress-circular indeterminate color="grey lighten-5"></v-progress-circular>
                        </v-row>
                      </template>
                    </v-img>
                  </v-col>
                  <v-col cols="12" md="12" class="mt-3">
                    <v-divider></v-divider>
                  </v-col>
                  <v-col cols="12" sm="3" md="3">
                    <v-select
                      :items="brands"
                      v-model="product.brand_id"
                      label="برند"
                      :error="errors.brand_id != null"
                      :error-messages="errors.brand_id"
                      chips
                      deletable-chips
                      clearable
                    ></v-select>
                  </v-col>

                  <v-col cols="12" sm="9" md="9">
                    <v-select
                      :items="categories"
                      v-model="product.category_ids"
                      label="دسته بندی (چند انتخاب)"
                      :error="errors.category_ids != null"
                      :error-messages="errors.category_ids"
                      chips
                      deletable-chips
                      multiple
                      clearable
                    ></v-select>
                  </v-col>

                  <v-col cols="12" md="4">
                    <v-text-field
                      label="عنوان (en)"
                      class="purple-input"
                      v-model="product.title_en"
                      :error="errors.title_en != null"
                      :error-messages="errors.title_en"
                      clearable
                    />
                  </v-col>

                  <v-col cols="12" md="4">
                    <v-text-field
                      label="عنوان (fa)"
                      class="purple-input"
                      v-model="product.title_fa"
                      :error="errors.title_fa != null"
                      :error-messages="errors.title_fa"
                      clearable
                    />
                  </v-col>

                  <v-col cols="12" md="4">
                    <v-text-field
                      label="اسلاگ"
                      class="purple-input"
                      v-model="product.slug"
                      :error="errors.slug != null"
                      :error-messages="errors.slug"
                      clearable
                    />
                  </v-col>

                  <v-col cols="12" md="4">
                    <v-text-field
                      label="قیمت قبل"
                      class="purple-input"
                      v-model="product.price_old"
                      :error="errors.price_old != null"
                      :error-messages="errors.price_old"
                      clearable
                    />
                  </v-col>

                  <v-col cols="12" md="4">
                    <v-text-field
                      label="قیمت جدید"
                      class="purple-input"
                      v-model="product.price"
                      :error="errors.price != null"
                      :error-messages="errors.price"
                      clearable
                    />
                  </v-col>

                  <v-col cols="12" md="8">
                    <v-text-field
                      label="توضیح کوتاه"
                      class="purple-input"
                      v-model="product.short_desc"
                      :error="errors.short_desc != null"
                      :error-messages="errors.short_desc"
                      clearable
                    />
                  </v-col>

                  <v-col cols="12" md="12" class="mt-3 mb-3">
                    <v-divider></v-divider>
                  </v-col>

                  <v-col cols="12" sm="12" md="12">
                    <v-select
                      :items="items"
                      v-model="product.item_ids"
                      label="آیتم های خصوصیت (چند انتخاب)"
                      :error="errors.item_ids != null"
                      :error-messages="errors.item_ids"
                      chips
                      deletable-chips
                      multiple
                      clearable
                    ></v-select>
                  </v-col>

                  <v-col cols="12" md="12" class="mt-3 mb-3">
                    <v-divider></v-divider>
                  </v-col>

                  <v-col cols="12" md="12">
                    <v-textarea
                      name="input-7-1"
                      label="توضیح کامل"
                      v-model="product.long_desc"
                      :error="errors.long_desc != null"
                      :error-messages="errors.long_desc"
                      style="font-size:14px"
                      auto-grow
                      clearable
                    ></v-textarea>
                  </v-col>

                  <v-col cols="12" class="text-center">
                    <v-btn color @click="update">
                      <v-icon left dark>mdi-circle-edit-outline</v-icon>ویرایش محصول
                    </v-btn>
                  </v-col>
                </v-row>
              </v-container>
            </v-form>
          </v-col>
        </v-row>
      </v-card>
    </v-flex>
  </v-layout>
</template>

<script>
import Header from "~/components/header.vue";

export default {
  components: {
    Header
  },

  data() {
    return {
      id: this.$route.params.id,
      product: {
        photo: null,
        photo_url: null,
        category_ids: [],
        brand_id: 0,
        item_ids: [],
        title_fa: "",
        title_en: "",
        slug: "",
        price: null,
        price_old: null,
        short_desc: "",
        long_desc: "",
        status: 1
      },
      errors: {},
      categories: [],
      brands: [],
      items: [],
      imageName: "",
      imageUrl: "",
      imageFile: ""
    };
  },

  async validate({ app, params }) {
    let result = /^\d+$/.test(params.id);
    if (result) return await app.$can("product_update");
    return result;
  },

  async created() {
    await this.initProduct();
    await this.initBrands();
    await this.initCategories();
    await this.initItems();
  },

  methods: {
    async initProduct() {
      await this.$axios
        .get(`api/panel/products/${this.id}`)
        .then(response => {
          this.product = response.data.data;
        })
        .catch(err => {
          console.log(err);
        });
    },

    // fetch list of brands
    async initBrands() {
      if (this.brands != []) {
        await this.$axios
          .get(`api/panel/brands?list=short`)
          .then(response => {
            this.brands = response.data.data;
          })
          .catch(err => {
            console.log(err);
          });
      }
    },

    // fetch list of categories
    async initCategories() {
      if (this.brands != []) {
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

    async initItems() {
      if (this.items != []) {
        await this.$axios
          .get(`api/panel/attributes/items`)
          .then(response => {
            this.items = response.data.data;
          })
          .catch(err => {
            console.log(err);
          });
      }
    },

    // image file refrences
    pickFile() {
      if (this.imageName !== "") {
        this.imageName = "";
        this.imageFile = "";
        this.imageUrl = "";
      }

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

    async update() {
      let form = new FormData();

      this.product.category_ids.forEach(item => {
        form.append("category_ids[]", item);
      });
      this.product.item_ids.forEach(item => {
        form.append("item_ids[]", item);
      });

      form.append("brand_id", this.product.brand_id);
      form.append("title_fa", this.product.title_fa);
      form.append("title_en", this.product.title_en);
      form.append("price", this.product.price);
      if (this.product.price_old !== null)
        form.append("price_old", this.product.price_old);
      form.append("short_desc", this.product.short_desc);
      form.append("long_desc", this.product.long_desc);
      form.append("slug", this.product.slug);
      form.append("status", this.product.status);
      form.append("_method", "PATCH");
      if (this.imageFile !== "") form.append("photo", this.imageFile);

      this.errors = {};

      await this.$axios
        .post(`api/panel/products/${this.id}`, form, {
          headers: {
            "Content-Type": "multipart/form-data"
          }
        })
        .then(response => {
          if (response.data.success) {
            this.$toast.success(response.data.message);
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
          console.clear();
        });
    }
  }
};
</script>

<style lang="scss">
</style>
