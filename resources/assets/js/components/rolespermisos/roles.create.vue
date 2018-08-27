<template>
    <div class="container-fluid">
        <ring-loader class="preloader-background" :loading="loading" :color="'#00bcd4'"></ring-loader>
        <div class="row">
            <form action="#" method="post" role="form" id="create_role">
                <div class="card">
                    <div class="card-header">
                        <h5 class="text-center">Roles</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">

                            <div class="form-group col-sm-12 col-md-6 col-xl-6">
                                <label for="name">Nombre: <span class="text-danger">*</span></label>
                                <input name="name" id="name" class="form-control" type="text" required/>
                            </div>
                            <div class="form-group col-sm-12 col-md-6 col-xl-6">
                                <label for="slug">Nombre a mostrar: </label>
                                <input name="slug" id="slug" class="form-control" type="text"/>
                            </div>
                            <div class="form-group col-sm-12 col-md-6 col-xl-6">
                                <label for="name">Descripción: </label>
                                <input name="description" id="description" class="form-control" type="text"/>
                            </div>

                        </div>
                    </div>
                    <div class="card-header text-center">
                        <button type="submit" @click.prevent="guardar" class="btn btn-outline-primary text-center">Guardar</button>
                    </div>
                </div>
            </form>
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
        data: function () {
            return {

            }
        },
        methods: {
            guardar() {
                var form = $("#create_role");
                if (form.valid()) {
                    this.loading=true;
                    axios.post('/role?' + form.serialize())
                        .then(res => {
                            toastr.info("Se ha registrado el rol con exito.", 'Registro exitoso');
                            this.$router.push({name:'role.Listar'});
                        })
                        .catch(error => {
                            this.error = error.response.data;
                        })
                        .finally(() => {
                            this.loading=false;
                        });
                } else {
                    toastr.info("Rellene todos los campos.", 'Campos vacios');
                }

            }
        }
    }
</script>