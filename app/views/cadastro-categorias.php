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
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>

</head>

<body id="page-top">
    <?php $this->loadComponent('header', $component)  ?>
    <div class="container-fluid" id="app">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Cadastro de categorias</h1>
        </div>
        <div class="row">
            <!-- <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Cadastro de categoria e serviços</h6>
                    </div>
                    <div class="card-body">
                        <p class="text-muted">Selecione os serviços que você pode atender.</p>
                        <form>
                            <div class="form-row align-items-center">
                                <div class="col-lg-10 col-md-12 mb-3">
                                    <label for="categoriaCadastro">Categoria</label>
                                    <form class="form-inline">
                                        <input type="text" class="form-control" id="inputPassword2">
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
                        <div class="col-12 flex-row d-flex justify-content-between align-items-center mb-2">
                            <h4 class="text-secondary align-middle m-0">Seviços</h4>
                            <button type="button" data-toggle="modal" data-target="#modalCadastroServico" class="btn btn-primary"><i class="fas fa-plus mr-2"></i>Novo</button>
                        </div>
                       
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
                                            <i class="fas fa-pen mr-2 text-warning"></i>
                                            <i class="fas fa-trash-alt text-danger cursor-pointer"></i>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div> -->
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-header d-flex justify-content-between py-3">
                        <h6 class="d-flex align-items-center align-middle font-weight-bold text-primary">Categorias ativas</h6>
                        <button type="button" data-toggle="modal" data-target="#modalCadastroServico" class="btn btn-primary"><i class="fas fa-plus mr-2"></i>Novo</button>
                    </div>
                    <div class="card-body">
                        <div id="table-dad">
                            <table class="table" id="table-list">
                                <tbody id="servicos-area">
                                    <tr v-for="(reg, index) in categorias" :key="index">
                                        <td class="align-middle">{{reg.descricao}}</td>
                                        <td class="text-right">
                                            <i class="fas fa-pen mr-2 text-warning"></i>
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
        <div class="modal fade" id="modalCadastroServico" tabindex="-1" role="dialog" aria-labelledby="modalCadastroServico" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-primary" id="exampleModalLongTitle">Criar Categoria</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 mb-3">
                                <div class="form-group">
                                <label for="exampleInputEmail1">Nome</label>
                                    <input 
                                        v-model="categoria.descricao" 
                                        type="name" 
                                        class="form-control" 
                                        id="nomeCategoria" 
                                        :class="{ 'is-invalid': errors.descricao}"
                                        @input="errors.descricao = null"
                                    >
                                    <div v-if="errors.descricao" class="invalid-feedback">{{errors.descricao}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <button type="button" @click="inserirCategoria()" class="btn btn-primary">Salvar</button>
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
                    errors: {
                        descricao: null
                    },

                    categoria: {
                        id: null,
                        descricao: null
                    },
                    
                    categorias: [],
                    
                    BASE_URL: $('#burl').val()
                }
            },
            mounted() {
                this.buscarDados()
            },

            methods: {
                inserirCategoria(){
                    let categoria = this.categoria

                    this.limparMensagens()

                    $.ajax({
                        type: "POST", // Método da requisição
                        url: `${this.BASE_URL}api/categorias/cadastrar`, // URL do servidor
                        data: categoria, // Dados no formato JSON
                        dataType: 'json',
                        success: (response)=> {
                            // Função a ser executada em caso de sucesso
                            this.categorias = response.categorias
                            this.categoria.descricao = null
                            alert("Categoria criada com sucesso!")
                        
                        },
                        error: (error) => {
                            this.errors = error.responseJSON.errors

                            console.log(this.errors);
                        }
                    });
                },

                

                buscarDados(){
                    $.ajax({
                        type: "GET", // Método da requisição (GET)
                        url: `${this.BASE_URL}api/categorias/buscar`, // URL da API ou recurso
                        dataType: "json", // Tipo de dados esperado na resposta (JSON, XML, HTML, etc.)
                        success: (data) => {
                            this.categorias = data.categorias
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