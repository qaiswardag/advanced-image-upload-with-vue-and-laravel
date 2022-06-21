import './bootstrap';
import {createApp} from 'vue'
import vuex from './vue/store'


// import vue components
import App from './vue/components/App'


// create app
createApp({
    components: {
        'app': App,
    }
})
    .use(vuex)
    .mount('#app')
