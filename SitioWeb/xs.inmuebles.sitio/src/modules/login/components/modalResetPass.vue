<template>
    <div class="modal-mask">
          <div class="modal-wrapper">
            <div class="modal-container">
              <form @submit.prevent="handleSubmit">
              <div class="modal-header">
                <slot name="header">
                  Recuperar contraseña
                </slot>
              </div>
          
              <div class="modal-body">
               <div v-if="!enviado">
                    <div>
                        <p>Se enviara un correo electronico con un link al siguiente correo electronico:</p>
                    </div>
                    <div class="mt-3">
                         <input v-model="email" type="email" class="form-control" required>
                    </div>
               </div>
                 <div v-else>
                    <div>
                        <p><b>{{mensaje}}</b></p>
                    </div>
               </div>
              </div>

              <div class="modal-footer">
                <slot name="footer">
                  
                  <button v-if="!enviado" type="submit" class="btn btn-primary">
                    Continuar
                  </button>
                  <button @click="$emit('close')" v-else class="btn btn-primary" >
                    Cerrar
                  </button>
                </slot>
              </div>
              </form>
            </div>
          </div>
        </div>
</template>

<script>
import axios from 'axios'

export default {
 data(){
    return{
        email:'',
        enviado: false,
        mensaje: ''
    }
 },
 methods:{
    enviarCorreoPass(){
         var result= '';
         var characters= 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
         var charactersLength = 10;
            for( var i = 0; i < charactersLength; i++ ) {
                result += characters.charAt(Math.floor(Math.random() * 
            charactersLength));
            }

       // let link = 'http://localhost:8080/#/resetpass?key='+ result
       let link = process.env.VUE_APP_RUTA_SITIO+'resetpass?key='+ result
         //console.log(link);
        // console.log(this.email);
        const now = new Date()
        let expiry= now.getTime()+300000
        //console.log(result);
        //console.log(expiry);
        axios.post(process.env.VUE_APP_RUTA_API+'users/enviarCorreoPass.php',
        {
        email: this.email,
        link: link,
        clave: result,
        expira: expiry,
        headers: [
        { 'Content-Type': "application/json; charset=utf-8" }
      ]
     }).then((res) => {
      console.log(res.data);
      this.mensaje = res.data.error ? 'el correo '+this.email+' no esta registrado' : 
      'Se envio un correo a la direccion: '+this.email+' para restablecer el password'
      // if (res.data.error) {
      //   this.mensaje= 'el correo '+this.email+' no esta registrado'
      // }
      // else
      this.enviado = true
      //this.$emit('close')
    });
    },
    handleSubmit() {
        //   console.log(e)
        this.enviarCorreoPass()
    },
 }
}
</script>

<style>
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

.modal-container {
  width: 600px;
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