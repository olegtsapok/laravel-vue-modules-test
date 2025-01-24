import './bootstrap';

import { createApp } from 'vue'
import axios from 'axios';

import Modules from './Components/Modules.vue'
import MainModule from './Components/Modules/MainModule.vue'
import BgModule from './Components/Modules/BgModule.vue'
import TypoModule from './Components/Modules/TypoModule.vue'

const app = createApp({})

app.component('Modules', Modules)
app.component('MainModule', MainModule)
app.component('BgModule', BgModule)
app.component('TypoModule', TypoModule)

app.mount('#app')