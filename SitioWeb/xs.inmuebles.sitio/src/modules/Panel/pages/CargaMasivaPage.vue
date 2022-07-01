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
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(inmueble,i) in readedInmuebles" :key="i">
                        <td>{{inmueble.NumCredito}}</td>
                        <td>{{inmueble.Deudor}}</td>
                        <td>{{inmueble.Estado}}</td>
                        <td>{{inmueble.Municipio}}</td>
                        <td>
                            <input type="checkbox" id="checkbox" v-model="inmueble.cargar">
                            
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div>
            <button class="btn btn-primary">Guardar</button>
        </div>
   </div>
   
 
</template>

<script>
import XLSX from "xlsx"

export default {
    data(){
        return{
            readedInmuebles: []       
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
                console.log(data);
                data.forEach(
                        element => {
                            let inm = {
                                NumCredito:	element.NumCredito,
                                Deudor: element.Deudor,	
                                TipoAdquisicion: element.TipoAdquisicion,
                                IdReoBan: element.IdReoBan,	
                                CuentaCat: element.CuentaCat,	
                                NumFolioReal: element.NumFolioReal,	
                                Estado: element.Estado,	
                                Municipio: element.Municipio,
                                IdEtapa: element.IdEtapa,	
                                IdEstado: element.IdEstado,	
                                IdMunicipio: element.IdMunicipio,	
                                Calle: element.Calle,	
                                CodigoPostal: element.CodigoPostal,
                                M2superficie: element.M2superficie,
                                M2construccion: element.M2construccion,	
                                MontoDeuda: element.MontoDeuda,
                                MontoMin: element.MontoMin,	
                                MontoVenta: element.MontoVenta,	
                                NumExpediente: element.NumExpediente,	
                                ComentarioRegPub: element.ComentarioRegPub,	
                                ComentarioExpJud: element.ComentarioExpJud,
                                cargar: true
                            }

                            this.readedInmuebles.push(inm)
                        }
                    )
                    console.log(this.readedInmuebles);
        }
        reader.readAsBinaryString(this.file);
          }
    }
}
}
</script>

<style>

</style>