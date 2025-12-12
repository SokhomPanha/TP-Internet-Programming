import { defineStore } from 'pinia'
import axios from 'axios'

export const useProductStore = defineStore('product', {
  state: () => ({
    groups: [],
    promotions: [],
    categories: [],
    products: [],
  }),

  actions: {
    async loadGroups() {
      const res = await axios.get("http://localhost:3000/api/groups")
      this.groups = res.data
    },

    async loadPromotions() {
      const res = await axios.get("http://localhost:3000/api/promotions")
      this.promotions = res.data
    },

    async loadCategories() {
      const res = await axios.get("http://localhost:3000/api/categories")
      this.categories = res.data
    },

    async loadProducts() {
      const res = await axios.get("http://localhost:3000/api/products")
      this.products = res.data
    },

    async loadAll() {
      await Promise.all([
        this.loadGroups(),
        this.loadPromotions(),
        this.loadCategories(),
        this.loadProducts()
      ])
    }
  },

  getters: {
    // All categories formatted for display
    allCategories: (state) =>
      state.categories.map(c => ({
        title: c.name,
        imageSrc: `http://localhost:3000/${c.image}`,
        itemCount: c.productCount,
        bgColor: c.color,
        id: c.id
      })),

    // All promotions formatted for display
    allPromotions: (state) =>
      state.promotions.map(p => ({
        title: p.title,
        imageSrc: `http://localhost:3000/${p.image}`,
        bgColor: p.color,
        bgButtonColor: p.buttonColor,
      })),

    // All products formatted for display
    allProducts: (state) =>
      state.products.map((p) => {
        let images = [];
        try {
          images = JSON.parse(p.image);
        } catch (e) {
          console.error('Invalid image JSON for product', p.id);
        }
        return {
          id: p.id,
          title: p.name,
          rating: p.rating,
          size: p.size,
          image: images.length > 0 ? `http://localhost:3000/${images[0]}` : '',
          price: p.price,
          promotion: p.promotionAsPercentage,
          categoryId: p.categoryId,
        };
      }),

    // Popular products (countSold > 10)
    getPopularProducts: (state) =>
      state.products
        .filter(p => p.countSold > 10)
        .map((p) => {
          let images = [];
          try {
            images = JSON.parse(p.image);
          } catch (e) {
            console.error('Invalid image JSON for product', p.id);
          }
          return {
            id: p.id,
            title: p.name,
            rating: p.rating,
            size: p.size,
            image: images.length > 0 ? `http://localhost:3000/${images[0]}` : '',
            price: p.price,
            promotion: p.promotionAsPercentage,
            categoryId: p.categoryId,
          };
        }),

    // Get categories by group name
    getCategoriesByGroup: (state) => {
      return (groupName) => {
        const group = state.groups.find(g => g.name === groupName)
        if (!group) return []
        
        return state.categories
          .filter(c => c.groupId === group.id)
          .map(c => ({
            title: c.name,
            imageSrc: `http://localhost:3000/${c.image}`,
            itemCount: c.productCount,
            bgColor: c.color,
            id: c.id
          }))
      }
    },

    // Get products by group name
    getProductsByGroup: (state) => {
      return (groupName) => {
        const group = state.groups.find(g => g.name === groupName)
        if (!group) return []
        
        const categoryIds = state.categories
          .filter(c => c.groupId === group.id)
          .map(c => c.id)
        
        return state.products
          .filter(p => categoryIds.includes(p.categoryId))
          .map((p) => {
            let images = [];
            try {
              images = JSON.parse(p.image);
            } catch (e) {
              console.error('Invalid image JSON for product', p.id);
            }
            return {
              id: p.id,
              title: p.name,
              rating: p.rating,
              size: p.size,
              image: images.length > 0 ? `http://localhost:3000/${images[0]}` : '',
              price: p.price,
              promotion: p.promotionAsPercentage,
              categoryId: p.categoryId,
            };
          })
      }
    },

    // Get products by category ID
    getProductsByCategory: (state) => {
      return (categoryId) =>
        state.products
          .filter(p => p.categoryId === categoryId)
          .map((p) => {
            let images = [];
            try {
              images = JSON.parse(p.image);
            } catch (e) {
              console.error('Invalid image JSON for product', p.id);
            }
            return {
              id: p.id,
              title: p.name,
              rating: p.rating,
              size: p.size,
              image: images.length > 0 ? `http://localhost:3000/${images[0]}` : '',
              price: p.price,
              promotion: p.promotionAsPercentage,
              categoryId: p.categoryId,
            };
          })
    },
  },
})