<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="<?=BASE_URL?>app/assets/libs/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?=BASE_URL?>app/assets/css/sb-admin-2.min.css" rel="stylesheet">
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>

</head>

<body id="page-top">
    <?php $this->loadComponent('header')  ?>
    <div class="container-fluid" id="app">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Cadastro de funcionário</h1>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Cadastro</h6>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nome completo</label>
                                <input v-model="Admin.nome" type="name" class="form-control" id="nome" placeholder="Ex: Maria dos Santos Ferreira">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input v-model="Admin.email" type="email" class="form-control" id="email" placeholder="Ex: maria@hotmail.com">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Senha temporária</label>
                                <input v-model="Admin.senha" type="password" class="form-control" id="senha" placeholder="Informe uma senha temporária">
                                <small id="senhaHelp" class="form-text text-muted">Defina uma senha temporária</small>
                            </div>

                            <button type="submit" @click.prevent="submit()" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
    
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                
            </div>
        </div>
    </div>
    <?php $this->loadComponent('footer')  ?>

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
                    Admin: {
                        nome: '',
                        email: '',
                        senha: ''
                    },
                    BASE_URL: $('#burl').val()
                }
            },
            created() {
                // alert(this.BASE_URL)
            },

            methods: {
                submit(){
                    let admin = this.Admin

                    $.ajax({
                        type: "POST", // Método da requisição
                        url: `${this.BASE_URL}/api/funcionario/cadastrar`, // URL do servidor
                        data: admin, // Dados no formato JSON
                        dataType: 'json',
                        success: function (response) {
                            // Função a ser executada em caso de sucesso
                            console.log("Requisição POST bem-sucedida:", response);
                        },
                        error: function (error) {
                            // Função a ser executada em caso de erro
                            console.error("Erro na requisição POST:", error);
                        }
                    });
                }
            }
        }

        createApp(app).mount('#app')
    </script>
</body>

</html>