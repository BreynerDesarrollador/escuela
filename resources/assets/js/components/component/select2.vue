<template>
    <select class="form-control" :name="name" :id="id">
        <slot></slot>
    </select>
</template>

<script>
    import $ from 'jquery'
    import 'select2'

    var vm, buscar1;
    export default {
        props: ['options', 'value', 'buscar', 'name', 'id'],
        data: function () {
            return {
                opciones: {}
            }
        },
        mounted() {
            vm = this;
            var clase = $(this.$el).hasClass('buscarno');
            $(this.$el)
            // init select2
                .select2({
                    data: vm.options,
                    width: '100%',
                    minimumResultsForSearch: clase ? -1 : 1,
                    placeholder: "...seleccione...",
                    theme:'bootstrap4'
                })
                .val(this.value)
                .trigger('change')
                // emit event on change.
                .on('change', function () {
                    //vm.$emit('input', this.value)
                })
        },
        watch: {
            value: function (value) {
                // update value
                $(this.$el)
                    .val(value)
                    .trigger('change')
            },
            options: function (options) {
                // update options
                var clase = $(this.$el).hasClass('buscarno');
                $(this.$el).empty().select2({
                    data: options,
                    width: '100%',
                    minimumResultsForSearch: clase ? -1 : 1,
                    placeholder: "...seleccione...",
                    theme:'bootstrap4'
                }).val(this.value)
                    .trigger('change');
            }
        },
        destroyed: function () {
            $(this.$el).off().select2('destroy')
        }
    }
</script>