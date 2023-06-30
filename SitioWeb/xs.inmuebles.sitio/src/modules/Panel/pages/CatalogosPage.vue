<template>
<div>
      <h1>Catalogos</h1>
        <div class="d-flex justify-content-center">
          
                <!-- <div class="cardboton btn">
                    <router-link class="nav-link" to="/usuario">
                      <h4>Usuarios</h4>
                     <p>Agregar nuevo usuario</p>  
                 </router-link>         
                </div> -->
                <v-flex md4 id="Cotizar" Style="display:none">
                    <v-card elevation="3" @click="goToPage('Usuario')">
                                    <div class="text-center">
                                         <div name="imgUsuarios">
                                            <img src="../../../assets/users-alt.png" class="iconoMenu" style="margin-top:10%" />
                                         </div>
                                        <v-card-text>
                                            <div>
                                              <p class="SubtituloGeneral" style="text-align:center;font-size:20px;">Agregar Usuario</p> 
                                            </div>
                                        </v-card-text>
                                        <div class="text-center cardHover">
                                        <v-card-text style="color: #FFFFFF; padding-bottom: 0;" >
                                            <div >
                                               <p class="tituloCard">Administrar Usuarios</p>
                                            </div>
                                        </v-card-text>
                                        <v-card-text style="color: #FFFFFF;">
                                            <div>
                                                Agregar nuevos usuarios
                                            </div>
                                        </v-card-text>
                                        <div>
                                            <v-btn light text color="#fd5f13" class="rounded-xl btnMinusculas" style="background-color:white" @click="goToPage('Usuario')">
                                                Ir a usuarios
                                            </v-btn>
                                        </div>
                                    </div>
                                    </div>
                                </v-card>
                </v-flex>

                <v-flex md4 id="Cotizar" Style="display:none">
                    <v-card elevation="3" @click="goToPage('Municipio')">
                                    <div class="text-center">
                                         <div name="imgMunicipios">
                                            <img src="../../../assets/building.png" class="iconoMenu" style="margin-top:10%" />
                                         </div>
                                        <v-card-text>
                                            <div>
                                              <p class="SubtituloGeneral" style="text-align:center;font-size:20px;">Municipios</p> 
                                            </div>
                                        </v-card-text>
                                        <div class="text-center cardHover">
                                        <v-card-text style="color: #FFFFFF; padding-bottom: 0;" >
                                            <div >
                                               <p class="tituloCard">Administrar Municipios</p>
                                            </div>
                                        </v-card-text>
                                        <v-card-text style="color: #FFFFFF;">
                                            <div>
                                                Agregar nuevos Municipios
                                            </div>
                                        </v-card-text>
                                        <div>
                                            <v-btn light text color="#fd5f13" class="rounded-xl btnMinusculas" style="background-color:white" @click="goToPage('Municipio')">
                                                Ir a Municipios
                                            </v-btn>
                                        </div>
                                    </div>
                                    </div>
                                </v-card>
                </v-flex>

                <v-flex md4 id="Cotizar" Style="display:none">
                    <v-card elevation="3" @click="goToPage('BancosyRec')">
                                    <div class="text-center">
                                         <div name="imgRecBancos">
                                            <img src="../../../assets/bank.png" class="iconoMenu" style="margin-top:10%" />
                                         </div>
                                        <v-card-text>
                                            <div>
                                              <p class="SubtituloGeneral" style="text-align:center;font-size:20px;">Recuperadoras y Bancos</p> 
                                            </div>
                                        </v-card-text>
                                        <div class="text-center cardHover">
                                        <v-card-text style="color: #FFFFFF; padding-bottom: 0;" >
                                            <div >
                                               <p class="tituloCard">Recuperadoras y Bancos</p>
                                            </div>
                                        </v-card-text>
                                        <v-card-text style="color: #FFFFFF;">
                                            <div>
                                                Agregar Recuperadoras y Bancos
                                            </div>
                                        </v-card-text>
                                        <div>
                                            <v-btn light text color="#fd5f13" class="rounded-xl btnMinusculas" style="background-color:white" @click="goToPage('BancosyRec')">
                                                Ir a Recuperadoras y Bancos
                                            </v-btn>
                                        </div>
                                    </div>
                                    </div>
                                </v-card>
                </v-flex>
               
               

             <!-- <div class="cardboton btn">
                 <router-link class="nav-link" to="/municipio">
                     <h4>Municipios</h4>
                     <p>Agregar Municipios</p>   
                 </router-link> 
              </div> -->

              <!-- <div class="shadow p-3 mb-5 bg-body rounded cardboton btn">
                  <router-link class="nav-link" to="/banyrec">
                      <h4>Recuperadoras y Bancos</h4>
                     <p>Agregar Recuperadora y bancos</p>     
                 </router-link> 
                
              </div> -->
  
    </div>
</div>
</template>

<script>
export default {
    methods: {
        goToPage(val){
            //console.log(this.$route.path);
            //this.$router.push(`/${val}`)
            //location.href = '/municipio'
            this.$router.push({name: val})
        },
        IrUsuarios(){
            this.$router.push({name: 'Usuario'}) 
        }
       
    }
}
</script>

<style>
    .iconoMenu {
    height: 55px;
    }

    .SubtituloGeneral {
    font: normal normal bold 14px/14px Montserrat;
    text-align: left;
    font-weight: 800;
    letter-spacing: 0.01px;
    color: #5A5A5A;
    opacity: 1;
}

.tituloCard {
    font-size: 20px;
}

.cardHover {
    top: 0;
    /*transform: scale(0, 0);*/
    opacity: 0;
    position: absolute;
    height: 100%;
    width: 100%;
    background-color: #00225a;
    transition: all 0.2s ease-in-out;
    justify-content: center;
    flex-flow: column;
}

.cardHover:hover {
    /*transform: scale(1, 0);*/
    opacity: 1;
    transition: all 0.2s ease-in-out;
}

.btnMinusculas{
    text-transform: none;
}

</style>