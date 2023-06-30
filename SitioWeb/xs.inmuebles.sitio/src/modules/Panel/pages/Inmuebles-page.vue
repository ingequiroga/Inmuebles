<template>
    <div>
        <h2>Inmuebles</h2>
      <!-- <div class="row mt-5">
        <div class="col-md-4">
            <label class="campo" for="">Crédito</label>
            <input type="text" class="form-control" v-model="numcred" />       
        </div>
      </div> -->
      <div class="mt-5 table-responsive">
    <v-data-table
          :headers="headers"
          :items="items"
          :search="search"
          :pagination.sync="pagination"
          :rows-per-page-items="[5, 10, 15]"
          :loading="loading"
          class="elevation-1"
        >
        <template v-slot:top>
          <v-toolbar flat>
            <v-toolbar-title>Inmuebles</v-toolbar-title>
            <v-divider class="mx-4" inset vertical></v-divider>
            <v-spacer></v-spacer>
            <v-text-field
              v-model="search"
              append-icon="mdi-magnify"
              label="Buscar"
              single-line
              hide-details
            ></v-text-field>
          </v-toolbar>
        </template>
        <template slot="item.actions" slot-scope="{ item }">
        <v-icon small class="mr-2" @click="editItem(item)">mdi-pencil</v-icon>
        <v-icon small @click="deleteItem(item)">mdi-delete</v-icon>
      </template>
    </v-data-table>
          <!-- <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Numero de Credito</th>
                        <th>Deudor</th>
                        <th>Estado</th>
                        <th>Municipio</th>
<<<<<<< Updated upstream
=======
                        <th>Proceso</th>
                        <th>Estatus</th>
>>>>>>> Stashed changes
                        <th>Accion</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(inmueble,i) in inmueblesObt" :key="i">
                        <td>{{inmueble.NumCredito}}</td>
                        <td>{{inmueble.Estado}}</td>
                        <td>{{inmueble.Municipio}}</td>
                        <td>{{inmueble.Proceso}}</td>
                        <td>{{inmueble.Estatus}}</td>
                        <td>
<<<<<<< Updated upstream
                            <input type="checkbox" id="checkbox">    
=======
                          <div class="d-flex justify-content-around icono">
                            <a @click="iniciarProc(inmueble)">
                              <font-awesome-icon icon="fa-solid fa-folder-open" />
                            </a>
                            <a @click="editar(inmueble.IdInmueble)">
                              <font-awesome-icon icon="fa-solid fa-pen-to-square" />
                            </a>
                            <a>
                              <font-awesome-icon icon="fa-solid fa-file-pdf" @click="openFicha(inmueble.IdInmueble)"/>
                            </a>
                          </div>
>>>>>>> Stashed changes
                        </td>
                    </tr>
                </tbody>
            </table> -->
      </div>
      <!-- <modalFicha ref="modalFichaRef" :inmueble="fichaInmueble"/> -->
      <modalFicha v-if="showModalFicha" @close="showModalFicha = false" :id="fichaInmueble"/>
    </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex';
import modalFicha from '../components/modalFicha.vue';

export default {
  computed:{
    ...mapGetters('panel',['getInmuebles']),
  },
  data(){
    return{
      numcred:'',
      Dialog: false,
      fichaInmueble:'',
      showModalFicha: false,



      //tabla vuetify
      headers: [
        { text: 'Numero de Credito', value: 'credito' },
        { text: 'Estado', value: 'estado' },
        { text: 'Municipio', value: 'municipio' },
        { text: 'Proceso', value: 'proceso', sortable: false },
        { text: 'Estatus', value: 'estatus', sortable: false },
        { text: 'Acciones', value: 'actions', sortable: false },

      ],
      items: [],
      search: '',
      pagination: {
        sortBy: 'name',
        descending: false,
        page: 1,
        rowsPerPage: 5,
        totalItems: 0,
      },
      loading: false,
    }
  },
  methods:{
      iniciarProc(inm){
        this.$router.push(`/${inm.IdInmueble}/${inm.IdProceso}`)
      },
      editar(id){
        this.$router.push({name:'EditarInmueble',params:{id:id}})
      },
<<<<<<< Updated upstream
=======
      openFicha(id)
      {
        this.fichaInmueble = id
        this.showModalFicha = true
        //console.log(inmueble)
        //this.$refs.modalFichaRef.inmueble =inmueble
       // this.$refs.modalFichaRef.dialog =true
      },
      llenarTabla(){
        let inmbtable = this.getInmuebles(this.numcred)
      inmbtable.forEach(element => {
        let item = {
          credito: element.NumCredito,
          estado: element.Estado,
          municipio: element.Municipio,
          proceso: element.Proceso,
          estatus: element.Estatus
        }
        this.items.push(item);
      })
      },
      editItem(item) {
        console.log(item);
      // Lógica para editar un elemento
      },
      deleteItem(item) {
        console.log(item);
      // Lógica para eliminar un elemento
      },
      ...mapActions('panel',{GetInmuebles:'getInmuebles'})

  },
  // watch:{
  //   buscarPor(event){
  //     if(event=='ubicacion'){
  //       this.numcred = ''
  //     }
  //     else{
  //       this.estadobus = ''
  //       this.munbus = ''
  //     }
  //   }
  // },
  components:{
    modalFicha
>>>>>>> Stashed changes
  },
  mounted(){
  this.GetInmuebles()
  this.llenarTabla()
},
}
</script>
<style>
  .icono {
    color: #F23545;
  }
</style>