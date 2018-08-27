<template>
    <div class="row">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <form role="form" action="#" method="post" id="form_create" class="auto-form-wrapper row"
                          v-show="buscar">
                        <div class="form-group col-sm-12 col-md-8 col-xl-8">
                            <label for="nombre">Nombre </label>
                            <div class="input-group">

                                <input id="nombre" type="text" class="form-control"
                                       placeholder="..." v-model="datos.nombre"
                                       name="nombre" required>
                                <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-check-circle-outline text-danger"></i>
                      </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-12 col-md-4 col-xl-4">
                            <label for="nombre">Nit </label>
                            <div class="input-group">
                                <input id="nit" type="text" class="form-control"
                                       placeholder="..." v-model="datos.nit"
                                       name="nit" required>
                                <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-check-circle-outline text-danger"></i>
                      </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-12 col-md-8 col-xl-8">
                            <label for="rector">Nombres y Apellidos del rector </label>
                            <div class="input-group">
                                <input id="rector" type="text" class="form-control"
                                       placeholder="..." v-model="datos.rector"
                                       name="rector" required>
                                <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-check-circle-outline text-danger"></i>
                      </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-12 col-md-4 col-xl-4">
                            <label for="codigo_dane">Código del dane </label>
                            <div class="input-group">
                                <input id="codigo_dane" type="text" class="form-control"
                                       placeholder="..." v-model="datos.codigo_dane"
                                       name="codigo_dane" required>
                                <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-check-circle-outline text-danger"></i>
                      </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-12 col-md-8 col-xl-8">
                            <label for="direccion">Dirección </label>
                            <div class="input-group">
                                <input id="direccion" type="text" class="form-control"
                                       placeholder="..." v-model="datos.direccion"
                                       name="direccion" required>
                                <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-check-circle-outline text-danger"></i>
                      </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-12 col-md-4 col-xl-4">
                            <label for="telefono">Teléfono </label>
                            <div class="input-group">
                                <input id="telefono" type="text" class="form-control"
                                       placeholder="..." v-model="datos.telefono"
                                       name="telefono" required v-on:keypress="solonumeros">
                                <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-check-circle-outline text-danger"></i>
                      </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-12 col-md-4 col-xl-4">
                            <label for="celular">Celular </label>
                            <div class="input-group">
                                <input id="celular" type="text" class="form-control"
                                       placeholder="..." v-model="datos.celular"
                                       name="celular" required v-on:keypress="solonumeros">
                                <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-check-circle-outline text-danger"></i>
                      </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-12 col-md-4 col-xl-4">
                            <label for="num_estudiantes">Número de estudiantes </label>
                            <div class="input-group">
                                <input id="num_estudiantes" type="text" class="form-control"
                                       placeholder="..." v-model="datos.num_estudiantes"
                                       name="num_estudiantes" v-on:keypress="solonumeros" required>
                                <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-check-circle-outline text-danger"></i>
                      </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-12 col-md-4 col-xl-4">
                            <label for="nombre">Tipo de institución (SEDE, PRINCIPAL) </label>
                            <div class="input-group">
                                <select2 :id="'type'" type="text" v-model="datos.type"
                                         placeholder="..." class="buscarno"
                                         :name="'type'" required>
                                    <option value="" selected>--Seleccione---</option>
                                    <option value="0">PRINCIPAL</option>
                                    <option value="1">SEDE</option>
                                </select2>
                            </div>
                        </div>
                        <div class="form-group col-sm-12 col-md-12 col-xl-12 text-center">
                            <button type="submit" @click.prevent="guardar" class="btn btn-outline-primary"><i
                                    class="mdi mdi-content-save-outline"></i> Guardar institución
                            </button>
                        </div>
                    </form>
                    <infinite-loading @infinite="actualizarshow" ref="infiniteLoading"
                                      v-if="$route.query.id>0">
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
    import $ from 'jquery'
    import 'jquery-validation'
    import toastr from 'toastr'
    import axios from 'axios'

    export default {
        name: "institucion.create",
        data: function () {
            return {
                datos: {
                    nombre: '',
                    nit: '',
                    codigo_dane: '',
                    rector: '',
                    direccion: '',
                    telefono: '',
                    celular: '',
                    num_estudiantes: '',
                    type: '',
                },
                buscar: false,
            }
        },
        mounted() {
            this.validatenomensaje();
            this.validatealert('form_create');
            this.buscar = true;
        },
        methods: {
            guardar() {
                var form = $("#form_create");

                if (form.valid()) {
                    if (this.$route.query.id == '' || this.$route.query.id == undefined) {
                        axios.post('/institucion?' + form.serialize())
                            .then(res => {
                                toastr.info('Se ha registrado la institución con exito', 'Registro exitoso.');
                                this.$router.push({name: 'institucion.Listar'});
                            })
                            .catch(error => {
                                this.error = error.response.data;
                            })
                    } else {
                        this.actualizar(form);
                    }
                } else {
                    toastr.info('Complete todos los campos', 'Campos vacios');
                }
            },
            actualizarshow($state) {
                this.buscar = false;
                const id = this.$route.query.id;
                axios.get(`/institucion/${id}/edit`)
                    .then(res => {
                        $state.loaded();
                        this.datos = res.data;
                    })
                    .catch(error => {
                        this.error = error.response.data;
                        $state.complete();
                    })
                    .finally(() => {
                        this.buscar = true;
                        $state.complete();
                    });
            },
            actualizar(form) {
                axios.put('/institucion/' + this.datos.id + '?' + form.serialize())
                    .then(res => {
                        toastr.info('La institución se ha actualizado con exito', 'Actualización exitosa.');
                        this.$router.push({name: 'institucion.Listar'});
                    })
                    .catch(error => {
                        this.error = error.response.data;
                    })
            }
        }

    }
</script>

<style scoped>

</style>