<template>
  <v-app dark>
    <NavigationNavbar :items="menus" />

    <v-content>
      <v-container>
        <nuxt />
      </v-container>
    </v-content>

    <!-- <Footer /> -->
  </v-app>
</template>
<script>
import NavigationNavbar from "~/components/master/navigation";
import Menu from "~/components/master/menu";
import Footer from "~/components/master/footer";
export default {
  middleware: "auth",
  transition: "default",
  components: {
    NavigationNavbar,
    Footer
  },
  data() {
    return {
      menus: Menu.items
    };
  },
  created() {
    this.menusPerms();
  },
  methods: {
    async menusPerms() {
      this.menus.forEach(item => {
        item.show = this.$can(item.perm);
      });
    }
  }
};
</script>

<style lang="scss">
.page-enter-active,
.page-leave-active {
  transition-property: opacity;
  transition-timing-function: ease-in-out;
  transition-duration: 300ms;
}
.page-enter,
.page-leave-to {
  opacity: 0;
}
</style>
