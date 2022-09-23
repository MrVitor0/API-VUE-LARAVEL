<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card" >
                    <div class="card-header">
                        <h3 class="card-title text-center">Cadastro de Pedidos</h3>
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="submit">
                            <div class="form-group ">
                                <label for="desname">Cliente</label>
                                <select class="form-control" v-model="form.customer_id">
                                    <option value="" disabled>Selecione um cliente</option>
                                    <option v-for="customer in customers" :value="customer.id">{{customer.desname}}</option>
                                </select>
                            </div>
                            <div class="form-group pt-3">
                                <label for="desname">Produtos</label>
                                <Multiselect
                                mode="tags"
                                v-model="form.products_id"
                                placeholder="Selecione um ou mais produtos"
                                label="name"
                                :options="this.products"
                                >
                                <template v-slot:singlelabel="{ value }">
                                    <div class="multiselect-single-label" price="{{value.desprice}}">
                                    {{ value.name }}
                                    </div>
                                </template>
                                <template v-slot:option="{ option }">
                                   {{ option.name }}
                                </template>
                                </Multiselect>
                            </div>
                            <br>
                            <br>
                            <div class="text-center">
                             <button type="submit" class="btn btn-primary btn-block  ">Cadastrar</button>
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
import Multiselect from '@vueform/multiselect'
export default {
    components: {
      Multiselect,
    },
    created() {
        this.getClients();
        this.getProducts();
    },
    data() {
        return {
            value: null,
            form: {
                customer_id: '',
                products_id: [],
            },
            customers: [],
            products: [],
            desname: '',
            desprice: ''
        }
    },
    methods: {
        /**
         * @author Vitor Hugo
         * @version 1.0
         * @returns {void}
         * @description Get list of products
        */
        getProducts() {
            axios.get('/api/product/list')
                .then(response => {
                    // foreach response.data append values to this.products in format item.id : item.desname
                    response.data.forEach(element => {
                         //push { value: element.id, name: element.desname, price: element.desprice }, to this.products
                          this.products.push({ value: element.id, name: element.desname, price: element.desprice });
                    });
                })
                .catch(error => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Erro ao carregar produtos!',
                    })
                })
        },
        /**
         * @author Vitor Hugo
         * @version 1.0
         * @returns {void}
         * @description Get Clients list
        */
        getClients() {
            axios.get('/api/client/list', { params: ['id','desname'] } )
                .then(response => {
                    this.customers = response.data;
                })
                .catch(error => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Erro ao carregar clientes!',
                    })
                })
        },
        /**
         * @author Vitor Hugo
         * @version 1.0
         * @returns {void}
         * @description Format price to BRL
        */
        format_price(){
             this.desprice = parseFloat(this.desprice).toLocaleString('pt', {
                style: 'decimal',
                decimal: ',',
                thousands: '.',
                maximumFractionDigits: 2,
                minimumFractionDigits: 2
            });
            this.desprice == undefined || this.desprice == null || this.desprice == 'NaN' ? this.desprice = '' : this.desprice = this.desprice;
        },
        /**
         * @author Vitor Hugo
         * @version 1.0
         * @returns {void}
         * @description Submit a form to create a new sell
        */
        submit(){
            //verify if form is valid
            if (this.form.customer_id == '' || this.form.products_id == []) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Preencha todos os campos!',
                    })
                } else {
                    //send form to api
                    var that = this;
                    //convert this.form.products_id to json
                    axios.post('/api/sell/create', {
                            idclient: this.form.customer_id,
                            desproducts: JSON.stringify(this.form.products_id),
                        })
                        .then(function (response) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Produto cadastrado com sucesso!',
                                showConfirmButton: true,
                                timer: 1500
                            })
                            //redirect to client_list
                            that.$router.push({ name: 'sell_list' })
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
    }
}
</script>
<style src="@vueform/multiselect/themes/default.css"></style>