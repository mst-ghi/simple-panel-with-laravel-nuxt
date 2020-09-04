<template>
  <div>
    <v-card class="mx-auto text-center">
      <v-card-text>
        <p class="text--primary">{{title}}</p>

        <slot></slot>
      </v-card-text>
    </v-card>
  </div>
</template>

<script>
export default {
  props: ["title"]
};
</script>

<style lang="scss" scoped>
.mx-auto {
  margin-bottom: 10px !important;
}
</style>
