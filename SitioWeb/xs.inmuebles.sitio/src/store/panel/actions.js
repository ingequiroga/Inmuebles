import guardarInmueblehelper from '../../helpers/guardarInmueble'
import getInmueblehelper from '../../helpers/getinmueblehelper'
//import getProcesohelper from '../../helpers/getProcesoHelper'
//import finsubetapahelper from '../../helpers/finsubetapahelper'
//import guardarImageneshelper from '../../helpers/guardarImageneshelper'



export const guardarInmueble = async ({commit},inmueble) => {   
     const {data} = await guardarInmueblehelper(inmueble)    
     commit('setConfirmacion',data)
  }

  export const getInmueble = async ({commit},id) => {   
     const {data} = await getInmueblehelper(id)   
   commit('setInmueble',data)
  }

//   export const finSubEtapa = async ({commit},subetapa) => {   
//    subetapa.datos.cerrada = "1"
//    const {data} = await finsubetapahelper(subetapa.datos)   
//    subetapa.imagenes.forEach(element => {
//       let obj = guardarImageneshelper(subetapa.datos,element) 
//       console.log(obj);
//    });
//      console.log(data);
//      console.log(subetapa);
//  //commit('setSubEtapa',subetapa)   

// }