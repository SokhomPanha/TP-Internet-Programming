<script lang="ts">
import type { list as ListItem, content as ContentItem } from "../views/type";

export default {
  name: "MenuComponent",
  data() {
    return {
      content: [
        { id: 0, name: "Home" },
        { id: 1, name: "Shop" },
      ] as ContentItem[],
      lists: [
        { id: 0, name: "All" },
        { id: 1, name: "Milks & Dairies" },
        { id: 2, name: "Coffees & Teas" },
        { id: 3, name: "Pet Foods" },
        { id: 4, name: "Meats" },
        { id: 5, name: "Vegetables" },
        { id: 6, name: "Fruits" },
      ] as ListItem[],
    };
  },
};
</script>

<template>
  <div class="w-full flex items-center justify-between py-4">
    <div>
      <h1 class="text-2xl font-semibold text-gray-800 m-0">Featured Categories</h1>
    </div>
    <nav>
      <ul class="flex items-center gap-6 m-0 p-0 list-none">
        <li
          v-for="item in lists"
          :key="item.id"
          class="text-gray-600 hover:text-green-500 cursor-pointer transition-colors duration-200 text-base font-medium"
        >
          {{ item.name }}
        </li>
      </ul>
    </nav>
  </div>
</template>

<style scoped>
ul li {
  font-size: 15px;
}


</style>