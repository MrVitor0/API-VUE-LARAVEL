require('./bootstrap')

import { createApp } from 'vue'
import router from './router/index' // <---
import navbar from './components/navbar.vue' // <---

//create app and use router
const app = createApp({})
app.use(router) // <---
//send navbar to app
app.component('navbar', navbar) // <---

//mount in component template with id="app"
app.mount('#app')
