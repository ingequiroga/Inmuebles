import axios from 'axios'

const guardarusuario = ({nombre,apellido,puesto,email,pass,rol}) =>{
    const json = `{"nombre": "${nombre}","apellido" : "${apellido}","puesto" : "${puesto}","email" : "${email}"
    ,"pass": "${pass}","idrol": "${rol}"}`
  
   // console.log(json);

   //return axios.post('http://localhost/api/users/crear.php',
   return axios.post(process.env.VUE_APP_RUTA_API+'users/crear.php',
       json,
       {headers:  {
         'Content-Type': 'application/json'}
       }) 
 }
 
 export default guardarusuario