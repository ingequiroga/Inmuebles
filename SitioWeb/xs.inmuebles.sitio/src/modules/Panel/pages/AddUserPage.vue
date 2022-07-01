<template>
<div class="container">
  <h1>Agregar Usuario</h1>
  <p class="subtit mb-0">Datos Personales</p>
  <hr class="mt-0">
  <form @submit.prevent="handleSubmit">
      <div class="row mt-5">
    <div class="col">
       <label class="campo" for="">Nombre</label>
              <input v-model="user.nombre" type="text" class="form-control" required>
    </div>
    <div class="col">
         <label class="campo" for="">Apellidos</label>
              <input v-model="user.apellido" type="text" class="form-control" required>
    </div>
    <div class="col">
         <label class="campo" for="">Puesto</label>
              <input v-model="user.puesto" type="text" class="form-control" required>
    </div>
  </div>
     <div class="row mt-5">
    <div class="col">
       <label class="campo" for="">Email</label>
              <input v-model="user.email" type="email" class="form-control" required>
    </div>
    <div class="col">
         <label class="campo" for="">Password</label>
              <input v-model="user.pass" type="text" class="form-control" required>
    </div>
    <div class="col">
         <label class="campo" for="">Rol</label>
           <select v-model="user.rol" class="form-select" required>
                <option value=1 selected>Administrador</option>
                <option value=2 >Consulta</option>
          </select>
    </div>
  </div>
  <div class="mt-5 d-flex flex-row-reverse bd-highlight">
      <div>
        <button type="submit" class="btn btn-primary btn-lg">Agregar</button>
      </div> 
  </div>
  </form>
</div>
  
</template>

<script>
import {mapActions} from 'vuex'

export default {
  data(){
    return{
      user: {
        nombre:'',
        apellido:'',
        puesto:'',
        email:'',
        pass:'',
        rol:''
      }
    }
  },
  methods:{
    async guardarUsuario(){
      await this.Guardaruser(this.user)
    },
    handleSubmit() {
     this.guardarUsuario()              
    },
    ...mapActions('login',{
        Guardaruser: 'crearusuario'
        }) 

  }
}
</script>

<style>

</style>