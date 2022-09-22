require('./bootstrap')

import { createApp } from 'vue'
import router from './router/index' // <---

//create app and use router
const app = createApp({})
app.use(router) // <---

//mount in component template with id="app"
app.mount('#app')
