
<template>

  <div class="text-center bodysi">
        <main class="form-signin" style="back" >
  <form>
    <img class="mb-4" src="../../../assets/casa.jpg" alt="" width="72" height="57">
    <h1 class="h3 mb-3 fw-normal">Inmuebles</h1>

    <div class="form-floating">
      <input type="text" v-model="usuario" class="form-control" id="floatingInput">
      <label for="floatingInput">Usuario</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" id="floatingPassword" v-model="pass">
      <label for="floatingPassword">Contraseña</label>
    </div>

    <div class="form-group mb-3">

       <a @click="RecuperarPass()" href="#" class="hdi-link">¿Olvidó su contraseña?</a>   
    
    </div>
    <button class="w-100 btn btn-lg btn-primary" type="button" @click="Validar()">Ingresar</button>
    <p class="mt-5 mb-3 text-muted">&copy; 2022–2023</p>
  </form>
</main>
<ModalA v-if="showModal" @close="showModal = false" :Mensaje="MsgError" />
</div>

</template>

<script>
/* eslint-disable */
import {mapActions, mapState} from 'vuex'
import ModalA from '../../shared/components/Modal-Acceso.vue';

export default {
       computed:{
     ...mapState('login',['isLoged','MsgError'])
      },
     data(){
        return{
             usuario:'',
             pass:'',
             showModal: false,
             RecCont: false
        } 
    },
    methods:{
       async Validar() {
       let datos = {
               name: this.usuario,
               pass: this.pass
             }
   
        await this.ValidarDatos(datos)
        if (!this.isLoged) {
          this.showModal = true
        }
        else{
          this.$router.push('panel')
        }

      },
       ...mapActions('login',{
        ValidarDatos: 'login'
        }) 
    },
    components:{
      ModalA
    },
}
</script>

<style>

/* .bodysi {
  background: url("../../../assets/fondologin.jpg") no-repeat fixed center;
  background-size: cover;
} */

.bodysi {
  display: flex;
  align-items: center;
  padding-top: 40px;
  padding-bottom: 40px;
  background-color: #f5f5f5;
}



 /* .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      } */


    .form-signin {
    width: 100%;
    max-width: 330px;
    padding: 15px;
    margin: auto;
  }
  
  .form-signin .checkbox {
    font-weight: 400;
  }
  
  .form-signin .form-floating:focus-within {
    z-index: 2;
  }
  
  .form-signin input[type="email"] {
    margin-bottom: -1px;
    border-bottom-right-radius: 0;
    border-bottom-left-radius: 0;
  }
  
  .form-signin input[type="password"] {
    margin-bottom: 10px;
    border-top-left-radius: 0;
    border-top-right-radius: 0;
  }
</style>