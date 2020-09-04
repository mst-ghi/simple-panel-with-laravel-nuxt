<template>
  <v-layout column justify-center align-center>
    <v-row style="width:100%">
      <v-col cols="12" md="6" style="width:100%">
        <SaleChart />
      </v-col>

      <v-col cols="12" md="6" style="width:100%">
        <ReturnedChart />
      </v-col>
    </v-row>
  </v-layout>
</template>

<script>
import SaleChart from "~/components/charts/sales.vue";
import ReturnedChart from "~/components/charts/returned.vue";
export default {
  middleware: "auth",
  components: {
    SaleChart,
    ReturnedChart
  }
};
</script>
