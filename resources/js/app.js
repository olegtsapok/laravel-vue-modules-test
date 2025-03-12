import './bootstrap';

import { createApp } from 'vue'
import axios from 'axios';

import Navigation from './Components/Navigation.vue'
import Pages from './Components/Pages.vue'
import Login from './Components/LoginPage.vue'
import Dashboard from './Components/DashboardPage.vue'
import Modules from './Components/ModulesPage.vue'

const app = createApp({})

app.component('Navigation', Navigation)
app.component('Pages', Pages)
app.component('Login', Login)
app.component('Dashboard', Dashboard)
app.component('Modules', Modules)

app.mount('#app')