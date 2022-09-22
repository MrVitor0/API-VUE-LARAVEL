<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card text-center" >
                    <div class="card-header">
                        <h3 class="card-title">Listagem de Clientes</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nome</th>
                                    <th scope="col">E-mail</th>
                                    <th scope="col">Telefone</th>
                                    <th scope="col">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="client in clients" :key="client.id">
                                    <th scope="row">@{{ client.id }}</th>
                                    <td>@{{ client.name }}</td>
                                    <td>@{{ client.email }}</td>
                                    <td>@{{ client.phone }}</td>
                                    <td>
                                        <a class="btn btn-primary" :href="'/client/edit/' + client.id">Editar</a>
                                        <a class="btn btn-danger" :href="'/client/delete/' + client.id">Excluir</a>
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
        getClients() {
            //return array of clients
            this.clients = [
                {
                    id: 1,
                    name: 'Vitor Hugo',
                    email: 'vto.hugo67@gmail.com',
                    phone: '(11) 9 9999-9999'
                }
            ]
            // axios.get('/api/client')
            //     .then(response => {
            //         this.clients = response.data;
            //     })
            //     .catch(error => {
            //         console.log(error);
            //     });
        }
    }
}
</script>
