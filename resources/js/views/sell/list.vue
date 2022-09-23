<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card text-center" >
                    <div class="card-header">
                        <h3 class="card-title">Listagem de Pedidos</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nome do Cliente</th>
                                    <th scope="col">Itens do Pedido</th>
                                    <th scope="col">Total do Pedido</th>
                                    <th scope="col">Data da Venda</th>
                                    <th scope="col">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="sell in sells" :key="sell.id">
                                    <th scope="row">#{{ sell.id }}</th>
                                    <td>{{ sell.user.desname }}</td>
                                    <td>{{ sell.produtos }}</td>
                                    <td>{{ sell.total }}</td>
                                    <td>{{ sell.created_at }}</td>
                                    <td>
                                        <a class="btn btn-danger" v-on:click='delete_sell(sell.id)'>Excluir</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import Swal from 'sweetalert2'
export default {
    data() {
        return {
        title: 'Listagem de Clientes',
        sells: []
        }
    },
    mounted() {
        this.getSells();
    },
    methods: {
        /**
         * @author Vitor Hugo
         * @version 1.0
        */
        delete_sell(id){
            Swal.fire({
                title: 'Tem certeza?',
                text: "Você não poderá reverter isso!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, excluir!'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete('/api/sell/delete/' + id)
                    .then(response => {
                        Swal.fire(
                            'Excluído!',
                            'O pedido foi excluído com sucesso.',
                            'success'
                        )
                        this.getSells();
                    })
                    .catch(error => {
                        Swal.fire(
                            'Erro!',
                            'Ocorreu um erro ao excluir este pedido.',
                            'error'
                        )
                    })
                }
            })
        },
        /**
         * @author Vitor Hugo
         * @version 1.0
        */
        getSells() {
            Swal.fire({
                title: 'Carregando..',
                html: 'Aguarde enquanto recebemos as informações.',
                didOpen: () => {
                    Swal.showLoading()
                        axios.get('/api/sell/list')
                        .then(response => {
                            var filteredData = [];
                            response.data.forEach(element => {
                                element.desproducts = JSON.parse(element.desproducts);
                                //percorre o array element.desproducts pra pegar o valor total da compra
                                 var total = 0;
                                 var produtos = '';
                                 element.desproducts.forEach(product => {
                                        total += Number(product.desprice);
                                        //adiciona o nome do produto a string produtos mas verifica se precisa ter uma , ou não
                                        if(produtos == ''){
                                            produtos = product.desname;
                                        }else{
                                            produtos = produtos + ', ' + product.desname;
                                        }
                                 });
                                 //format element.created_at to dd/mm/yyyy H:i:s
                                 var date = new Date(element.created_at);
                                 var day = date.getDate();
                                 var month = date.getMonth() + 1;
                                 var year = date.getFullYear();
                                 var hour = date.getHours();
                                 var minutes = date.getMinutes();
                                 var seconds = date.getSeconds();
                                 day = day < 10 ? '0' + day : day;
                                 month = month < 10 ? '0' + month : month;
                                 hour = hour < 10 ? '0' + hour : hour;
                                 minutes = minutes < 10 ? '0' + minutes : minutes;
                                 seconds = seconds < 10 ? '0' + seconds : seconds;
                                
                                 element.created_at = day + '/' + month + '/' + year + ' ' + hour + ':' + minutes + ':' + seconds;
                                 element.produtos = produtos;
                                 element.total = total.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
                                filteredData.push(element);
                            });
                            //stop loading
                            Swal.close();
                            this.sells = filteredData;
                         
                        })
                        .catch(error => {
                            console.log(error);
                        });
                }})
        }
    }
}
</script>
