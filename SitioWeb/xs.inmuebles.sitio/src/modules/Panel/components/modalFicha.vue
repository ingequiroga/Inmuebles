
<template>
    <div class="modal-mask">
          <div class="modal-wrapper">
            <div class="modal-container">
              <div class="modal-body">
                 <button class="btn btn-primary" @click="$emit('close')">Cerrar</button>  
                 <div class="mt-5">
                     <embed id="embArchivo" type="application/pdf" style="width:100%; height:30rem;" />
                </div>           
              </div>
            </div>
          </div>
        </div>
</template>

<script>
import { jsPDF } from "jspdf";
import { mapActions, mapState } from 'vuex';


export default {
 props:{
    id: {
            type: String,
            require: true
        }
    },
 computed:{
  ...mapState('login',['persona'])
 },
 data(){
    return{
      inmueble:{
      IdInmueble: 0,
      numcredito:'',
      namedeudor:'',
      lastdeudor:'',
      tipodquisicion:0,
      idreoban:0,
      cuentacat:'',
      numfolioreal:'',
      idetapa: 0,
      comentarioregpub:'',
      idestado:0,
      idmunicipio: 0,
      calle: '',
      codigopostal: '',
      m2superficie: 0,
      m2construccion: 0,
      montoDeuda: 0,
      montoMin:0,
      montoVenta: 0,
      numexpediente: '',
      comentarioexpjudicial: '',
      estatusinm:0,
      procInicial: 1,
      Colonia: '',
      Banos: '',
      Cochera: '',
      Dormitorios: '',
      DescripcionAdicional: '',
      NumInterior: 0,
      NumExt: 0,
      TipoInmueble: '',
      },
      estatus:'',
      tipo:'',
      imagenes:[]
    }
 },
 methods:{
    async llenarFicha()
    {
    let resp = await this.Obtener(this.id)
    console.log("Inmueble");
    console.log(resp);
    this.inmueble = {...resp}
    let respTipo= await this.getDescripcion(this.inmueble.TipoInmueble)
    this.tipo = respTipo.Descripcion
   // console.log(respTipo);
     let respEstatus = await this.getDescripcion(this.inmueble.estatusinm)
     this.estatus = respEstatus.Descripcion

    //let imgresp = await this.GetImagenes(this.id)
    //console.log(imgresp);
    const {imgresp}  = await this.GetImagenes(this.id)
    //console.log(imagenes);
    this.imagenes = imgresp //{...imgresp}
    if (this.inmueble.IdInmueble) {
        this.generarPDF()
    }
    //console.log(this.imagenes);
   // this.imagenes.push({"name":"descarga.jpg","data":"data:image/jpeg;base64,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"})
  },
    generarPDF(){
    
    let y = 30
    const doc = new jsPDF('p', 'px');
    let width = doc.internal.pageSize.getWidth();
    let height = doc.internal.pageSize.getHeight();
    

  
    doc.setFontSize(18)
    doc.text('Logo', 30, y)
    //Etiquetas
    doc.setFont("Montserrat", "bold"); //Tipo de fuente
    doc.setFontSize(12)
    doc.text('Nombre del Agente:', 120, y)
    doc.text('Fecha:', 320, y)
    
    let currentDate = new Date();
    let day = currentDate.getDate();
    let month = currentDate.getMonth() + 1;
    let year = currentDate.getFullYear();
    let formattedDate = day.toString().padStart(2, '0') + '/' + month.toString().padStart(2, '0') + '/' + year.toString();
   // console.log(formattedDate);
    let yFichaT = 300
    let yCaract = 300
    let yFoot = 480
    //Datos
    doc.setFont("Montserrat", "normal");
    doc.text(this.persona.nombre + ' '+ this.persona.apellido, 205, 30)
    doc.text(formattedDate, 350, 30)


    // if (this.imagenes>0) {
       var imag = document.createElement('img');
       imag.src = this.imagenes[0].data;
       imag.alt = "Imagen";
       doc.addImage(imag, "JPG", 30, 60, width-60, 200);
  //  }
  // // else {
  //   var image2 = new Image()
  //    image2.src = '../```'
  //    doc.addImage(image2, "JPG", 30, 60, width-60, 200);
  //  // }
    
    doc.setFont("Montserrat", "bold");
    doc.setFontSize(14)
    doc.text('FICHA TÉCNICA', 30, yFichaT)
    doc.text('CARACTERISTICAS', 260, yCaract)
    doc.text('DESCRIPCION', 30, yCaract + 120)
    doc.text('PRECIO',width/2,yFoot,'center')
    doc.setFontSize(12)
    doc.text('Ubicacion:', 30, yFichaT+20)
    doc.text('Municipio:', 30, yFichaT+40)
    doc.text('Medidas:', 30, yFichaT+60)
    doc.text('Estatus:', 30, yFichaT+80)
    doc.text('Tipo de Inmueble:', 260, yCaract + 20)
    doc.text('Dormitorios:', 260, yCaract + 40)
    doc.text('Baños:', 260, yCaract + 60)
    doc.text('Cochera:', 260, yCaract + 80)
    
    
    doc.setFont("Montserrat", "normal");
    doc.text(this.inmueble.Colonia, 80, yFichaT+20) //ubicacion
    doc.text(this.inmueble.NomMunic, 80, yFichaT+40) //Municipio

    let texto = this.inmueble.m2superficie + " m"

    doc.text(texto, 70, yFichaT+60) //superficie
    let posiciónFinalTexto = doc.getTextDimensions(texto);
    doc.setFontSize(7);
    doc.text("2", 70 + posiciónFinalTexto.w, yFichaT+55); //superindice para m2 
    doc.setFontSize(12)
    doc.text(' de superficie', 75 + posiciónFinalTexto.w, yFichaT+60) //superficie
    doc.text(this.estatus, 65, yFichaT+80) //Estatus
    doc.text(this.tipo, 335, yCaract + 20) //Tipo de Inmueble
    doc.text(this.inmueble.Dormitorios, 315, yCaract + 40) //Dormitorios
    doc.text(this.inmueble.Banos, 290, yCaract + 60) //Baños
    doc.text('Baños', 300, yCaract + 60) //Baños
    doc.text(this.inmueble.Cochera, 300, yCaract + 80) //Cochera
    doc.text('Autos', 310, yCaract + 80) //Cochera

    //Descripcion Adicional
    doc.setFontSize(14);
    let lines = doc.splitTextToSize(this.inmueble.DescripcionAdicional, (width-60))
    doc.text(lines, 30, yCaract + 140) 

   
    //Footer
    doc.setFontSize(14)
    doc.text('$ ' + this.inmueble.montoVenta,width/2,yFoot+20,'center');
    doc.text('Solo Contado',width/2,yFoot+40,'center');



    let binary = doc.output();
    let objpdf = binary ? btoa(binary) : "";
    var visoremb = document.getElementById('embArchivo');
    visoremb.src = "data:application/pdf;base64," + objpdf;

    console.log(this.imagenes[0]);
    console.log(this.inmueble);
    },
   
  ...mapActions('panel',{
    Obtener:'getInmueble',
    GetImagenes: 'getImagenes',
    getDescripcion: 'getDescCatalogo'
    })
 },
   mounted(){
    this.llenarFicha()
   },
}
</script>

<style scoped>
    .modal-mask {
  position: fixed;
  z-index: 9998;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  display: table;
  transition: opacity 0.3s ease;
}

.modal-wrapper {
  display: table-cell;
  vertical-align: middle;
}

.modal-body{
    height: 100%;
}

.modal-container {
  width: 50rem;
  height: 50rem;
  margin: 0px auto;
  padding: 20px 30px;
  background-color: #fff;
  border-radius: 2px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.33);
  transition: all 0.3s ease;
  font-family: Helvetica, Arial, sans-serif;
}

.modal-header h3 {
  margin-top: 0;
  color: #42b983;
}

.modal-body {
  margin: 20px 0;
}

.modal-default-button {
  float: right;
}

.modal-enter {
  opacity: 0;
}

.modal-leave-active {
  opacity: 0;
}

.modal-enter .modal-container,
.modal-leave-active .modal-container {
  -webkit-transform: scale(1.1);
  transform: scale(1.1);
}

</style> 