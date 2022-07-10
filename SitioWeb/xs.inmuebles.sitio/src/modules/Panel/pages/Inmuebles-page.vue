<template>
    <div>
        <h2>Inmuebles</h2>
      <div class="table-responsive">
          <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Numero de Credito</th>
                        <th>Estado</th>
                        <th>Municipio</th>
                        <th>Etapa</th>
                        <th>Accion</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(inmueble,i) in inmuebles" :key="i">
                        <td>{{inmueble.NumCredito}}</td>
                        <td>{{inmueble.Estado}}</td>
                        <td>{{inmueble.Municipio}}</td>
                        <td>{{inmueble.Etapa}}</td>
                        <td>
                            <a href="#">
                              <font-awesome-icon icon="fa-solid fa-house-circle-check" />
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
        axios.get(process.env.VUE_APP_RUTA_API+'inmueble/readall.php')
        .then((res) => {
          if (res.data) {
              const {datos} = res.data
              this.inmuebles = datos
              //console.log(datos);                               
           }
        });
      },
  },
  mounted(){
  this.getInmuebles()
},
}
</script>

<style>

</style>