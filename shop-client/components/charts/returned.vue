<template>
  <v-card class="mx-auto text-center" dark>
    <v-card-text>
      <v-sheet dark>
        <v-sparkline
          :value="item.value"
          color="#66BB6A"
          height="100"
          padding="10"
          line-width="2.5"
          auto-draw
          :auto-draw-duration="drawDuration"
          stroke-linecap="round"
          show-labels
        >
          <template v-slot:label="item">{{ item.value }}</template>
        </v-sparkline>
      </v-sheet>
    </v-card-text>

    <v-divider></v-divider>

    <v-card-text>
      <div class="font-weight-thin">میزان مرجوعی در دو هفته گذشته</div>
    </v-card-text>
  </v-card>
</template>

<script>
export default {
  data() {
    return {
      drawDuration: 2000,
      item: {
        value: []
      }
    };
  },

  async created() {
    await this.initChart();
  },

  methods: {
    async initChart() {
      for (let index = 0; index < 15; index++) {
        this.item.value.push(this.getRandom());
      }
    },
    getRandom() {
      return Math.floor(Math.random() * Math.floor(100));
    }
  }
};
</script>
