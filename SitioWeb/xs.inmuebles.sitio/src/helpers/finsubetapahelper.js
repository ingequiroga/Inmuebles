import axios from 'axios'

const finSubEtapa = ({cerrada,comentarios,id,idAdquisicion,idEtapa}) =>{
    const json = `{"IdAdquisicion": "${idAdquisicion}","IdSubEtapa" : "${id}","IdEtapa" : "${idEtapa}",
    "Estatus" : "${cerrada}","Comentarios" : "${comentarios}"}`

    //console.log(json)
   //return axios.post('http://localhost/api/inmueble/create.php',
   return axios.post(process.env.VUE_APP_RUTA_API+'subetapa/updateSubEtapa.php',
       json,
       {headers:  {
         'Content-Type': 'application/json'}
       }) 
 }
 
 export default finSubEtapa