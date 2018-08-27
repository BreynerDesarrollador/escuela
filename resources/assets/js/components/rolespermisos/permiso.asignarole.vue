<template>
    <div class="pt-4">
        <ring-loader class="preloader-background" :loading="loading" :color="'#00bcd4'"></ring-loader>
        <error :mensaje="error" :titulo="'Error al procesar la solicitud'"></error>
        <div class="card">
            <div class="card-header text-center">
                <h5 class="card-title">Gestionar permisos rol</h5>
            </div>
            <div class="card-body">
                <form method="post" id="form_create" role="form" novalidate class="row">
                    <div class="w-100">

                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title text-center">Gestionar permisos</h5>
                                <p><a class="btn btn-success text-white" @click="nuevo==false?nuevo=true:nuevo=false">Nuevo
                                    permiso rol<span v-if="nuevo==false">+</span><span v-else>-</span></a></p>
                            </div>
                            <div class="card-body" v-show="nuevo">
                                <div class="row">
                                    <section class="col-sm-12 col-md-5">
                                        <label for="permisos">---Seleccione los permisos---</label>
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

                    </div>
                </form>
                <div class="row pt-2">
                    <div v-for="da in datos" class="table-responsive ">
                        <div class="bg-light text-center rounded">
                            <strong><h3>{{da.permisonombre}}</h3></strong>
                        </div>
                        <table class="w-100 table table-hover col-sm-12 col-md-12">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">
                                    Nombre del permiso
                                </th>
                                <th scope="col">
                                    Nombre para mostrar
                                </th>
                                <th scope="col">
                                    Descripción
                                </th>
                                <th scope="col">
                                    Gestionar
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="da1 in da.datos">
                                <td>
                                    {{da1.name}}
                                </td>
                                <td>
                                    {{da1.slug}}
                                </td>
                                <td>
                                    {{da1.description}}
                                </td>
                                <td class="text-center">
                                        <span @click="eliminarpermisorol(da.roleid,da.permisoid)"><i
                                                class="icono text-danger mdi mdi-delete-circle"></i></span>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

</template>

<script>
    import axios from 'axios';
    import toastr from 'toastr';

    var vm;
    export default {
        data: function () {
            return {
                datos: [],
                roles: [],
                permisos: [],
                nuevo: false
            }
        },
        mounted() {
            vm = this;
            this.consultardatos();
        },
        methods: {
            consultardatos() {
                this.loading = true;
                axios.all([axios.get('/role?opcion=permiso'), axios.get('/role?opcion=roles'), axios.get('/role?opcion=obtenerdatospermisosrol')])
                    .then(axios.spread(function (permisos, roles, datospermisorol) {
                        vm.roles = roles.data;
                        vm.permisos = permisos.data;
                        vm.cargarpermisorol(datospermisorol.data);
                    }))
                    .catch(error => {
                        vm.error = error.response.data;
                    })
                    .finally(() => {
                        this.loading = false;
                    });
            },
            savepermiso() {
                axios.post('/savepermisorol', $("#form_create").serialize())
                    .then(res => {
                        toastr.info("Se han asignado con exito los permisos al rol.", 'Registro exitoso');
                        this.consultardatos();
                    })
                    .catch(error => {
                        this.error = error.response;
                    })
            },
            cargarpermisorol(datosve) {
                var da = [];
                $.each(datosve, function (index, value) {
                    if (da.length > 0) {
                        var con = da.findIndex(x => x.permisonombre === value.permisonombre);
                        if (con === -1) {
                            da.push({
                                "id": value.id,
                                'permisoid': value.permisoid,
                                'roleid': value.roleid,
                                "permisonombre": value.permisonombre,
                                "datos": []
                            });
                            var con1 = da.length;
                            da[con1 - 1].datos.push(value);
                        } else {
                            //da.push({"id":value.id,"permisonombre":value.permisonombre,"datos":[]});
                            da[con].datos.push(value);
                        }
                    } else {
                        da.push({
                            "id": value.id,
                            'permisoid': value.permisoid,
                            'roleid': value.roleid,
                            "permisonombre": value.permisonombre,
                            "datos": []
                        });
                        da[0].datos.push(value);
                    }
                });
                this.datos = da;
            },
            eliminarpermisorol(rol, permiso) {
                var res = confirm('Desea eliminar el permiso?');
                if (res) {
                    this.loading = true;
                    axios.delete('/role/1?opcion=eliminarpermisorol&permiso=' + permiso + '&role=' + rol)
                        .then(res => {
                            var rol = res.data.rol;
                            var permiso = res.data.permiso;
                            var cont = this.datos.findIndex(x => x.permisoid === permiso && x.roleid === rol);
                            this.datos.splice(cont, 1);
                        })
                        .catch(error => {
                            this.error = error.response.data;
                        })
                        .finally(() => {
                            this.loading = false;
                        })
                }
            }
        }
    }
</script>