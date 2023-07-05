const UserList = () =>
  import('./components/UserList.vue' /* webpackChunkName: "resource/js/components/UserList" */)

export const routes = [ {
  name: 'home',
  path: '/',
  component: UserList
},

]