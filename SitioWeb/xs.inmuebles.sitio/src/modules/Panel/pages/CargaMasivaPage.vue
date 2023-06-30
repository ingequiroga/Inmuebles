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
                        <td>{{inmueble.numcredito}}</td>
                        <td>{{inmueble.namedeudor +' '+ inmueble.lastdeudor}}</td>
                        <td>{{inmueble.DescEstado}}</td>
                        <td>{{inmueble.DescMunicipio}}</td>
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
            if (this.file.type == 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet') {
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
                data.forEach(
                        element => {

                            // let inm = {
                            //     numcredito:	'',
                            //     namedeudor: '',	
                            //     lastdeudor: '',
                            //     Banos: 0,
                            //     Cochera: 0,
                            //     Dormitorios: 0,
                            //     tipodquisicion: 0,
                            //     //tipoAdq: element.tipoAdq,
                            //     idreoban: 0,
                            //     numFolioReal: '',		
                            //     cuentaCat: '',
                            //     DescripcionAdicional: '',	
                            //     comRegPub: '',	
                            //     idetapa: 0,	
                            //     idestado: 0,	
                            //     idmunicipio: 0,
                            //     Colonia: '',
                            //     NumInterior: '',
                            //     NumExt: '',
                            //     calle: '',	
                            //     TipoInmueble: 0,
                            //     codigopostal: '',
                            //     m2superficie: 0,
                            //     m2construccion: 0,	
                            //     montoDeuda: 0,
                            //     montoMin: 0,	
                            //     montoVenta: 0,	
                            //     numExpJud: 0,	
                            //     comentarioexpjudicial: '',
                            //     cargar: true,
                            //     guardado: '',
                            //     estatusinm: 1,
                            //     procInicial: 1,
                            //     DescEstado: '',
                            //     DescMunicipio: '',
                            // }
                            
                            let inm = {
                                numcredito:	element.NumCredito,
                                namedeudor: element.NombreDeudor,	
                                lastdeudor: element.ApellidosDeudor,
                                Banos: typeof element.NumeroBanos !== 'undefined' ? element.NumeroBanos : '',
                                Cochera: typeof element.LugaresCochera !== 'undefined' ? element.LugaresCochera : '',
                                Dormitorios: typeof element.Dormitorios !== 'undefined' ? element.Dormitorios : '',
                                tipodquisicion: typeof element.TipoAdq !== 'undefined' ? element.TipoAdq : 0,
                                //tipoAdq: element.tipoAdq,
                                idreoban: typeof element.RecObanco !== 'undefined' ? element.RecObanco : 0,
                                numfolioreal: typeof element.numFolioReal !== 'undefined' ? element.numFolioReal : '',		
                                cuentacat: typeof element.cuentaCat !== 'undefined' ? element.cuentaCat :'',
                                DescripcionAdicional: typeof element.DescripcionAdicional !== 'undefined' ? element.DescripcionAdicional : '',	
                                comentarioregpub: typeof element.comRegPub !== 'undefined' ? element.comRegPub : '',	
                                idetapa: typeof element.EtapaAct !== 'undefined' ? element.EtapaAct : 0,	
                                idestado: typeof element.IdEstado !== 'undefined' ? element.IdEstado : 0,	
                                idmunicipio: typeof element.IdMunicipio !== 'undefined' ? element.IdMunicipio : 0,
                                Colonia: typeof element.Colonia !== 'undefined' ? element.Colonia : '' ,
                                NumInterior: typeof element.NumInterior !== 'undefined' ? element.NumInterior : '' ,
                                NumExt: typeof element.NumExterior !== 'undefined' ? element.NumExterior : '' ,
                                calle: typeof element.Calle !== 'undefined' ? element.Calle : '' ,	
                                TipoInmueble: typeof element.IdTipoInmueble !== 'undefined' ? element.IdTipoInmueble : 0 ,
                                codigopostal: typeof element.CodPostal !== 'undefined' ? element.CodPostal : '' ,
                                m2superficie: typeof element.M2Superficie !== 'undefined' ? element.M2Superficie : 0 ,
                                m2construccion: typeof element.M2Construccion !== 'undefined' ? element.M2Construccion : 0 ,	
                                montoDeuda: typeof element.MontoDeuda !== 'undefined' ? element.MontoDeuda : 0 ,
                                montoMin: typeof element.MontoMin !== 'undefined' ? element.MontoMin : 0 ,	
                                montoVenta: typeof element.MontoVenta !== 'undefined' ? element.MontoVenta : 0 ,	
                                numexpediente: typeof element.numExpJud !== 'undefined' ? element.numExpJud : '' ,	
                                comentarioexpjudicial: typeof element.ComExpJud !== 'undefined' ? element.ComExpJud : '' ,
                                cargar: true,
                                guardado: '',
                                estatusinm: 1,
                                procInicial: 1,
                                DescEstado: element.Estado,
                                DescMunicipio: element.Municipio,
                            }

                            console.log(inm)
                            this.readedInmuebles.push(inm)
                        }
                    )
                }
        reader.readAsBinaryString(this.file);
            }  
        else{
            console.log("El formato de archivo no es el correcto");
        }    
        }
    },
    async cargaMasiva(){
    for(const inmueble of this.readedInmuebles)
    {
    //this.readedInmuebles.forEach((inmueble)=>{
        //console.log(inmueble);
        if (inmueble.cargar == true) {
            const {error} = await this.Guardar(inmueble)
            if (!error) {
             inmueble.guardado = 'Guardado'
            }else{
                inmueble.guardado = 'Error'
            }
        }
   // })
    }
   
    // this.inmueblestosave.forEach(element => {
    //    
    //      this.guardar(element,i)   
       
    //     //  if (!this.Error) {
    //     //     this.inmueblestosave[i].resultado = true
    //     //  }
    //     i++
    // })
  
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