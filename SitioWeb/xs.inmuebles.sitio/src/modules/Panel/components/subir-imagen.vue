<template>
  <div>
    <p class="subtit mb-0 mt-5">Imagenes</p>
    <hr class="mt-0">
      <div class="row">
        <div class="col-md-4">
          <readFile :indice="'1'" @tratar="tratarimagenes($event)"/> 
          </div>
           <!-- <div v-for="(imag,i) in imagenes" :key="i">
            <img :src="imag.data" :id="i" style="height: 80px;"/>
          </div>  -->
      </div>
      <div class="row">
        <div v-for="(imag,i) in imagenes" :key="i" class="col-md-3">
          <v-card
            class="mx-auto mt-3"
         max-width="400"
          >
          <v-img
            class="align-end text-white"
            height="80"
            :src="imag.data"
            cover
          >
          </v-img>
          <v-card-subtitle class="pt-4">
            {{ imag.name }}
          </v-card-subtitle>
          <v-card-actions>
            <v-btn color="secondary" @click="borrarImagen(i)">
              Eliminar
            </v-btn>
          </v-card-actions>
         </v-card>
        </div>
    
      </div>
    
      <!-- <img src="https://definicion.de/wp-content/uploads/2011/01/casa-1.jpg" alt="entry picture"
       class="img-thumbnail"> -->
  </div>
</template>

<script>
import  readFile  from '../components/read-file.vue';

export default {
    props:{
      imagenes:[]
    },
    methods:{
      tratarimagenes(event){
        this.$emit('addImagen', event)
        },
      borrarImagen(index){
        console.log(index);
        this.$emit('delImagen', index)
      }
    },
    components:{
        readFile
    }

}
</script>

<style lang="scss" scoped>
img {
    width: 200px;
    box-shadow: 0px 5px 10px rgba($color: #000000, $alpha: 0.2);
}
</style>