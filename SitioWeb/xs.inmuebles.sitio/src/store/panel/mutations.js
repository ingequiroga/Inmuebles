

export const SetError = (state,val) => {
    state.Msg = val
    state.Error = true
  }


  export const setConfirmacion = (state,val) => {
    state.Msg = val.message
    state.Error = val.error
  }

