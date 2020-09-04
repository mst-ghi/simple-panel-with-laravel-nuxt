<template>
  <div>
    <v-navigation-drawer
      v-model="drawer"
      :mini-variant="miniVariant"
      :clipped="clipped"
      :mini-variant-width="60"
      :width="200"
      three-line
      bottom
      fixed
      app
      right
    >
      <v-card class="mx-auto" max-width="434" tile>
        <v-img height="100%">
          <v-row align="end" class="fill-height">
            <v-col align-self="start" class="pt-2 pa-0 text-center" cols="12">
              <nuxt-link :to="`/users/${$auth.user.id}`">
                <v-avatar class="profile" color="grey" size="90" tile>
                  <v-img src="/user.jpg"></v-img>
                </v-avatar>
              </nuxt-link>
            </v-col>
            <v-col class="py-0 text-center">
              <v-list-item color="rgba(0, 0, 0, .4)" dark>
                <v-list-item-content>
                  <v-list-item-title
                    style="font-size:18px !important"
                    class="mb-3"
                    >{{
                      $auth.user.name + " " + $auth.user.family
                    }}</v-list-item-title
                  >
                  <p style="font-size:10px" class="mb-0">
                    {{ $auth.user.email }}
                  </p>
                </v-list-item-content>
              </v-list-item>
            </v-col>
          </v-row>
        </v-img>
      </v-card>
      <v-list style="padding:0px">
        <v-divider></v-divider>
        <div v-for="(item, i) in items" :key="i">
          <v-list-item v-if="item.show" :to="item.to" router exact>
            <v-list-item-action>
              <v-icon>{{ item.icon }}</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title v-text="item.title" class="title-font Samim" />
            </v-list-item-content>
          </v-list-item>
        </div>
      </v-list>
      <template v-slot:append>
        <div class="pa-2">
          <v-btn block @click.stop="dialog = true">خروج</v-btn>
        </div>
      </template>
    </v-navigation-drawer>

    <v-app-bar :clipped-left="clipped" :elevation="24" dense fixed app>
      <v-app-bar-nav-icon @click.stop="drawer = !drawer" />
      <v-btn icon @click.stop="miniVariant = !miniVariant">
        <v-icon class="icon-bar"
          >mdi-{{ `chevron-${miniVariant ? "right" : "left"}` }}</v-icon
        >
      </v-btn>
      <v-spacer />
      <v-toolbar-title v-text="title" class="title-font Samim" />
      <v-spacer />
      <v-btn icon>
        <v-icon @click.stop="dialog = true">mdi-power-standby</v-icon>
      </v-btn>
    </v-app-bar>
    <v-dialog v-model="dialog" max-width="290">
      <v-card>
        <div class="text-center">
          <v-icon class="mt-4" size="90">mdi-power-standby</v-icon>
        </div>
        <v-card-text class="logout-text">برای خروج اطمینان داری؟</v-card-text>
        <v-card-actions>
          <div class="logout-btn">
            <v-btn dark class="logout-yes" color="darken-1" @click="logout"
              >آره</v-btn
            >
            <v-btn dark color="darken-1" @click="dialog = false">بیخیال!</v-btn>
          </div>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </div>
</template>
<script>
export default {
  props: ["items"],
  data() {
    return {
      dialog: false,
      clipped: false,
      drawer: true,
      fixed: false,
      miniVariant: false,
      right: true,
      title: "پنل مدیریت"
    };
  },
  methods: {
    async logout() {
      await this.$auth.logout();
      this.$router.push("/login");
    }
  }
};
</script>

<style lang="scss" scoped>
.name {
  font-size: 13px !important;
}
.v-list-item__title,
.v-btn__content {
  font-size: 12px !important;
}
.logout-text {
  text-align: center;
  padding-top: 12px !important;
}
.logout-btn {
  width: 100%;
  text-align: center;
}
.logout-yes {
  font-size: initial;
  font-weight: 600 !important;
}
</style>
