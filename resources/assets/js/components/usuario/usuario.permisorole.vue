<template>
    <div class="pt-2">
        <div class="card">
            <div class="card-header">
                <h5 class="text-center">Permisos</h5>
            </div>
            <div class="card-body">
                <div class="row" style="display:none">
                    <section class="col-sm-12 col-md-5">
                        <label for="permisos" class="text-center">---Seleccione los permisos---</label>
                        <select class="custom-select" size="10" name="permisos[]" id="permisos"
                                multiple>
                            <option v-for="ro in permisos" :value="ro.id">{{ro.name}}</option>
                        </select>
                    </section>
                    <section class="col-sm-12 col-md-2 text-center">
                        <button type="submit" class="btn btn-success" @click.prevent="savepermiso">
                            <strong>+</strong></button>
                    </section>
                    <section class="col-sm-12 col-md-5">
                        <label for="roles">---Seleccione los roles---</label>
                        <select class="custom-select" size="10" name="roles" id="roles">
                            <option v-for="pe in roles" :value="pe.id">
                                {{pe.name}}
                            </option>
                        </select>
                    </section>
                </div>
            </div>
        </div>
        <section>
            <div class="card">
                <div class="card-header">
                    <h5 class="text-center">Lista de permisos</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="list-group">
                            <a href="#" v-for="da in datospermisos"
                               class="list-group-item list-group-item-action flex-column align-items-start">
                                <div class="row">
                                    <div class="col-sm-10 col-md-10 col-xs-10">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h5 class="mb-1">{{da.name}}</h5>
                                            <small>3 days ago</small>
                                        </div>
                                        <p class="mb-1">{{da.description}}</p>
                                        <!-- <small>Donec id elit non mi porta.</small> -->
                                    </div>
                                    <div class="col-sm-2 col-md-2 col-xs-2">
                                        <a ><i class="mdi mdi-delete-circle text-danger icono"></i></a>
                                    </div>
                                </div>



                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
    var vm;
    export default {
        name: "usuario.permisorole",
        data: function () {
            return {
                permisos: [],
                roles: [],
                datospermisos: []
            }
        },
        mounted() {
            vm = this;
            this.consultardatos();
        },
        methods: {
            consultardatos() {
                this.loading = true;
                axios.all([axios.get('/role?opcion=permiso'), axios.get('/usuario?opcion=listarusuarios&institucion=' + this.datosinsselect().id), axios.get('/usuario?opcion=datosusuariopermisos')])
                    .then(axios.spread(function (permisos, roles, datosusuariopermiso) {
                        vm.roles = roles.data;
                        vm.permisos = permisos.data;
                        vm.datospermisos = datosusuariopermiso.data;
                    }))
                    .catch(error => {
                        this.error = error.response.data;
                    })
                    .finally(() => {
                        this.loading = false;
                    });
            },
        }
    }
</script>

<style scoped>

</style>