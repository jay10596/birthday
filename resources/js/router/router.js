import Vue from 'vue';
import VueRouter from 'vue-router';

import ExampleComponent from '../components/ExampleComponent'
import CreateContact from '../components/views/CreateContact'
import DisplayContact from '../components/views/DisplayContact'
import EditContact from '../components/views/EditContact'
import Contacts from '../components/views/Contacts'
import Birthdays from '../components/views/Birthdays'
import Logout from '../components/views/Logout'


Vue.use(VueRouter);

export default new VueRouter({
    routes: [
        { 
            path: '/', component: ExampleComponent,
            meta: {title: 'Welcome'}
        },
        { 
            path: '/contacts', component: Contacts,
            meta: {title: 'List of contacts'}
        },
        { 
            path: '/birthdays', component: Birthdays,
            meta: {title: 'Birthdays'}
        },
        { 
            path: '/create', component: CreateContact,
            meta: {title: 'Add new contact'}
        },
        { 
            path: '/contacts/:id', component: DisplayContact,
            meta: {title: 'Details'}
        },
        { 
            path: '/contacts/:id/edit', component: EditContact,
            meta: {title: 'Edit contact'}
        },
        { 
            path: '/logout', component: Logout,
            meta: {title: 'Logout'}
        },
    ],
    mode: 'history',
    hash: false
});