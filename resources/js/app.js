import './bootstrap';
import {createApp} from 'vue'
import router from './vue/router'
import vuex from './vue/store'


// import vue components
import Posts from "./vue/components/Posts";

// create app
createApp({
    components: {
        // 'posts': Posts,
    }
})
    .use(router)
    .use(vuex)
    .mount('#app')
