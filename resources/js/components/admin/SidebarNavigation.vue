<template>
   <div>
      <aside>
         <div id="sidebar-nav">
            <ul class="sidebar-menu">
               <router-link to="/" tag="li" active-class="active" exact>
                  <a><span class="i-wrap"><i class="fas fa-tachometer-alt"></i></span>
                     <span class="nav-a-text">Головна</span>
                  </a>
               </router-link>

               <li class="dropdown">
                  <a href="javascript:;" click="event.preventDefault();" class="drop-toggle"><span class="i-wrap"><i class="fas fa-tasks"></i></span><span class="nav-a-text">&nbsp;Завдання
                        &nbsp;&nbsp;</span><i class="fas fa-angle-right"></i></a>
                  <ul class="sidebar_submenu">

                     <router-link :to="{name: 'tasks'}" tag="li" active-class="active" exact>
                        <a><span class="i-wrap"><i class="fas fa-eye"></i></span><span class="nav-a-text">
                                Переглянути </span>
                        </a>
                     </router-link>

                     <router-link to="/tasks/create" tag="li" active-class="active" exact>
                        <a><span class="i-wrap"><i class="fas fa-plus"></i></span><span class="nav-a-text">
                                Додати </span>
                        </a>
                     </router-link>

                  </ul>
               </li>

               <li><a href="#"><span class="i-wrap"><i class="far fa-calendar-alt"></i></span>
                  <span class="nav-a-text">Календар</span></a>
               </li>
            </ul>
         </div>
      </aside>
   </div>
</template>

<script>
    export default {

    }
</script>

<style scoped>
   #sidebar-nav {
      width: 200px;
      height: calc(100% - 54px);
      position: fixed;
      left: 0px;
      top: 56px;
      background-color: #3f4a53;
      margin-left: 0px;
      transition-duration: .2s;
      overflow: hidden;
      opacity: 1;
      z-index: 999;
   }
   ul.sidebar-menu>li>a, ul.sidebar_submenu>li>a, .navbar-nav>li>ul.dropdown-menu>li>a {
      color: #d0d8df;
      text-decoration: none;
      display: block;
      padding: 15px 0 15px 10px !important;
      font-size: 15.5px;
      font-family: 'Roboto', sans-serif;
      letter-spacing: .8px;
      outline: none;
      -webkit-transition: 0.4s;
      -moz-transition: 0.4s;
      -o-transition: 0.4s;
      -ms-transition: 0.4s;
      transition: 0.4s;
      border-bottom: 1px solid #D7D7D7;
   }
   ul.sidebar-menu>li>a:hover, ul.sidebar_submenu>li>a:hover {
      background-color: #616970;
   }
   .navbar-nav>li>ul.dropdown-menu>li>a {
      padding: 5px 0 5px 10px;
   }
   ul.sidebar_submenu>li>a{
      padding: 7px 0 7px 10px;
      font-size: 14px;
      font-family: 'Roboto', sans-serif;
      letter-spacing: .8px;
      padding-left: 30px !important;
      font-style: italic;
   }
   ul.sidebar-menu ul.sidebar_submenu {
      display: none;
   }
   ul.sidebar-menu ul.sidebar_submenu.open {
      display: block;
   }
   ul.sidebar-menu li.dropdown>a>i.down {
      transform: rotate(90deg);
   }
   ul.sidebar-menu span.i-wrap {
      display: inline-block;
      width: 18px;
   }
   li.router-link-exact-active a {
      background-color: #616970;
   }
</style>