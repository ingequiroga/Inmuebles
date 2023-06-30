export const logearUser = (state, val) =>{
   console.log(val);
  state.user.email = val.Email
    state.user.idpersona = val.IdPersona
    state.user.idrol = val.IdRol
    state.isLoged = true 
  }

export const limpiarUser = (state) =>{
    state.user = {}
    state.isLoged = false 
  }

export const SetError = (state,val) => {
    state.MsgError = val.message
    state.Error = val.error
  }

  export const setInmueble = (state,val) => {
    state.inmueble = val
  }

  export const setUser = (state,val) => {
    state.user.email = val.email
    state.user.idpersona = val.idpersona
    state.user.idrol = val.idrol
  }

  export const setPersona = (state,val) => {
    state.persona.nombre = val.Nombre
    state.persona.apellido = val.Apellido
  }

