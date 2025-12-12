<script>
export default {
  name: "GroupProducts",
  methods: {
    finalPrice(pro) {
      if (typeof pro.promotionAsPercentage === "number" && pro.promotionAsPercentage > 0) {
        return (pro.price - (pro.price * pro.promotionAsPercentage) / 100).toFixed(2);
      }
      return pro.price.toFixed(2);
    },
    star(rating) {
      const nostar = 5 - rating;
      if(rating<5){
        return "⭐".repeat(rating)+"☆".repeat(nostar);
      }else if(rating==5){
        return "⭐".repeat(rating);
      }
      return "⭐".repeat(rating);
    },
    extract_img(input) {
      if (!input) return "";  
      try {
        const arr = JSON.parse(input);
        return Array.isArray(arr) && arr.length > 0 ? arr[0] : "";
      } catch (e) {
        return input.replace('["', "").replace('"]', "").split('","')[0] || "";
      }
    },
    shopnow(pro){
      alert("Product "+pro.name+" add to cart");
    }
  },
  props: {
    product: Array
  },
};
</script>

<template>
  <div class="grid xl:grid-cols-5 gap-4 p-4">
    <div 
      v-for="(pro, index) in product"
      :key="index"
      class="bg-white rounded-lg shadow-md w-[320px] h-[450px] flex flex-col gap-4 border-1 border-[#BCE3C9] transition-all duration-300 hover:shadow-xl hover:scale-[1.02] hover:-translate-y-1"
    >
      <!-- BADGE -->
      <div v-if="pro.promotionAsPercentage>0" class="bg-[#3BB77E] w-[60px] h-[35px] mt-6 rounded-r-full flex justify-center items-center transition-transform duration-300 transform hover:scale-105">
        <h3 class="text-white">-{{ pro.promotionAsPercentage }}%</h3>
      </div>
      <div v-else-if="pro.promotionAsPercentage==0" class="bg-[#FFFFFF] w-[60px] h-[35px] mt-6 rounded-r-full flex justify-center items-center"></div>
      <div v-else-if="pro.promotionAsPercentage==='Hot'" class="bg-[#FD6E6E] w-[60px] h-[35px] mt-6 rounded-r-full flex justify-center items-center transition-transform duration-300 transform hover:scale-105">
        <h3 class="text-white">hot</h3>
      </div>
      <div v-else-if="pro.promotionAsPercentage==='Sale'" class="bg-[#F6C851] w-[60px] h-[35px] mt-6 rounded-r-full flex justify-center items-center transition-transform duration-300 transform hover:scale-105">
        <h3 class="text-white">sale</h3>
      </div>
      
      <!-- IMAGE -->
      <div class="w-[250px] h-[150px] object-cover bg-white-500 mx-auto overflow-hidden rounded-md transition-transform duration-500 hover:scale-105">
        <img 
          :src="`http://localhost:3000/${extract_img(pro.image)}`" 
          :alt="pro.name" 
          class="w-full h-full object-cover transition-transform duration-500 hover:scale-110"
        >        
      </div>
      
      <!-- CONTENT -->
      <div class="ml-8 mr-8 flex flex-col flex-grow">  
        <!-- type --> 
        <div class="text-[#7E7E7E]">
          <h4>{{ pro.group || 'Hodo Foods' }}</h4>
        </div>
        
        <!-- title -->
        <div class="text-black font-[Quicksand] mt-1"> 
          <h2>{{ pro.name }}</h2>
        </div>
        
        <!-- star -->
        <div class="flex flex-row gap-5 mt-2">
          <div>
            <h4>{{ star(pro.rating) }}</h4>
          </div>
          <div>
            <h4>({{ pro.rating }})</h4>
          </div>
        </div>
        
        <!-- kg -->
        <div class="text-[#7E7E7E] mt-2">
          <h6>{{ pro.size }}</h6>
        </div>
        
        <!-- price -->
        <div class="flex flex-row mt-auto mb-3 items-center">
          <div class="text-[20px] flex items-end text-[#3BB77E] font-[Quicksand]">
            <span>${{ finalPrice(pro) }}</span>
          </div>
          <div class="text-[13px] flex items-end ml-3 line-through text-[#7E7E7E]">
            <h1>$2.80</h1>
          </div>
          <div class="ml-auto">
            <div 
              class="counter-container gap-3 flex items-center justify-center bg-[#DEF9EC] rounded-lg h-[30px] w-[80px] transition-transform duration-200 hover:scale-105 cursor-pointer"
              @click="shopnow(pro)"
            >
              <h1 class="text-[#3BB77E]">add</h1>   
              <svg class="w-[20px] h-[20px] text-[#3BB77E]" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"/>
              </svg>            
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
.counter-container button {
  cursor: pointer;
  transition: background-color 0.2s;
}
.counter-container button:active {
  background-color: #e0e0e0;
}
</style>
