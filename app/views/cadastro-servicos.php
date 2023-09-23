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
    <link href="<?=BASE_URL?>app/assets/css/cadastro-servicos.css" rel="stylesheet">
    <link href="<?=BASE_URL?>app/assets/css/cadastro-servicos-2.css" rel="stylesheet">
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>

</head>

<body id="page-top">
    <?php $this->loadComponent('header', $component)  ?>
    <div class="container-fluid" id="app">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Suas informações</h1>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-body row">
                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                            <h4 class="text-primary">Cadastro de categoria e serviços</h4>

                            <p class="text-muted">Selecione os serviços que você pode atender.</p>
                            <form>
                                <div class="form-row align-items-center">
                                    <div class="col-lg-5 col-md-12 mb-3">
                                        <label for="categoriaCadastro">Categoria</label>
                                        <form class="form-inline">
                                            <input type="password" class="form-control" id="inputPassword2">
                                        </form>
                                        <div v-if="errors.adminServico.categoria" class="invalid-feedback">{{errors.adminServico.categoria}}</div>
                                    </div>
                                    <div class="col-lg-2 col-md-12 mb-3">
                                        <label for="categoriaCadastro">&nbsp;</label>
                                        <input type="submit" @click.prevent="inserirServico()" class="btn btn-success form-control" value="Adicionar">
                                    </div>
                                </div>
                            </form>
                            <hr>
                            <h4 class="text-secondary">Seviços</h4>
                            <div id="table-dad" @scroll="scrollHandleFuncionarios($event)">
                                <table class="table" id="table-list">
                                    <thead id="theadAdmins" class="bg-white">
                                        <tr id="trTransacoes">
                                            <th scope="col">Nome</th>
                                            <th scope="col" class="text-center"></th>
                                        </tr>
                                    </thead>
                                    <tbody id="servicos-area">
                                        <tr v-for="(reg, index) in adminServicos" :key="index">
                                            <td class="align-middle">{{reg.nome}}</td>
                                            <td class="text-center">
                                                <i class="fas fa-trash-alt text-danger cursor-pointer"></i>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
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
                    admin: {
                        id: null,
                        nome: null,
                        foto: null,
                        descricao: null,
                        telefone: null,
                        email: null,
                        senha: null,
                        dataCriacao: null
                    },

                    errors: {
                        nome: null,
                        foto: null,
                        descricao: null,
                        telefone: null,
                        email: null,
                        senha: null,
                        adminServico: {
                            servico: null,
                            categoria: null
                        }
                    },

                    servico: {
                        idCategoria: null,
                        idServico: null
                    },

                    servicos: [],

                    categorias: [],

                    adminServicos: [
                        {id: 23, nome: "Unha de gel"},
                        {id: 23, nome: "Alongamento de unha"}
                    ],
                    
                    BASE_URL: $('#burl').val()
                }
            },
            mounted() {
                this.buscarDados()
            },

            methods: {
                inserirServico(){
                    let servico = this.servico

                    this.limparMensagens()

                    $.ajax({
                        type: "POST", // Método da requisição
                        url: `${this.BASE_URL}api/admin-servicos/cadastrar`, // URL do servidor
                        data: servico, // Dados no formato JSON
                        dataType: 'json',
                        success: function (response) {
                            // Função a ser executada em caso de sucesso
                            alert("Funcionário cadastrado com sucesso")
                        },
                        error: (error) => {
                            this.errors.adminServico = error.responseJSON.errors

                            console.log(this.errors);
                        }
                    });
                },

                buscarDados(){
                    $.ajax({
                        type: "GET", // Método da requisição (GET)
                        url: `${this.BASE_URL}api/funcionario/buscar`, // URL da API ou recurso
                        dataType: "json", // Tipo de dados esperado na resposta (JSON, XML, HTML, etc.)
                        success: (data) => {
                            this.admin = data.admin
                            this.categorias = data.listas.categorias
                        },
                        error: (data) => {
                            // Função a ser executada em caso de erro
                            console.error("Erro na requisição GET:", error);
                        }
                    });
                },

                buscarServico(){
                    $.ajax({
                        type: "post", // Método da requisição (GET)
                        url: `${this.BASE_URL}api/servicos/buscar-por-categoria`, // URL da API ou recurso
                        dataType: "json", // Tipo de dados esperado na resposta (JSON, XML, HTML, etc.)
                        data: {idCategoria: this.servico.idCategoria},
                        success: (data) => {
                            this.servicos = data.servicos
                        },
                        error: (data) => {
                            // Função a ser executada em caso de erro
                            console.error("Erro na requisição GET:", data);
                        }
                    });
                },

                scrollHandleFuncionarios(event){
                    const scrollTop = event.target.scrollTop;

                    $("#theadAdmins").css({
                        'transform': `translateY(${scrollTop}px)`,
                        'box-shadow': 'black 0px 0.3px 0px 0px'
                    })
                },

                limparMensagens(){
                    this.errors.nome = null
                    this.errors.email = null
                    this.errors.senha = null
                },

                limparCampos(){
                    this.admin.nome = null
                    this.admin.email = null
                    this.admin.senha = null
                }
            }
        }

        createApp(app).mount('#app')
    </script>
</body>

</html>