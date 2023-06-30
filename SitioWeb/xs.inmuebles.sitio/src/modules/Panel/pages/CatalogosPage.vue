<template>
<div>
      <h1>Catalogos</h1>
        <div class="d-flex justify-content-center">
          
                <div class="cardboton btn">
                    <router-link class="nav-link" to="/usuario">
                      <h4>Usuarios</h4>
                     <p>Agregar nuevo usuario</p>  
                 </router-link>         
                </div>

             <div class="cardboton btn">
                 <router-link class="nav-link" to="/municipio">
                     <h4>Municipios</h4>
                     <p>Agregar Municipios</p>   
                 </router-link> 
              </div>

                <div class="cardboton btn">
                  <router-link class="nav-link" to="/banyrec">
                      <h4>Recuperadoras y Bancos</h4>
                     <p>Agregar Recuperadora y bancos</p>     
                 </router-link> 
                
              </div>
    
    </div>
</div>
</template>

<script>
export default {

}
</script>

<style>

</style>