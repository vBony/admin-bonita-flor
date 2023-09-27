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
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Serviços</h1>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Cadastro de Serviços</h6>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="form-row align-items-center">
                                <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                                    <label for="categoriaCadastro">Categoria</label>
                                    <select class="form-control" @change="buscarServicos()" v-model="categoria.id">
                                        <option selected :value="null"></option>
                                        <option :value="reg.id" v-for="(reg, index) in lista.categorias">{{reg.descricao}}</option>
                                    </select>
                                </div>
                            </div>
                        </form>
                        <hr>
                        <div class="col-12 flex-row d-flex justify-content-between align-items-center mb-2 " v-if="categoria.id !== null">
                            <h4 class="text-secondary align-middle m-0">Serviços</h4>
                            <button type="button" data-toggle="modal" data-target="#modalCadastroServico" class="btn btn-primary"><i class="fas fa-plus mr-2"></i>Novo</button>
                        </div>
                       
                        <div id="table-dad" @scroll="scrollHandleFuncionarios($event)" v-if="categoria.id !== null">
                            <table class="table" id="table-list">
                                <thead id="theadAdmins" class="bg-white">
                                    <tr id="trTransacoes">
                                        <th scope="col">Nome</th>
                                        <th scope="col">Preço</th>
                                        <th scope="col" class="text-center"></th>
                                        
                                    </tr>
                                </thead>
                                <tbody id="servicos-area">
                                    <tr v-for="(reg, index) in servicos" :key="index">
                                        <td class="align-middle">{{reg.nome}}</td>
                                        <td class="listaPreco">{{reg.preco.toLocaleString('pt-br',{style: 'currency', currency: 'BRL'})}}</td>
                                        <td class="text-center">
                                            <i class="fas fa-pen mr-2 text-warning cursor-pointer px-2"></i>
                                            <i class="fas fa-trash-alt text-danger cursor-pointer px-2" @click="excluirServico(reg.id)"></i>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="modalCadastroServico" tabindex="-1" role="dialog" aria-labelledby="modalCadastroServico" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-primary" id="exampleModalLongTitle">{{alterando == true ? "Alterar Categoria" : "Cadrastar Serviço"}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Categoria</label>
                                        <input 
                                            v-model="categoria.descricao" 
                                            type="name" 
                                            class="form-control" 
                                            id="nomeCategoria"
                                            disabled
                                        >
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Nome Serviço</label>
                                        <input 
                                            v-model="servico.nome" 
                                            type="name" 
                                            class="form-control" 
                                            id="nomeServico" 
                                            :class="{ 'is-invalid': errors.nome}"
                                            @input="errors.nome = null"
                                        >
                                        <div v-if="errors.nome" class="invalid-feedback">{{errors.nome}}</div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Preço</label>
                                        <input 
                                            type="name" 
                                            class="form-control" 
                                            id="precoServico" 
                                            :class="{ 'is-invalid': errors.preco}"
                                            @input="errors.preco = null"
                                        >
                                        <div v-if="errors.preco" class="invalid-feedback">{{errors.preco}}</div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Duração (Horas/minutos)</label>
                                        <input 
                                            type="name" 
                                            class="form-control" 
                                            id="duracaoServico" 
                                            :class="{ 'is-invalid': errors.duracao}"
                                            @input="errors.duracao = null"
                                        >
                                        <div v-if="errors.duracao" class="invalid-feedback">{{errors.duracao}}</div>
                                    </div>
                                </div>
                                <div class="col-12 mb-3">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Descrição</label>
                                        <textarea 
                                            v-model="servico.descricao"                                             
                                            :class="{ 'is-invalid': errors.descricao}"
                                            @input="errors.descricao = null" 
                                            class="form-control" 
                                        ></textarea>
                                        <div v-if="errors.descricao" class="invalid-feedback">{{errors.descricao}}</div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                            <button v-if="alterando == false" type="button" @click="inserirServico()" class="btn btn-primary">Salvar</button>
                            <button v-if="alterando == true" type="button" @click="alterarServico()" class="btn btn-warning">Alterar</button>
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
    
    <script src="<?=BASE_URL?>app/assets/libs/maskMoney.js"></script>    

    <script src="<?=BASE_URL?>app/assets/libs/jquery.mask.js"></script>  

    <input type="hidden" id="burl" value="<?=BASE_URL?>">

    <script>
        const { createApp } = Vue

        const app = {
            data() {
                return {
                    alterando: false,
                    errors: {
                        idCategoria: null,
                        nome: null,
                        descricao: null,
                        preco: null, 
                        duracao: null
                    },

                    categoria: {
                        id: null,
                        descricao: null
                    },

                    servico: {
                        id: null,
                        idCategoria: null,
                        nome: null,
                        descricao: null,
                        preco: null, 
                        duracao: null,
                    },
                    
                    servicos: [],

                    lista: {
                        categorias: []
                    },
                    
                    BASE_URL: $('#burl').val()
                }
            },
            mounted() {
                
                $("#precoServico, .listaPreco").maskMoney({
                    prefix:"R$",
                    decimal:",",
                    thousands:".",
                })
                
                $("#duracaoServico").mask("00:00")
                   
                this.buscarDados()

            },

            methods: {
                inserirServico(){
                    let servico = this.servico

                    servico.preco = $("#precoServico").maskMoney('unmasked')[0]
                    servico.duracao = $("#duracaoServico").val()
                    servico.idCategoria = this.categoria.id

                    // this.limparMensagens()

                    $.ajax({
                        type: "POST", // Método da requisição
                        url: `${this.BASE_URL}api/servicos/cadastrar`, // URL do servidor
                        data: servico, // Dados no formato JSON
                        dataType: 'json',
                        success: (response)=> {
                            // Função a ser executada em caso de sucesso
                            this.servicos = response.servicos
                            this.limparServico()
                            $("#modalCadastroServico").modal("hide")
                            alert("Serviço cadastrado com sucesso!")
                        
                        },
                        error: (error) => {
                            this.errors = error.responseJSON.errors

                            console.log(this.errors);
                        }
                    });
                    
                },

                editar(id){
                    this.alterando = true
                    let obj = this.categorias.find(item => item.id === id)

                    this.categoria = obj

                    console.log(this.categoria);

                    $('#modalCadastroServico').modal('show')
                },

                novo(){
                    this.alterando = false
                    this.limparCategoria()

                    $('#modalCadastroServico').modal('show')
                },

                
                buscarDados(){
                    $.ajax({
                        type: "GET", // Método da requisição (GET)
                        url: `${this.BASE_URL}api/servicos`, // URL da API ou recurso
                        dataType: "json", // Tipo de dados esperado na resposta (JSON, XML, HTML, etc.)
                        success: (data) => {
                            this.lista.categorias = data.lista.categorias
                            
                        },
                        error: (data) => {
                            // Função a ser executada em caso de erro
                            console.error("Erro na requisição GET:", error);
                        }
                    });
                    
                },

                
                excluirServico(id){
                    let obj = this.servicos.find(item => item.id === id)
                    let msg = `Confirma a exclusão do serviço ${obj.nome}?`

                    if(confirm(msg)){
                        $.ajax({
                            type: "POST",
                            url: `${this.BASE_URL}api/servicos/excluir`,
                            dataType: "json",
                            data: {id: id},
                            success: (data) => {
                                this.servicos = this.servicos.filter(item => item.id !== id)
                                alert('Serviço excluido com sucesso!')
                            },
                            error: (data) => {
                                // Função a ser executada em caso de erro
                                alert('Houve um problema ao excluir o serviço, tente novamente mais tarde')
                                location.reload();
                            }
                        });
                    }
                    
                },

                buscarServicos(){

                    let obj =  this.lista.categorias.find(item => item.id === this.categoria.id)
                    this.categoria.descricao = obj.descricao

                    let idCategoria = this.categoria.id

                    $.ajax({
                        type: "POST", // Método da requisição (GET)
                        url: `${this.BASE_URL}api/servicos/buscar-por-categoria`, // URL da API ou recurso
                        dataType: "json", // Tipo de dados esperado na resposta (JSON, XML, HTML, etc.)
                        data: {idCategoria: idCategoria},
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
                    this.errors.servico.nome = null
                    this.errors.servico.duracao = null
                    this.errors.servico.preco = null
                    this.errors.servico.descricao = null
                    this.errors.servico.idCategoria = null
                },

                limparServico(){
                    this.servico.nome = null
                    this.servico.duracao = null
                    this.servico.preco = null
                    this.servico.descricao = null
                    this.servico.idCategoria = null
                }
            }
        }

        createApp(app).mount('#app')
    </script>
</body>

</html>