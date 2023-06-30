import axios from 'axios';

const inmueblesApi = axios.create({
    baseURL: process.env.VUE_APP_RUTA_API
})

export default inmueblesApi