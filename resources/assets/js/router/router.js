const Home = {template: '<div class="container-fluid"><router-view></router-view></div>'};
const dashboard = {template: '<div><h1>Estas en dashboard</h1></div>'};
const Nuevo = require('../components/estudiante/estudiante.create');
const Listar = require('../components/estudiante/estudiante');
const Estudiante = {template: '<div>Estas en estudiante</div>'};
const rolesnew=require('../components/rolespermisos/roles.create');
const roleslist=require('../components/rolespermisos/roles.index');
const permisonew=require('../components/rolespermisos/permiso.create');
const permisolist=require('../components/rolespermisos/permiso.index');
const permisoasignar=require('../components/rolespermisos/permiso.asignarole');
const usuario=require('../components/usuario/usuario');
const usuarioregistrar=require('../components/usuario/usuario.registrar');
const usuarioperfil=require('../components/usuario/usuario.perfil');
const institucion=require('../components/institucion/institucion');
const institucionnueva=require('../components/institucion/institucion.create');
const usuariopermisosroles=require('../components/usuario/usuario.permisorole');
const acudientelistar=require('../components/acudiente/acudiente');
const acudientenuevo=require('../components/acudiente/acudiente.nuevo');

import route from 'vue-router';

const router = [
    {
        path: '/',
        name: 'Home',
        redirect: '/dashboard',
        component: Home,
        meta: {
            breadcrumb: 'Home'
        },
        children: [
            {
                path: '/dashboard',
                name: 'Dashboard',
                component: dashboard,
                meta: {
                    breadcrumb: 'Dashboard'
                },
            },
            {
                path: 'estudiante',
                name: 'Estudiante',
                redirect: '/estudiante/listar',
                component: {
                    render(c) {
                        return c('router-view')
                    }
                },
                meta: {
                    breadcrumb: 'Estudiante'
                },
                children: [
                    {
                        path: '/estudiante/listar',
                        name: 'estudiante.Listar',
                        component: Listar,
                        meta: {
                            breadcrumb: 'Listar'
                        },
                    },
                    {
                        path: '/estudiante/gestionar/:opcion',
                        name: 'estudiante.Nuevo',
                        component: Nuevo,
                        meta: {
                            breadcrumb: routeParams => `${routeParams.opcion}`
                        },
                    }
                ]
            },
            {
                path: 'role',
                name: 'Role',
                redirect: '/role/listar',
                component: {
                    render(c) {
                        return c('router-view')
                    }
                },
                meta: {
                    breadcrumb: 'Roles'
                },
                children: [
                    {
                        path: 'listar',
                        name: 'role.Listar',
                        component: roleslist,
                        meta: {
                            breadcrumb: 'Listar'
                        },
                    },
                    {
                        path: 'nuevo',
                        name: 'role.Nuevo',
                        component: rolesnew,
                        meta: {
                            breadcrumb: 'New'
                        },
                    }
                ]
            },
            {
                path: 'permiso',
                name: 'Permiso',
                redirect: '/permiso/listar',
                component: {
                    render(c) {
                        return c('router-view')
                    }
                },
                meta: {
                    breadcrumb: 'Permisos'
                },
                children: [
                    {
                        path: 'listar',
                        name: 'permiso.Listar',
                        component: permisolist,
                        meta: {
                            breadcrumb: 'Listar'
                        },
                    },
                    {
                        path: 'nuevo',
                        name: 'permiso.Nuevo',
                        component: permisonew,
                        meta: {
                            breadcrumb: 'New'
                        },
                    },
                    {
                        path: 'asignarpermiso',
                        name: 'permiso.asignarpermiso',
                        component: permisoasignar,
                        meta: {
                            breadcrumb: 'Asignar permiso'
                        },
                    }
                ]
            },
            {
                path: 'usuario',
                name: 'Usuario',
                redirect: '/usuario/listar',
                component: {
                    render(c) {
                        return c('router-view')
                    }
                },
                meta: {
                    breadcrumb: 'Usuarios'
                },
                children: [
                    {
                        path: '/usuario/listar',
                        name: 'usuario.Listar',
                        component: usuario,
                        meta: {
                            breadcrumb: 'Listar'
                        },
                    },
                    {
                        path: '/usuario/gestionar/:opcion',
                        name: 'usuario.Nuevo',
                        component: usuarioregistrar,
                        meta: {
                            breadcrumb: routeParams => `${routeParams.opcion}`
                        },
                    },
                    {
                        path: '/usuario/permisosroles',
                        name: 'usuario.PermisosRoles',
                        component: usuariopermisosroles,
                        meta: {
                            breadcrumb: 'Permisos y Roles'
                        },
                    },
                    {
                        path: '/usuario/perfil',
                        name: 'usuario.Perfil',
                        component: usuarioperfil,
                        meta: {
                            breadcrumb: 'Mi perfil'
                        },
                    },
                ]
            },
            {
                path: 'institucion',
                name: 'Institucion',
                redirect: '/institucion/listar',
                component: {
                    render(c) {
                        return c('router-view')
                    }
                },
                meta: {
                    breadcrumb: 'Institución'
                },
                children: [
                    {
                        path: 'listar',
                        name: 'institucion.Listar',
                        component: institucion,
                        meta: {
                            breadcrumb: 'Listar'
                        },
                    },
                    {
                        path: '/institucion/gestionar/:opcion',
                        name: 'institucion.Nuevo',
                        component: institucionnueva,
                        meta: {
                            breadcrumb: routeParams => `${routeParams.opcion}`
                        },
                    },
                ]
            },
            {
                path: 'acudiente',
                name: 'Acudiente',
                redirect: '/acudiente/listar',
                component: {
                    render(c) {
                        return c('router-view')
                    }
                },
                meta: {
                    breadcrumb: 'Acudientes'
                },
                children: [
                    {
                        path: 'listar',
                        name: 'acudiente.Listar',
                        component: acudientelistar,
                        meta: {
                            breadcrumb: 'Listar'
                        },
                    },
                    {
                        path: '/acudiente/gestionar/:opcion',
                        name: 'acudiente.Nuevo',
                        component: acudientenuevo,
                        meta: {
                            breadcrumb: routeParams => `${routeParams.opcion}`
                        },
                    },
                ]
            },
        ]
    }
];

export default router;