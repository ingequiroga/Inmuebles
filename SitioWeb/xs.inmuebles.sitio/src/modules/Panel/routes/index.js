export default{
    name: '',
    component: () => import(/* webpackChunkName: "Cotizador" */ '@/modules/Panel/layouts/panel-layout.vue'),
    children:[
      {
        path: '', 
        name: 'panelhome',
        component: () => import(/* webpackChunkName: "BuscarPage "*/'@/modules/Panel/pages/Panel-Home.vue')   
    },
    {
      path: '/addinmueble', 
      name: 'AddInmueble',
      component: () => import(/* webpackChunkName: "Agregar inmueble "*/'@/modules/Panel/pages/AddInmueble.vue')   
   },
   {
    path: '/inmuebles', 
    name: 'Inmuebles',
    component: () => import(/* webpackChunkName: "Inmuebles "*/'@/modules/Panel/pages/Inmuebles-page.vue')   
 }

]
}