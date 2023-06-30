import axios from "axios";

const getCatalogosHelper = () =>{

    return axios.get(process.env.VUE_APP_RUTA_API+'catalogos/readall.php',{headers:  {
        'Content-Type': 'application/json'}
      })
}

export default getCatalogosHelper