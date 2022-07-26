
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
    path: '/catalogos', 
    name: 'Catalogos',
    component: () => import(/* webpackChunkName: "Catalogos "*/'@/modules/Panel/pages/CatalogosPage.vue')   
    },
    {
    path: '/inmuebles', 
    name: 'Inmuebles',
    component: () => import(/* webpackChunkName: "Inmuebles "*/'@/modules/Panel/pages/Inmuebles-page.vue')   
    },
    {
    path: '/carga', 
    name: 'CargaMasiva',
    component: () => import(/* webpackChunkName: "Carga Masiva de inmuebles "*/'@/modules/Panel/pages/CargaMasivaPage.vue')   
    },
    {
    path: '/usuario', 
    name: 'Usuario',
    component: () => import(/* webpackChunkName: "Administrar Usuarios "*/'@/modules/Panel/pages/AddUserPage.vue')   
    },
    {
    path: '/municipio', 
    name: 'Municipio',
    component: () => import(/* webpackChunkName: "Administrar Municipio "*/'@/modules/Panel/pages/AddMunicipioPage.vue')   
    },
    {
    path: '/banyrec', 
    name: 'BancosyRec',
    component: () => import(/* webpackChunkName: "Administrar Bancos y Recuperadoras  "*/'@/modules/Panel/pages/AddBanyRecPage.vue')   
    },
    {
    path: '/:id', 
    name: 'Adquisicion',
    component: () => import(/* webpackChunkName: "Proceso de Adquisicion de Inmuebles  "*/'@/modules/Panel/pages/AdquisicionPage.vue'),   
   }

]
}