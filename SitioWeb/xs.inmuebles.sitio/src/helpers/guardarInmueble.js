import axios from 'axios'

const guardarInmueble = ({numCredit,deudor,tipoAdq,recObanco,cuentaCat,numFolioReal,etapaAct,comRegPub,estado,
    municipio,calle,codPostal,m2Superficie,m2Construccion,montoDeuda,montoMin,montoVenta,numExpJud,comExpJud}) =>{
    const json = `{"numcredito": "${numCredit}","deudor" : "${deudor}","tipodquisicion" : "${tipoAdq}","idreoban" : "${recObanco}"
    ,"cuentacat": "${cuentaCat}","numfolioreal": "${numFolioReal}","idetapa": "${etapaAct}",
    "idestado": "${estado}","idmunicipio": "${municipio}","calle": "${calle}","codigopostal": "${codPostal}"
    ,"m2superficie": "${m2Superficie}","m2construccion": "${m2Construccion}","montoDeuda": "${montoDeuda}"
    ,"montoMin": "${montoMin}","montoVenta": "${montoVenta}","numexpediente": "${numExpJud}"
    ,"comentarioregpub": "${comRegPub}","comentarioexpjudicial": "${comExpJud}","numexpediente": "${numExpJud}"}`
  
    console.log(json);

   return axios.post('http://localhost/api/inmueble/create.php',
       json,
       {headers:  {
         'Content-Type': 'application/json'}
       }) 
 }
 
 export default guardarInmueble