<template>
<div>
    <Navbar />
     <div class="container-fluid">
  <div class="row">
    <SideBar />
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
         <router-view />
    </main>
  </div>
</div>
</div>
</template>

<script>
import SideBar from '../components/panel-sidebar.vue';
import Navbar from '../components/panel-head.vue';
export default {
    components:{
        SideBar,
        Navbar
    }
}
</script>

<style>

</style>