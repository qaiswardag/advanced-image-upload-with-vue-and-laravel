import {createStore} from 'vuex';
import create from "./modules/create";


const store = createStore({
    modules: {
        create: create,
    },
});

export default store;
