import axios from 'axios'

const guardarInmueble = (inmueble) =>{
    const json = `{"idinmueble": "${inmueble.id}","numcredito": "${inmueble.numcredito}","namedeudor" : "${inmueble.nomDeudor}","lastdeudor" : "${inmueble.apellidoDeudor}",
    "tipodquisicion" : "${inmueble.tipoAdquisicion}","idreoban" : "${inmueble.idrecuperadora}"
    ,"cuentacat": "${inmueble.cuentaCatalog}","numfolioreal": "${inmueble.numfolio}",
    "idestado": "${inmueble.estado}","idmunicipio": "${inmueble.municipio}","calle": "${inmueble.calle}","codigopostal": "${inmueble.codPostal}"
    ,"m2superficie": "${inmueble.m2Superficie}","m2construccion": "${inmueble.m2Construccion}","montoDeuda": "${inmueble.montoDeuda}"
    ,"montoMin": "${inmueble.montoMinimo}","montoVenta": "${inmueble.montoVental}"
    ,"comentarioregpub": "${inmueble.comRegPub}","comentarioexpjudicial": "${inmueble.comExpDig}","numexpediente": "${inmueble.numExpJud}"
    ,"estatusinm": "${inmueble.estatusInm}"}`
    //console.log(json);
   //return axios.post('http://localhost/api/inmueble/create.php',
   return axios.post(process.env.VUE_APP_RUTA_API+'inmueble/update.php',
       json,
       {headers:  {
         'Content-Type': 'application/json'}
       }) 
 }
 
 export default guardarInmueble