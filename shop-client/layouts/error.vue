<template>
  <v-app dark>
    <v-container fill-height style="height: calc(100vh - 58px);">
      <v-layout align-center>
        <v-flex text-center>
          <h1 class="display-2 primary--text mb-6">{{error.statusCode}}</h1>
          <p class="mb-10">{{msg(error.statusCode)}}</p>
          <v-btn to="/" outlined color="primary">برو به داشبورد مدیریتی</v-btn>
        </v-flex>
      </v-layout>
    </v-container>
  </v-app>
</template>

<script>
export default {
  layout: "default",
  props: {
    error: {
      type: Object,
      default: null
    }
  },
  data() {
    return {
      e404: "صفحه مورد نظر شما وجود ندارد"
    };
  },
  methods: {
    msg(code) {
      switch (code) {
        case 404:
          return this.e404;
          break;
        default:
          return this.error.message;
      }
    }
  }
};
</script>

<style scoped>
h1 {
  font-size: 20px;
}
</style>
