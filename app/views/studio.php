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
                                <i class="fas fa-calendar mr-2"></i>
                                <span>Dias de atendimento</span>
                            </h5>
                            <div class="col-12 mb-4">
                                <h6>Dias disponíveis</h6>
                                <div class="form-check">
                                    <input 
                                        class="form-check-input" 
                                        v-model="entidade.diasAtendimento.segunda" 
                                        type="checkbox" 
                                        :value="true" 
                                        id="segunda"
                                        @input="errors.diasAtendimento = null" 
                                    >
                                    <label class="form-check-label" for="segunda">
                                        Segunda-Feira
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input 
                                        class="form-check-input" 
                                        v-model="entidade.diasAtendimento.terca" 
                                        type="checkbox" 
                                        :value="true" 
                                        id="terca"
                                        @input="errors.diasAtendimento = null" 
                                    >
                                    <label class="form-check-label" for="terca">
                                        Terça-Feira
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input 
                                        class="form-check-input" 
                                        v-model="entidade.diasAtendimento.quarta"  
                                        type="checkbox" 
                                        :value="true" 
                                        id="quarta"
                                        @input="errors.diasAtendimento = null" 
                                    >
                                    <label class="form-check-label" for="quarta">
                                        Quarta-Feira
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input 
                                        class="form-check-input" 
                                        v-model="entidade.diasAtendimento.quinta" 
                                        type="checkbox" 
                                        :value="true" 
                                        id="quinta"
                                        @input="errors.diasAtendimento = null" 
                                    >
                                    <label class="form-check-label" for="quinta">
                                        Quinta-Feira
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input 
                                        class="form-check-input" 
                                        v-model="entidade.diasAtendimento.sexta" 
                                        type="checkbox" 
                                        :value="true" 
                                        id="sexta"
                                        @input="errors.diasAtendimento = null" 
                                    >
                                    <label class="form-check-label" for="sexta">
                                        Sexta-Feira
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input 
                                        class="form-check-input" 
                                        v-model="entidade.diasAtendimento.sabado" 
                                        type="checkbox" 
                                        :value="true" 
                                        id="sabado"
                                        @input="errors.diasAtendimento = null" 
                                    >
                                    <label class="form-check-label" for="sabado">
                                        Sábado
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input 
                                        class="form-check-input" 
                                        v-model="entidade.diasAtendimento.domingo" 
                                        type="checkbox" 
                                        :value="true" 
                                        id="domingo"
                                        @input="errors.diasAtendimento = null" 
                                    >
                                    <label class="form-check-label" for="domingo">
                                        Domingo
                                    </label>
                                </div>

                                <div v-if="errors.diasAtendimento" class="text-danger">{{errors.diasAtendimento}}</div>
                        </div>

                        <div class="col-12">
                            <h5 class="text-primary">
                                <i class="fas fa-clock mr-2"></i>
                                <span>Horário de atendimento</span>
                            </h5>
                            <div class="row">
                                <div class=" col-lg-2 col-md-2 col-sm-12 mb-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Início</label>
                                        <input 
                                            type="text" 
                                            class="form-control hora" 
                                            id="inicioAtendimento"
                                            :class="{ 'is-invalid': errors.horarios.atendimento.inicio }"
                                            @input="errors.horarios.atendimento.inicio = null"
                                        >
                                        <div v-if="errors.horarios.atendimento.inicio" class="invalid-feedback">{{errors.horarios.atendimento.inicio}}</div>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-12 mb-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Fim</label>
                                        <input 
                                            type="text" 
                                            class="form-control hora" 
                                            id="fimAtendimento" 
                                            :class="{ 'is-invalid': errors.horarios.atendimento.fim }"
                                            @input="errors.horarios.atendimento.fim = null"
                                        >
                                        <div v-if="errors.horarios.atendimento.fim" class="invalid-feedback">{{errors.horarios.atendimento.fim}}</div>
                                    </div>
                                </div>
                            </div>
                            <h6 class="font-weight-bolder">Horário de almoço</h6>
                            <div class="row ">
                                <div class=" col-lg-2 col-md-2 col-sm-12 mb-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Início</label>
                                        <input 
                                            type="text" 
                                            class="form-control hora" 
                                            id="inicioIntervalo" 
                                            :class="{ 'is-invalid': errors.horarios.intervalo.inicio }"
                                            @input="errors.horarios.intervalo.inicio = null"
                                        >
                                        <div v-if="errors.horarios.intervalo.inicio" class="invalid-feedback">{{errors.horarios.intervalo.inicio}}</div>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-12 mb-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Fim</label>
                                        <input 
                                            type="email" 
                                            class="form-control hora" 
                                            id="fimIntervalo"
                                            :class="{ 'is-invalid': errors.horarios.intervalo.fim }"
                                            @input="errors.horarios.intervalo.fim = null"
                                        >
                                        <div v-if="errors.horarios.intervalo.fim" class="invalid-feedback">{{errors.horarios.intervalo.fim}}</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <h5 class="text-primary">
                                <i class="fas fa-map-marker-alt mr-2"></i>
                                <span>Endereço</span>
                            </h5>
                            <div class="row">
                                <div class=" col-lg-2 col-md-6 col-sm-12 mb-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">CEP</label>
                                        <input 
                                            type="cep" 
                                            class="form-control" 
                                            id="cep" 
                                            @change="consultaCep()"
                                            :class="{ 'is-invalid': errors.endereco.cep }"
                                            @input="errors.endereco.cep = null">
                                        <div v-if="errors.endereco.cep" class="invalid-feedback">{{errors.endereco.cep}}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class=" col-lg-4 col-md-8 col-sm-12 mb-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Endereço</label>
                                        <input 
                                            type="email" 
                                            v-model="entidade.endereco.logradouro" 
                                            class="form-control" 
                                            id="exampleInputEmail1" 
                                            :class="{ 'is-invalid': errors.endereco.logradouro }"
                                            @input="errors.endereco.logradouro = null"
                                        >
                                        <div v-if="errors.endereco.logradouro" class="invalid-feedback">{{errors.endereco.logradouro}}</div>
                                    </div>
                                </div>
                                <div class=" col-lg-2 col-md-4 col-sm-12 mb-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Número</label>
                                        <input 
                                            type="email" 
                                            class="form-control" 
                                            v-model="entidade.endereco.numero" 
                                            id="exampleInputEmail1" 
                                            :class="{ 'is-invalid': errors.endereco.numero }"
                                            @input="errors.endereco.numero = null"
                                        >
                                        <div v-if="errors.endereco.numero" class="invalid-feedback">{{errors.endereco.numero}}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class=" col-lg-6 col-md-12 col-sm-12 mb-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Complemento</label>
                                        <input 
                                            type="email" 
                                            class="form-control" 
                                            id="exampleInputEmail1" 
                                            v-model="entidade.endereco.complemento" 
                                            :class="{ 'is-invalid': errors.endereco.complemento }"
                                            @input="errors.endereco.complemento = null"
                                        >
                                        <div v-if="errors.endereco.complemento" class="invalid-feedback">{{errors.endereco.complemento}}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class=" col-lg-4 col-md-8 col-sm-12 mb-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Bairro</label>
                                        <input 
                                            type="email" 
                                            v-model="entidade.endereco.bairro" 
                                            class="form-control" disabled   
                                            id="exampleInputEmail1" 
                                            :class="{ 'is-invalid': errors.endereco.bairro }"
                                            @input="errors.endereco.bairro = null"
                                        >
                                        <div v-if="errors.endereco.bairro" class="invalid-feedback">{{errors.endereco.bairro}}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class=" col-lg-4 col-md-8 col-sm-12 mb-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Cidade</label>
                                        <input 
                                            type="email" 
                                            class="form-control" 
                                            id="exampleInputEmail1" 
                                            disabled 
                                            v-model="entidade.endereco.cidade" 
                                            :class="{ 'is-invalid': errors.endereco.cidade }"
                                            @input="errors.endereco.cidade = null"
                                        >
                                        <div v-if="errors.endereco.cidade" class="invalid-feedback">{{errors.endereco.cidade}}</div>
                                    </div>
                                </div>
                                <div class=" col-lg-2 col-md-4 col-sm-12 mb-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Estado</label>
                                        <input 
                                            type="email" 
                                            class="form-control" 
                                            id="exampleInputEmail1" 
                                            disabled  
                                            v-model="entidade.endereco.estado" 
                                            aria-describedby="emailHelp"
                                            :class="{ 'is-invalid': errors.endereco.estado }"
                                            @input="errors.endereco.estado = null"
                                        >
                                        <div v-if="errors.endereco.estado" class="invalid-feedback">{{errors.endereco.estado}}</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-2 col-md-4 col-sm-12">
                            <button class="btn btn-block btn-primary" @click="alterar()">Salvar</button>
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

    <script src="<?=BASE_URL?>app/assets/libs/jquery.mask.js"></script> 


    <script>
        const { createApp } = Vue

        const app = {
            data() {
                return {
                    BASE_URL: $('#burl').val(),
                    msg: null,

                    entidade:{
                        endereco: {
                            cep: null,
                            logradouro: null,
                            numero: null,
                            complemento: null,
                            bairro: null,
                            cidade: null,
                            estado: null,
                        },

                        horas: {
                            atendimento: {
                                inicio: null,
                                fim: null
                            },
                            intervalo: {
                                inicio: null,
                                fim: null
                            }
                        },

                        diasAtendimento: {
                            segunda: false,
                            terca: false,
                            quarta: false,
                            quinta: false,
                            sexta: false,
                            sabado: false,
                            domingo: false
                        }
                    },
                    errors: {
                        endereco:{
                            cep: null,
                            endereco: null,
                            numero: null,
                            complemento: null,
                            bairro: null,
                            cidade: null,
                            estado: null,
                        },

                        horarios: {
                            atendimento: {
                                inicio: null,
                                fim: null
                            },
                            intervalo: {
                                inicio: null,
                                fim: null
                            }
                        },

                        diasAtendimento: null
                    }
                }
            },
            mounted() {
                $("#cep").mask("99999-999")
                $(".hora").mask("99:99")

                this.buscarDados()
            },

            methods: {
                buscarDados(){
                    $.ajax({
                        type: "GET", // Método da requisição (GET)
                        url: `${this.BASE_URL}api/studio`, // URL da API ou recurso
                        dataType: "json", // Tipo de dados esperado na resposta (JSON, XML, HTML, etc.)
                        success: (data) => {
                            this.entidade = data

                            $("#inicioAtendimento").val(this.entidade.horarios.atendimento.inicio)
                            $("#fimAtendimento").val(this.entidade.horarios.atendimento.fim)

                            $("#inicioIntervalo").val(this.entidade.horarios.intervalo.inicio)
                            $("#fimIntervalo").val(this.entidade.horarios.intervalo.fim)
                        },
                        error: (data) => {
                            // Função a ser executada em caso de erro
                            console.error("Erro na requisição GET:", error);
                        }
                    });
                    
                },

                alterar(){
                    let entidade = this.entidade

                    entidade.horarios.atendimento.inicio = $("#inicioAtendimento").val()
                    entidade.horarios.atendimento.fim    = $("#fimAtendimento").val()
                    entidade.horarios.intervalo.inicio   = $("#inicioIntervalo").val()
                    entidade.horarios.intervalo.fim      = $("#fimIntervalo").val()

                    $.ajax({
                        type: "POST",
                        url: `${this.BASE_URL}api/studio/alterar`,
                        data: entidade,
                        dataType: "json",
                        success: (data) => {
                            
                        },
                        error: (data) => {
                            // Função a ser executada em caso de erro
                            let errors = data.responseJSON.errors

                            if(errors.endereco !== undefined){
                                this.errors.endereco = errors.endereco
                            }

                            if(errors.horarios !== undefined){
                                if(errors.horarios.atendimento !== undefined){
                                    this.errors.horarios.atendimento = errors.horarios.atendimento
                                }

                                if(errors.horarios.intervalo !== undefined){
                                    this.errors.horarios.intervalo = errors.horarios.intervalo
                                }
                            }

                            if(errors.diasAtendimento !== undefined){
                                this.errors.diasAtendimento = errors.diasAtendimento
                            }
                        }
                    });
                },

                consultaCep() {
                    this.entidade.endereco.cep = $("#cep").cleanVal();

                    $.getJSON("https://viacep.com.br/ws/"+ this.entidade.endereco.cep +"/json/?callback=?", (dados)=> {

                        if (!("erro" in dados)) {
                            //Atualiza os campos com os valores da consulta.
                            this.entidade.endereco.bairro = dados.bairro
                            this.entidade.endereco.logradouro = dados.logradouro
                            this.entidade.endereco.cidade = dados.localidade
                            this.entidade.endereco.estado = dados.uf
                        } //end if.
                        else {
                            //CEP pesquisado não foi encontrado.
                            this.errors.endereco.cep  = "CEP não encontrado."
                        }
                    });

                }
            }
        }

        createApp(app).mount('#app')
    </script>
</body>

</html>