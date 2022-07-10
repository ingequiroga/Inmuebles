import guardarInmueblehelper from '../../helpers/guardarInmueble'

export const guardarInmueble = async ({commit},inmueble) => {   
   console.log(inmueble);
     const {data} = await guardarInmueblehelper(inmueble)    
     commit('setConfirmacion',data)
  }