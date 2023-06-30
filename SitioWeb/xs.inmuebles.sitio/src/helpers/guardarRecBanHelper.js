import axios from 'axios'

const guardarRecBanHelper = ({tipo,nombre}) =>{  
   //return axios.post('http://localhost/api/inmueble/create.php',
   return axios.post(process.env.VUE_APP_RUTA_API+'recobanco/create.php',{
    "tipo": tipo,
    "nombre": nombre
   },
       {headers:  {
         'Content-Type': 'application/json'}
       }) 
 }
 
 export default guardarRecBanHelper