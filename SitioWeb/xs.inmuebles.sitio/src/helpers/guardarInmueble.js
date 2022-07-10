import axios from 'axios'

const guardarInmueble = ({numCredit,namedeudor,lastdeudor,tipoAdq,recObanco,cuentaCat,numFolioReal,etapaAct,comRegPub,estado,
    municipio,calle,codPostal,m2Superficie,m2Construccion,montoDeuda,montoMin,montoVenta,numExpJud,comExpJud,estatusinm}) =>{
    const json = `{"numcredito": "${numCredit}","namedeudor" : "${namedeudor}","lastdeudor" : "${lastdeudor}",
    "tipodquisicion" : "${tipoAdq}","idreoban" : "${recObanco}"
    ,"cuentacat": "${cuentaCat}","numfolioreal": "${numFolioReal}","idetapa": "${etapaAct}",
    "idestado": "${estado}","idmunicipio": "${municipio}","calle": "${calle}","codigopostal": "${codPostal}"
    ,"m2superficie": "${m2Superficie}","m2construccion": "${m2Construccion}","montoDeuda": "${montoDeuda}"
    ,"montoMin": "${montoMin}","montoVenta": "${montoVenta}","numexpediente": "${numExpJud}"
    ,"comentarioregpub": "${comRegPub}","comentarioexpjudicial": "${comExpJud}","numexpediente": "${numExpJud}"
    ,"estatusinm": "${estatusinm}"}`

   //return axios.post('http://localhost/api/inmueble/create.php',
   return axios.post(process.env.VUE_APP_RUTA_API+'inmueble/create.php',
       json,
       {headers:  {
         'Content-Type': 'application/json'}
       }) 
 }
 
 export default guardarInmueble