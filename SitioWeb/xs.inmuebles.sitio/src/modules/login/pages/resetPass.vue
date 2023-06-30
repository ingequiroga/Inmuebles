<template>
  <div v-if="IsValid">
    <h2>Resetear Password</h2>
    <button @click="resetpass()" class="btn btn-primary">Cambiar</button>
    <ModalNewPass v-if="showModalnp" @close="showModalnp = false"  :Pass="pass" :Email="email" />
  </div>
</template>

<script>
import axios from 'axios'
import ModalNewPass from '../components/modalNewPass.vue';

export default {
    data() {
        return {
            IsValid: false,
            email: "",
            pass:'',
            showModalnp: false
        };
    },
    methods: {
        resetpass() {
            axios.post(process.env.VUE_APP_RUTA_API + "users/sendNewPass.php", {
                email: this.email,
                headers: [
                    { "Content-Type": "application/json; charset=utf-8" }
                ]
            }).then((res) => {
                if (res.data) {
                    //const {data} = res.data
                   
                    this.pass = res.data.pass
                    console.log(this.pass);
                    this.showModalnp = true
                }
            });
        }
    },
    mounted() {
        const now = new Date();
        axios.post(process.env.VUE_APP_RUTA_API + "solicitudPass/validarSolicitud.php", {
            clave: this.$route.query.key,
            expira: now.getTime(),
            headers: [
                { "Content-Type": "application/json; charset=utf-8" }
            ]
        }).then((res) => {
            if (res.data) {
                //const {data} = res.data
                //console.log(res.data);
                this.IsValid = !res.data.error;
                this.email = res.data.email;
            }
        });
    },
    components: { ModalNewPass }
}
</script>


<style>

</style>