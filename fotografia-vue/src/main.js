import { createApp } from 'vue'
import App from './App.vue'

import router from './router/router'

import { library } from '@fortawesome/fontawesome-svg-core'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { faChevronDown, faEnvelope, faPhone, faStar, faUser } from '@fortawesome/free-solid-svg-icons'
import { faFacebook, faInstagram} from '@fortawesome/free-brands-svg-icons'
library.add(faEnvelope, faPhone, faFacebook, faInstagram, faStar, faChevronDown, faUser)

createApp(App).component('font-awesome-icon', FontAwesomeIcon).use(router).mount('#app')    
