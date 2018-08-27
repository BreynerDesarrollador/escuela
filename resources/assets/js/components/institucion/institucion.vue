<template>
    <div class="">
        <ring-loader class="preloader-background" :loading="loading" :color="'#00bcd4'"></ring-loader>
        <div class="">
            <div class="card animated fadeIn">
                <div class="card-body">
                    <div class="row">
                        <div class="pb-3">
                            <router-link class="btn btn-success"
                                         :to="{name:'institucion.Nuevo',params:{'opcion':'Registrar'}}"><i
                                    class="mdi mdi-new-box"></i> Registrar institución
                            </router-link>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover  table-bordered">
                                <thead class="thead-light">
                                <tr>
                                    <th>
                                        Nombre
                                    </th>
                                    <th>
                                        Nit
                                    </th>
                                    <th>
                                        Código del dane
                                    </th>
                                    <th>
                                        Rector
                                    </th>
                                    <th>
                                        Dirección
                                    </th>
                                    <th>
                                        Teléfono
                                    </th>
                                    <th>
                                        Celular
                                    </th>
                                    <th>
                                        Número de estudiantes
                                    </th>
                                    <th>
                                        Tipo de institción
                                    </th>
                                    <th>
                                        Gestionar
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="da in datos">
                                    <td>
                                        {{da.nombre}}
                                    </td>
                                    <td>
                                        {{da.nit}}
                                    </td>
                                    <td>
                                        {{da.codigo_dane}}
                                    </td>
                                    <td>
                                        {{da.rector}}
                                    </td>
                                    <td>
                                        {{da.direccion}}
                                    </td>
                                    <td>
                                        {{da.telefono}}
                                    </td>
                                    <td>
                                        {{da.celular}}
                                    </td>
                                    <td>
                                        {{da.num_estudiante}}
                                    </td>
                                    <td class="text-center">
                                        <div class="badge badge-primary" v-if="da.type==0">
                                            PRINCIPAL
                                        </div>
                                        <div class="badge badge-secondary" v-else>
                                            SEDE
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <router-link
                                                :to="{name:'institucion.Nuevo',params:{'opcion':'Actualizar'},query:{id:da.id}}">
                                            <i class="mdi mdi-table-edit icono"></i></router-link>
                                        <a href="#" @click.prevent="eliminar(da.id)" class="text-danger"><span
                                                class="mdi mdi-delete-forever icono"></span></a>
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
    import axios from 'axios';

    export default {
        name: "institucion",
        data: function () {
            return {
                datos: [],
            }
        },
        mounted() {
            this.listarinstituciones();
        },
        methods: {
            listarinstituciones() {
                this.loading = true;
                axios.get('/institucion')
                    .then(res => {
                        this.datos = res.data;
                    })
                    .catch(error => {
                        this.error = error.response.data;
                    })
                    .finally(() => {
                        this.loading = false;
                    })
            },
            eliminar(id) {
                const o = confirm("Desea eliminar la institución seleccionada? Una vez eliminada todos sus datos se perderan.");
                if (o) {
                    axios.delete(`/institucion/${id}`)
                        .then(res => {
                            toastr.success("Se ha eliminado la institución con exito", "Eliminación exitosa");
                        })
                        .catch(error => {
                            this.error = error.response.data;
                        })
                }
            }
        }
    }
</script>

<style scoped>

</style>