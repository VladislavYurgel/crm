import VueRouter from 'vue-router'

/* Import vue js components */
import Example from './components/Example.vue'

export default new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            component: Example
        }
    ]
})