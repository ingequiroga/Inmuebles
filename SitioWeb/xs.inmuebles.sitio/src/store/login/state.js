export default () => ({   
    user:{},
    isLoged: false,
    MsgError: '',
    recContrasenia:{
      mensaje:'',
      mostrar: false,
      error: false,
      mensajeError: ''
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
      montoDeuda: 0,
      montoMin: 0,
      montoVenta: 0,
      numExpJud: '',
      comExpJud: ''
    }
  })
