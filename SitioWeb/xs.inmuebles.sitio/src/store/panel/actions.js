<<<<<<< Updated upstream
import guardarInmueblehelper from '../../helpers/guardarInmueble'

export const guardarInmueble = async ({commit},inmueble) => {   
     const {data} = await guardarInmueblehelper(inmueble)    
     commit('setConfirmacion',data)
  }
=======
//  export const myAction = async (/*{commit}*/)=> {
//  }


import guardarMunHelper from '@/helpers/guardarMunHelper'
import guardarRecBanHelper from '@/helpers/guardarRecBanHelper'
import getCatalogosHelper from '@/helpers/getCatalogosHelper'
import inmueblesApi from '@/Api/InmueblesApi'



export const guardarInmueble = async ({commit},inmueble) => {  
      
const {numcredito,namedeudor, lastdeudor, tipodquisicion,idreoban,cuentacat,numfolioreal,idetapa
   ,idestado,idmunicipio,calle,codigopostal,m2superficie,m2construccion,montoDeuda,montoMin,montoVenta
   ,comentarioregpub,comentarioexpjudicial,numexpediente,estatusinm,procInicial,Colonia, Banos, Cochera,
   Dormitorios, DescripcionAdicional, NumInterior, NumExt, TipoInmueble} = inmueble     



const datatosave = {numcredito,namedeudor, lastdeudor, tipodquisicion,idreoban,cuentacat,numfolioreal,idetapa
   ,idestado,idmunicipio,calle,codigopostal,m2superficie,m2construccion,montoDeuda,montoMin,montoVenta
   ,comentarioregpub,comentarioexpjudicial,numexpediente,estatusinm,procInicial,Colonia, Banos, Cochera,
   Dormitorios, DescripcionAdicional, NumInterior, NumExt, TipoInmueble}

   console.log(datatosave);
   console.log(commit);

   const {data} = await inmueblesApi.post('inmueble/create.php',datatosave)     
    // commit('setConfirmacion',data)

    return data
  }

export const updateInmueble = async ({commit},inmueble) => {  

   //console.log(inmueble)
   const {
      IdInmueble,numcredito,namedeudor,lastdeudor,tipodquisicion,idreoban,cuentacat,numfolioreal,idetapa,comentarioregpub,
      idestado,idmunicipio,calle,codigopostal,m2superficie,m2construccion,montoDeuda,montoMin,montoVenta,numexpediente,
      comentarioexpjudicial,estatusinm,procInicial,Colonia,Banos,Cochera,Dormitorios,DescripcionAdicional,NumInterior,
      NumExt,TipoInmueble} = inmueble 

   const datatoupdate = {IdInmueble,numcredito,namedeudor,lastdeudor,tipodquisicion,idreoban,cuentacat,numfolioreal,idetapa,comentarioregpub,
      idestado,idmunicipio,calle,codigopostal,m2superficie,m2construccion,montoDeuda,montoMin,montoVenta,numexpediente,
      comentarioexpjudicial,estatusinm,procInicial,Colonia,Banos,Cochera,Dormitorios,DescripcionAdicional,NumInterior,
      NumExt,TipoInmueble}

   console.log(datatoupdate);

   const {data} = await inmueblesApi.post('inmueble/update.php',datatoupdate)    

//    const {data} = await updateInmueblehelper(inmueble)  
    console.log(data) 
    commit('setConfirmacion',data)
    return data
 }

export const getInmueble = async ({commit},id) => {   
     const {data} = await inmueblesApi.get('inmueble/readone.php?IdInmueble='+id)   
     console.log(data);
     console.log(commit);
   //commit('setInmueble',data)
     return data
  }

  export const getImagenes = async ({commit},id)=> {
   let iddefault = 0;
   const {data} = await inmueblesApi.get('imagenes/getbyinmueble.php?IdInmueble='+id)
   const {imagenes} = data
   if (imagenes.length == 0) {
      let resp = await inmueblesApi.get('imagenes/getbyinmueble.php?IdInmueble='+iddefault)
      let imgdefault = resp.data.imagenes

      return imgdefault
   }
   console.log(imagenes);
   // for (let id of data){
   //    imags.push({
   //       ...data[id]
   // })
   console.log(commit);
   //console.log(imags);
   return imagenes
  //}
}


export const getInmuebles = async ({commit})=> {
   const {data} = await inmueblesApi.get('inmueble/readall.php')
   const {datos} = data
   //console.log(datos);
   commit('setInmuebles',datos)
  }


export const getporcentaje = async ({commit},subetapas) => {
    let cumplido = 0
    subetapas.datos.forEach(element => {
     if (element.Estatus == 1) {
       cumplido += 1
     }        
    });
    //let incremento = (1 / subetapas.datos.length).toFixed(2)
    let calc = cumplido/subetapas.datos.length
 
    //commit('SetaumentoPorc',incremento)
    commit('SetPorc',calc)  
   }

export const getincrementoporc = async ({commit},subetapas) => {
    let incremento = parseFloat(1 / subetapas.datos.length)
    commit('SetaumentoPorc',incremento)
   }

export const Updporcentaje = async ({commit}) => {
    commit('IncrementarPorc')  
   }

export const guardarIdsProceso = async ({commit},ids) => {
    commit('setIdsProceso',ids)  
   }

export const guardarmunicipio = async ({commit},petMun) => {  
    const {data} = await guardarMunHelper(petMun)    
    console.log(data);
    commit('setConfirmacion',data)
 }

 export const guardarrecobanco = async ({commit},petrecban) => {  
  const {data} = await guardarRecBanHelper(petrecban)    
  console.log(data);
  commit('setConfirmacion',data)
}

//Catalogos
export const getCatalogos = async ({commit}) => {   
   const {data} = await getCatalogosHelper()   
   console.log(data);
   commit('setCatalogos',data)
}

export const getDescCatalogo = async ({commit},id)=> {
   //const {data} = inmueblesApi.get('catalogos/getxid.php?IdDet='+id) 
   const {data} = await inmueblesApi.get('catalogos/getxid.php?IdDet='+id) 
   console.log(data)
   console.log(commit)
   return data
  }





 export const saveImage = async ({commit},imagen)=> {
   const {data} = await inmueblesApi.post('Imagenes/create.php',imagen)     
   if (data.error) {
      commit('setErrores',data.message)
   }
   //console.log(commit);
   //console.log(data);
   return data
}

 export const limpiarImgs = async ({commit},IdInmueble)=> {
   console.log(IdInmueble);
   let datatosend = {
      IdInmueble: IdInmueble
   }
   const {data} = await inmueblesApi.post('Imagenes/limpiar.php',datatosend)
   if (data.error) {
      commit('setErrores',data.message)
   }
   return data
 }
>>>>>>> Stashed changes
