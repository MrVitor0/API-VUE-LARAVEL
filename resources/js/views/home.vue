<template>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card text-center" >
                        <div class="card-header">
                            <h3 class="card-title animate-charcter">Bem-vindo (a) ao teste técnico</h3>
                        </div>
                        <div class="card-body">
                            <p>Este sistema foi desenvolvido utilizando <a class="text-danger" :href="social.lr_website" target="_blank"><b>Laravel</b></a> e <a class="text-success" :href="social.vue_website" target="_blank"><b>Vue.JS</b></a>.</p>
                            <strong>Desenvolvedor</strong>
                            <ul class="list-group list-group-center">
                                <li class="list-group-item"><a :href="social.linkedin" target="_blank">Linkedin</a></li>
                                <li class="list-group-item"><a :href="social.github" target="_blank">Github</a></li>
                            </ul>
                            <br>
                            <strong>Funcionalidades do Sistema</strong>
                            <ul class="list-group list-group-center">
                                <li class="list-group-item"><router-link :to="{name: 'client_list'}">Listagem de Clientes</router-link></li>
                                <li class="list-group-item"><router-link :to="{name: 'client_register'}">Cadastro de Clientes</router-link></li>
                            </ul>
                            <br>
                            <ul class="list-group list-group-center">
                                <li class="list-group-item"><router-link :to="{name: 'product_list'}">Listagem de Produtos</router-link></li>
                                <li class="list-group-item"><router-link :to="{name: 'product_register'}">Cadastro de Produtos</router-link></li>
                            </ul>
                            <br>
                            <ul class="list-group list-group-center">
                                <li class="list-group-item"><router-link :to="{name: 'sell_list'}">Listagem de Pedidos de Venda</router-link></li>
                                <li class="list-group-item"><router-link :to="{name: 'sell_register'}">Cadastro de Pedidos de Venda</router-link></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</template>
<script>
export default {
    data() {
        return {
            social: {
                //public
                wk_website: 'https://wktechnology.com.br',
                lr_website: 'https://laravel.com',
                vue_website: 'https://vuejs.org',   
                //private
                linkedin: 'https://www.linkedin.com/in/vitorhugorj',
                github : 'https://github.com/MrVitor0'
            }
        }
    }
}
</script>
