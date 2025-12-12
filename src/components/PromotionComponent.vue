<template>
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 p-4">
    <div
      v-for="(promo, index) in promotions"
      :key="index"
      :style="{ backgroundColor: promo.color }"
      class="flex justify-between items-center p-8 rounded-2xl transform transition-all duration-500 hover:scale-[1.02] hover:-translate-y-1 hover:shadow-xl cursor-pointer group opacity-0 animate-fadeIn"
    > 
      <!-- LEFT CONTENT -->
      <div class="flex flex-col transition-all duration-300 group-hover:translate-x-1">
        <h3 class="w-3/5 text-gray-900 text-lg font-semibold leading-snug mb-3">
          {{ promo.title }}
        </h3>

        <button 
          class="text-white border-0 px-5 py-2 rounded-full cursor-pointer mt-2 inline-flex items-center gap-2 transition-all duration-300 hover:scale-105 hover:shadow-lg active:scale-95 relative overflow-hidden"
          :style="{ backgroundColor: promo.buttonColor }"
          @click="shopnow(promo)"
        >
          <span>Shop Now →</span>
        </button>
      </div>

      <!-- RIGHT IMAGE -->
      <img 
        :src="`http://localhost:3000/${promo.image}`" 
        :alt="promo.title"
        class="w-70 h-55 rounded-md transition-transform duration-700 ease-out group-hover:scale-110"
      />
    </div>
  </div>
</template>

<script>
export default {
  name: "PromotionList",
  props: { 
    promotions: Array 
  },
  methods: {
    shopnow(promo) {
      alert("Let's shop from: " + promo.title);
    }
  }
};
</script>

<style scoped>
/* Fade-in animation */
@keyframes fadeIn {
  0% { opacity: 0; transform: translateY(10px); }
  100% { opacity: 1; transform: translateY(0); }
}

.animate-fadeIn {
  animation: fadeIn 0.6s ease-out forwards;
}
</style>
