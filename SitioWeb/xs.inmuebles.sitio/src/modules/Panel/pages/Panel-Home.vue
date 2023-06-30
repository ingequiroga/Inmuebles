<template>
    <div class="text-center mt-5">
        

        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <h3>Qué deseas hacer1?</h3>
    </div>
    <div class="carousel-item">
      <h3>Qué deseas hacer2</h3>
    </div>
    <div class="carousel-item">
      <h3>Qué deseas hacer3</h3>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
    </div>
</template>

<script>
import { mapActions, mapState } from 'vuex'
export default {
    computed:{
        ...mapState('panel',['catalogos'])
    },
    methods: {
        ...mapActions('panel',{
            getCatalogos:'getCatalogos'
        })
    },
    mounted(){
        this.getCatalogos()
    }
}
</script>




<style>

.cardboton{
    height: 10rem;
    width: 15rem;
    border: 3px blue solid;
    /* background-color: blue; */
    font-weight: bold;
    margin: 20px;
}

</style>