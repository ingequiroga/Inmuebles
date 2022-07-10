<template>
  <div v-if="IsValid">
    <h2>Resetear Password</h2>
    <button @click="resetpass()" class="btn btn-primary">Cambiar</button>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  data(){
    return{
      IsValid: false
    }
  },
methods:{
    resetpass(){
        console.log(this.$route.query.key)
    }
},
mounted(){
  const now = new Date()
     console.log(now.getTime()); 
     console.log(this.$route.query.key);

     axios.post(process.env.VUE_APP_RUTA_API+'solicitudPass/validarSolicitud.php',
     {
        clave: this.$route.query.key,
        expira: now.getTime(), 
        headers: [
        { 'Content-Type': "application/json; charset=utf-8" }
      ]
     }).then((res) => {
        if (res.data) 
        {
           //const {data} = res.data
          console.log(res.data);
          this.IsValid = !res.data.error                            
         }
    });
}
}
</script>


<style>

</style>