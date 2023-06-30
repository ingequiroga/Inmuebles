<template>
  <div class="container">
    <h1>Agregar Municipio</h1>
    <form @submit.prevent="handleSubmit">
      <div class="row">
        <div class="col">
              <label class="campo" >Estado</label>
              <select v-model="idestado" class="form-select" required>
                <option v-for="(estado,i) in estados"  :value="estado.IdEstado" :key="i">
                  {{estado.Nombre}}
                </option>
              </select>
        </div>
        <div class="col">
              <label class="campo" for="">Nombre Municipio</label>
              <input v-model="nombre" type="text" class="form-control upercase" required>
        </div>
      </div>
      <div class="gap-2 mx-auto mt-5">
            <button type="submit" class="btn btn-primary">Crear</button>
      </div>
    </form>
    <Modal v-if="showModal" @close="showModal = false" :Mensaje="Msg" />
  </div>
</template>

<script>
import axios from 'axios'
import { mapActions,mapState } from 'vuex'
import Modal from '../../shared/components/Modal-Confirm.vue';

export default {
  computed:{
     ...mapState('panel',['Error','Msg'])
      },
  data(){
    return{
      idestado:0,
      nombre:'',
      estados:[],
      showModal: false,
    }
  },
  methods: {
    async guardar(){

      let petGuardar = {
        idEstado: this.idestado,
        nombre: this.nombre.toUpperCase(),
      }

      console.log(petGuardar);
      await this.Guardar(petGuardar)
       if (!this.Error) {
          this.showModal = true
          this.inmueble = {}
        }
        else{
          this.showModal = true
        }
  },
    getEstados(){
      axios.post(process.env.VUE_APP_RUTA_API+'estados/getall.php').
      then((res) => {
      
       if (res.data) {
           const {datos} = res.data
           this.estados = datos                               
                            }
    });
    },
    handleSubmit(){
      this.guardar()
    },
    ...mapActions('panel',{
  Guardar: 'guardarmunicipio'
    })
  },
  mounted(){
  this.getEstados()
},
components:{
      Modal
},
}
</script>

<style>
  .upercase{
    text-transform: uppercase;
  }
</style>