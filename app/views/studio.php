<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Serviços</title>

    <!-- Custom fonts for this template-->
    <link href="<?=BASE_URL?>app/assets/libs/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?=BASE_URL?>app/assets/css/cadastro-categorias.css" rel="stylesheet">
    <link href="<?=BASE_URL?>app/assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="<?=BASE_URL?>app/assets/css/system.css" rel="stylesheet">
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>

</head>

<body id="page-top">
    <?php $this->loadComponent('header', $component)  ?>

    <div class="container-fluid" id="app">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Configurações do Studio</h1>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-body row">

                        <div class="col-12">
                            <h5 class="text-primary">
                                <i class="fas fa-book mr-2"></i>
                                <span>Agenda</span>
                            </h5>

                            <div class="col-12 mb-4">
                                
                            </div>
                        </div>

                        <div class="col-12">
                            <h5 class="text-primary">
                                <i class="fas fa-calendar mr-2"></i>
                                <span>Dias de atendimento</span>
                            </h5>

                            <div class="col-12 mb-4">

                            </div>
                        </div>

                        <div class="col-12">
                            <h5 class="text-primary">
                                <i class="fas fa-clock mr-2"></i>
                                <span>Horário de atendimento</span>
                            </h5>

                            <div class="col-12 mb-4">

                            </div>
                        </div>

                        <div class="col-12">
                            <h5 class="text-primary">
                                <i class="fas fa-map-marker-alt mr-2"></i>
                                <span>Endereço</span>
                            </h5>

                            <div class="col-12 mb-4">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php $this->loadComponent('footer', $component)  ?>

    <!-- Bootstrap core JavaScript-->
    <script src="<?=BASE_URL?>app/assets/libs/jquery/jquery.min.js"></script>
    <script src="<?=BASE_URL?>app/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?=BASE_URL?>app/assets/libs/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?=BASE_URL?>app/assets/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="<?=BASE_URL?>app/assets/libs/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="<?=BASE_URL?>app/assets/js/demo/chart-area-demo.js"></script>
    <script src="<?=BASE_URL?>app/assets/js/demo/chart-pie-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <input type="hidden" id="burl" value="<?=BASE_URL?>">


    <script>
        const { createApp } = Vue

        const app = {
            data() {
                return {
                    msg: null
                }
            },
            mounted() {
            },

            methods: {
            }
        }

        createApp(app).mount('#app')
    </script>
</body>

</html>