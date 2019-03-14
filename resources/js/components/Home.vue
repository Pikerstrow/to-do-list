<template>
   <div>
      <div class="row">
         <div class="col-12 admin-welcome">
            <h2 class="admin-welcome-h2">
               Вітаємо в додатку "To Do List :)", <span>{{ username }}!</span>
            </h2>
            <hr>
            <div class="row justify-content-center">
               <div class="col-12 text-center">
                  <img class="img-fluid img-thumbnail" src="../../images/main-picutre.jpg" alt="hello">
               </div>
            </div>
         </div>
      </div>
   </div>
</template>

<script>
    export default {
        computed: {
            username() {
                return this.$store.getters.username;
            }
        }
    }
</script>

<style scoped>

</style>