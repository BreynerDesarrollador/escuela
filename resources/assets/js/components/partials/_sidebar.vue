<template>
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
            <li class="nav-item nav-profile">
                <div class="nav-link">
                    <div class="user-wrapper">
                        <div class="profile-image">
                            <img :src="'/'+$store.state.datos.user.imagen" alt="profile image">
                        </div>
                        <div class="text-wrapper">
                            <p class="profile-name">{{$store.state.datos.user.name}}</p>
                            <div>
                                <small class="designation text-muted">{{$store.state.datos.user.roles[0].name}}</small>
                                <span class="status-indicator online"></span>
                            </div>
                        </div>
                    </div>
                    <router-link :to="{name:'estudiante.Nuevo',params:{opcion:'Registrar'}}"
                                 class="btn btn-success btn-block text-light">
                        Nueva matricula
                        <i class="menu-icon icon ion-ios-add text-light"></i>
                    </router-link>
                </div>
            </li>
            <li class="nav-item">
                <router-link class="nav-link" :to="{name:'Home'}">
                    <i class="menu-icon icon ion-ios-globe"></i>
                    <span class="menu-title">Menú principal</span>
                </router-link>
            </li>
            <li class="nav-item">
                <router-link :to="{name:'estudiante.Listar',params:{opcion:'Registrar'}}" class="nav-link">
                    <i class="menu-icon icon ion-ios-contact"></i> Estudiantes
                </router-link>
            </li>
            <li class="nav-item">
                <router-link class="nav-link" :to="{name:'acudiente.Listar'}">
                    <i class="menu-icon mdi mdi-account-multiple"></i>
                    <span class="menu-title">Acudientes</span>
                </router-link>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
                    <i class="menu-icon mdi mdi-contacts"></i>
                    <span class="menu-title">Roles y Permisos</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="auth">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <router-link class="nav-link" :to="{name:'role.Listar'}"><i
                                    class="menu-icon mdi mdi-view-list"></i>Gestionar roles
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link class="nav-link" :to="{name:'permiso.Listar'}"><i
                                    class="menu-icon mdi mdi-view-list"></i> Gestionar permisos
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link class="nav-link" :to="{name:'permiso.asignarpermiso'}"><i
                                    class="menu-icon mdi mdi-new-box"></i>Permiso asignar
                            </router-link>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#usuarios" aria-expanded="false" aria-controls="auth">
                    <i class="menu-icon mdi mdi-account-box"></i>
                    <span class="menu-title">Gestionar usuarios</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="usuarios">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <router-link id="usuario.Listar" class="nav-link" :to="{name:'usuario.Listar'}"><i
                                    class="menu-icon mdi mdi-view-list"></i>Usuarios
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link id="usuario.PermisosRoles" class="nav-link"
                                         :to="{name:'usuario.PermisosRoles'}"><i class="menu-icon mdi mdi-security"></i>Permisos
                                y Roles
                            </router-link>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </nav>
</template>