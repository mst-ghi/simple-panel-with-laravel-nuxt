<template>
  <v-app dark>
    <v-container fill-height style="height: calc(100vh - 58px);">
      <v-layout align-center>
        <v-flex text-center>
          <h1 class="display-2 primary--text mb-6">404</h1>
          <p class="mb-10">صفحه یا داده ی مورد نظر شما وجود ندارد</p>
          <v-btn to="/" outlined color="primary">برو به داشبورد مدیریتی</v-btn>
        </v-flex>
      </v-layout>
    </v-container>
  </v-app>
</template>

<script>
export default {
  layout: "default"
};
</script>

<style scoped>
h1 {
  font-size: 20px;
}
</style>
