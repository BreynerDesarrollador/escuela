<template>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <navbar></navbar>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper" style="position: relative">
            <!-- partial:partials/_sidebar.html -->
            <sidebar></sidebar>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <breadcrumbs></breadcrumbs>
                        <router-view></router-view>
                    </div>
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                <footer-app></footer-app>
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
</template>

<script>
    import toastr from 'toastr';

    export default {
        created() {
            this.$store.commit("agregardatos", datosescuela);
            this.$store.commit("agregardatosinstitucion", datosinstitucion);
            if (this.$store.state.datosinstitucion.length > 0) {
                this.$store.commit('Isinstitucion');
                if (!this.$store.state.return)
                    this.$store.state.institucionselected = this.$store.state.datosinstitucion[0];
                else this.$store.state.institucionselected = JSON.parse(localStorage.getItem('institucionseleccionada'));
            } else {
                toastr.error("No tiene asocidada un institución, primero debe registrar su institución.", "Registrar institución");
            }
        }
    }
</script>

<style lang="scss">
    .error-item {
        color: red;
    }

    .valid-item {
        color: black;
    }
</style>
