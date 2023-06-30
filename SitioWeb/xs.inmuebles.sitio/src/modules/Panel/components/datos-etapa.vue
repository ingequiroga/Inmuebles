<template>
  <div>
    <p >Datos Inmueble</p>
        <hr class="mt-0">
        <div class="row">
            <div class="col center">
             <p class="text-muted">Id Inmueble: <span class="text-dark fw-bold">{{inmueble.idInmueble}}</span></p> 
           </div>
              <div class="col center">
                <p class="text-muted">Nombre Deudor: <span class="text-dark fw-bold">{{inmueble.nomDeudor}} {{inmueble.apellidoDeudor}}</span></p>
              </div>
            <div class="col center">
              <p class="text-muted">Calle: <span class="text-dark fw-bold">{{inmueble.calle}}</span></p>
            </div>
        </div>
        <div> 
          <p class="text-muted">Porcentaje Etapa: <span class="text-dark fw-bold">{{porcentajeTransformado}}</span></p>
          
        </div>
  </div>
</template>

<script>
import {mapState,mapActions} from 'vuex'
export default {
    computed:{
      porcentajeTransformado: function (){
        return Math.round(this.porcProceso*100)+'%'
      },
     ...mapState('panel',['inmueble','porcProceso'])
      },
    data: function () {
    return{
      
    }
  },
  methods:{
        ...mapActions('panel',{
        getInmueble: 'getInmueble'
        }) 
    },
       created(){
      this.getInmueble(this.$route.params.id)
      
    },

}
</script>

<style>

</style>