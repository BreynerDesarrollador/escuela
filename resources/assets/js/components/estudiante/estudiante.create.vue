<template>
    <div class="container-fluid">
        <ring-loader class="preloader-background" :loading="loading" :color="'#00bcd4'"></ring-loader>
        <div class="row">
            <form id="form_guardarestudiante" method="post" action="/" role="form" novalidate
                  enctype="multipart/form-data">
                <input type="hidden" name="institucion" id="institucion" v-model="datos.institucion"/>
                <div class="card card-outline-primary animated fadeIn">
                    <h5 class="card-header text-center">Generar matricula</h5>
                    <div class="card-body bg-gray-dark">
                        <div class="row">
                            <div class="col-sm-12 col-mb-12 col-xs-12">
                                <div class="border-1 w-100 d-flex align-content-center text-center m-0">
                                    <div class="mx-auto">
                                        <img :src="'/'+datos.imagen" id="imagenavatar" name="imagenavatar"
                                          style="max-width: 151px;max-height: 189px"   width="151" height="189" class="rounded img-thumbnail">
                                        <input type="file" name="imagen" id="imagen" style="display: none;" ref="file"
                                               accept="image/gif, image/jpeg, image/png" @change="obtenerimagen"><br>
                                        <a href="#" @click.prevent="seleccionarimagen">
                                            <span class="mdi mdi-camera icono"></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12 col-xl-12 pt-3 text-center">
                                <label>Matricula temporal ? <i class="text-danger">*</i></label>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" id="estadosi" name="estado"
                                           value="3" v-model="datos.estado" required>
                                    <label class="custom-control-label" for="estadosi">SI</label>
                                </div>

                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" checked="checked" class="custom-control-input" id="estadono"
                                           name="estado" v-model="datos.estado"
                                           value="0" required>
                                    <label class="custom-control-label" for="estadono">NO</label>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header text-center">
                                    <strong class="font-italic">Datos personales</strong>
                                </div>
                                <div class="card-body row">
                                    <div class="col-sm-12 col-md-6 col-xl-6">
                                        <label for="nombre">Primer nombre <i class="text-danger">*</i></label>
                                        <input maxlength="20" type="text" v-model="datos.nombre" name="nombre"
                                               id="nombre" required
                                               class="form-control"/>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-xl-6">
                                        <label for="segundo_nombre">Segundo nombre</label>
                                        <input maxlength="20" type="text" v-model="datos.segundo_nombre"
                                               name="segundo_nombre" id="segundo_nombre"
                                               class="form-control"/>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-xl-6">
                                        <label for="apellido">Primer apellido<i class="text-danger">*</i></label>
                                        <input maxlength="20" type="text" v-model="datos.apellido" name="apellido"
                                               id="apellido" required
                                               class="form-control"/>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-xl-6">
                                        <label for="segundo_apellido">Segundo apellido<i
                                                class="text-danger">*</i></label>
                                        <input maxlength="20" type="text" v-model="datos.segundo_apellido"
                                               name="segundo_apellido" id="segundo_apellido"
                                               required
                                               class="form-control"/>
                                    </div>
                                    <div class="col-sm-12 col-md-3 col-xl-3">
                                        <label for="fecha_nac">Fecha nacimiento <i class="text-danger">*</i></label>
                                        <div class='input-group mb-3'>
                                            <!-- <input type="text" name="fecha_nac" id="fecha_nac" required
                                                    class="form-control combofecha" v-model="datos.fecha_nac"/> -->
                                            <date-picker :class="'form-control combofecha'" name="fecha_nac"
                                                         id="fecha_nac" required v-model="datos.fecha_nac"
                                                         :config="optiondate" @dp-change="calcularfecha"></date-picker>
                                            <div class="input-group-append">
                                                <i class="input-group-text icon ion-ios-calendar"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-3 col-xl-3">
                                        <label for="edad">Edad <i class="text-danger">*</i></label>
                                        <input maxlength="10" readonly type="text" v-model="datos.edad" name="edad"
                                               id="edad" required v-on:keypress="solonumeros"
                                               class="form-control"/>
                                    </div>
                                    <div class="col-sm-12 col-md-4 col-xl-4 pt-3">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" class="custom-control-input" v-model="datos.genero"
                                                   id="genero1" name="genero"
                                                   value="M">
                                            <label class="custom-control-label" for="genero1">Masculino</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" v-model="datos.genero" class="custom-control-input"
                                                   id="genero2" name="genero"
                                                   value="F">
                                            <label class="custom-control-label" for="genero2">Femenino</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-2 col-xl-2">
                                        <label for="estrato">Estrato <i class="text-danger">*</i></label>
                                        <input maxlength="2" v-model="datos.estrato" v-on:keypress="solonumeros"
                                               type="text" name="estrato"
                                               id="estrato" required
                                               class="form-control"/>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header text-center">
                                    <strong class="font-italic">
                                        Documento de identificación y datos de nacimiento
                                    </strong>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-3 col-xl-3">
                                            <label for="tipo_documento1">Tipo documento identidad <i
                                                    class="text-danger">*</i></label>
                                            <select2 :options="opciontipodoc" v-model="datos.tipo_documento"
                                                     :buscar="false"
                                                     :id="'tipo_documento'" :name="'tipo_documento'" class="buscarno">
                                                <option disabled value="0">...Seleccione tipo documento...</option>
                                            </select2>
                                            <!-- <input type="hidden" v-model="datos.tipo_documento" name="tipo_documento"> -->
                                        </div>
                                        <div class="col-sm-12 col-md-3 col-xl-3">
                                            <label for="documento"># documento identidad <i
                                                    class="text-danger">*</i></label>
                                            <input maxlength="20" type="text" v-model="datos.documento" name="documento"
                                                   id="documento" required v-on:keypress="solonumeros"
                                                   class="form-control"/>
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-xl-3">
                                            <label for="lugar_expedicion">Lugar de expedición <i
                                                    class="text-danger">*</i></label>
                                            <input maxlength="40" type="text" v-model="datos.lugar_expedicion"
                                                   name="lugar_expedicion"
                                                   id="lugar_expedicion" required
                                                   class="form-control"/>
                                        </div>

                                        <div class="col-sm-12 col-md-6 col-xl-3">
                                            <label for="fecha_expedicion">Fecha de expedición <i
                                                    class="text-danger">*</i></label>
                                            <div class='input-group mb-3'>
                                                <!-- <input maxlength="20" type="text" v-model="datos.fecha_expedicion" name="fecha_expedicion"
                                                       id="fecha_expedicion" required
                                                       class="form-control combofecha"/> -->
                                                <date-picker :class="'form-control combofecha'" name="fecha_expedicion"
                                                             id="fecha_expedicion" required
                                                             v-model="datos.fecha_expedicion"
                                                             :config="optiondate"></date-picker>
                                                <div class="input-group-append">
                                                    <i class="input-group-text icon ion-ios-calendar"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-xl-6">
                                            <label for="departamento">Departamento <i class="text-danger">*</i></label>
                                            <select2 :options="opciontidepa" v-model="datos.departamento" :buscar="true"
                                                     :id="'departamento'" :name="'departamento'">
                                                <option disabled value="0">...Seleccione el departamento...</option>
                                            </select2>
                                            <!-- <input type="hidden" v-model="datos.departamento" name="departamento"> -->
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-xl-6">
                                            <label for="municipio">Municipio <i class="text-danger">*</i></label>
                                            <select2 :options="opcionciudad" v-model="datos.municipio"
                                                     :id="'municipio'" :name="'municipio'">
                                                <option disabled value="0">...Seleccione la ciudad...</option>
                                            </select2>
                                            <!-- <input type="hidden" v-model="datos.municipio" name="ciudad"> -->
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-xl-6">
                                            <label for="direccion">Dirección <i class="text-danger">*</i></label>
                                            <input maxlength="200" v-model="datos.direccion" type="text"
                                                   name="direccion" id="direccion" required
                                                   class="form-control"/>
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-xl-6">
                                            <label for="barrio">Barrio <i class="text-danger">*</i></label>
                                            <input maxlength="100" type="text" v-model="datos.barrio" name="barrio"
                                                   id="barrio" required
                                                   class="form-control"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header text-center">
                                    <strong class="font-italic">Datos de contacto</strong>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6 col-xl-6">
                                            <label for="email">Email <i class="text-danger">*</i></label>
                                            <input type="email" v-model="datos.email" name="email" id="email" required
                                                   class="form-control"/>
                                        </div>
                                        <div class="col-sm-12 col-md-3 col-xl-3">
                                            <label for="telefono">Teléfono <i class="text-danger">*</i></label>
                                            <input type="text" name="telefono" v-model="datos.telefono" id="telefono"
                                                   required v-on:keypress="solonumeros"
                                                   class="form-control phone"/>
                                        </div>
                                        <div class="col-sm-12 col-md-3 col-xl-3">
                                            <label for="celular">Celular <i class="text-danger">*</i></label>
                                            <input type="text" name="celular" v-model="datos.celular" id="celular"
                                                   required v-on:keypress="solonumeros"
                                                   class="form-control celular"/>
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-xl-6">
                                            <label for="padre">Nombre completo padre <i
                                                    class="text-danger">*</i></label>
                                            <input maxlength="50" type="text" v-model="datos.padre" name="padre"
                                                   id="padre" required
                                                   class="form-control"/>
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-xl-6">
                                            <label for="madre">Nombre completo madre <i
                                                    class="text-danger">*</i></label>
                                            <input maxlength="50" type="text" v-model="datos.madre" name="madre"
                                                   id="madre" required
                                                   class="form-control"/>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header text-center">
                                    <strong class="font-italic">Otros datos</strong>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6 col-xl-6 pt-3">
                                            <label>Regimen <i class="text-danger">*</i></label>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" v-model="datos.eps_tipo"
                                                       class="custom-control-input" id="eps_tipo"
                                                       name="eps_tipo" required
                                                       value="0">
                                                <label class="custom-control-label" for="eps_tipo">Subsidiado</label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" class="custom-control-input" id="eps_tipo1"
                                                       name="eps_tipo" required v-model="datos.eps_tipo"
                                                       value="1">
                                                <label class="custom-control-label" for="eps_tipo1">Contributivo</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-xl-6">
                                            <label for="eps">Nombre de la EPS <i class="text-danger">*</i></label>
                                            <input maxlength="50" type="text" v-model="datos.eps" name="eps" id="eps"
                                                   required
                                                   class="form-control"/>
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-xl-6 pt-3">
                                            <label>Sisben <i class="text-danger">*</i></label>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" class="custom-control-input" id="sisben"
                                                       name="sisben" required v-model="datos.sisben"
                                                       value="0">
                                                <label class="custom-control-label" for="sisben">SI</label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" class="custom-control-input" id="sisben1"
                                                       name="sisben" required v-model="datos.sisben"
                                                       value="1">
                                                <label class="custom-control-label" for="sisben1">NO</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-xl-6">
                                            <label for="calificacion">Puntaje <i class="text-danger">*</i></label>
                                            <input maxlength="10" type="text" name="calificacion" id="calificacion"
                                                   required v-model="datos.calificacion"
                                                   v-on:keypress="solonumerospunto"
                                                   class="form-control"/>
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-xl-6 pt-3">
                                            <label>Repitente <i class="text-danger">*</i></label>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" class="custom-control-input" id="repitente"
                                                       name="repitente" required v-model="datos.repitente"
                                                       value="0">
                                                <label class="custom-control-label" for="repitente">SI</label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" class="custom-control-input" id="repitente1"
                                                       name="repitente" required v-model="datos.repitente"
                                                       value="1">
                                                <label class="custom-control-label" for="repitente1">NO</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <div class="divflotante">
                            <button type="submit" class="btn btn-icons btn-rounded btn-outline-primary" @click.prevent="guardarestudiante">
                                <i class="icon ion-ios-save"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <error :mensaje="error" :titulo="'Error al procesar la solicitud'"></error>
    </div>

</template>

<script>

    import $ from 'jquery'
    import 'select2'
    import 'jquery-validation'
    import 'bootstrap4-datetimepicker'
    import 'jquery-mask-plugin'
    import toastr from 'toastr';
    import axios from 'axios'
    import resizeImage from 'resize-image'
    //var Jimp = require('jimp');

    var vm;
    export default {
        data: function () {
            return {
                loading: false,
                optiondate: {
                    format: 'YYYY-MM-DD',
                    useCurrent: false,
                    locale: 'es'
                },
                tipo_documento: 2,
                departamento: 0,
                municipio: 0,
                opciontipodoc: [],
                opciontidepa: [],
                opcionciudad: [],
                datos: {
                    estado: 0,
                    nombre: '',
                    segundo_nombre: '',
                    apellido: '',
                    segundo_apellido: '',
                    fecha_nac: '',
                    edad: 0,
                    genero: '',
                    estrato: '',
                    tipo_documento: 2,
                    documento: '',
                    lugar_expedicion: '',
                    fecha_expedicion: '',
                    departamento: 0,
                    municipio: 0,
                    direccion: '',
                    barrio: '',
                    email: '',
                    telefono: '',
                    celular: '',
                    padre: '',
                    madre: '',
                    eps_tipo: '',
                    eps: '',
                    sisben: '',
                    calificacion: '',
                    repitente: '',
                    institucion: this.$store.state.institucionselected.id,
                    imagen: 'images/avatar100.png',
                    operacion: 'nuevo',
                },
                formData: '',
                imagen: []
            }
        },
        mounted() {
            vm = this;
            this.cargarcombos();
            this.eventos();
            this.combosfunciones();
            var id = this.$route.query.id, ins = this.datosinsselect().id;
            if (id != '' && id != undefined) {
                this.estudianteeditarshow(id, ins);
            }
        },
        methods: {
            guardarestudiante() {
                var form = $('#form_guardarestudiante');
                var datos = form.serialize();
                if (form.valid()) {
                    this.loading = true;
                    //agregamos la imagen
                    this.formData = new FormData();
                    this.formData.append('imagen', this.imagen);

                    if (this.datos.operacion == "nuevo") {
                        axios.post('/estudiante?' + datos, this.formData, {headers: {'Content-Type': 'multipart/form-data'}})
                            .then(res => {
                                toastr.info('La matricula se ha registrado con exito.', 'Registro exitoso');
                                location.reload();
                            })
                            .catch(error => {
                                this.error = error.response.data;
                            })
                            .finally(() => {
                                this.loading = false;
                            });
                    } else {
                        this.actualizarestudiante(this.datos.id, datos);
                    }

                } else {
                    toastr.info('Debe rellenar todos los campos marcados en rojo.', 'Datos incompletos');
                }

            },
            actualizarestudiante(id, form) {
                axios.post('/estudiante.actualizarestudiante/' + id + '?' + form, this.formData, {headers: {'Content-Type': 'multipart/form-data'}})
                    .then(respo => {
                        if (respo) {
                            toastr.info("Los datos del estudiante se han actualizado con exito.", 'Actualización exitosa');
                        }
                    })
                    .catch(error => {
                        this.error = error.response.data;
                    })
                    .finally(() => {
                        this.loading = false;
                    })
            },
            cargarcombos() {
                this.loading = true;
                axios.all([vm.cargarcombotipodoc(), vm.cargarcombodepa()])
                    .then(axios.spread(function (datos, datos1) {
                        vm.opciontipodoc = datos.data.datos;
                        vm.opciontidepa = datos1.data.datos;
                    }))
                    .catch(error => {
                        this.error = error.response.data;
                    })
                    .finally(() => {
                        this.loading = false;
                    });
            },
            cargarcombotipodoc() {
                return axios.get('/combos?opcion=combotipo_doc');
            },
            cargarcombodepa() {
                return axios.get('/combos?opcion=combodepartamento');
            },
            cargarcombomuni(buscar) {
                axios.get('/combos?opcion=combomunicipio&buscar=' + buscar)
                    .then(res => {
                        this.opcionciudad = res.data.datos;
                    })
                    .catch(error => {
                        this.error = error.response.data;
                    });
            },
            eventos() {
                $("#departamento").on('change', function () {
                    var valor = $(this).select2('data')[0];
                    vm.cargarcombomuni(valor != undefined ? valor.text : '');
                });

                this.validatenomensaje();
                this.validatealert('form_guardarestudiante');

                $('.combofecha').mask('0000-00-00');
                $('.phone').mask('0000-0000');
                $('.celular').mask('(000) 000-0000');
            },
            calcularfecha(fecha) {
                var anoactual = new Date();
                var anofecha = new Date(fecha.date);

                var ano = anoactual.getFullYear() - anofecha.getFullYear();

                this.datos.edad = ano;
            },
            estudianteeditarshow(id, ins) {
                axios.get('/estudiante/' + id + '/edit?institucion=' + ins)
                    .then(res => {
                        if (res.data.length > 0) {
                            this.datos = res.data[0];
                            this.datos.operacion = "editar";
                            this.municipio = res.data.municipio;
                        } else {
                            toastr.warning("El estudiante no se encuentra asociado a la institución seleccionada.", 'Estudiante no existe');
                        }
                    })
                    .catch(error => {
                        this.error = error.response.data;
                    });
            },
            seleccionarimagen() {
                $("#imagen").click();
            },
            obtenerimagen() {
                var imagenes = this.$refs.file.files;
                if (imagenes && imagenes[0]) {
                    vm.imagen=imagenes[0];
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $("#imagenavatar").attr("src", e.target.result);
                        $("#imagenavatar").attr("title", escape(e.name));
                    };
                    reader.readAsDataURL(imagenes[0]);
                }
            },
            resizeimg(src, an, largo) {
                var img = new Image();
                img.src = src;
                img.onload = function () {
                    var data = resizeImage.resize(img, 151, 189, resizeImage.JPEG);
                    //console.log(data);
                    vm.imagen = data;
                };
                //img.src = url; // local image url
            }
        },
        updated() {
            /* $("#municipio")
                .val(this.municipio)
                .trigger('change'); */
        }

    }
</script>