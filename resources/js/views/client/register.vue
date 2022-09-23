<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card " >
                    <div class="card-header">
                        <h3 class="card-title text-center">Cadastro de Cliente</h3>
                    </div>
                    <div class="card-body ">
                        <form @submit.prevent="submit" >
                            <div class="form-group ">
                                <label for="desname">Nome</label>
                                <input type="text" class="form-control" id="desname" v-model="desname"  placeholder="Nome">
                            </div>
                            <br>
                            <div class="col-12 row">
                                <div class="col-6">
                                    <div class="form-group ">
                                        <label for="desemail">E-mail</label>
                                        <input type="email" class="form-control" id="desemail" v-model="desemail"  placeholder="exemplo@exemplo.com">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group text-left">
                                        <label for="desdocument">CPF <a :href="web_geradorcpf" target="_blank">(Link Gerador de CPF)</a></label>
                                        <input type="text" class="form-control" v-on:change="validateCPF()" maxlength="11" id="desdocument" max v-model="desdocument"  placeholder="00000000-00">
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="form-group ">
                                <label for="dtbirth">Data de Nascimento</label>
                                <input type="date" class="form-control" id="dtbirth" v-model="dtbirth"  placeholder="Nome">
                            </div>
                            <hr>
                            <div class="form-group ">
                                <label for="descep">CEP</label>
                                <input type="text" v-on:change="find_cep" class="form-control" id="descep" v-model="descep"  placeholder="00000-000">
                            </div>
                            <br>
                            <div class="col-12 row">
                                <div class="col-6">
                                    <div class="form-group text-left">
                                        <label for="descidade">Cidade</label>
                                        <input type="text" class="form-control" id="descidade" v-model="descidade"  placeholder="00000000-00">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group ">
                                        <label for="desbairro">Bairro</label>
                                        <input type="text" class="form-control" id="desbairro" v-model="desbairro"  placeholder="ex: bairro">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group ">
                                        <label for="text">Logradouro</label>
                                        <input type="text" class="form-control" id="deslogradouro" v-model="deslogradouro"  placeholder="ex: logradouro">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12  row pt-3">
                                <div class="col-6 ">
                                    <div class="form-group ">
                                        <label for="descomplemento">Complemento</label>
                                        <input type="text" class="form-control" id="descomplemento" v-model="descomplemento"  placeholder="ex: complemento">
                                    </div>
                                </div>
                                <div class="col-6 ">
                                    <div class="form-group ">
                                        <label for="text">Número</label>
                                        <input type="number" class="form-control" id="desnumero" v-model="desnumero"  placeholder="ex: 156">
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="text-center">
                             <button type="submit" class="btn btn-primary btn-block" >Cadastrar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Swal from 'sweetalert2'
    export default {
        methods: {
            /**
             * @func CPFValidator
             * @version 1.6
             * @param {Event} event
            */
            cpf_check(cpf){
                var cpf = cpf.replace(/[^\d]+/g, '');
                if (cpf == '') return false;
                if (cpf.length != 11 ||
                    cpf == "00000000000" ||
                    cpf == "11111111111" ||
                    cpf == "22222222222" ||
                    cpf == "33333333333" ||
                    cpf == "44444444444" ||
                    cpf == "55555555555" ||
                    cpf == "66666666666" ||
                    cpf == "77777777777" ||
                    cpf == "88888888888" ||
                    cpf == "99999999999")
                    return false;
                var add = 0;
                for (var i = 0; i < 9; i++)
                    add += parseInt(cpf.charAt(i)) * (10 - i);
                var rev = 11 - (add % 11);
                if (rev == 10 || rev == 11)
                    rev = 0;
                if (rev != parseInt(cpf.charAt(9)))
                    return false;
                add = 0;
                for (var i = 0; i < 10; i++)
                    add += parseInt(cpf.charAt(i)) * (11 - i);
                var rev = 11 - (add % 11);
                if (rev == 10 || rev == 11)
                    rev = 0;
                if (rev != parseInt(cpf.charAt(10)))
                    return false;
                return true;
            },
            /**
             * @author Vitor Hugo
             * @version 1.0
             * @param {Event} event
            */
            validateCPF(event){
                if(this.desdocument.length == 11){
                    if(this.cpf_check(this.desdocument)){
                        Swal.fire({
                            icon: 'success',
                            title: 'CPF Válido',
                            timer: 1500
                        })
                    }else{
                        Swal.fire({
                            icon: 'error',
                            title: 'CPF Inválido',
                            text: 'Por favor, digite um CPF válido!',
                            timer: 1500
                        })
                        this.desdocument = ''
                    }
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'CPF Inválido',
                        text: 'O CPF deve conter 11 dígitos',
                        showConfirmButton: true,
                        timer: 1500
                    })
                    this.desdocument = ''
                }
            },
            /**
             * @author Vitor Hugo
             * @version 1.0
             * @param {Event} event
            */
            find_cep(event){
                if (event) event.preventDefault();
                this.descep = this.descep.trim().replace(/[^0-9]/g, '');

                var url_cep = 'https://viacep.com.br/ws/' + this.descep + '/json';
                // clear all headers axios to viacep
                axios.defaults.headers.common = null;

                axios.get(url_cep).then(function (response) {

                    this.deslogradouro = response.data.logradouro;
                    this.descomplemento = response.data.complemento;
                    this.desbairro = response.data.bairro;
                    this.descidade = response.data.localidade;
                }.bind(this)).catch(function (error) {
                    //dont debug
                });
                document.getElementById('desnumero').focus();
            },
            /**
             * @author Vitor Hugo
             * @version 1.0
             * @param {Event} event
             */
            submit() {            
                //verifica se todos os campos estão preenchidos
                if (this.desname == '' || this.desemail == '' || this.desdocument == '' || this.dtbirth == '' || this.descep == '' || this.descidade == '' || this.desbairro == '' || this.deslogradouro == '' || this.descomplemento == '' || this.desnumero == '') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Preencha todos os campos!',
                    })
                } else {
                    //envia os dados para o controller
                    var that = this;
                    axios.post('/api/client/create', {
                            desname: this.desname,
                            desemail: this.desemail,
                            desdocument: this.desdocument,
                            dtbirth: this.dtbirth,
                            descep: this.descep,
                            descidade: this.descidade,
                            desbairro: this.desbairro,
                            deslogradouro: this.deslogradouro,
                            descomplemento: this.descomplemento,
                            desnumero: this.desnumero,
                        })
                        .then(function (response) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Cliente cadastrado com sucesso!',
                                showConfirmButton: true,
                                timer: 1500
                            })
                            //redirect to client_list
                            that.$router.push({ name: 'client_list' })
                        })
                        .catch(function (error) {
                            //check if has error.response.data.errors
                            if(error.response.data.error){
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: error.response.data.error,
                                })
                            }
                        });
                }
            }
        },
        data() {
            return {
                web_geradorcpf: 'https://www.geradordecpf.org/',
                desname: '',
                desemail: '',
                desdocument: '',
                dtbirth: '',
                descep: '',
                descidade: '',
                desbairro: '',
                deslogradouro: '',
                descomplemento: '',
                desnumero: '',
            }
        }
    }

</script>