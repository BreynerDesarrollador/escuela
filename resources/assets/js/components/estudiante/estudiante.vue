<template>
    <div class="">
        <ring-loader class="preloader-background" :loading="loading" :color="'#00bcd4'"></ring-loader>
        <div class="">
            <div class="card card-outline-primary animated fadeIn">
                <div class="card-header">
                    <h5 class="text-center">Listado de estudiantes</h5>
                </div>
                <div class="card-body">
                    <router-link :to="{name:'estudiante.Nuevo',params:{opcion:'Registrar'}}"
                                 class="btn btn-success text-light">
                        Registrar estudiante
                        <i class="menu-icon icon ion-ios-add text-light"></i>
                    </router-link>
                    <!-- <table class="table table-hover table-striped table-bordered" style="width: 100%" id="tabla_estudiante">
                         <thead class="thead-light">
                         <tr>
                             <th>
                                 Nombres
                             </th>
                             <th>
                                 Apellidos
                             </th>
                             <th>
                                 Padre
                             </th>
                             <th>
                                 Madre
                             </th>
                             <th class="text-center">
                                 Acudiente
                             </th>
                             <th class="text-center">
                                 Estado del estudiante
                             </th>
                             <th class="text-center">
                                 Gestionar
                             </th>
                         </tr>
                         </thead>
                         <tbody>
                         <tr v-for="(da,index) in datos">
                             <td>
                                 {{da.nombre+' '+da.segundo_nombre}}
                             </td>
                             <td>
                                 {{da.apellido+' '+da.segundo_apellido}}
                             </td>
                             <td>
                                 {{da.padre}}
                             </td>
                             <td>
                                 {{da.madre}}
                             </td>
                             <td class="text-center">
                                 <a href="#" @click.prevent="agregaracudiente(da.id,index)"
                                    v-if="da.acudiente==null || da.acudiente==''"><i
                                         class="mdi mdi-account-plus-outline icono text-secondary"></i></a>
                                 <label v-else>{{da.acudiente}}</label>
                             </td>
                             <td class="text-center">
                                 <div v-if="da.estado==0" class="badge badge-primary">
                                     Activo
                                 </div>
                                 <div v-if="da.estado==1" class="badge badge-secondary">
                                     Estudiante retirado
                                 </div>
                                 <div v-if="da.estado==2" class="badge badge-danger">
                                     Estudiante expulsado
                                 </div>
                                 <div v-if="da.estado==3" class="badge badge-warning">
                                     Matricula temporal
                                 </div>
                                 <div v-if="da.estado==4" class="badge badge-info">
                                     Otro motivo
                                 </div>
                             </td>
                             <td class="text-center">
                                 <router-link class="animated pulse text-success p-1"
                                              :to="{name:'estudiante.Nuevo',query:{'id':da.id},params:{'opcion':'actualizar'}}">
                                     <i class="menu-icon icono mdi mdi-account-edit"></i></router-link>
                                 <router-link :to="{name:''}" class="text-danger p-1"><i
                                         class="menu-icon icono icon ion-ios-trash"></i></router-link>
                             </td>
                         </tr>
                         </tbody>
                     </table> -->
                    <v-client-table :data="datos" :columns="columns" :options="options">
                        <div slot="imagen" slot-scope="da">
                            <img :src="'/'+da.row.imagen" :alt="da.row.nombre+' '+da.row.apellido">
                        </div>
                        <div slot="gestionar" slot-scope="da">
                            <router-link class="animated pulse text-success p-1"
                                         :to="{name:'estudiante.Nuevo',query:{'id':da.row.id},params:{'opcion':'actualizar'}}">
                                <i class="menu-icon icono mdi mdi-account-edit"></i></router-link>
                            <router-link :to="{name:''}" class="text-danger p-1"><i
                                    class="menu-icon icono icon ion-ios-trash"></i></router-link>
                        </div>
                        <div slot="acudiente" slot-scope="da">
                            <a href="#" @click.prevent="agregaracudiente(da.row.id,da.index)"
                               v-if="da.row.acudiente==null || da.acudiente==''"><i
                                    class="mdi mdi-account-plus-outline icono text-secondary"></i></a>
                            <label v-else>{{da.row.acudiente}}</label>
                        </div>
                        <div slot="estado" slot-scope="da">
                            <div v-if="da.row.estado==0" class="badge badge-primary">
                                Activo
                            </div>
                            <div v-if="da.row.estado==1" class="badge badge-secondary">
                                Estudiante retirado
                            </div>
                            <div v-if="da.row.estado==2" class="badge badge-danger">
                                Estudiante expulsado
                            </div>
                            <div v-if="da.row.estado==3" class="badge badge-warning">
                                Matricula temporal
                            </div>
                            <div v-if="da.row.estado==4" class="badge badge-info">
                                Otro motivo
                            </div>
                        </div>
                    </v-client-table>
                    <infinite-loading @infinite="cargarlistaestudiantes" ref="infiniteLoading">
                      <span slot="no-more" class="">
                            <small>Mostrando {{ datos.length }} resultados
                            </small>
                      </span>
                    </infinite-loading>
                </div>
            </div>
        </div>
        <error :mensaje="error" :titulo="'Error al procesar la solicitud'"></error>
        <acudientefiltro :id="estudiante_id" @generar="guardaracudiente"></acudientefiltro>
    </div>
</template>

<script>

    import axios from 'axios'
    import toastr from 'toastr'
    import acudientefiltro from '../acudiente/acudiente.filtro';

    export default {
        components: {acudientefiltro},
        data: function () {
            return {
                datos: [],
                estudiante_id: {
                    id: '',
                    index: ''
                },
                acudiente_id: {
                    id: '',
                    nombre: ''
                },
                columns: ['imagen','nombre', 'apellido', 'padre', 'madre', 'acudiente', 'estado', 'gestionar'],
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
                    filterable: ['nombre', 'apellido', 'padre', 'madre', 'acudiente'],
                    headings: {
                        nombre: 'Nombre',
                        apellido: 'Apellido',
                        padre: 'Padre',
                        madre: 'Madre',
                        acudiente: 'Acudiente',
                        estado: 'Estado',
                        gestionar: 'Gestionar'
                    },
                    columnsClasses: {
                        'acudiente': 'text-center',
                        'gestionar': 'text-center'
                    }
                }
            }
        },
        mounted() {
            //this.cargarlistaestudiantes();
            //this.$store.commit('pruebamutacion');
        },
        methods: {
            cargarlistaestudiantes($state) {
                const i = this.$store.commit('Isinstitucion');
                const e = this.$store.state.return;
                axios.get('/estudiante?institucion=' + e.id)
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
            guardaracudiente(acudiente_id) {
                var id = acudiente_id.split('$')[0], nombre = acudiente_id.split("$")[1];
                this.acudiente_id.id = id;
                this.acudiente_id.nombre = nombre;

                axios.post('/estudiante.guardaracudiente?acudiente_id=' + id + '&estudiante_id=' + this.estudiante_id.id)
                    .then(res => {
                        if (res.data == "OK") {
                            toastr.info("Se ha registrado el acudiente al estudiante seleccionado.", 'Registro exitoso');
                            $("#modal_acudiente_filtro").modal('hide');
                            this.datos[this.estudiante_id.index].acudiente = this.acudiente_id.nombre;
                        } else {
                            toastr.warning(res.data, 'Registro fallido');
                        }

                    })
                    .catch(error => {
                        this.error = error.response.data;
                    });
            },
            agregaracudiente(id, index) {
                this.estudiante_id.id = id;
                this.estudiante_id.index = index;
                $('#boton_acudiente_filtro').click();
            }
        }
    }
</script>