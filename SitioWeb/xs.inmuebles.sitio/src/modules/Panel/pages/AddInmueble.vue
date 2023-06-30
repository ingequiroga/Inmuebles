<template>
  <div class="mb-5">
    <div class="container mt-5">
        <h2>Alta de Inmueble</h2>
        <p class="subtit mb-0">Datos generales</p>
        <hr class="mt-0">
        <form @submit.prevent="handleSubmit" class="needs-validation">
          <div class="row mt-3">
              <div class="col-md-4">
<<<<<<< Updated upstream
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
=======
                <label class="campo" for="">Número de Crédito</label>
                <input v-model="inmueble.numcredito" type="text" class="form-control" required>
                 <div class="invalid-feedback">Por favor llene este campo.</div>
              </div>
              <div class="col-md-4">
                <label class="campo" for="">Nombre Deudor</label>
                <input type="text" v-model="inmueble.namedeudor" class="form-control mayuscula" required>
                <div class="invalid-feedback">Por favor llene este campo.</div>
              </div>

              <div class="col-md-4">
                <label class="campo" for="">Apellido Deudor</label>
                <input type="text" v-model="inmueble.lastdeudor" class="form-control mayuscula" required>
                <div class="invalid-feedback">Por favor llene este campo.</div>
              </div>
        </div>
         <div class="row mt-3">
              <div class="col-md-4">
                <label class="campo" for="">Número de Baños</label>
                <input v-model="inmueble.Banos" type="number" class="form-control" required>
                 <div class="invalid-feedback">Por favor llene este campo.</div>
              </div>
              <div class="col-md-4">
                <label class="campo" for="">Número de Lugares en Cochera</label>
                <input type="number" v-model="inmueble.Cochera" class="form-control" required>
                <div class="invalid-feedback">Por favor llene este campo.</div>
              </div>

              <div class="col-md-4">
                <label class="campo" for="">Número de Dormitorios</label>
                <input type="number" v-model="inmueble.Dormitorios" class="form-control" required>
                <div class="invalid-feedback">Por favor llene este campo.</div>
              </div>
        </div>
        <div class="row mt-3">

          <div class="col-md-4">
                <label class="campo" for="">Tipo de adquisición</label>
                  <select v-model="inmueble.tipodquisicion" class="form-select" required>
                  <option value=1 selected>Recuperadora</option>
                  <option value=2>Banco</option>
                </select>
            </div>

>>>>>>> Stashed changes
          <div class="col-md-4">
              <label class="campo" for="">Recuperadora/Banco</label>
               <select v-model="inmueble.idreoban" class="form-select" required>
                <option value=1>Santander</option>
                <option value=2>HSBC</option>
                <option value=3>Bancomer</option>
                </select>
          </div>
           
          <div class="col-md-4">
              <label class="campo" for="">Número de folio real</label>
              <input v-model="inmueble.numfolioreal" type="text" class="form-control">
          </div>
           
      </div>
        <div class="row mt-3">
            <div class="col-md-4">
              <label class="campo" for="">Cuenta Catastral</label>
              <input v-model="inmueble.cuentacat" type="text" class="form-control">
          </div>
<<<<<<< Updated upstream

        
          
          <div class="col-md-4">
              <label class="campo" >Etapa actual</label>
               <select v-model="inmueble.etapaAct" class="form-select">
               <option v-for="etapa in catalogos[1]" :value="etapa.Id" :key="etapa.Id">
                {{etapa.Nombre}}
               </option>
=======
           <div class="col-md-4">
              <label class="campo" >Estatus</label>
                <select v-model="inmueble.estatusinm" class="form-select">
                <option value=1>Cesion de derechos de crédito</option>
                <option value=2>En Juicio</option>
>>>>>>> Stashed changes
                </select>
          </div>
           
      </div>
    <div class="row mt-3">
      <div class="col-md-6">
                <label class="campo" for="">Descripcion Adicional</label>
                <textarea v-model="inmueble.DescripcionAdicional" class="form-control"></textarea>
            </div> 
          
            <div class="col-md-6">
                <label class="campo" for="">Comentarios de registro público</label>
                <textarea v-model="inmueble.comentarioregpub" class="form-control"></textarea>
            </div>
    </div> 

        <p class="subtit mb-0 mt-5">Ubicación de Inmueble</p>
        <hr class="mt-0">
                <div class="row mt-4">
            <div class="col-md-4">
              <label class="campo" >Estado</label>
               <select v-model="selEstado" class="form-select" required>
                    <option v-for="(estado,i) in catalogos.estados" :value="estado.Id" :key="i">
                   {{estado.Nombre}}
                    </option>
              </select>
          </div>
           <div class="col-md-4">
              <label class="campo" >Municipio</label>
               <select v-model="inmueble.idmunicipio" class="form-select" required>
                <option v-for="(municipio,i) in ciudadesObt" :value="municipio.Id" :key="i">
                   {{municipio.Nombre}}
                    </option>
              </select>
          </div>

            <div class="col-md-4">
              <label class="campo" for="">Colonia</label>
              <input v-model="inmueble.Colonia" type="text" class="form-control mayuscula" required>
              <div class="invalid-feedback">Por favor llene este campo.</div>
          </div>   
      </div>
      <div class="row mt-3">
        <div class="col-md-4">
              <label class="campo" for="">Calle</label>
              <input v-model="inmueble.calle" type="text" class="form-control mayuscula" required>
              <div class="invalid-feedback">Por favor llene este campo.</div>
          </div>  

          <div class="col-md-4">
              <label class="campo" for="">Número Interior</label>
              <input v-model="inmueble.NumInterior" type="text" class="form-control" required>
              <div class="invalid-feedback">Por favor llene este campo.</div>
          </div>  

         <div class="col-md-4">
              <label class="campo" for="">Número Exterior</label>
              <input v-model="inmueble.NumExt" type="text" class="form-control">
          </div>   

      </div>

      <div class="row mt-3">
          <div class="col-md-4">
              <label class="campo" >Tipo inmueble</label>
                <select v-model="inmueble.TipoInmueble" class="form-select">
                <option value=5>Casa</option>
                <option value=6>Edificio</option>
                <option value=7>Bodega</option>
                </select>
          </div>

         <div class="col-md-4">
              <label class="campo" for="">Código postal</label>
              <input v-model="inmueble.codigopostal" type="text" class="form-control">
          </div>   

      </div>

 

        <p class="subtit mb-0 mt-5">Medidas</p>
        <hr class="mt-0">
                <div class="row mt-4">
             <div class="col-md-4">
              <label class="campo" for="">M2 Superficie</label>
              <input v-model="inmueble.m2superficie" type="text" class="form-control" required>
              <div class="invalid-feedback">Por favor llene este campo.</div>
          </div>  

            <div class="col-md-4">
              <label class="campo" for="">M2 Construcción (Opcional)</label>
              <input v-model="inmueble.m2construccion" type="text" class="form-control" required>
              <div class="invalid-feedback">Por favor llene este campo.</div>
          </div>  
      </div>

          <p class="subtit mb-0 mt-5">Montos</p>
        <hr class="mt-0">
                <div class="row mt-4">
             <div class="col-md-4">
              <label class="campo" for="">Monto de la deuda</label>
              <input v-model="inmueble.montoDeuda" type="text" class="form-control" required>
              <div class="invalid-feedback">Por favor llene este campo.</div>
          </div>  

            <div class="col-md-4">
              <label class="campo" for="">Monto mínimo</label>
              <input v-model="inmueble.montoMin" type="text" class="form-control" required>
              <div class="invalid-feedback">Por favor llene este campo.</div>
          </div>  

          <div class="col-md-4">
              <label class="campo" for="">Monto de venta</label>
              <input v-model="inmueble.montoVenta" type="text" class="form-control" required>
              <div class="invalid-feedback">Por favor llene este campo.</div>
          </div>  
      </div>

      <p class="subtit mb-0 mt-5">Expedientes</p>
        <hr class="mt-0">
                <div class="row mt-4">
             <div class="col-md-4">
              <label class="campo" for="">Número de expediente judicial</label>
              <input v-model="inmueble.numexpediente" type="text" class="form-control">
          </div>  

            <div class="col-md-6">
              <label class="campo" for="">Comentarios expediente judicial</label>
             <textarea v-model="inmueble.comentarioexpjudicial" class="form-control"></textarea>
          </div>  
      </div>
      <p class="subtit mb-0 mt-5">Iniciar Proceso</p>
        <hr class="mt-0">
      <div class="row">
        <div class="col-md-4">
              <label class="campo" >Iniciar Proceso:</label>
                <select v-model="inmueble.procInicial" class="form-select">
                  <option value=1>Adquisición</option>
                  <option value=2>Juicios</option>
                </select>
          </div>
      </div> 
       <subir-imagen :imagenes="imagenes" @addImagen="agregarImagen($event)" 
      @delImagen="borrarImagen($event)"></subir-imagen> 
      <div class=" d-grid gap-2 col-4 mx-auto mt-5">
          <v-btn color="primary" type="submit">Crear</v-btn>
      </div>
    </form>  
    </div>
  </div>
</template>

<script>
import axios from 'axios'
import {mapActions,mapGetters,mapState} from 'vuex'
import SubirImagen from '../components/subir-imagen.vue';
import Swal from 'sweetalert2'

export default {
   computed:{
     ...mapState('panel',['Error','catalogos']),
     ...mapGetters('panel',['filterCiudades']),
     ciudadesObt(){
      return this.filterCiudades(this.selEstado)
     }
     },
  data(){
    return{
      inmueble:{
<<<<<<< Updated upstream
        numCredit:'',
        deudor:'',
        tipoAdq:'',
        recObanco:'',
        cuentaCat:'',
        numFolioReal:'',
        etapaAct: 0,
        comRegPub:'',
        estado: 0,
        municipio: 0,
=======
        numcredito:'',
        namedeudor:'',
        lastdeudor:'',
        tipodquisicion:'',
        idreoban:'',
        cuentacat:'',
        numfolioreal:'',
        idetapa: 1,
        comentarioregpub:'',
        idestado: 0,
        idmunicipio: 0,
>>>>>>> Stashed changes
        calle: '',
        codigopostal: '',
        m2superficie: 0,
        m2construccion: 0,
        montoDeuda: 0,
        montoMin: 0,
        montoVenta: 0,
<<<<<<< Updated upstream
        numExpJud: '',
        comExpJud: ''
=======
        numexpediente: '',
        comentarioexpjudicial: '',
        estatusinm: 1,
        procInicial: 1,
        Colonia: '',
        Banos: '',
        Cochera: '',
        Dormitorios: '',
        DescripcionAdicional: '',
        NumInterior: 0,
        NumExt: 0,
        TipoInmueble: '',
        imagenes: []
>>>>>>> Stashed changes
      },
     imagenes:[],
     //catalogos:[],
     selEstado:null,
    }
  },
methods:{
<<<<<<< Updated upstream
  async guardar(){
      await this.Guardar(this.inmueble)
      console.log(this.inmueble);
       if (!this.Error) {
          this.showModal = true
=======
   async guardar(){
    //console.log("Guardar");
    //console.log(this.inmueble);
    let _Msg = 'Ocurrio un error al guardar'
    let _Icon = 'error'
    let _Title = 'Guardado'


    new Swal ({
      title: 'Espere por favor',
      allowOutsideClick: false
    })

    Swal.showLoading()

      const {error,idinmueble,message} = await this.Guardar(this.inmueble)
      //console.log(resp);
      if (!(error == null)) {
        if (error) {
          _Msg = message
>>>>>>> Stashed changes
          this.inmueble = {}
          _Icon = 'info'
         }
         else{
           if (this.imagenes.length > 0) {
            console.log(error,idinmueble,message);
             
            for(const image of this.imagenes){
             // console.log(image);
              const imagedata = {
                  idinmueble: idinmueble,
                  filename: image.name,
                  imagen: image.data
                 }
             
               await this.SaveImage(imagedata)
          
            }
       
            this.$router.push({name:'panelhome'})           
           }
           _Msg = message
           _Icon = 'success'
      }
      }
      Swal.fire(_Title,_Msg,_Icon)
   },
  getCatalogos(){
    axios.get(process.env.VUE_APP_RUTA_API+'catalogos/readall.php')
    .then((res) => {
       if (res.data) {
          const {datos} = res.data
          this.catalogos = datos                               
                            }
    });
  },
  getMunicipios(idestado){
     axios.post(process.env.VUE_APP_RUTA_API+'municipios/obtporestados.php',
     {
        estado: idestado,
        headers: [
        { 'Content-Type': "application/json; charset=utf-8" }
      ]
     }).then((res) => {
      
      //  if (res.data) {
      //     const {datos} = res.data
      //     this.catalogos = datos                               
      //                       }
      console.log(res);
    });
  },
  handleSubmit() 
  {
   this.inmueble.imagenes = this.imagenes;
    this.guardar()    
  },
  tratarimagenes(event) { 
      this.inmueble.imagenes.push(event)

        // var filePreview = document.createElement('img');
        // filePreview.id = 'file-preview';
        //  filePreview.src = event.data;
        // var previewZone = document.getElementById('previewZone');
        //  previewZone.appendChild(filePreview);
    //console.log(event);
  },
  agregarImagen(event){
    //console.log(event)
    this.imagenes.push(event);
  },
  borrarImagen(event){
    console.log("borrar imagen");
    console.log(event);
    this.imagenes.splice(event, 1);
  },
   ...mapActions('panel',{
        Guardar: 'guardarInmueble',
        SaveImage: 'saveImage'
        }) 
},
watch:{
    selEstado(event){
<<<<<<< Updated upstream
      console.log(event);
      this.inmueble.estado = event
     // this.getMunicipios(event)
=======
      this.inmueble.idestado = event
      this.getMunicipios(event)
>>>>>>> Stashed changes
    }
},
mounted(){
 // this.getCatalogos()
},
components:{
SubirImagen 
},
}
</script>

<style>

</style>