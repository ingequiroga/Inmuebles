<template>
  <div class="mb-5">
    <div class="container mt-5">
        <h2>Alta de Inmueble</h2>
        <p class="subtit mb-0">Datos generales</p>
        <hr class="mt-0">
        <div class="row mt-3">
              <div class="col-md-4">
              <label class="campo" for="">Número de Crédito</label>
              <input v-model="inmueble.numCredit" type="text" class="form-control">
          </div>
            <div class="col-md-4">
              <label class="campo" for="">Deudor</label>
              <input type="text" v-model="inmueble.deudor" class="form-control">
          </div>
            <div class="col-md-4">
              <label class="campo" for="">Tipo de adquisición</label>
                <select v-model="inmueble.tipoAdq" class="form-select">
                <option value=1 selected>Recuperadora</option>
                <option value=2>Banco</option>
              </select>
          </div>
      </div>
         <div class="row mt-3">
          <div class="col-md-4">
              <label class="campo" for="">Recuperadora/Banco</label>
               <select v-model="inmueble.recObanco" class="form-select">
                <option value=1>Santander</option>
                <option value=2>HSBC</option>
                <option value=3>Bancomer</option>
                </select>
          </div>
           
          <div class="col-md-4">
              <label class="campo" for="">Número de folio real</label>
              <input v-model="inmueble.numFolioReal" type="text" class="form-control">
          </div>
           
      </div>
        <div class="row mt-3">
            <div class="col-md-4">
              <label class="campo" for="">Cuenta Catastral</label>
              <input v-model="inmueble.cuentaCat" type="text" class="form-control">
          </div>

        
          
          <div class="col-md-4">
              <label class="campo" >Etapa actual</label>
               <select v-model="inmueble.etapaAct" class="form-select">
               <option v-for="etapa in catalogos[1]" :value="etapa.Id" :key="etapa.Id">
                {{etapa.Nombre}}
               </option>
                </select>
          </div>
           
      </div>
    <div class="row mt-3">
           <div class="col-md-6">
              <label class="campo" for="">Comentarios de registro público</label>
              <textarea v-model="inmueble.comRegPub" class="form-control"></textarea>
          </div>
    </div>

       <p class="subtit mb-0 mt-5">Ubicación de Inmueble</p>
        <hr class="mt-0">
                <div class="row mt-4">
            <div class="col-md-4">
              <label class="campo" >Estado</label>
               <select v-model="selEstado" class="form-select">
                    <option v-for="(estado,i) in catalogos[0]" :value="estado.Id" :key="i">
                   {{estado.Nombre}}
                    </option>
              </select>
          </div>
           <div class="col-md-4">
              <label class="campo" >Municipio</label>
               <select v-model="inmueble.municipio" class="form-select">
                <option v-for="(municipio,i) in catalogos[2]" :value="municipio.Id" :key="i">
                   {{municipio.Nombre}}
                    </option>
              </select>
          </div>

     
            <div class="col-md-4">
              <label class="campo" for="">Calle</label>
              <input v-model="inmueble.calle" type="text" class="form-control">
          </div>   
      </div>
      <div class="row mt-3">
         <div class="col-md-4">
              <label class="campo" for="">Código postal</label>
              <input v-model="inmueble.codPostal" type="text" class="form-control">
          </div>   

      </div>

        <p class="subtit mb-0 mt-5">Medidas</p>
        <hr class="mt-0">
                <div class="row mt-4">
             <div class="col-md-4">
              <label class="campo" for="">M2 Superficie</label>
              <input v-model="inmueble.m2Superficie" type="text" class="form-control">
          </div>  

            <div class="col-md-4">
              <label class="campo" for="">M2 Construcción (Opcional)</label>
              <input v-model="inmueble.m2Construccion" type="text" class="form-control">
          </div>  
      </div>

          <p class="subtit mb-0 mt-5">Montos</p>
        <hr class="mt-0">
                <div class="row mt-4">
             <div class="col-md-4">
              <label class="campo" for="">Monto de la deuda</label>
              <input v-model="inmueble.montoDeuda" type="text" class="form-control">
          </div>  

            <div class="col-md-4">
              <label class="campo" for="">Monto mínimo</label>
              <input v-model="inmueble.montoMin" type="text" class="form-control">
          </div>  

          <div class="col-md-4">
              <label class="campo" for="">Monto de venta</label>
              <input v-model="inmueble.montoVenta" type="text" class="form-control">
          </div>  
      </div>

      <p class="subtit mb-0 mt-5">Expedientes</p>
        <hr class="mt-0">
                <div class="row mt-4">
             <div class="col-md-4">
              <label class="campo" for="">Número de expediente judicial</label>
              <input v-model="inmueble.numExpJud" type="text" class="form-control">
          </div>  

            <div class="col-md-6">
              <label class="campo" for="">Comentarios expediente judicial</label>
             <textarea v-model="inmueble.comExpJud" class="form-control"></textarea>
          </div>  
      </div>
      <div class=" d-grid gap-2 col-4 mx-auto mt-5">
            <button type="button" @click="guardar()" class="btn btn-primary">Crear</button>
      </div>
      

        </div>
    <Modal v-if="showModal" @close="showModal = false" :Mensaje="Mensg" />
  </div>
</template>

<script>
import axios from 'axios'
import {mapActions,mapState} from 'vuex'
import Modal from '../../shared/components/Modal-Acceso.vue';

export default {
   computed:{
     ...mapState('login',['Error','MsgError'])
      },
  data(){
    return{
      inmueble:{
        numCredit:'',
        deudor:'',
        tipoAdq:'',
        recObanco:'',
        cuentaCat:'',
        numFolioReal:'',
        etapaAct: 0,
        comRegPub:'',
        estado:0,
        municipio: 0,
        calle: '',
        codPostal: '',
        m2Superficie: 0,
        m2Construccion: 0,
        montoDeuda: 0,
        montoMin: 0,
        montoVenta: 0,
        numExpJud: '',
        comExpJud: ''
      },
      catalogos:[],
      selEstado:null,
      showModal: false,
      Mensg: ''
    }
  },
methods:{
  async guardar(){
      await this.Guardar(this.inmueble)
       if (!this.Error) {
          this.showModal = true
        }
  },
  getCatalogos(){
    axios.get('http://localhost/api/catalogos/readall.php')
    .then((res) => {
       if (res.data) {
          const {datos} = res.data
          this.catalogos = datos                               
                            }
    });
  },
  getMunicipios(idestado){
     axios.post('http://localhost/api/municipios/obtporestados.php',
     {
        estado: idestado,
        headers: [
        { 'Content-Type': "application/json; charset=utf-8" }
      ]
     }).then((res) => {
      console.log(res);
      //  if (res.data) {
      //     const {datos} = res.data
      //     this.catalogos = datos                               
      //                       }
    });
  },
   ...mapActions('login',{
        Guardar: 'guardarInmueble'
        }) 
},
watch:{
    selEstado(event){
      //console.log(event);
      this.getMunicipios(event)
    }
},
mounted(){
  this.getCatalogos()
},
components:{
      Modal
},
}
</script>

<style>

</style>