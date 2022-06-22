import validarUsuario from '../../helpers/validarUsuario'

export const login = async (user) => {    
    const {data} = await validarUsuario(user)
    console.log(data);
//     if (data.error) {
//       //commit('limpiarUser')
//       //commit('SetError',data.mensajeError)
//   }
//   else{
//     //setLocalValues("credenciales",data,180000)
//     //commit('logearUser',data.usuario)
//   }
}