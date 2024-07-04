import { createRouter, createWebHistory } from 'vue-router'
import axiosInstance from '@/plugins/axios'
import { useAuthStore } from '@/stores/auth-store'
import { createAcl, defineAclRules } from 'vue-simple-acl'

const simpleAcl = createAcl({})
const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/admin/dashboard',
      name: 'dashboard',
      component: () => import('../views/Admin/DashboardView.vue'),
      meta: {
        requiresAuth: true,
        role: 'admin'
      }
    },
    {
      path: '/login',
      name: 'login',
      component: () => import('../views/Admin/Auth/LoginView.vue')
    },
    {
      path: '/',
      name: 'home',
      component: () => import('../views/Web/HomeView.vue')
    },
    {
      path: '/category',
      name: 'category',
      component: () => import('../views/Web/Category/ServiceView.vue')
    },
    {
      path: '/about',
      name: 'about',
      component: () => import('../views/Web/About/AboutUs.vue')
    },
    {
      path:'/adjay/:id',
      name:'adjay',
      component:() => import('../views/Web/Category/AdjayView.vue'),
      props: true,
    },
    {
      path:"/service",
      name:"service",
      component:() => import('../views/Web/Category/ServiceView.vue')

    },
    {
      path:'/register',
      name:'register',
      component:() => import('../views/Admin/Auth/RegisterView.vue')
    },
    {
      path: '/contact',
      name: 'contactus',
      component: () => import('../views/Web/Post/ContactusView.vue')
    },
    {
    path:"/profile",
    name:"profile",
    component:() => import('../views/User/UserProfileView.vue')
  },
    {
    path:"/chat",
    name:"chat",
    component:() => import('../views/Web/Chat/ChatView.vue')
  },
    {
    path:"/comment-post",
    name:"comment-post",
    component:() => import('../views/Web/commentPost/CommentView.vue')
  },
    {
    path:"/homeview",
    name:"homeview",
    component:() => import('../views/Web/HomeView.vue')
  },
    {
      path: '/partner',
      name: 'partner',
      component: () => import('../views/Web/Post/PartnerView.vue')
    },
    {
      path: '/favorite-page',
      name: 'favorite page',
      component: () => import('../views/Web/userInfo/FavoritePage.vue')
    },
    {
      path:"/post",
      name:"post",
      component:() => import('../views/Web/Post/PostCard.vue')
    },
      {
      path:"/post/create",
      name:"post",
      component:() => import('../views/Web/Post/PostCreate.vue')
    },
      {
      path:"/post/edit/:id",
      name:"edit_post",
      component:() => import('../views/Web/Post/PostEdit.vue'),
      props: true,
    },
      {
      path:"/messenger",
      name:"messenger",
      component:() => import('../views/Web/Chat/UserChat.vue')
    },
    //pyment
      {
      path:"/payment",
      name:"payment",
      component:() => import('../views/Web/userInfo/PaymentPage.vue')
    },
    {
      path: '/company/dashboard',
      name: 'CompanyDashboard',
      component: () => import('../views/Company/CompanyDashboard.vue')
    },
    
    {
      path: '/company/revenue',
      name: 'companyRevenue',
      component: () => import('../views/Web/Company/CompanyRevenue.vue')
    },


  ]
})

// router.beforeEach(async (to, from, next) => {
//   const publicPages = ['/login']
//   const authRequired = !publicPages.includes(to.path)
//   const store = useAuthStore()

//   try {
//     const { data } = await axiosInstance.get('/me')

//     store.isAuthenticated = true
//     store.user = data.data

//     store.permissions = data.data.permissions.map((item: any) => item.name)
//     store.roles = data.data.roles.map((item: any) => item.name)

//     const rules = () =>
//       defineAclRules((setRule) => {
//         store.permissions.forEach((permission: string) => {
//           setRule(permission, () => true)
//         })
//       })

//     simpleAcl.rules = rules()
//   } catch (error) {
//     /* empty */
//   }

//   if (authRequired && !store.isAuthenticated) {
//     next('/login')
//   } else {
//     next()
//   }
// })

export default { router}
