<template>
    <div class="">
        <form action="#" role="form" method="post" novalidate id="form_create" enctype="multipart/form-data">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-xl-12">
                    <div class="w-100 d-flex align-items-center">
                        <div class="card col-lg-4 mx-auto animated fadeIn">
                            <div class="card-body">
                                <div class="">
                                    <div class="form-group text-center m-auto">
                                        <img :src="datos.imagen!='' && datos.imagen!=null ? '/'+datos.imagen:''"
                                             class="rounded-circle" width="100" height="100"/>

                                        <div class="custom-file">
                                            <input type="file" style="display: none" class="custom-file-input"
                                                   name="imagen" id="imagen" ref="file" @change="addFile()">
                                            <a href="#" @click.prevent="imagenshow"><i
                                                    class="mdi mdi-camera icono"></i></a>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="nombre">Nombres </label>
                                        <div class="input-group">
                                            <input class="form-control" v-model="datos.nombre" name="nombre" type="text"
                                                   id="nombre" required/>
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="mdi mdi-account-edit"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="apellido">Apellidos </label>
                                        <div class="input-group">
                                            <input class="form-control" v-model="datos.apellido" name="apellido"
                                                   type="text" id="apellido"
                                                   required/>
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="mdi mdi-account-edit"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="celular">Celular </label>
                                        <div class="input-group">
                                            <input class="form-control" name="celular" v-on:keypress="solonumeros"
                                                   type="text" id="celular" v-model="datos.celular"
                                                   required/>
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="mdi mdi-phone"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Correo </label>
                                        <div class="input-group">
                                            <input class="form-control" readonly v-model="datos.email" name="email"
                                                   type="text"
                                                   id="email" required/>
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="mdi mdi-email"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" @click.prevent="guardarperfil"
                                                class="btn btn-block btn-outline-primary text-center"><i
                                                class="mdi mdi-content-save"></i> Guardar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </form>
        <error :mensaje="error" :titulo="'Error al procesar la solicitud'"></error>
    </div>
</template>

<script>
    import toastr from 'toastr'

    export default {
        name: "usuario.perfil",
        data: function () {
            return {
                datos: {
                    nombre: '',
                    apellido: '',
                    celular: '',
                    email: '',
                    imagen: '',
                    institucion: this.$store.state.institucionselected.id
                },
                formData: '',
                files: []
            }
        },
        mounted() {
            this.consultardatos();
        },
        methods: {
            consultardatos() {
                this.loading = true;
                axios.get('/usuario?opcion=datosusuario')
                    .then(res => {
                        this.datos = res.data;
                    })
                    .catch(error => {
                        this.error = error.response.data;
                    })
                    .finally(() => {
                        this.loading = false;
                    });
            },
            imagenshow() {
                $('#imagen').click();
            },
            guardarperfil() {
                var form = $("#form_create");
                axios.put('/usuario/' + this.datos.id + '?' + form.serialize())
                    .then(res => {
                        toastr.success("Los datos se han actualizado con exito", "Actaulización exitosa.");
                    })
                    .catch(error => {
                        this.error = error.response.data;
                    })
                    .finally(() => {
                        this.loading = false;
                    })
            },
            guadarimagen() {
                var form = $("#form_create");
                this.formData = new FormData();
                this.formData.append('imagen', this.files);

                axios.post("/usuario.guardarimagenperfil?", this.formData, {headers: {'Content-Type': 'multipart/form-data'}})
                    .then(res => {
                        toastr.success("La imagen se ha actualizado con exito.", "Imagen actualizada");
                        location.reload();
                    })
                    .catch(error => {
                        this.error = error.response.data;
                    })
                    .finally(() => {

                    })
            },
            addFile() {
                this.files = this.$refs.file.files[0];

                this.guadarimagen();
            },


        }
    }
</script>

<style scoped>

</style>