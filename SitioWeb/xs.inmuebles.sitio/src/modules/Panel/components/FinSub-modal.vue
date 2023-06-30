<template>
    <div class="modal-mask">
          <div class="modal-wrapper">
            <div class="modal-container">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" @click="$emit('close')">&times;</button>
                <slot name="header">
                  Guardar SubEtapa
                </slot>
              </div>    
              <div class="modal-body">  
                    <div>
                        <div>
                            <h4>Se guardaron los datos de la subetapa {{descripcion}} </h4>
                        </div>
                        <!-- <div>
                             <label class="campo" >Desea Cambiar la etapa del inmueble?: </label>
                            <select  class="form-select" v-model="idEtapa">
                             <option value = 1 >Viable</option>
                            <option value= 2 >Compra en proceso</option>
                            <option value = 3 >En negociación</option>
                            <option value= 4 >En juicio</option>
                             <option value = 5>En cartera propia</option>
                            <option value=6>Vendido</option>
                            </select>
                        </div> -->
                    </div>   
                    <!-- <div class="mt-5">
                        <button @click="cerrarsubEtapa()" class="btn btn-primary">Cambiar</button>
                    </div> -->
              </div>
            </div>
          </div>
        </div>
</template>

<script>
import axios from 'axios'
import {mapState} from 'vuex'


export default {
     props:{
        descripcion: String
    },
    computed:{
     ...mapState('panel',['proceso'])
      },
 data(){
    return{
        idEtapa: 0
    }
 },
 methods:{
    cerrarEtapa(){
        let obj = {
          "Idadquisicion": this.proceso.IdAdquisicion,
          "Idinmueble": this.proceso.idInmueble,
          "IdProceso": this.idEtapa,
          "IdEtapa": this.idEtapa
        }
          
          axios.post(process.env.VUE_APP_RUTA_API+'proceso/addProceso.php',
                obj,
                {headers:  {
                    'Content-Type': 'application/json'}
                }).then((res) => {
                   
                   alert(res.data.message)
                   this.$router.push({name: 'panelhome'})
                })
       
   
        
    }
 },
 mounted(){
   
    this.idEtapa = this.proceso.idEtapa
    
 }
   
}
</script>

<style scoped>
    .modal-mask {
  position: fixed;
  z-index: 9998;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  display: table;
  transition: opacity 0.3s ease;
}

.modal-wrapper {
  display: table-cell;
  vertical-align: middle;
}

.modal-body{
    height: 100%;
}

.modal-container {
  width: 50rem;
  margin: 0px auto;
  padding: 20px 30px;
  background-color: #fff;
  border-radius: 2px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.33);
  transition: all 0.3s ease;
  font-family: Helvetica, Arial, sans-serif;
}

.modal-header h3 {
  margin-top: 0;
  color: #42b983;
}

.modal-body {
  margin: 20px 0;
}

.modal-default-button {
  float: right;
}

.modal-enter {
  opacity: 0;
}

.modal-leave-active {
  opacity: 0;
}

.modal-enter .modal-container,
.modal-leave-active .modal-container {
  -webkit-transform: scale(1.1);
  transform: scale(1.1);
}

</style>