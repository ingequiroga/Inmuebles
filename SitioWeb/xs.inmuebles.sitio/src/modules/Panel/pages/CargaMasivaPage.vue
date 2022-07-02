<template>
   <div class="container">
        <div class="mt-5">
             <input type="file" @change="onChange" />
        </div>
        <div class="mt-5">
              <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Numero de Credito</th>
                        <th>Deudor</th>
                        <th>Estado</th>
                        <th>Municipio</th>
                        <th>Accion</th>
                        <th>Resultado</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(inmueble,i) in readedInmuebles" :key="i">
                        <td>{{inmueble.numCredit}}</td>
                        <td>{{inmueble.deudor}}</td>
                        <td>{{inmueble.Estado}}</td>
                        <td>{{inmueble.Municipio}}</td>
                        <td>
                            <input type="checkbox" id="checkbox" v-model="inmueble.cargar">    
                        </td>
                         <td>
                            {{inmueble.guardado}}
                            <!-- <input type="checkbox" id="checkbox" v-model="inmueble.guardado" disabled>     -->
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div>
            <button class="btn btn-primary" @click="cargaMasiva()">Guardar</button>
        </div>
         <Modal v-if="showModal" @close="showModal = false" :Mensaje="Msg" />
   </div>
</template>

<script>
import XLSX from "xlsx"
import {mapActions,mapState} from 'vuex'
import Modal from '../../shared/components/Modal-Confirm.vue';

export default {
     computed:{
     ...mapState('panel',['Error'])
      },
    data(){
        return{
            readedInmuebles: [],
            inmueblestosave:[],
            showModal: false,     
        }
    },
methods:{
    onChange(event){
      
        this.file = event.target.files ? event.target.files[0] : null;
          
          if (this.file) {
                const reader = new FileReader();

                 reader.onload = (e) => {
                /* Parse data */
                const bstr = e.target.result;
                const wb = XLSX.read(bstr, { type: 'binary' });
                /* Get first worksheet */
                const wsname = wb.SheetNames[0];
                const ws = wb.Sheets[wsname];
                /* Convert array of arrays */
                const data = XLSX.utils.sheet_to_json(ws, { header: 0 });
                //console.log(data);
                data.forEach(
                        element => {
                            let inm = {
                                numCredit:	element.numCredit,
                                deudor: element.deudor,	
                                TipoAdquisicion: element.TipoAdquisicion,
                                tipoAdq: element.tipoAdq,
                                recObanco: element.recObanco,	
                                cuentaCat: element.cuentaCat,	
                                numFolioReal: element.numFolioReal,	
                                Estado: element.Estado,	
                                Municipio: element.Municipio,
                                etapaAct: element.etapaAct,	
                                estado: element.estado,	
                                municipio: element.municipio,	
                                calle: element.calle,	
                                codPostal: element.codPostal,
                                m2Superficie: element.m2Superficie,
                                m2Construccion: element.m2Construccion,	
                                montoDeuda: element.montoDeuda,
                                montoMin: element.montoMin,	
                                montoVenta: element.montoVenta,	
                                numExpJud: element.numExpJud,	
                                comRegPub: element.comRegPub,	
                                comExpJud: element.comExpJud,
                                cargar: true,
                                guardado: ''
                            }

                            this.readedInmuebles.push(inm)
                        }
                    )
                }
        reader.readAsBinaryString(this.file);
        }
    },
    async guardar(inm){
      await this.Guardar(inm)
  },
    cargaMasiva(){
    //let i=0
    this.readedInmuebles.forEach((inmueble)=>{
        if (inmueble.cargar == true) {
            this.guardar(inmueble) 
            if (!this.Error) {
             inmueble.guardado = 'Guardado'
            }else{
                inmueble.guardado = 'Error'
            }
            //i++
            //this.inmueblestosave.push(inmueble)
        }
    })
   
    // this.inmueblestosave.forEach(element => {
    //     //console.log(element);
    //      this.guardar(element,i)   
       
    //     //  if (!this.Error) {
    //     //     this.inmueblestosave[i].resultado = true
    //     //  }
    //     i++
    // })
    console.log(this.readedInmuebles)
},
 ...mapActions('panel',{
        Guardar: 'guardarInmueble'
        }) 
},
components:{
      Modal
},

}
</script>

<style>

</style>