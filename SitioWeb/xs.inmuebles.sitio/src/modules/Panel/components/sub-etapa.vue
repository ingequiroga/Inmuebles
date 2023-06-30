<template>
<div class="card mt-5">
    <div class="card-body">
        <div class="row">
            <div class="col-md-2 text-center cardL" :class="{cerrada: datosEtapa.datos.cerrada == 1,abierta: datosEtapa.datos.cerrada == 0}" >
                    <h4>Etapa: {{subetapa.Descripcion}}</h4>
                    <font-awesome-icon v-if="datosEtapa.datos.cerrada == 0" class="icono" icon="fa-solid fa-pen-to-square" />
                    <font-awesome-icon v-if="datosEtapa.datos.cerrada == 1" class="icono" icon="fa-solid fa-check" />
                       <div v-if="datosEtapa.datos.cerrada == 1">
                        <h2>Estatus: Completa</h2>
                    </div> 
            </div>
            <div class="col-md-6 cardR">
                <div>
                    <span>Comentarios:</span>
                    <textarea class="form-control" v-model="datosEtapa.datos.comentarios" placeholder="agregar Comentarios" :disabled = "datosEtapa.datos.cerrada == 1"></textarea>
                </div>        
            </div>
            <div class="col-md-4 archivos">
                 
                    <div v-if="datosEtapa.datos.cerrada == 0">
                        <readFile :indice="subetapa.IdTabsubetapa" @tratar="tratarimagenes($event)"/> 
                    </div> 
                    <div class="mt-3 form-check" v-if="datosEtapa.imagenes.length > 0">
                    <div v-for="(imagen,i) in datosEtapa.imagenes" :key="i">
                        <input class="form-check-input" type="radio" :id="i" :value="imagen" v-model="imagenchecked"/>
                        <label class="form-check-label" for="one">{{imagen.name}}</label>
                    </div>
                    </div> 
                  
                    <div>
                        <div class="d-grid gap-2 mt-5" >
                                <button @click="$emit('verimgs', imagenchecked)" class="btn btn-info">Ver Archivo</button>
                                <button v-if="datosEtapa.datos.cerrada == 0" @click="UpdateEtapa(0)" class="btn btn-primary">Guardar</button>
                                <button v-if="datosEtapa.datos.cerrada == 0" @click="UpdateEtapa(1)" class="btn btn-primary">Cerrar</button>
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
import {mapActions,mapState} from 'vuex'

export default {
      computed:{
     ...mapState('panel',['porcProceso','proceso'])
      },
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
                comentarios:this.subetapa.Comentarios ,
                cerrada: this.subetapa.Estatus 
            },
            imagenes:this.subetapa.Imagenes,
        },
        imagenchecked:{}
    }
    },
    methods:{
      tratarimagenes(event){
   
      this.datosEtapa.imagenes.push(event)
    },
    UpdateEtapa(status){
      this.datosEtapa.datos.cerrada = status;
      const json = `{"IdAdquisicion": "${this.datosEtapa.datos.idAdquisicion}"
      ,"IdSubEtapa" : "${this.datosEtapa.datos.id}","IdProceso" : "${this.proceso.idProceso}",
      "Estatus" : "${this.datosEtapa.datos.cerrada}","Comentarios" : "${this.datosEtapa.datos.comentarios}"}`

      axios.post(process.env.VUE_APP_RUTA_API+'subetapa/updateSubEtapa.php',
       json,
       {headers:  {
         'Content-Type': 'application/json'}
       }).then((res)=>{
        if (res.data) {
            //alert("Se Guardo Etapa")

            if (status == 1) {
              this.Updporcentaje()
            }
            
            this.datosEtapa.imagenes.forEach(element => {
               
              let json = `{"IdAdquisicion": "${this.datosEtapa.datos.idAdquisicion}","IdProceso" : "${this.proceso.idProceso}",
              "IdSubEtapa" : "${this.datosEtapa.datos.id}","FileName": "${element.name}","Documento" : "${element.data}"}`
              debugger;
              axios.post(process.env.VUE_APP_RUTA_API+'Documento/crearDocumento.php',
                json,
                {headers:  {
                    'Content-Type': 'application/json'}
                }).then((resp)=>{
                    const {message} = resp.data
                    console.log(message);
                })
          
         })
         this.$emit('modfin',this.subetapa.Descripcion);
        }
       }) 
    },
     ...mapActions('panel',{
        Updporcentaje: 'Updporcentaje'
        }) 
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
    .archivos{
        padding: 2rem;
    }
    
    .card {
    /* Add shadows to create the "card" effect */
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
    transition: 0.3s;
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
   