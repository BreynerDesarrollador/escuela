<template>
    <div>
        <ring-loader class="preloader-background" :loading="loading" :color="'#00bcd4'"></ring-loader>
        <div class="card card-outline-primary animated fadeIn">
            <div class="card-header">
                <h5 class="text-center">Listado de usuarios</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="pb-2">
                        <router-link :to="{name:'usuario.Nuevo',params:{opcion:'nuevo'}}"
                                     class="btn btn-outline-primary">
                            Registrar usuario
                        </router-link>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="thead-light">
                            <tr>
                                <th>
                                    Nombre completo
                                </th>
                                <th>
                                    Email
                                </th>
                                <th>
                                    Rol
                                </th>
                                <th class="text-center">
                                    Gestionar
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="da in datos">
                                <td>
                                    {{da.name}}
                                </td>
                                <td>
                                    {{da.email}}
                                </td>
                                <td>
                                    <div class="badge badge-primary">
                                        {{da.role}}
                                    </div>

                                </td>
                                <td class="text-center">
                                    <router-link
                                            :to="{name:'usuario.Nuevo',params:{opcion:'actualizar'},query:{id:da.id}}">
                                        <i class="mdi mdi-account-edit icono p-1"></i></router-link>
                                    <router-link class="text-success"
                                                 :to="{name:'usuario.PermisosRoles',query:{user:da.id}}"><i
                                            class="mdi mdi-security icono p-1"></i></router-link>
                                    <a class="text-danger link-inherit" @click="eliminarusuario(da.id)"><i
                                            class="mdi mdi-delete-circle icono p-1"></i></a>

                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
        <error :mensaje="error" :titulo="'Error al procesar la solicitud'"></error>
    </div>
</template>

<script>

    import axios from 'axios'
    import toastr from 'toastr'

    export default {
        name: 'usuario',
        data: function () {
            return {
                datos: [],
            }
        },
        mounted() {
            this.cargarusuarios();
        },
        methods: {
            cargarusuarios() {
                this.loading = true;
                axios.get('/usuario?opcion=listarusuarios&institucion=' + this.$store.state.institucionselected.id)
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
            eliminarusuario(id) {
                const res = confirm("desea eliminar el usuario ?, recuerde una vez elimnado el usuario no puede recuperar los datos.");
                if (res) {
                    this.loading = true;
                    axios.delete('/usuario/' + id)
                        .then(res => {
                            const index = this.datos.findIndex(x => x.id === res.data);
                            this.datos.splice(index, 1);
                        })
                        .catch(error => {
                            this.error = erros.response.data;
                        })
                        .finally(() => {
                            this.loading = false;
                        })
                }

            }
        }
    }
</script>