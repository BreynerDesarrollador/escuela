//inicializamos el estado de los todos
export const state = {
    datos: [],
    datosinstitucion: [],
    institucionselected: [],
    return: '',
}

export const mutations = {

    agregardatos(state, datos) {
        state.datos = JSON.parse(datos);
    },
    agregardatosinstitucion(state, datos) {
        state.datosinstitucion = JSON.parse(datos);
    },
    seleccionarinstitucion(state, datos) {
        state.institucionselected = JSON.parse(localStorage.getItem('institucionseleccionada'));
    },
    Isinstitucion() {
        var json = JSON.parse(localStorage.getItem('institucionseleccionada'));
        var i = json.id != undefined ? json : 0;
        state.return = i;
    },
    //cambiar el estado de un todo
    toggleTodo(state, {todo}) {
        todo.done = !todo.done
    },

    pruebamutacion() {
        alert('Esta es una mutacion');
    },
    //Cierra sesion
    logout() {
        localStorage.clear();
    }
}