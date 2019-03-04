<template>
   <div>
      <div class="row">
         <div class="col-12 admin-welcome">
            <h2 class="admin-welcome-h2">
               Вітаємо в додатку "To Do List :)", <span>{{ username }}!</span>
            </h2>
            <hr>
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