import './bootstrap';

import { createApp } from 'vue'
import axios from 'axios';

import Navigation from './Components/Navigation.vue'

import Pages from './Components/Pages.vue'

import Dashboard from './Components/DashboardPage.vue'

import Modules from './Components/ModulesPage.vue'
import MainModule from './Components/Modules/MainModule.vue'
import BgModule from './Components/Modules/BgModule.vue'
import TypoModule from './Components/Modules/TypoModule.vue'

const app = createApp({})

app.component('Navigation', Navigation)

app.component('Pages', Pages)

app.component('Dashboard', Dashboard)

app.component('Modules', Modules)
app.component('MainModule', MainModule)
app.component('BgModule', BgModule)
app.component('TypoModule', TypoModule)

app.mount('#app')
