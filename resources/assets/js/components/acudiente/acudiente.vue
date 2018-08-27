<template>
    <div>
        <ring-loader class="preloader-background" :loading="loading" :color="'#00bcd4'"></ring-loader>
        <div class="card animated fadeIn">
            <div class="card-header">
                <h5 class="text-center">
                    Lista de acudientes
                </h5>
            </div>
            <div class="card-body">
                <div class="">
                    <div class="pt-1 pb-1">
                        <router-link :to="{name:'acudiente.Nuevo',params:{opcion:'nuevo'}}"
                                     class="btn btn-outline-primary"><i class="mdi mdi-account-plus-outline"></i>
                            Agregar acudiente >>
                        </router-link>
                    </div>
                    <!-- <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                            <thead class="thead-light">
                            <tr>
                                <th>
                                    Nombres
                                </th>
                                <th>
                                    Apellidos
                                </th>
                                <th>
                                    Parentesco
                                </th>
                                <th>
                                    Dirección
                                </th>
                                <th>
                                    Correo
                                </th>
                                <th>
                                    Teléfono
                                </th>
                                <th>
                                    Celular
                                </th>
                                <th class="text-center">
                                    Gestionar
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="da in datos">
                                <td>
                                    {{da.nombre+' '+da.segundo_nombre}}
                                </td>
                                <td>
                                    {{da.apellido+' '+da.segundo_apellido}}
                                </td>
                                <td>
                                    {{da.parentesco}}
                                </td>
                                <td>
                                    {{da.direccion}}
                                </td>
                                <td>
                                    {{da.email}}
                                </td>
                                <td>
                                    {{da.telefono}}
                                </td>
                                <td>
                                    {{da.celular}}
                                </td>
                                <td>
                                    gdjsafhdsf
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <infinite-loading @infinite="cargaracudientes" ref="infiniteLoading">
                          <span slot="no-more" class="">
                                <small>Mostrando {{ datos.length }} resultados
                                </small>
                          </span>
                        </infinite-loading> -->
                    <v-client-table :data="datos" :columns="columns" :options="options">
                        <div slot="gestionar" slot-scope="da">
                            <router-link class="animated pulse text-success p-1"
                                         :to="{name:'acudiente.Nuevo',query:{'id':da.row.id},params:{'opcion':'actualizar'}}">
                                <i class="menu-icon icono mdi mdi-account-edit"></i></router-link>
                            <a href="#" @click.prevent="eliminar(da.row.id,da.index)" class="text-danger p-1"><i
                                    class="menu-icon icono icon ion-ios-trash"></i></a>
                        </div>
                        <div slot="nombres" slot-scope="da">
                            <label>{{da.row.nombre+' '+(da.row.segundo_nombre!='' && da.row.segundo_nombre!=null
                                ?da.row.segundo_nombre:'')}}</label>
                        </div>
                        <div slot="apellidos" slot-scope="da">
                            <label>{{da.row.apellido+' '+da.row.segundo_apellido}}</label>
                        </div>
                        <div slot="email" slot-scope="da">
                            <router-link class="animated pulse text-primary font- p-1"
                                         :to="{name:'acudiente.Nuevo',query:{'id':da.row.id},params:{'opcion':'actualizar'}}">
                                {{da.row.email}}
                            </router-link>
                        </div>
                    </v-client-table>
                    <infinite-loading @infinite="cargaracudientes" ref="infiniteLoading">
                      <span slot="no-more" class="">
                            <small>Mostrando {{ datos.length }} resultados
                            </small>
                      </span>
                    </infinite-loading>
                </div>
            </div>
        </div>
        <error :mensaje="error" :titulo="'Error al procesar la solicitud'"></error>
    </div>
</template>


<script>
    import toastr from 'toastr'

    export default {
        name: "acudiente",
        data: function () {
            return {
                datos: [],
                columns: ['nombres', 'apellidos', 'parentesco', 'direccion', 'email', 'telefono', 'celular', 'gestionar'],
                options: {
                    filterByColumn: true,
                    perPage: 2,
                    texts: {
                        count: 'Mostrando del {from} al {to} de {count} resultados|{count} resultados|Un resultado',
                        filter: 'Filtrar resultados:',
                        filterPlaceholder: 'Buscar',
                        limit: 'Resultados:',
                        page: 'Página:',
                        noResults: 'No hay resultados',
                        filterBy: 'Filtrar por {column}',
                        loading: 'Cargando...',
                        defaultOption: 'Seleccionar {column}'
                    },
                    pagination: {chunk: 10, dropdown: true},
                    filterable: ['nombres', 'apellidos'],
                }
            }
        },
        mounted() {
            //this.cargaracudientes();
        },
        methods: {
            cargaracudientes($state) {
                //this.loading = true;
                axios.get("/acudiente?institucion=" + this.$store.state.institucionselected.id)
                    .then(res => {
                        $state.loaded();
                        this.datos = res.data;
                    })
                    .catch(error => {
                        this.error = error.response.data;
                        $state.complete();
                    })
                    .finally(() => {
                        //this.loading = false;
                        $state.complete();
                    })
            },
            eliminar(id, index) {
                var res = confirm("Desea eliminar el acudiente? ");
                if (res) {
                    axios.delete('/acudiente/' + id + "?index=" + index)
                        .then(res => {
                            toastr.info("El acudiente se ha eliminado.", "Eliminación exitosa");
                            this.datos.splice(res.data.index, 1);
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