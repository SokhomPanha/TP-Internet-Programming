<template>
  <div class="categories-wrapper">
    <div class="categories">
      <div
        class="category-card"
        v-for="(cat, index) in categories"
        :key="index"
        :style="{ backgroundColor: cat.color }"
      >
        <img :src="`http://localhost:3000/${cat.image}`" :alt="cat.name" />
        <h4>{{ cat.name }}</h4>
        <p>{{ cat.productCount }} items</p>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "CategoryList",
  props: {
    categories: Array
  }
};
</script>

<style scoped>
.categories-wrapper {
 
  padding-bottom: 15px;
}

.categories {
  display: flex;
  gap: 20px;
  min-width: max-content;
}

.category-card {
  min-width: 110px;
  text-align: center;
  padding: 18px;
  border-radius: 10px;
  transition: 0.3s;
  border: 1px solid #eee;
}

.category-card img {
  width: 60px;
  height: 60px;
  margin-bottom: 8px;
}

.category-card h4 {
  font-size: 14px;
  font-weight: 600;
}

.category-card p {
  font-size: 12px;
  color: gray;
}

.category-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 6px 20px rgba(0,0,0,0.1);
}
</style>