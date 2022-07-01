export const logearUser = (state, val) =>{
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
    state.MsgError = val
    state.Error = true
  }

  export const setInmueble = (state,val) => {
    state.inmueble = val
  }

  export const setUser = (state,val) => {
    state.user.email = val.email
    state.idpersona = val.IdPersona
    state.idrol = val.IdRol
  }

