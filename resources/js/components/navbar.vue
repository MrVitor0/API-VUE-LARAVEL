<template>
  <!-- Vertical navbar -->
 <div class="vertical-nav bg-white" id="sidebar">
     <div class="py-4 px-3 mb-4 bg-light">
       <div class="media d-flex align-items-center">
         <div class="media-body">
           <h4 class="m-1">Admin</h4>
           <p class="font-weight-light text-muted m-1">WK Technology</p>
         </div>
       </div>
     </div>
     <p class="text-gray font-weight-bold text-uppercase px-3 small pb-2 mb-0">Menu Inicial</p>
     <ul class="nav flex-column bg-white mb-0">
          <li class="nav-item">
              <router-link :to="{name: 'home'}" class="nav-link text-dark font-italic bg-light">
                    Início
              </router-link>
          </li>
     </ul>
      <p class="text-gray font-weight-bold text-uppercase px-3 pt-2 small pb-1 mb-0">Clientes</p>
      <ul class="nav flex-column bg-white mb-0">
          <li class="nav-item">
              <router-link :to="{name: 'client_list'}" class="nav-link text-dark font-italic bg-light">
                Listar
              </router-link>
          </li>
          <li class="nav-item">
              <router-link :to="{name: 'client_register'}" class="nav-link text-dark font-italic bg-light">
                Cadastrar
              </router-link>
          </li>
      </ul>
      <p class="text-gray font-weight-bold text-uppercase px-3 pt-2 small pb-1 mb-0">Produtos</p>
      <ul class="nav flex-column bg-white mb-0">
          <li class="nav-item">
              <router-link :to="{name: 'product_list'}" class="nav-link text-dark font-italic bg-light">
                Listar
              </router-link>
          </li>
          <li class="nav-item">
              <router-link :to="{name: 'product_register'}" class="nav-link text-dark font-italic bg-light">
                Cadastrar
              </router-link>
          </li>
      </ul>
      <p class="text-gray font-weight-bold text-uppercase px-3 pt-2 small pb-1 mb-0">Pedidos</p>
      <ul class="nav flex-column bg-white mb-0">
          <li class="nav-item">
              <router-link :to="{name: 'sell_list'}" class="nav-link text-dark font-italic bg-light">
                Listar
              </router-link>
          </li>
      </ul>

   </div>
   <!-- End vertical navbar -->
 </template>
 <script>
 //Bootstrap and jQuery libraries
 import 'bootstrap/dist/css/bootstrap.min.css';
 import 'bootstrap/dist/js/bootstrap.min.js';
 import 'jquery/dist/jquery.slim.min.js';
 import 'popper.js/dist/umd/popper.min.js';
 import 'jquery/dist/jquery.min.js';
 import '../style/navbar.css';

 export default {
  //usar o slot para importar conteudo
   mounted(){

   },
 }
 </script>