<template>
  <div class="banners">
    <div
      class="banner-card"
      v-for="(promo, index) in promotions"
      :key="index"
      :style="{ backgroundColor: promo.color }"
    >
      <div>
        <h3>{{ promo.title }}</h3>
        <button :style="{ backgroundColor: promo.buttonColor } " @click="shopnow(promo)"     >
          Shop Now →
        </button>
      </div>

      <img :src="`http://localhost:3000/${promo.image}`" :alt="promo.title" />
    </div>
  </div>
</template>

<script>
export default {
  name: "PromotionList",
  props: { promotions: Array },
  methods: {
    shopnow(promo) {
      alert("let's shop from: " + promo.title);
    }
  }
};
</script>

<style scoped>
.banners {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 20px;
}

.banner-card {
  display: flex;
  justify-content: space-between;
  padding: 35px;
  border-radius: 15px;
  align-items: center;
}

.banner-card h3 {
  width: 60%;
  color: #1c1c1c;
  line-height: 1.3;
}

.banner-card button {
  color: #fff;
  border: none;
  padding: 8px 20px;
  border-radius: 30px;
  cursor: pointer;
  margin-top: 10px;
}

.banner-card img {
  width: 150px;
  height: auto;
}

@media (max-width: 768px) {
  .banners {
    grid-template-columns: 1fr;
  }
}
</style>
