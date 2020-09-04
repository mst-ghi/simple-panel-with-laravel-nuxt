export default {
  items: [{
      perm: 'user_list',
      icon: 'mdi-apps',
      title: 'داشبورد',
      to: '/'
    },
    {
      perm: 'user_list',
      icon: 'mdi-account-supervisor-outline',
      title: 'کاربران',
      to: '/users'
    },
    {
      perm: 'product_list',
      icon: 'mdi-lumx',
      title: 'محصولات',
      to: '/products'
    },
    {
      perm: 'category_list',
      icon: 'mdi-arrow-decision',
      title: 'دسته بندی ها',
      to: '/categories'
    },
    {
      perm: 'brand_list',
      icon: 'mdi-apple-finder',
      title: 'برند ها',
      to: '/brands'
    },
    {
      perm: 'attribute_group_list',
      icon: 'mdi-vector-polygon',
      title: 'خصوصیات',
      to: '/attributes/groups'
    },
    {
      perm: 'role_list',
      icon: 'mdi-account-details',
      title: 'نقش ها',
      to: '/roles'
    },
    {
      perm: 'province_list',
      icon: 'mdi-map-marker',
      title: 'مناطق',
      to: '/locations'
    }
  ]
};
