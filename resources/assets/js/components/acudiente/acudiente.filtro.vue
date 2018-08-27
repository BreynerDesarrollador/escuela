<template>
    <div v-on:read="abrirpopat">
        <button type="button" style="display: none" id="boton_acudiente_filtro" data-toggle="modal"
                data-target="#modal_acudiente_filtro">
            Launch modal
        </button>
        <!-- Modal -->
        <div class="modal fade" id="modal_acudiente_filtro" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <h5 class="modal-title text-center">Listado de acudientes</h5>
                        <button type="button" class="close float-right" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center">
                        <div class="table-responsive">
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
                                        <div class="form-group custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" :id="'acudiente'+da.id"
                                                   name="acudiente" required data-toggle="tooltip"
                                                   :value="da.id+'$'+da.nombre+' '+da.apellido"
                                                   :title="'Seleccionar '+da.nombre+' '+da.apellido"
                                                   v-model="acudiente_id">
                                            <label class="custom-control-label" :for="'acudiente'+da.id"></label>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer text-center">
                        <button type="button" @click.prevent="agregaracudiente"
                                class="btn btn-outline-primary text-center"><i
                                class="mdi mdi-content-save"></i> Guardar
                        </button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            <i class="mdi mdi-close"></i> Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    var vm;
    export default {
        name: "acudiente.filtro",
        props: ["id"],
        data: function () {
            return {
                datos: [],
                acudiente_id: ''
            }
        },
        mounted() {
            vm = this;
            /*if (this.id != "" && this.id != undefined) {
                this.cargaracudientes();
                $('#boton_acudiente_filtro').click();
            }*/
            $('#modal_acudiente_filtro').on('show.bs.modal', function (e) {
                vm.cargaracudientes();
            });
        },
        watch: {
            /*id: function (id) {
                this.cargaracudientes();
                $('#boton_acudiente_filtro').click();
            }*/
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
            abrirpopat() {
                $('#boton_acudiente_filtro').click();
            },
            agregaracudiente() {
                this.$emit("generar", this.acudiente_id);
            }
        },
        updated() {
            $('[data-toggle="tooltip"]').tooltip();
        }
    }
</script>

<style scoped>

</style>