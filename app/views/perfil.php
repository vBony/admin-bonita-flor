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

                            <form>
                                <div class="col-12 px-0 my-4 d-flex align-items-center">
                                    <img :src="previewProfilePic" class="profile-photo" alt="">
                                    <div class="d-flex flex-column ml-4">
                                        <div class="font-weight-bold">{{admin.nome}}</div>
                                        <a href="#" @click="triggerFotoPerfil()">Alterar foto de perfil</a>
                                        <span class="text-danger" v-if="errors.admin.foto">{{errors.admin.foto}}</span>
                                    </div>

                                    <input type="file" @change="previewImage" id="fotoPerfil" class="d-none" accept="image/jpg, image/png, image/jpeg">
                                </div>
    
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nome completo</label>
                                    <input 
                                        v-model="admin.nome" 
                                        type="name" 
                                        class="form-control" 
                                        id="nome" 
                                        placeholder="Ex: Maria dos Santos Ferreira"
                                        :class="{ 'is-invalid': errors.admin.nome }"
                                        @input="errors.admin.nome = null"
                                    >
                                    <div v-if="errors.admin.nome" class="invalid-feedback">{{errors.admin.nome}}</div>
                                </div>
    
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email</label>
                                    <input 
                                        v-model="admin.email" 
                                        type="email" 
                                        class="form-control" 
                                        id="email" 
                                        placeholder="Ex: maria@hotmail.com"
                                        :class="{ 'is-invalid': errors.admin.email }"
                                        @input="errors.admin.email = null"
                                    >
                                    <div v-if="errors.admin.email" class="invalid-feedback">{{errors.admin.email}}</div>
                                </div>
                            
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Sobre mim</label>
                                    <textarea 
                                        v-model="admin.descricao" 
                                        class="form-control" 
                                        id="descricao" 
                                        rows="5"
                                        :class="{ 'is-invalid': errors.admin.descricao }"
                                        @input="errors.admin.descricao = null"
                                        placeholder="Um breve texto sobre sua carreira e experiências profissionais"
                                    >
                                    </textarea>
                                    <div v-if="errors.admin.descricao" class="invalid-feedback">{{errors.admin.descricao}}</div>
                                </div>
    
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Alterar Senha</label>
                                    <input 
                                        v-model="admin.senha" 
                                        type="password" 
                                        class="form-control" 
                                        id="alterarSenha" 
                                        autocomplete="one-time-code"
                                        :class="{ 'is-invalid': errors.admin.senha }"
                                        @input="errors.admin.senha = null"
                                    >
                                    <div v-if="errors.admin.senha" class="invalid-feedback">{{errors.admin.senha}}</div>
                                </div>
    
                                <div class="form-group my-4">
                                    <input type="submit" class="btn btn-success form-control" @click.prevent="alterarAdmin()" value="Alterar">
                                </div>
                            </form>
                        </div>

                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                            <h4 class="text-primary">Especialidades</h4>

                            <p class="text-muted">Selecione os serviços que você pode atender.</p>
                            <form>
                                <div class="form-row align-items-center">
                                    <div class="col-lg-5 col-md-12 mt-3">
                                        <label for="categoriaCadastro">Categoria</label>
                                        <select 
                                            class="form-control" 
                                            id="categoriaCadastro" 
                                            v-model="servico.idCategoria" 
                                            @change="buscarServico(); errors.adminServico.categoria = null"
                                            :class="{ 'is-invalid': errors.adminServico.categoria }"
                                            
                                        >
                                            <option selected :value="null">Selecione</option>
                                            <option :value="reg.id" v-for="(reg, index) in categorias">{{reg.descricao}}</option>
                                        </select>
                                        <div v-if="errors.adminServico.categoria" class="invalid-tooltip">{{errors.adminServico.categoria}}</div>
                                    </div>
                                    <div class="col-lg-5 col-md-12 mt-3">
                                        <label for="categoriaCadastro">Serviço</label>
                                        <select 
                                            class="form-control" 
                                            id="servicoCadastro" 
                                            v-model="servico.idServico" 
                                            :disabled="servico.idCategoria == null"
                                            @change="errors.adminServico.servico = null"
                                            :class="{ 'is-invalid': errors.adminServico.servico }"
                                        >
                                            <option selected>Selecione</option>
                                            <option :value="reg.id" v-for="(reg, index) in servicos">{{reg.nome}}</option>
                                        </select>
                                        <div v-if="errors.adminServico.servico" class="invalid-tooltip">{{errors.adminServico.servico}}</div>
                                    </div>
                                    <div class="col-lg-2 col-md-12 mt-3">
                                        <label for="categoriaCadastro">&nbsp;</label>
                                        <input type="submit" @click.prevent="inserirServico()" class="btn btn-success form-control" value="Adicionar">
                                    </div>
                                </div>
                            </form>
                            <hr>
                            <h4 class="text-secondary">Suas Especialidades</h4>
                            <div id="table-dad" @scroll="scrollHandleFuncionarios($event)">
                                <table class="table" id="table-list">
                                    <thead id="theadAdmins" class="bg-white">
                                        <tr id="trTransacoes">
                                            <th scope="col">Nome</th>
                                            <th scope="col">Cat.</th>
                                            <th scope="col" class="text-center"></th>
                                        </tr>
                                    </thead>
                                    <tbody id="servicos-area">
                                        <tr v-for="(reg, index) in adminServicos" :key="index">
                                            <td class="align-middle">{{reg.servico.nome}}</td>
                                            <td class="align-middle">{{reg.servico.categoria.descricao}}</td>
                                            <td class="text-center cursor-pointer" @click="excluirAdminServico(reg.id)">
                                                <i class="fas fa-trash-alt text-danger"></i>
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
                    backupFoto: null,
                    previewProfilePic: null,

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
                        admin: {
                            nome: null,
                            foto: null,
                            descricao: null,
                            telefone: null,
                            email: null,
                            senha: null,
                        },
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

                    adminServicos: [],
                    
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
                        type: "POST",
                        url: `${this.BASE_URL}api/admin-servicos/cadastrar`,
                        data: servico,
                        dataType: 'json',
                        success: (response) => {
                            this.adminServicos = response.adminServicos

                            this.servico.idCategoria = null 
                            this.servico.idServico = null 
                        },
                        error: (error) => {
                            this.errors.adminServico = error.responseJSON.errors
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
                            this.admin.senha = null // Recuperando a prop senha, pois o backend não retorna
                            this.categorias = data.listas.categorias
                            this.adminServicos = data.listas.adminServicos

                            this.backupFoto = this.admin.foto
                            this.previewProfilePic = this.admin.foto
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

                excluirAdminServico(id){
                    let obj = this.adminServicos.find(item => item.id === id)
                    let msg = `Confirma a exclusão do Serviço ${obj.servico.nome}?`

                    if(confirm(msg)){
                        this.adminServicos = this.adminServicos.filter(item => item.id !== id)

                        $.ajax({
                        type: "POST",
                        url: `${this.BASE_URL}api/admin-servicos/excluir`,
                        data: {id: id},
                        dataType: 'json',
                            error: (error) => {
                                alert("Falha ao excluir o serviço, tente novamente mais tarde")
                                this.adminServicos.push(obj);
                            }
                        });
                    }
                },

                triggerFotoPerfil(){
                    $('#fotoPerfil').trigger('click')
                },

                previewImage(){
                    this.errors.admin.foto = null;

                    // Mantendo a foto anterior caso dê algum erro
                    const bckpFoto = this.admin.foto
                    
                    const file = event.target.files[0];
                    if (file) {
                        const extensoesPermitidas = ["jpg", "jpeg", "png"];
                        const tamanhoMaximo = 5 * 1024 * 1024; // 5MB

                         // Verificando a extensão do arquivo
                        const extensao = file.name.split(".").pop().toLowerCase();
                        if (!extensoesPermitidas.includes(extensao)) {
                            this.errors.admin.foto = "Apenas arquivos de imagem (jpg, jpeg e png) são permitidos.";
                            this.previewProfilePic = this.backupFoto;
                            return;
                        }

                        // Verificando o tamanho do arquivo
                        if (file.size > tamanhoMaximo) {
                            this.errors.admin.foto = "O tamanho do arquivo excede o limite de 5MB.";
                            this.previewProfilePic = this.backupFoto;
                            return;
                        }

                        const reader = new FileReader();

                        reader.onload = (e) => {
                            this.previewProfilePic = e.target.result;
                            this.admin.foto = file
                        };

                        reader.readAsDataURL(file);
                    } else {
                        this.previewProfilePic = bckpFoto;
                    }
                },

                alterarAdmin(){
                    let arquivo = $("#fotoPerfil")[0].files[0];

                    let form = this.getFormData()

                    $.ajax({
                        url: `${this.BASE_URL}api/admin/alterar`, // Substitua pela URL do servidor
                        type: "POST",
                        data: form,
                        processData: false,
                        contentType: false,
                        success: (response) => {
                            alert('Dados alterados com sucesso!')
                            // location.reload();
                        },
                        error: (error) => {
                            let errorsObj = JSON.parse(error.responseText)
                            this.errors.admin = errorsObj.errors.admin
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
                },

                getFormData(){
                    let form = new FormData()

                    form.append('admin[id]', this.admin.id)
                    form.append('admin[nome]', this.admin.nome)
                    form.append('admin[descricao]', this.admin.descricao)
                    form.append('admin[telefone]', this.admin.telefone)
                    form.append('admin[email]', this.admin.email)
                    form.append('admin[senha]', this.admin.senha == null ? "" : this.admin.senha)

                    console.log(this.admin);

                    form.append('foto', this.admin.foto)

                    return form
                }
            }
        }

        createApp(app).mount('#app')
    </script>
</body>

</html>