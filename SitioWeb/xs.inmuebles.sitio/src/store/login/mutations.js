export const logearUser = (state, val) =>{
    state.user = val
    state.isLoged = true 
  }

export const limpiarUser = (state) =>{
    state.user = {}
    state.isLoged = false 
  }

export const SetError = (state,val) => {
    state.MsgError = val
  }

  export const setInmueble = (state,val) => {
    state.inmueble = val
  }

