<template>
   <div>
      <footer>
         <div class="copyright">
            <p>Created by <span class="panel_author">Oleksandr Mishchuk</span></p>
         </div>
      </footer>
   </div>
</template>

<script>
    export default {

    }
</script>

<style scoped>
   div.copyright {
      position: fixed;
      right: 10px;
      bottom: 0;
      font-family: 'Dancing Script', cursive;
      font-size: 17px;
   }
   div.copyright a, div.copyright a:hover {
      color: inherit;
      text-decoration: none;
   }
</style>