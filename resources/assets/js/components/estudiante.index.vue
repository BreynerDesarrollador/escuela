<template>
    <div class="row">
        estas en estudiante
        <div v-if="is('Administrador')">Es administrador</div>
        <div v-else>No es administrador</div>
    </div>
</template>

<script>
    export default {

    }
</script>