<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card text-center" >
                    <div class="card-header">
                        <h3 class="card-title">Listagem de Clientes</h3>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table  table-striped table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Nome</th>
                                    <th scope="col">E-mail</th>
                                    <th scope="col">CPF</th>
                                    <th scope="col">Nascimento</th>
                                    <th scope="col">CEP</th>
                                    <th scope="col">Cidade</th>
                                    <th scope="col">Bairro</th>
                                    <th scope="col">Logradouro</th>
                                    <th scope="col">Complemento</th>
                                    <th scope="col">Número</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="client in clients" :key="client.id">
                                    <th scope="row">#{{ client.id }}</th>
                                    <td>{{ client.desname }}</td>
                                    <td>{{ client.desemail }}</td>
                                    <td>{{ client.desdocument }}</td>
                                    <td>{{ client.dtbirth_ }}</td>
                                    <td>{{ client.descep }}</td>
                                    <td>{{ client.descidade }}</td>
                                    <td>{{ client.desbairro }}</td>
                                    <td>{{ client.deslogradouro }}</td>
                                    <td>{{ client.descomplemento }}</td>
                                    <td>{{ client.desnumero }}</td>
                                    <td>
                                        <a class="btn btn-danger" v-on:click='delete_client(client.id)'>Excluir</a>
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
            clients: []
        }
    },
    mounted() {
        this.getClients();
    },
    methods: {
        /**
         * @author Vitor Hugo
         * @version 1.0
         * @param {int} id
         * @returns {void}
         * @description Delete a client
        */
        delete_client(id){
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
                    axios.delete('/api/client/delete/' + id)
                    .then(response => {
                        Swal.fire(
                            'Excluído!',
                            'O cliente foi excluído com sucesso.',
                            'success'
                        )
                        this.getClients();
                    })
                    .catch(error => {
                        Swal.fire(
                            'Erro!',
                            'Ocorreu um erro ao excluir o cliente.',
                            'error'
                        )
                    })
                }
            })
        },
        /**
         * @author Vitor Hugo
         * @version 1.0
         * @returns {void}
         * @description Get all clients
        */
        getClients() {
            Swal.fire({
                title: 'Carregando..',
                html: 'Aguarde enquanto recebemos as informações.',
                didOpen: () => {
                    Swal.showLoading()
                        axios.get('/api/client/list')
                        .then(response => {
                            //stop loading
                            Swal.close();
                            this.clients = response.data;
                        })
                        .catch(error => {
                            Swal.fire(
                                'Erro!',
                                'Ocorreu um erro ao carregar os clientes.',
                                'error'
                            )
                        });
                }})
        }
    }
}
</script>
