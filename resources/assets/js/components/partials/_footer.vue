<template>
    <footer class="footer">
        <div class="container-fluid clearfix">
            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © {{date}}
              <a href="http://www.bootstrapdash.com/" target="_blank">Bootstrapdash</a>. All rights reserved.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with
              <i class="mdi mdi-heart text-danger"></i>
            </span>
        </div>
    </footer>
</template>

<script>
    export default{
        methods: {
            date() {
                var ano=new Date();
                return new ano.getFullYear();
            }
        }
    }
</script>
