<template>
<div>
   <div :id="'file-preview-zone'+indice"></div>
   <div class="mt-3">
      <label class="text-reader">
    <input type="file" class="form-control" @change="loadTextFromFile">   
    
     </label>
   </div>

</div>
   
</template>

<script>
export default {
  props:{
    indice: String
  },
     methods: {
    loadTextFromFile(ev) {
      const file = ev.target.files[0];
      console.log(file);
      const reader = new FileReader();
       reader.onload = e => {
      //   var filePreview = document.createElement('img');
      //   filePreview.id = 'file-preview';
      //   filePreview.src = e.target.result;
      //    var previewZone = document.getElementById('file-preview-zone'+this.indice);
      //    previewZone.appendChild(filePreview);
         
         this.$emit("tratar", e.target.result);
        
         }
      // reader.readAsDataURL(file);
       
    }
  }
}
</script>

<style>

</style>