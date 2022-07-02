import validarUsuario from '../../helpers/validarUsuario'
import setLocalValues from '../../helpers/setLocalValues'
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

export const crearusuario = async ({commit},user) => {
  
   const {data} = await guardarUsuariohelper(user)
    //console.log(data);
  
  // if(error){
     commit('SetError',data)
  // }   
  // else{
  //   console.log(message);
  //   //commit('setInmueble',inmueble)
  // } 
}

export const cargarUsuario = async ({commit},user) => {
  console.log(user);
  commit('setUser',user)
}