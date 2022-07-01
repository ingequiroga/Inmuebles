import validarUsuario from '../../helpers/validarUsuario'
import setLocalValues from '../../helpers/setLocalValues'
import guardarInmueblehelper from '../../helpers/guardarInmueble'
import guardarUsuariohelper from '../../helpers/guardarusuario'

export const login = async ({commit},datos) => {   
    const {data} = await validarUsuario(datos)
     if (data.error) {
       commit('limpiarUser')
       commit('SetError',data.message)
   }
   else{
     setLocalValues("credenciales",data,180000)
     commit('logearUser',data)
   }
}

export const guardarInmueble = async ({commit},inmueble) => {
  //console.log(inmueble);
  
   const {message,error} = await guardarInmueblehelper(inmueble)
   //console.log(message);
   //console.log(commit);
   //console.log(error);
  if(error){
    commit('SetError',message)
  }   
  else{
    //console.log(message);
    commit('setInmueble',inmueble)
  } 
}

export const crearusuario = async ({commit},user) => {
  
   const {message,error} = await guardarUsuariohelper(user)

  if(error){
    commit('SetError',message)
  }   
  else{
    console.log(message);
    //commit('setInmueble',inmueble)
  } 
}