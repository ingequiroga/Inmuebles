import Vue from 'vue'
import VueRouter from 'vue-router'

import panelRouter from '../modules/Panel/routes/'

Vue.use(VueRouter)

function guardMyroute(to, from, next)
{
 var isAuthenticated= false;
 const cred = getExpire('credenciales')
if(cred)
  isAuthenticated = true;
 else
  isAuthenticated= false;
 if(isAuthenticated) 
 {
  next(); // allow to enter route
 } 
 else
 {
  next({name: 'loginPage'}); // go to '/login';
 }
}

function getExpire(key) {
  const itemStr = localStorage.getItem(key)
  //si no existe regresa null
  if(!itemStr){
      return null
  }

  const item = JSON.parse(itemStr)
  const now = new Date()

  //Comparamos el tiempo de expiracion con el tiempo actual
  if(now.getTime() > item.expiry){
      localStorage.removeItem(key)
      return null
  }
  return item.data
}


const routes = [
  {
    path: '/',
    name: 'loginPage',
    component: () => import(/* webpackChunkName: "login" */ '../modules/login/pages/loginPage.vue')
  },
  {
    path: '/resetpass',
    name: 'resetpass',
    component: () => import(/* webpackChunkName: "resetpass" */ '../modules/login/pages/resetPass.vue')
  },
  {
    path: '/panel',
    beforeEnter : guardMyroute,
    ...panelRouter
  }
 
]

const router = new VueRouter({
  routes
})

export default router
