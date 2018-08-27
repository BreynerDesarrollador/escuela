import axios from 'axios';
import toastr from 'toastr'
import $ from 'jquery'
import 'jquery-validation'

const mixin = {
    mounted() {
        /*if (location.href != "/login" && location.href != '/')
            this.consultarrp();
        if (this.datosinstitucion.length == 0) {
            this.consultarinstitucion();
        }*/
        //this.global_datosinstitucion = datosinstitucion;
        //this.global_escuela = datosescuela;

    },
    data() {
        return {
            global_escuela: [],
            loading: false,
            error: [],
            global_datosinstitucion: [],
            global_institucionseleted: []
        }
    },
    methods: {
        consultarinstitucion() {
            axios.get('/institucion?opcion=datosinstitucion')
                .then(res => {
                    this.datosinstitucion = res.data;
                    this.institucionseleted = this.datosinstitucion[0];
                })
                .catch(error => {
                    toastr.danger(error.response.data, 'Error al cargar datos de la institución.');
                })
        },
        is(role) {
            return this.array_has(this.escuela.r, role);
        },
        can(permiso) {
            return this.array_has(this.escuela.p, permiso);
        },
        array_has(arr, obj) {
            return (arr.findIndex(x => x === obj) != -1);
        },
        datosins() {
            return JSON.parse(datosinstitucion);
        },
        consultarrp() {
            return JSON.parse(Base64.decode(datosescuela));
        },
        datosinsselect() {
            var da = localStorage.getItem('institucionseleccionada');
            if (da == null || da == "" || da == "undefined" || da == undefined) {
                var d = this.datosins();
                localStorage.setItem('institucionseleccionada', JSON.stringify(d[0]));
                da = localStorage.getItem('institucionseleccionada');
            }

            return JSON.parse(da);
        },
        combosfunciones() {
            $('.combofecha').datetimepicker({
                format: 'YYYY-MM-DD',
                locale: 'es',
                icons: {
                    time: 'icon ion-ios-time',
                    date: 'icon ion-ios-calendar',
                    up: 'icon ion-ios-arrow-up',
                    down: 'icon ion-ios-arrow-down',
                    previous: 'icon ion-ios-arrow-back',
                    next: 'icon ion-ios-arrow-forward',
                    today: 'icon ion-ios-today',
                    clear: 'icon ion-ios-close-circle-outline',
                    close: 'icon ion-ios-close'
                }
            });
        },
        solonumeros(evt) {
            var nav4 = window.Event ? true : false;
            // NOTE: Backspace = 8, Enter = 13, '0' = 48, '9' = 57
            var key = nav4 ? evt.which : evt.keyCode;
            var res = (key <= 13 || (key >= 48 && key <= 57));
            if (!res) {
                evt.preventDefault();
            }
        },
        solonumerospunto(evt) {
            var nav4 = window.Event ? true : false;
            // NOTE: Backspace = 8, Enter = 13, '0' = 48, '9' = 57
            var key = nav4 ? evt.which : evt.keyCode;
            var res = (key <= 13 || (key >= 48 && key <= 57) || key == 46);
            if (!res) {
                evt.preventDefault();
            }
        },
        validatenomensaje() {
            $.validator.messages.required = '';
        },
        validatealert(form) {
            $("#" + form).validate({
                highlight: function (element, errorClass, validClass) {
                    $(element)
                        .parent()
                        .parent()
                        .addClass("error-item")
                        .removeClass("valid-item");
                },

                unhighlight: function (element, errorClass, validClass) {
                    $(element)
                        .parent()
                        .parent()
                        .addClass("valid-item")
                        .removeClass("error-item");
                }
            });
        }
    }
};

export default mixin;