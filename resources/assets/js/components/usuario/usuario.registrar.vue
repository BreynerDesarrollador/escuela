<template>
    <div class="">
        <form id="form_create" role="form" action="#" novalidate>
            <input type="hidden" name="institucion" id="institucion" v-model="datos.institucion"/>
            <div class="card animated fadeIn">
                <div class="card-body">

                    <div class="card">
                        <div class="card-header">
                            <h5 class="text-center">Datos personales</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="nombre">Nombres </label>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input id="nombre" type="text" class="form-control"
                                                       placeholder="Digite sus nombres" v-model="datos.nombre"
                                                       name="nombre" required>
                                                <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-check-circle-outline"></i>
                      </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="apellido">Apellidos </label>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input id="apellido" type="text" class="form-control"
                                                       placeholder="Digite sus apellidos" v-model="datos.apellido"
                                                       name="apellido" required>
                                                <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-check-circle-outline"></i>
                      </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-4 col-xs-4">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="celular">Celular </label>
                                            <div class="input-group">
                                                <input id="celular" type="text" class="form-control"
                                                       v-model="datos.celular"
                                                       placeholder="Celular del usuario"
                                                       name="celular" required v-on:keypress="solonumeros">
                                                <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-check-circle-outline"></i>
                      </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-4 col-xs-4">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="email">Correo </label>
                                            <div class="input-group">
                                                <input id="email" type="email" class="form-control"
                                                       v-model="datos.email"
                                                       placeholder="Correo del usuario"
                                                       name="email" required>
                                                <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-check-circle-outline"></i>
                      </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-4 col-xs-4">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="role">Rol </label>
                                            <select2 :id="'role'" :options="options" :name="'role'" v-model="datos.role"
                                                     class="buscarno">
                                                <option value="">---seleccione---</option>
                                            </select2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h5 class="text-center">Contraseña de acceso</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12 col-md-6 col-xs-6">
                                    <div class="form-group">
                                        <label for="password">Contraseña </label>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input id="password" type="password" class="form-control"
                                                       placeholder="********"
                                                       name="password" required>
                                                <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-check-circle-outline"></i>
                      </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6 col-xs-6">
                                    <div class="form-group">
                                        <label for="password_confirmation">Confirmar contraseña </label>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input id="password_confirmation" type="password" class="form-control"
                                                       placeholder="********"
                                                       name="password_confirmation" required>
                                                <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-check-circle-outline"></i>
                      </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-xs-12 text-center">
                            <button type="submit" @click.prevent="guardarusuario" class="btn btn-outline-primary"><i
                                    class="mdi mdi-content-save"></i> Guardar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <error :mensaje="error" :titulo="'Error al procesar la solicitud'"></error>
    </div>
</template>

<script>
    import axios from 'axios'
    import toastr from 'toastr'

    export default {
        name: "usuario.registrar",
        data: function () {
            return {
                datos: {
                    name: '',
                    nombre: '',
                    apellido: '',
                    celular: '',
                    email: '',
                    passoword: '',
                    role: '',
                    opcion: '',
                    institucion:this.$store.state.institucionselected.id,
                },
                options: [],
            }
        },
        mounted() {
            const option = this.$route.params.opcion;
            if (option == "actualizar") {
                const id = this.$route.query.id;
                this.actualizarshow(id);
            }
            this.cargarroles();
        },
        methods: {
            cargarroles() {

                axios.get('/combos?opcion=comboroles')
                    .then(res => {
                        this.options = res.data.datos;
                    })
                    .catch(error => {
                        this.error = error.response.data;
                    })
                    .finally(() => {
                        this.loading = false;
                    });
            },
            guardarusuario() {
                this.loading = true;
                var form = $("#form_create");
                if (this.datos.opcion == "actualizar") {
                    this.loading = true;
                    axios.put('/usuario/' + this.datos.id + '?' + form.serialize())
                        .then(res => {
                            toastr.info("Se ha actualizado los datos del usuario", "Actualización exitosa");
                            this.$router.push({name: 'usuario.Listar'});
                        })
                        .catch(error => {
                            this.error = error.response.data;
                        })
                        .finally(() => {
                            this.loading = false;
                        })
                } else {
                    axios.post('/usuario?' + form.serialize())
                        .then(res => {
                            this.$router.push({name: 'usuario.Listar'});
                        })
                        .catch(error => {
                            this.error = error.response.data;
                        })
                        .finally(() => {
                            this.loading = false;
                        })
                }

            },
            actualizarshow(id) {
                this.loading = true;
                axios.get('/usuario?opcion=actualizarshow&institucion=' + id)
                    .then(res => {
                        if (res.data.length > 0) {
                            this.datos = res.data[0];
                            this.datos.opcion = "actualizar";
                        } else {
                            toastr.warning("Lo sentimos, no hemos encontrado el usuario", "Usuario no encontrado");
                        }

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
</script>

<style scoped>

</style>