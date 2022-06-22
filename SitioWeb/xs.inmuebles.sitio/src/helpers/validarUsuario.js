import axios from 'axios'

const validarUsuario = ({name,pass}) =>{
    const json = `{"email"  : "${name}","pass" : "${pass}"}`
    //const json = `{"Usuario": "${name}","Password" : "${pass}","NumIntentosLogin": 0,"HostGuid": ""}`
 
   return axios.post('http://localhost/api/users/login.php',
    //return axios.post('http://servicewrapper.ts07.hdi.net:8000/api/Security/Login',
       json,
       {headers:  {
         'Content-Type': 'application/json'}
       }) 
 }
 
 export default validarUsuario