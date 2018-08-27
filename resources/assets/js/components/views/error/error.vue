<template>
    <div>
        <button type="button" style="display: none" id="boton_error" data-toggle="modal" data-target="#modal_error">
            Launch modal
        </button>
        <!-- Modal -->
        <div class="modal fade" id="modal_error" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <h5 class="modal-title text-center" id="exampleModalCenterTitle">{{titulo}}</h5>
                        <button type="button" class="close float-right" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center">
                        <div class="col-sm-12 col-md-12 col-xl-12">
                            <i class="icon ion-ios-close-circle-outline text-danger" style="font-size: 90px"></i>
                        </div>
                        <div class="container-fluid">
                            <div>
                                <h4>{{mensaje.message}}</h4>
                                <ul class="list-group">
                                    <li class="list-group-item" v-for="da1 in mensaje.errors">
                                        <i class="menu-icon icon ion-ios-close-circle-outline text-danger"></i>{{da1[0]}}

                                    </li>
                                </ul>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        props: ['titulo', 'mensaje'],
        updated() {
            $('#boton_error').click();
        }
    }
</script>