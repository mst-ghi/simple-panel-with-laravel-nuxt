<template>
  <div>
    <v-card class="elevation-12">
      <v-toolbar class="head-form" dark>
        <v-toolbar-title style="font-size:16px"
          >ورود به داشبورد مدیریتی</v-toolbar-title
        >
      </v-toolbar>
      <v-card-text style="padding: 50px;">
        <v-form @keydown.enter="login">
          <v-row align="center" justify="center">
            <v-text-field
              label="نام کاربری"
              name="login"
              type="text"
              class="mrg"
              v-model="username"
            ></v-text-field>
          </v-row>
          <v-row align="center" justify="center">
            <v-text-field
              id="password"
              label="گذرواژه"
              name="password"
              class="mrg"
              type="password"
              v-model="password"
            ></v-text-field>
          </v-row>
        </v-form>
      </v-card-text>

      <v-card-actions>
        <div class="flex-grow-1"></div>
        <v-btn @click="login" color="primary" class="btn-login" :disabled="!btn"
          >ورود</v-btn
        >
      </v-card-actions>
    </v-card>
  </div>
</template>

<script>
export default {
  layout: "authenticate",
  data() {
    return {
      btn: false,
      username: "mostafa",
      password: "secret",
      recaptcha: ""
    };
  },
  methods: {
    async login() {
      await this.$auth
        .loginWith("local", {
          data: {
            username: this.username,
            password: this.password,
            recaptcha: this.recaptcha
          }
        })
        .catch(e => {
          console.log(e);
        });
      this.$router.push("/");
    }
  },
  async mounted() {
    if (this.$auth.loggedIn) {
      this.$router.push("/");
    } else {
      this.recaptcha = await this.$recaptcha.execute("login");
      this.btn = true;
      this.$toast.show("برای ورود اطلاعات احراز هویت خود را وارد کنید");
    }
  }
};
</script>

<style lang="scss" scoped>
.elevation-12 {
  max-width: 400px;
}
.head-form {
  border-radius: 3px;
  height: 64px;
  position: absolute;
  top: -30px;
  right: 25%;
}
.mrg {
  margin-left: 5px !important;
  margin-right: 5px !important;
  direction: ltr !important;
}
.btn-login {
  position: absolute;
  width: 50%;
  right: 25%;
  bottom: -15px;
}
</style>
