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
    <link href="<?=BASE_URL?>app/assets/css/perfil.css" rel="stylesheet">
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
                            <h4 class="text-primary">Informações Pessoais</h4>

                            <div class="col-12 my-4 d-flex align-items-center">
                                <img :src="admin.foto" class="profile-photo" alt="">
                                <div class="d-flex flex-column ml-4">
                                    <div class="font-weight-bold">{{admin.nome}}</div>
                                    <a href="">Alterar foto de perfil</a>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Nome completo</label>
                                <input 
                                    v-model="admin.nome" 
                                    type="name" 
                                    class="form-control" 
                                    id="nome" 
                                    placeholder="Ex: Maria dos Santos Ferreira"
                                    :class="{ 'is-invalid': errors.nome }"
                                    @input="errors.nome = null"
                                >
                                <div v-if="errors.nome" class="invalid-feedback">{{errors.nome}}</div>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input 
                                    v-model="admin.email" 
                                    type="email" 
                                    class="form-control" 
                                    id="email" 
                                    placeholder="Ex: maria@hotmail.com"
                                    :class="{ 'is-invalid': errors.email }"
                                    @input="errors.email = null"
                                >
                                <div v-if="errors.email" class="invalid-feedback">{{errors.email}}</div>
                            </div>
                        
                            <div class="form-group">
                                <label for="exampleInputEmail1">Sobre mim</label>
                                <textarea 
                                    v-model="admin.descricao" 
                                    class="form-control" 
                                    id="descricao" 
                                    rows="5"
                                    :class="{ 'is-invalid': errors.descricao }"
                                    @input="errors.descricao = null"
                                    placeholder="Um breve texto sobre sua carreira e experiências profissionais"
                                >
                                </textarea>
                                <div v-if="errors.descricao" class="invalid-feedback">{{errors.descricao}}</div>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Senha</label>
                                <input 
                                    v-model="admin.senha" 
                                    type="password" 
                                    class="form-control" 
                                    id="senha" 
                                    :class="{ 'is-invalid': errors.senha }"
                                    @input="errors.senha = null"
                                >
                                <div v-if="errors.senha" class="invalid-feedback">{{errors.senha}}</div>
                            </div>

                            <div class="form-group mt-4">
                                <input type="submit" class="btn btn-success form-control" value="Alterar">
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                            <h4 class="text-primary">Seus serviços</h4>
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
                    },
                    
                    BASE_URL: $('#burl').val()
                }
            },
            mounted() {
                this.buscarDados()
            },

            methods: {
                submit(){
                    let admin = this.Admin

                    this.limparMensagens()

                    $.ajax({
                        type: "POST", // Método da requisição
                        url: `${this.BASE_URL}api/funcionario/cadastrar`, // URL do servidor
                        data: admin, // Dados no formato JSON
                        dataType: 'json',
                        success: function (response) {
                            // Função a ser executada em caso de sucesso
                            alert("Funcionário cadastrado com sucesso")
                        },
                        error: (error) => {
                            this.errors = error.responseJSON.errors
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
                        },
                        error: (data) => {
                            // Função a ser executada em caso de erro
                            console.error("Erro na requisição GET:", error);
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