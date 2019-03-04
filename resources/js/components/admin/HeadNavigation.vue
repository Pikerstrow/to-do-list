<template>
   <div>
      <!-- Header Nav -->
      <header class="header">
         <nav class="top-nav">
            <div class="nav-hamburger-menu-container">
               <div id="hamburger_menu">
                  <span></span>
                  <span></span>
                  <span></span>
               </div>
               <div class="admin_panel_title">
                  <span>To Do </span><span>App</span>
               </div>
            </div>
            <div class="nav-profile-container">
               <ul class="navbar-nav mr-auto">
                  <li class="nav-item dropdown">
                     <a class="admin-profile" href="#" onclick="event.preventDefault()" aria-expanded="true">
                        <span class="admin-name">{{ username }}</span> <i class="fas fa-caret-down"></i>
                     </a>
                     <div class="dropdown-menu admin-profile-dropdown">
                        <a @click="logout()" class="dropdown-item" onclick="event.preventDefault()"><i style="transform:rotate(180deg)" class="fas fa-sign-in-alt"></i> Вихід</a>
                        <form id="logout-form" action="http://to-do-list.test/logout" method="POST" style="display: none;">
                           <input type="hidden" name="_token" id="csrf-token" :value="csrf_token">
                        </form>
                     </div>
                  </li>
               </ul>
            </div>
         </nav>
      </header>
      <!-- End of header -->
   </div>
</template>

<script>
    export default {
        computed: {
            username(){
                return this.$store.getters.username
            },
            csrf_token(){
                return document.querySelector("meta[name='csrf-token']").getAttribute("content")
            }
        },
        methods: {
            logout(){
               let form = document.getElementById("logout-form");
               form.submit();
            }
        }
    }
</script>

<style scoped>
   .top-nav{
      display: flex;
      flex-direction: row;
      justify-content: space-between;
   }
   .header {
      min-height: 50px;
      width: 100%;
      position: fixed;
      top: 0;
      left: 0;
      z-index: 99;
      background-color: #333333;
      color: #d0d8df;
      padding: 10px 20px;
   }
   #hamburger_menu {
      position: relative;
      width: 36px;
      height: 30px;
      cursor: pointer;
      display: inline-block;
   }
   #hamburger_menu span {
      display: block;
      height: 3px;
      width: 100%;
      background-color: #d0d8df;
      position: relative;
      left: 0;
   }
   #hamburger_menu span:nth-child(1) {
      top: 2px;
   }
   #hamburger_menu span:nth-child(2) {
      top: 11px;
   }
   #hamburger_menu span:nth-child(3) {
      top: 20px;
   }
   .nav-hamburger-menu-container, .nav-profile-container {
      display: flex;
      width: auto;
      align-items: center !important;
      flex-direction: row;
      justify-content: space-between;
   }
   .admin_panel_title {
      font-family: 'Rancho', cursive;
      letter-spacing: 1px;
      font-size: 23px;
      margin-left: 15px;
      display: inline-block;
   }
   .admin_panel_title span:nth-child(1) {
      color: yellow;
   }
   .admin_panel_title span:nth-child(2) {
      color: #d0d8df;
   }
   .admin-profile, .admin-profile:hover {
      text-decoration: none;
      font-size: 16px;
      font-family: 'Roboto', sans-serif;
      letter-spacing: .8px;
      color: #d0d8df;
   }
   .admin-name {
      display: inline-block;
      margin: 0px 3px;
   }
   .admin-profile-dropdown {
      position: absolute !important;
      margin-top: 14px;
      border-radius: 0;
      background-color: #333333;
   }
   .admin-profile-dropdown a {
      color: #d0d8df;
      cursor: pointer;
   }
   .admin-profile-dropdown a:hover {
      background-color: #333333;
      color: yellow;
   }
   .admin-profile-dropdown a i {
      margin-right: 10px;
   }
   .caret-up {
      transform: rotate(180deg);
   }
   .separator {
      display: inline-block;
      margin: 0 10px;
      font-size: 25px;
   }
   .admin-to-site, .admin-to-site:hover, .admin-to-site:visited {
      color: #d0d8df;
      text-decoration: none;
      cursor: pointer;
   }
</style>