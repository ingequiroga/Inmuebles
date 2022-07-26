import axios from 'axios'

const guardarImageneshelper = ({id,idAdquisicion,idEtapa,imagen}) =>{
        let json = `{"IdAdquisicion": "${idAdquisicion}","IdEtapa" : "${idEtapa}","IdSubEtapa" : "${id}",
        "Image" : "${imagen}"}`
   //return axios.post('http://localhost/api/users/crear.php',
   return axios.post(process.env.VUE_APP_RUTA_API+'Imagen/crearImagen.php',
       json,
       {headers:  {
         'Content-Type': 'application/json'}
       }) 
 }
 
 export default guardarImageneshelper