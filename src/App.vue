<template>
  <div class="home">

    <CategoryListLocal :categories="categories" />
    <PromotionListLocal :promotions="promotions" />

  </div>
</template>

<script>
import axios from "axios";

import CategoryList from "./components/CategoryComponent.vue";
import PromotionList from "./components/PromotionComponent.vue";

export default {
  name: "Home",

  components: {
    CategoryListLocal: CategoryList,
    PromotionListLocal: PromotionList,
  },

  data() {
    return {
      categories: [], 
      promotions: []  
    };
  },

  methods: {
    async fetchCategories() {
      try {
        const res = await axios.get("http://localhost:3000/api/categories");
        this.categories = res.data;   
        console.log("Loaded categories:", this.categories);
      } catch (err) {
        console.error("Error loading categories:", err);
      }
    },

    async fetchPromotions() {
      try {
        const res = await axios.get("http://localhost:3000/api/promotions");
        this.promotions = res.data;
        console.log("Loaded promotions:", this.promotions);
      } catch (err) {
        console.error("Error loading promotions:", err);
      }
    },
  },

  mounted() {
   
    this.fetchCategories();
    this.fetchPromotions();
  }
};
</script>

<style scoped>
.home {
  max-width: 1200px;
  margin: auto;
  padding: 40px 20px;
}
</style>