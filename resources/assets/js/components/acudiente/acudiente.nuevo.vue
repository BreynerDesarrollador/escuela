<template>
    <div>
        <form action="#" method="post" role="form" id="form_create">
            <input type="hidden" v-model="datos.institucion" name="institucion" id="institucion">
            <div class="card animated fadeIn">
                <div class="card-header">
                    <h5 class="text-center">
                        Registrar nuevo acudiente
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-sm-12 col-md-6 col-xl-6">
                            <label for="nombre">Primer nombre </label>
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
                        <div class="form-group col-sm-12 col-md-6 col-xl-6">
                            <label for="segundo_nombre">Segundo nombre </label>
                            <div class="input-group">
                                <input id="segundo_nombre" type="text" class="form-control"
                                       placeholder="..." v-model="datos.segundo_nombre"
                                       name="segundo_nombre">
                                <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-check-circle-outline"></i>
                      </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-12 col-md-6 col-xl-6">
                            <label for="apellido">Primer apellido </label>
                            <div class="input-group">
                                <input id="apellido" type="text" class="form-control"
                                       placeholder="..." v-model="datos.apellido"
                                       name="apellido" required>
                                <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-check-circle-outline text-danger"></i>
                      </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-12 col-md-6 col-xl-6">
                            <label for="segundo_apellido">Segundo apellido </label>
                            <div class="input-group">
                                <input id="segundo_apellido" type="text" class="form-control"
                                       placeholder="..." v-model="datos.segundo_apellido"
                                       name="segundo_apellido" required>
                                <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-check-circle-outline text-danger"></i>
                      </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-12 col-md-6 col-xl-6">
                            <label for="lugar_nacimiento">Lugar de nacimiento </label>
                            <div class="input-group">
                                <input id="lugar_nacimiento" type="text" class="form-control"
                                       placeholder="..." v-model="datos.lugar_nacimiento"
                                       name="lugar_nacimiento" required>
                                <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-check-circle-outline text-danger"></i>
                      </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-3 col-xl-3">
                            <label for="fecha_nacimiento">Fecha nacimiento <i class="text-danger">*</i></label>
                            <div class='input-group mb-3'>
                                <!-- <input type="text" name="fecha_nac" id="fecha_nac" required
                                        class="form-control combofecha" v-model="datos.fecha_nac"/> -->
                                <date-picker :class="'form-control combofecha'" name="fecha_nacimiento"
                                             id="fecha_nacimiento" required v-model="datos.fecha_nacimiento"
                                             :config="optiondate"></date-picker>
                                <div class="input-group-append">
                                    <i class="input-group-text icon ion-ios-calendar"></i>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-12 col-md-12 col-xl-12">
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
                        <div class="form-group col-sm-12 col-md-3 col-xl-3">
                            <label for="ocupacion">Ocupación </label>
                            <div class="input-group">
                                <input id="ocupacion" type="text" class="form-control"
                                       placeholder="..." v-model="datos.ocupacion"
                                       name="ocupacion" required>
                                <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-check-circle-outline text-danger"></i>
                      </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-12 col-md-3 col-xl-3">
                            <label for="parentesco">Parentesco</label>
                            <select2 :options="options" v-model="datos.parentesco"
                                     :buscar="false"
                                     :id="'parentesco'" :name="'parentesco'" class="buscarno">
                                <option disabled value="0">...Parentesco...</option>
                            </select2>
                            <!-- <input type="hidden" v-model="datos.tipo_documento" name="tipo_documento"> -->
                        </div>
                        <div class="form-group col-sm-12 col-md-3 col-xl-3">
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
                        <div class="form-group col-sm-12 col-md-3 col-xl-3">
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
                            <label for="email">Correo </label>
                            <div class="input-group">
                                <input id="email" type="email" class="form-control"
                                       placeholder="..." v-model="datos.email"
                                       name="email" required>
                                <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-check-circle-outline text-danger"></i>
                      </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-12 text-center">
                            <button type="submit" @click.prevent="guardar" class="btn btn-outline-primary"><i
                                    class="mdi mdi-content-save icono"></i> Guardar
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
    import $ from 'jquery'
    import 'jquery-validation'
    import toastr from 'toastr'

    export default {
        name: "acudiente",
        data: function () {
            return {
                optiondate: {
                    format: 'YYYY-MM-DD',
                    useCurrent: false,
                    locale: 'es'
                },
                options: [
                    {id: 'PADRE', text: 'PADRE'},
                    {id: 'MADRE', text: 'MADRE'},
                    {id: 'ABUELO', text: 'ABUELO'},
                    {id: 'ABUELA', text: 'ABUELA'},
                    {id: 'TIO', text: 'TIO'},
                    {id: 'TIA', text: 'TIA'},
                    {id: 'PRIMO', text: 'PRIMO'},
                    {id: 'PRIMA', text: 'PRIMA'},
                    {id: 'OTRO', text: 'OTRO'},
                ],
                datos: {
                    nombre: '',
                    segundo_nombre: '',
                    apellido: '',
                    segundo_apellido: '',
                    lugar_nacimiento: '',
                    fecha_nacimiento: '',
                    direccion: '',
                    ocupacion: '',
                    parentesco: '',
                    telefono: '',
                    celular: '',
                    email: '',
                    opcion: '',
                    institucion: this.$store.state.institucionselected.id
                },
            }
        },
        mounted() {
            this.validatenomensaje();
            this.validatealert('form_create');
            var opcion = this.$route.params.opcion;
            if (opcion == "actualizar") {
                this.actualizarshow(this.$route.query.id);
            }
        },
        methods: {
            cargaracudientes() {
                this.loading = true;
                axios.get("/acudiente")
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
            guardar() {
                var form = $("#form_create");
                if (form.valid()) {
                    if (this.datos.opcion != "actualizar") {
                        axios.post('/acudiente?' + form.serialize())
                            .then(res => {
                                toastr.info("Se ha registrado el acudiente con exito.", "registro exitoso");
                                this.$router.push({name: 'acudiente.Listar'});
                            })
                            .catch(error => {
                                this.error = error.response.data;
                            })
                            .finally(() => {
                                this.loading = false;
                            })
                    } else {
                        this.actualizar(form);
                    }
                }
            },
            actualizarshow(id) {
                this.loading = true;
                axios.get('/acudiente/' + id + "/edit")
                    .then(res => {
                        this.datos = res.data;
                        this.datos.opcion = "actualizar";
                    })
                    .catch(error => {
                        this.erros = error.response.data;
                        this.loading = false;
                    })
                    .finally(() => {
                        this.loading = false;
                    })
            },
            actualizar(form) {
                this.loading = true;
                axios.put('/acudiente/' + this.datos.id + "?" + form.serialize())
                    .then(res => {
                        toastr.info("El acudiente se ha actualizado con exito", "Datos actualizados");
                        this.$router.push({name: 'acudiente.Listar'});
                    })
                    .catch(error => {
                        this.erros = error.response.data;
                        this.loading = false;
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