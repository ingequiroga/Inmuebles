<template>
   <div>

      <datosetapa />
  
    <div>    
        <div v-for="(subetapa,i) in subetapas.datos" :key="subetapa.Id">
            <subetapa :subetapa="subetapa" :indice="i" @verimgs="mostrarImagenes($event)" @modfin="mostrarModalSub($event)"></subetapa>
        </div>
        <div v-if="proceso.Estatus!='Cerrado'" class="mt-5 mb-5" >
          <button :disabled="porcProceso < 0.95" class="btn btn-primary" @click="finalizar()">Cerrar Proceso</button>
        </div>
    </div>  
          <modalImg v-if="showModalimg" @close="showModalimg = false" :imagen="file"/>
          <modalfin v-if="showModalfin" @close="showModalfin = false" :proceso="proceso" />
          <modalsub v-if="showModalSub" @close="showModalSub = false" :descripcion = "descripcionSub"/>
    </div>
</template>

<script>
import  subetapa  from '../components/sub-etapa.vue';
import  modalImg  from '../components/modalArchivos.vue';
import  datosetapa  from '../components/datos-etapa.vue';
import  modalfin  from '../components/modal-finalizar.vue';
import  modalsub  from '../components/FinSub-modal.vue';
import {mapState,mapActions} from 'vuex'
import axios from 'axios'
export default {
   computed:{
     ...mapState('panel',['porcProceso','inmueble'])
      },
  data(){
    return{
      proceso: {},
      subetapas:{},
      file:{},
      showModalimg: false,
      showModalfin: false,
      showModalSub: false,
      descripcionSub:''
    }
  },
  methods:{
     getProceso(){
             
             axios.post(process.env.VUE_APP_RUTA_API+'proceso/readOneProc.php',
             {
              Idinmueble: this.$route.params.id,
              IdProceso: this.$route.params.proceso
             })
             .then((response) => {
             
                            // Ensure there's something to actually assign here.
                            console.log(response.data);
                            if (response.data) {
                                //var obj = JSON.parse(response.data.d);
                                const {proceso,subetapas} = response.data
                               
                                let ids = {
                                  idEtapa: proceso.IdEtapa,
                                  IdProceso: this.$route.params.proceso
                                }
                                this.guardarIdsProceso(ids)
                                this.proceso = proceso
                                this.subetapas = subetapas
                                this.getincrementoporc(subetapas)
                                this.getporc(subetapas)
                                this.proceso.Porcentaje = parseFloat(this.porcProceso)
                                this.proceso.idInmueble = this.inmueble.idInmueble
                            }
                        });
     },
     mostrarImagenes(event){
        
         this.file=event
         this.showModalimg = true
     },
     finalizar(){
      this.showModalfin=true
     },
     mostrarModalSub(desc){
      this.descripcionSub = desc
      this.showModalSub = true
     },
      ...mapActions('panel',{
        getporc: 'getporcentaje',
        getincrementoporc: 'getincrementoporc',
        guardarIdsProceso: 'guardarIdsProceso'
        }) 


    },
    mounted(){  
      this.getProceso()  
    },
  components:{
    subetapa,
    modalImg,
    datosetapa,
    modalfin,
    modalsub
  }  
}
</script>

<style>
  
</style>