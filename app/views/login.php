<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Login</title>

    <!-- Custom fonts for this template-->
    <link href="<?=BASE_URL?>app/assets/libs/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?=BASE_URL?>app/assets/css/sb-admin-2.min.css" rel="stylesheet">
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <!-- <div class="col-lg-6 d-none d-lg-block bg-login-image"></div> -->
                            <div class="col-12">
                                <div class="p-5 mx-auto col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Bela Flor 🌷</h1>
                                    </div>
                                    <form class="user">
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Seu e-mail">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="Senha">
                                        </div>

                                        <input type="submit" class="btn btn-primary btn-user btn-block" value="Entrar" @click.prevent="submit()">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?=BASE_URL?>app/assets/libs/jquery/jquery.min.js"></script>
    <script src="<?=BASE_URL?>app/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?=BASE_URL?>app/assets/libs/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?=BASE_URL?>app/assets/js/sb-admin-2.min.js"></script>

    <script>
        const { createApp } = Vue

        const app = {
            data() {
                return {
                    Admin: {
                        email: '',
                        senha: ''
                    },

                    errors: {
                        email: null,
                        senha: null
                    },

                    
                    BASE_URL: $('#burl').val()
                }
            },
            
            created(){
                alert('ok')
            },

            methods: {
                submit(){
                    let admin = this.Admin

                    this.limparMensagens()

                    // $.ajax({
                    //     type: "POST", // Método da requisição
                    //     url: `${this.BASE_URL}api/funcionario/login`, // URL do servidor
                    //     data: admin, // Dados no formato JSON
                    //     dataType: 'json',
                    //     success: (response) => {
                    //         // Função a ser executada em caso de sucesso
                    //         console.log(response)
                    //     },
                    //     error: (error) => {
                    //         this.errors = error.responseJSON.errors
                    //     }
                    // });
                },

                buscarAdmins(){
                    $.ajax({
                        type: "GET", // Método da requisição (GET)
                        url: `${this.BASE_URL}api/funcionario/listar`, // URL da API ou recurso
                        dataType: "json", // Tipo de dados esperado na resposta (JSON, XML, HTML, etc.)
                        success: (data) => {
                            this.admins = data.admins
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
                    this.Admin.nome = null
                    this.Admin.email = null
                    this.Admin.senha = null
                }
            }
        }

        createApp(app).mount('#app')
    </script>
</body>

</html>