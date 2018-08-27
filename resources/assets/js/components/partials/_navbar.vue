<template>
    <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
            <router-link class="navbar-brand brand-logo" :to="{name:'Home'}">
                <img src="../../images/logo.svg" alt="logo"/>
            </router-link>
            <router-link class="navbar-brand brand-logo-mini" :to="{name:'Home'}">
                <img src="../../images/logo-mini.svg" alt="logo"/>
            </router-link>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-center">
            <ul class="navbar-nav navbar-nav-left header-links d-none d-md-flex">
                <li class="nav-item">
                    <a href="#" class="nav-link">Schedule
                        <span class="badge badge-primary ml-1">New</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="mdi mdi-elevation-rise"></i>Reports</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="mdi mdi-bookmark-plus-outline"></i>Score</a>
                </li>
            </ul>
            <ul class="navbar-nav navbar-nav-right">
                <li class="nav-item dropdown" v-if="$store.state.datosinstitucion.length>0">
                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" id="menuinstitucion"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{$store.state.institucionselected.nombre}}
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a v-for="(da,index) in $store.state.datosinstitucion" class="dropdown-item"
                               @click="seleccionarinstitucion(da.id,index)">{{da.nombre}}</a>

                        </div>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#"
                       data-toggle="dropdown">
                        <i class="mdi mdi-bell"></i>
                        <span class="count">4</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                         aria-labelledby="notificationDropdown">
                        <a class="dropdown-item">
                            <p class="mb-0 font-weight-normal float-left">You have 4 new notifications
                            </p>
                            <span class="badge badge-pill badge-warning float-right">View all</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item preview-item">
                            <div class="preview-thumbnail">
                                <div class="preview-icon bg-success">
                                    <i class="mdi mdi-alert-circle-outline mx-0"></i>
                                </div>
                            </div>
                            <div class="preview-item-content">
                                <h6 class="preview-subject font-weight-medium text-dark">Application Error</h6>
                                <p class="font-weight-light small-text">
                                    Just now
                                </p>
                            </div>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item preview-item">
                            <div class="preview-thumbnail">
                                <div class="preview-icon bg-warning">
                                    <i class="mdi mdi-comment-text-outline mx-0"></i>
                                </div>
                            </div>
                            <div class="preview-item-content">
                                <h6 class="preview-subject font-weight-medium text-dark">Settings</h6>
                                <p class="font-weight-light small-text">
                                    Private message
                                </p>
                            </div>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item preview-item">
                            <div class="preview-thumbnail">
                                <div class="preview-icon bg-info">
                                    <i class="mdi mdi-email-outline mx-0"></i>
                                </div>
                            </div>
                            <div class="preview-item-content">
                                <h6 class="preview-subject font-weight-medium text-dark">New user registration</h6>
                                <p class="font-weight-light small-text">
                                    2 days ago
                                </p>
                            </div>
                        </a>
                    </div>
                </li>
                <li class="nav-item dropdown d-none d-xl-inline-block">
                    <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown"
                       aria-expanded="false">
                        <span class="profile-text">Hola, {{$store.state.datos.user.name}}</span>
                        <img class="img-xs rounded-circle" :src="'/'+$store.state.datos.user.imagen" alt="Profile image">
                    </a>
                    <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                        <a class="dropdown-item p-0">
                            <div class="d-flex border-bottom">
                                <div class="py-3 px-4 d-flex align-items-center justify-content-center">
                                    <i class="mdi mdi-bookmark-plus-outline mr-0 text-gray"></i>
                                </div>
                                <div class="py-3 px-4 d-flex align-items-center justify-content-center border-left border-right">
                                    <i class="mdi mdi-account-outline mr-0 text-gray"></i>
                                </div>
                                <div class="py-3 px-4 d-flex align-items-center justify-content-center">
                                    <i class="mdi mdi-alarm-check mr-0 text-gray"></i>
                                </div>
                            </div>
                        </a>
                        <router-link class="dropdown-item mt-2" :to="{name:'Institucion'}">
                            Institución
                        </router-link>
                        <router-link :to="{name:'usuario.Perfil'}" class="dropdown-item">
                            Mi perfil
                        </router-link>
                        <a class="dropdown-item">
                            Change Password
                        </a>
                        <a class="dropdown-item" href="/logout" onclick="event.preventDefault();store.commit('logout'); document.getElementById('logout-form').submit();">
                            Cerrar sesión
                            <form id="logout-form" action="/logout" method="POST" style="display: none;">
                                <input name="_token" id="_token"
                                       :value="token">
                            </form>
                        </a>
                    </div>
                </li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                    data-toggle="offcanvas">
                <span class="icon-menu mdi mdi-menu"></span>
            </button>
        </div>
    </nav>
</template>

<script>
    export default {
        data: function () {
            return {
                token: $("meta[name='csrf-token']").attr("content")
            }
        },
        mounted() {
            /*var da = localStorage.getItem('institucionseleccionada');
            if (this.global_institucionseleted.length == 0 && da == null) {
                this.global_institucionseleted = this.global_datosinstitucion[0];
                localStorage.setItem('institucionseleccionada', JSON.stringify(this.global_institucionseleted));
            } else {
                this.global_institucionseleted = JSON.parse(localStorage.getItem('institucionseleccionada'));
            }*/
        },
        methods: {
            seleccionarinstitucion(id, index) {
                var res = this.$store.state.institucionselected;
                if (id != res.id) {
                    //this.global_institucionseleted = this.global_datosinstitucion[index];
                    localStorage.setItem('institucionseleccionada', JSON.stringify(this.datosins()[index]));
                    this.$store.commit("seleccionarinstitucion",this.$store.state.datosinstitucion[index]);
                    location.reload();
                }

            }
        }
    }
</script>