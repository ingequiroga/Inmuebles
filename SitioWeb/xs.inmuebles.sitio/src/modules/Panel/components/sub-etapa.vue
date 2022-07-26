<template>
<div class="card mt-5">
    <div class="card-body">
        <div class="row">
            <div class="col-md-2 text-center cardL" :class="{cerrada: datosEtapa.datos.cerrada == 1,abierta: datosEtapa.datos.cerrada == 0}" >
                    <h4>{{subetapa.Descripcion}}</h4>
                    <font-awesome-icon v-if="datosEtapa.datos.cerrada == 0" class="icono" icon="fa-solid fa-pen-to-square" />
                    <font-awesome-icon v-if="datosEtapa.datos.cerrada == 1" class="icono" icon="fa-solid fa-check" />
            </div>
            <div class="col-md-10 cardR">
                <div>
                    <span>Comentarios:</span>
                    <textarea class="form-control" v-model="datosEtapa.datos.comentarios" placeholder="agregar Comentarios" :disabled = "datosEtapa.datos.cerrada == 1"></textarea>
                </div>
                <div class="row mt-5">
                    <div class="col" v-if="datosEtapa.datos.cerrada == 0">
                        <readFile :indice="subetapa.IdTabsubetapa" @tratar="tratarimagenes($event)"/> 
                    </div> 
                    <div class="col" v-if="datosEtapa.imagenes.length > 0">
                        <ul>
                        <li v-for="(imagen,i) in datosEtapa.imagenes" :key="i">
                            {{imagen.name}}
                        </li>
                            
                        </ul>
                    </div> 
                     <div class="col text-center" v-if="datosEtapa.datos.cerrada == 1">
                        <h3>Etapa Completada</h3>
                    </div> 
                    <div class="d-flex flex-row-reverse">
                        <button @click="FinalizarEtapa()" class="mt-5 btn btn-primary">Completar</button>
                    </div>
                </div>
            </div>
        </div>        
    </div>
</div>   
</template>

<script>
import  readFile  from '../components/read-file.vue';
import axios from 'axios'

export default {
    props:{
        subetapa: {},
        indice: Number
    },
     data(){
    return{
        datosEtapa:{
            datos:{
                indice: this.indice,
                idAdquisicion: this.subetapa.IdAdquisicion,
                id: this.subetapa.IdSubEtapa,
                idEtapa: 1, //etapa Adquisicion
                comentarios:'',
                cerrada: this.subetapa.Estatus 
            },
            imagenes:[],
        } 
    }
    },
    methods:{
      tratarimagenes(event){
        console.log(event);
      this.datosEtapa.imagenes.push(event)
    },
    FinalizarEtapa(){

      this.datosEtapa.datos.cerrada = 1;
      const json = `{"IdAdquisicion": "${this.datosEtapa.datos.idAdquisicion}"
      ,"IdSubEtapa" : "${this.datosEtapa.datos.id}","IdEtapa" : "${this.datosEtapa.datos.idEtapa}",
      "Estatus" : "${this.datosEtapa.datos.cerrada}","Comentarios" : "${this.datosEtapa.datos.comentarios}"}`
      axios.post(process.env.VUE_APP_RUTA_API+'subetapa/updateSubEtapa.php',
       json,
       {headers:  {
         'Content-Type': 'application/json'}
       }) 
    }
    },
    components:{
    readFile
  }  
}
</script>

<style lang="scss">
     .icono {
        font-size:5rem; 
        color: primary
    }

    .cerrada {
        background-color: #F23545;
        color: #f8f9fa;
    }

    .abierta {
        background-color: #275D8C;
        color: #f8f9fa;
    }

    .card-body{
        padding: 0;
    }

    .cardL{
        padding: 1rem 1rem;
    }

     .cardR{
        padding: 1rem 1rem;
    }
</style>
   