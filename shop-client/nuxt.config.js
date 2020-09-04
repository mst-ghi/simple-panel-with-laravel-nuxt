export default {
  mode: 'spa',
  /*
   ** Headers of the page
   */
  head: {
    titleTemplate: '%s - ' + process.env.npm_package_name,
    title: process.env.npm_package_name || '',
    meta: [{
        charset: 'utf-8'
      },
      {
        name: 'viewport',
        content: 'width=device-width, initial-scale=1'
      },
      {
        hid: 'description',
        name: 'description',
        content: process.env.npm_package_description || ''
      }
    ],
    link: [{
      rel: 'icon',
      type: 'image/x-icon',
      href: '/favicon.ico'
    }]
  },
  /*
   ** Customize the progress-bar color
   */
  loading: {
    color: '#fff',
    height: '3px'
  },
  /*
   ** Global CSS
   */
  css: ['~/assets/fonts/fonts.css', '~/assets/styles.css'],
  /*
   ** Plugins to load before mounting the App
   */
  plugins: [
    '~/plugins/axios',
    '~/plugins/vuetify',
    '~/plugins/can',
  ],
  /*
   ** Nuxt.js dev-modules
   */
  buildModules: ['@nuxtjs/vuetify'],
  /*
   ** Nuxt.js modules
   */
  modules: [
    '@nuxtjs/auth',
    '@nuxtjs/axios',
    '@nuxtjs/proxy',
    '@nuxtjs/recaptcha',
    '@nuxtjs/toast'
  ],
  /*
   ** recaptcha module configuration
   */
  recaptcha: {
    hideBadge: false, // Hide badge element (v3)
    language: 'en', // Recaptcha language (v2)
    siteKey: '6Ldcp7wUAAAAACIt1ZFBXYNWP_1HgmdkfbxaVj9u', // Site key for requests
    version: 3 // Version
  },
  /*
   ** auth module configuration
   */
  auth: {
    strategies: {
      local: {
        endpoints: {
          login: {
            url: 'api/panel/auth/login',
            method: 'post',
            propertyName: 'token'
          },
          user: {
            url: 'api/panel/auth/user',
            method: 'get',
            propertyName: 'data'
          },
          logout: {
            url: 'api/panel/auth/logout',
            method: 'get',
            propertyName: false
          },
          tokenRequired: true,
          tokenType: 'Bearer'
        }
      }
    }
  },
  /*
   ** axios module configuration
   */
  axios: {
    credentials: true,
    progress: true,
    proxy: true
  },
  /*
   ** axios proxy configuration
   */
  proxy: {
    '/api': {
      target: 'http://127.0.0.1:8000',
      pathRewrite: {
        '^/api/': ''
      }
    }
  },
  /*
   ** vuetify module configuration
   ** https://github.com/nuxt-community/vuetify-module
   */
  vuetify: {
    rtl: true,
    customVariables: ['~/assets/variables.scss'],
    theme: {
      dark: true,
      themes: {
        dark: {
          primary: '#21cff3',
          accent: '#FF4081',
          secondary: '#ffe18d',
          success: '#4CAF50',
          info: '#2196F3',
          warning: '#FB8C00',
          error: '#FF5252'
        },
        light: {
          primary: '#1976D2',
          accent: '#e91e63',
          secondary: '#30b1dc',
          success: '#4CAF50',
          info: '#2196F3',
          warning: '#FB8C00',
          error: '#FF5252'
        }
      }
    }
  },
  /*
   ** Toast configuration
   */
  toast: {
    duration: 3000,
    position: 'bottom-left',
    iconPack: 'mdi'
  },
  /*
   ** Build configuration
   */
  build: {
    /*
     ** You can extend webpack config here
     */
    extend(config, ctx) {}
  }
};
