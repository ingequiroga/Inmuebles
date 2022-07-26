

export const SetError = (state,val) => {
    state.Msg = val
    state.Error = true
  }


  export const setConfirmacion = (state,val) => {
    state.Msg = val.message
    state.Error = val.error
  }

  export const setInmueble = (state,val) => {
    state.inmueble = val
    state.inmueble.nomDeudor=val.NombreDeudor,
      state.inmueble.apellidoDeudor=val.ApellidosDeudor,
      state.inmueble.calle=val.Calle,
      state.inmueble.codPostal=val.CodigoPostal,
      state.inmueble.etapaAct=val.IdEtapa,
      state.inmueble.etapaDesc=val.Etapa,
      state.inmueble.idInmueble=val.IdInmueble,
      state.inmueble.m2Superficie=val.M2superficie,
      state.inmueble.m2Construccion=val.M2construccion,
      state.inmueble.estado=val.IdEstado,
      state.inmueble.descEstado=val.NomEstado,
      state.inmueble.municipio=val.IdMunicipio,
     state.inmueble.descMunicipio=val.NomMunic
  }

  export const setProceso = (state,val) => {
    console.log(val)
    state.proceso.id = val.proceso.IdAdquisicion
    state.proceso.porcProceso = val.proceso.Porcentaje
    state.proceso.Estatus = val.proceso.Estatus
    state.proceso.subEtapas = val.subetapas.datos
  }

  export const setSubEtapa = (state,val) => {
    state.proceso.subEtapas[val.datos.indice].Comentarios = val.datos.comentarios
    //state.proceso.subEtapas[val.datos.indice].Descripcion = val.datos.comentarios
    state.proceso.subEtapas[val.datos.indice].Estatus = val.datos.cerrada
    state.proceso.subEtapas[val.datos.indice].IdAdquisicion =val.datos.idAdquisicion
    state.proceso.subEtapas[val.datos.indice].IdSubEtapa = val.datos.id
    //state.proceso.subEtapas[val.datos.indice].IdTabsubetapa = val.datos.cerrada
    state.proceso.subEtapas[val.datos.indice].Indice = val.datos.indice
    //state.proceso.subEtapas[val.datos.indice].Value = val.datos.cerrada
    state.proceso.subEtapas[val.datos.indice].Imagenes = val.imagenes


  }

