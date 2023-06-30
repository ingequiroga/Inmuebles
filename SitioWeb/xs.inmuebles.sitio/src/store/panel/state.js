export default () => ({   
    Msg: '',
    Error: false,
    Errores:[],
    catalogos:{
      estados:[],
      estatus:[],
      ciudades:[]
    },
    inmueble:{
      numCredit:'',
      deudor:'',
      tipoAdq:'',
      recObanco:'',
      cuentaCat:'',
      numFolioReal:'',
      etapaAct: 0,
      comRegPub:'',
      estado:0,
      municipio: 0,
      calle: '',
      codPostal: '',
      m2Superficie: 0,
      m2Construccion: 0,
<<<<<<< Updated upstream
      montoDeuda: 0,
      montoMin: 0,
      montoVenta: 0,
      numExpJud: '',
      comExpJud: ''
    }
=======
      estado:0,
      descEstado:'',
      municipio: 0,
      descMunicipio:''
    },
    inmuebles:[],
    proceso:{
      idEtapa: 0,
      idProceso: 0
    },
    porcProceso: 0,
    aumentoPorc: 0,
    isLoading: true
>>>>>>> Stashed changes
  })
