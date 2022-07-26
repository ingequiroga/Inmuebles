export default () => ({   
    Msg: '',
    Error: false,
   
    inmueble:{
      id: 0,
      nomDeudor:'',
      apellidoDeudor:'',
      calle: '',
      codPostal: '',
      etapaAct: 0,
      etapaDesc: '',
      idInmueble: 0,
      m2Superficie: 0,
      m2Construccion: 0,
      estado:0,
      descEstado:'',
      municipio: 0,
      descMunicipio:''
    },
    proceso:{
      id: 0,
      idEtapa:0,
      porcProceso:0,
      Estatus: "En proceso"
    }
  })
