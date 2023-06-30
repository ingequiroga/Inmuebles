//  export const myAction = async (/*{commit}*/)=> {
//  }


import validarUsuario from '../../helpers/validarUsuario'
import setLocalValues from '../../helpers/setLocalValues'
import guardarUsuariohelper from '../../helpers/guardarusuario'
import inmueblesApi from '@/Api/InmueblesApi'

export const login = async ({commit},datos) => {   
    const {data} = await validarUsuario(datos)
    console.log(data);
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
  
     commit('SetError',data)
}

export const cargarUsuario = async ({commit},user) => {
  commit('setUser',user)
}

export const getPersona = async ({commit},id)=> {
const {data} = await inmueblesApi.get('persona/readone.php?Id='+id)
console.log(data);
commit('setPersona',data)
  }
