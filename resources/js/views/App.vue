<template>
    <main id="wrapper">
        <div id="content">
            <navbar></navbar>
            <menuNav></menuNav>
            <div class=" bg-box"></div>
            <div class="container-fluid content-wrapper">
                <router-view></router-view>
            </div>
        </div>
    </main>


</template>
<script>
    import Navbar from './includes/Navbar';
    import menuNav from './includes/Menu';

    export default {
        data () {
            return {
                
            }
        },

        methods: {
            
        },

        mounted () {

        },

        components: {
            Navbar, menuNav
        },
    }
</script>