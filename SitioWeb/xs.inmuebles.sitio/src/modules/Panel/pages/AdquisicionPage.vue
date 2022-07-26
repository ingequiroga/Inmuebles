<template>
   <div>
    <div>
        <p class="subtit mb-0">Datos Inmueble</p>
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
        <div v-for="(subetapa,i) in subetapas.datos" :key="subetapa.Id">
            <subetapa :subetapa="subetapa" :indice="i" @verimgs="mostrarImagenes($event)"></subetapa>
        </div>
    </div>  
          <modalImg v-if="showModalimg" @close="showModalimg = false" :imagenes="files"/>
    </div>
</template>

<script>
import  subetapa  from '../components/sub-etapa.vue';
import  modalImg  from '../components/modalArchivos.vue';
import {mapActions,mapState} from 'vuex'
import axios from 'axios'
export default {
   computed:{
     ...mapState('panel',['inmueble'])
      },
  data(){
    return{
      proceso: {},
      subetapas:{},
      files:[],
      showModalimg: false
    }
  },
  methods:{
     getProceso(){
             axios.get(process.env.VUE_APP_RUTA_API+'proceso/readOneProc.php?IdInmueble='+this.$route.params.id).then((response) => {
                            // Ensure there's something to actually assign here.
                            if (response.data) {
                                //var obj = JSON.parse(response.data.d);
                                const {proceso,subetapas} = response.data
                                this.proceso = proceso
                                this.subetapas = subetapas
                                //console.log(response.data);
                            }
                        });
     },
     mostrarImagenes(event){
        console.log(event);
        this.files=event
        this.showModalimg = true
     },
     ...mapActions('panel',{
        getInmueble: 'getInmueble'
        }) 
    },
    mounted(){
      this.getProceso()
    },
    created(){
      this.getInmueble(this.$route.params.id)
    },

  components:{
    subetapa,
    modalImg
  }  
}
</script>

<style>

</style>