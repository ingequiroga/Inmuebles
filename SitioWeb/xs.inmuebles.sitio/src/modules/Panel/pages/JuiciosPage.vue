<template>
    <div>
        <h2>Inmuebles en Juicio</h2>
      <div class="table-responsive">
          <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Numero de Credito</th>
                        <th>Estado</th>
                        <th>Municipio</th>
                        <th>Deuda</th>
                        <th>Accion</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(inmueble,i) in inmuebles" :key="i">
                        <td>{{inmueble.NumCredito}}</td>
                        <td>{{inmueble.Estado}}</td>
                        <td>{{inmueble.Municipio}}</td>
                        <td>{{inmueble.Deuda}}</td>
                        <td>
                            <a @click="iniciarProc(inmueble.IdInmueble)">
                              <font-awesome-icon icon="fa-solid fa-house-circle-check" />
                            </a>

                            <a class="ms-3" @click="editar(inmueble.IdInmueble)">
                              <font-awesome-icon icon="fa-solid fa-pen" />
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
      </div>
    </div>
</template>

<script>
import axios from 'axios'

export default {
    data(){
    return{
      inmuebles:[]
    }
  },
     methods:{
      getInmuebles(){
        let juicios = 2
        axios.get(process.env.VUE_APP_RUTA_API+'inmueble/readXproceso.php?IdProceso='+ juicios)
        .then((res) => {
          if (res.data) {
              const {datos} = res.data
              this.inmuebles = datos
                                          
           }
        });
      },
       iniciarProc(id){
         this.$router.push('/'+id+'/2')
       },
       editar(id){
        this.$router.push('/editar/'+id)
      }
  },
    mounted(){
        this.getInmuebles()
    }
}
</script>

<style>

</style>