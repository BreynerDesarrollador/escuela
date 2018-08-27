<template>
    <div class="container-fluid">
        <ring-loader class="preloader-background" :loading="loading" :color="'#00bcd4'"></ring-loader>
        <div class="">
            <div class="card card-outline-primary animated fadeIn align-content-center">
                <div class="card-header">
                    <h5 class="text-center">Listado de permisos</h5>
                </div>
                <div class="card-body">
                    <div class="container-fluid">
                        <div class="pb-2">
                            <router-link class="btn btn-outline-success" :to="{name:'permiso.Nuevo'}"><i class="menu-icon mdi mdi-new-box"></i>Nuevo permiso</router-link>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="thead-light">
                                <tr>
                                    <th>
                                        Nombre
                                    </th>
                                    <th>
                                        Display nombre
                                    </th>
                                    <th>
                                        Descripción
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="da in datos">
                                    <td>
                                        {{da.name}}
                                    </td>
                                    <td>
                                        {{da.slug}}
                                    </td>
                                    <td>
                                        {{da.description}}
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <error :mensaje="error" :titulo="'Error al procesar la solicitud'"></error>
    </div>
</template>

<script>

    import axios from 'axios'

    export default {
        data: function () {
            return {
                datos: [],
            }
        },
        mounted() {
            this.cargarlistaestudiantes();
        },
        methods: {
            cargarlistaestudiantes() {
                this.loading=true;
                axios.get('/role?opcion=permiso')
                    .then(res => {
                        this.datos = res.data;
                    })
                    .catch(error => {
                        this.error = error.response.data;
                    })
                    .finally(() => {
                        this.loading=false;
                    })
            }
        }
    }
</script>