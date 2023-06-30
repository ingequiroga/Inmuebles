import axios from 'axios'

const validarUsuario = ({name,pass}) =>{
    const json = `{"email"  : "${name}","pass" : "${pass}"}`
    //const json = `{"Usuario": "${name}","Password" : "${pass}","NumIntentosLogin": 0,"HostGuid": ""}`
 
   //return axios.post('http://localhost/api/users/login.php',
   return axios.post(process.env.VUE_APP_RUTA_API+'users/login.php',
   
       json,
       {headers:  {
         'Content-Type': 'application/json'}
       }) 
 }
 
 export default validarUsuario