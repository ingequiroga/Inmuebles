import axios from 'axios'

const guardarMunHelper = ({idEstado,nombre}) =>{  
   //return axios.post('http://localhost/api/inmueble/create.php',
   return axios.post(process.env.VUE_APP_RUTA_API+'municipios/create.php',{
    "idestado": idEstado,
    "nombre": nombre
   },
       {headers:  {
         'Content-Type': 'application/json'}
       }) 
 }
 
 export default guardarMunHelper