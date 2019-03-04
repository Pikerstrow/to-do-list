<template>
    <div>
        <head-navigation></head-navigation>
        <sidebar-navigation></sidebar-navigation>
        <!-- Main Content -->
        <section id="main-content">
            <div class="content">
                <router-view></router-view>
            </div>
        </section>
        <!-- End of Main Content section -->
        <admin-footer></admin-footer>
    </div>
</template>

<script>
    import HeadNavigation from "./admin/HeadNavigation.vue";
    import SidebarNavigation from "./admin/SidebarNavigation.vue";
    import AdminFooter from "./admin/AdminFooter.vue";

    export default {
        components: {
            "head-navigation": HeadNavigation,
            "sidebar-navigation": SidebarNavigation,
            "admin-footer": AdminFooter
        },
        mounted(){
            this.$store.dispatch('getUserName');
            this.$store.dispatch('getTasks');
        }
    }
</script>
