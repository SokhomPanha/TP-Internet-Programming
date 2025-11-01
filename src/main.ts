import './assets/main.css'

import { createApp } from 'vue'
import App from './App.vue'
import CategoryComponent from '@/components/CategoryComponent.vue'
import PromotionComponent from '@/components/PromotionComponent.vue'

createApp(App)
  .component('CategoryComponent', CategoryComponent)
  .component('PromotionComponent', PromotionComponent)
  .mount('#app')
