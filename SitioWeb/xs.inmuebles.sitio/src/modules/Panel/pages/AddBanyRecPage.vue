<template>
  <div class="container">
    <h1>Agregar bancos y recuperadoras</h1>
    <form @submit.prevent="handleSubmit">
      <div class="row">
        <div class="col">
              <label class="campo" >Tipo</label>
              <select v-model="tipo" class="form-select" required>
                <option value=1>Banco</option>
                <option value=2>Recuperadora</option>
                </select>
        </div>
        <div class="col">
              <label class="campo" for="">Nombre Entidad</label>
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
import { mapActions, mapState } from 'vuex';
import Modal from '../../shared/components/Modal-Confirm.vue';
export default {
  computed:{
     ...mapState('panel',['Error','Msg'])
      },
  data(){
    return{
      tipo:0,
      nombre:'',
      estados:[],
      showModal: false,
    }
  },
  methods:{
    async guardar(){

let petGuardar = {
  tipo: this.tipo,
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
handleSubmit(){
      this.guardar()
    },
...mapActions('panel',{
  Guardar: 'guardarrecobanco'
    })
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