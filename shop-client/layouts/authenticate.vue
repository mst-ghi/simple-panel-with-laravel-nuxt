<template>
  <div>
    <v-app>
      <v-content>
        <v-container class="fill-height" fluid>
          <v-row align="center" justify="center">
            <v-col cols="12" sm="8" md="4">
              <nuxt />
            </v-col>
          </v-row>
        </v-container>
      </v-content>
    </v-app>
  </div>
</template>
<script>
export default {};
</script>

<style scope lang="scss">
.v-application .headline {
  font-family: Samim, "Roboto", sans-serif !important;
  font-weight: normal;
}
.title-font {
  font-size: 14px;
}
.icon-bar {
  font-size: 18px;
}
</style>
