<script setup>
import { RouterLink, RouterView } from 'vue-router';
import { ref, computed } from 'vue';

const isDarkMode = ref(false);
const menuOpen = ref(false);
const searchQuery = ref('');
const newItemName = ref('');
const showAddForm = ref(false);

// Initial wardrobe items
const wardrobeItems = ref([
  { id: 1, name: 'Blue Slim Jeans', category: 'Bottoms', imageUrl: 'https://picsum.photos/400/300?random=2' },
  { id: 2, name: 'Green Fedora', category: 'Accessories', imageUrl: 'https://picsum.photos/400/300?random=3' },
  { id: 3, name: 'Yellow Sundress', category: 'Accessories', imageUrl: 'https://picsum.photos/400/300?random=4' },
  { id: 4, name: 'Red Tee', category: 'Tops', imageUrl: 'https://picsum.photos/400/300?random=5' },
  { id: 5, name: 'Navy Blazer', category: 'Tops', imageUrl: 'https://picsum.photos/400/300?random=6' },
  { id: 6, name: 'Black Shorts', category: 'Bottoms', imageUrl: 'https://picsum.photos/400/300?random=7' },
  { id: 7, name: 'White Sneakers', category: 'Shoes', imageUrl: 'https://picsum.photos/400/300?random=8' },
  { id: 8, name: 'Brown Loafers', category: 'Shoes', imageUrl: 'https://picsum.photos/400/300?random=9' },
  { id: 9, name: 'Silver Watch', category: 'Accessories', imageUrl: 'https://picsum.photos/400/300?random=10' },
]);

// Computed property for filtered items
const filteredItems = computed(() => {
  return wardrobeItems.value.filter(item =>
    item.name.toLowerCase().includes(searchQuery.value.toLowerCase())
  );
});

// Functions
const toggleTheme = () => {
  isDarkMode.value = !isDarkMode.value;
};

const toggleMenu = () => {
  menuOpen.value = !menuOpen.value;
};

const closeMenu = () => {
  menuOpen.value = false;
};

const toggleAddForm = () => {
  showAddForm.value = !showAddForm.value;
  newItemName.value = ''; // Reset input when opening/closing
};

const addItem = () => {
  if (newItemName.value.trim()) {
    const newId = wardrobeItems.value.length + 1;
    wardrobeItems.value.push({
      id: newId,
      name: newItemName.value,
      category: 'Uncategorized', // Default category (can be expanded later)
      imageUrl: `https://picsum.photos/400/300?random=${newId}`, // Random image for new item
    });
    newItemName.value = '';
    showAddForm.value = false; // Close form after adding
  }
};
</script>

<template>
  <div class="flex flex-col min-h-screen bg-zinc-100 dark:bg-gray-900 text-gray-900 dark:text-white">
    <!-- Header with Navbar -->
    <header class="shadow-lg">
      <nav class="bg-gradient-to-r from-zinc-800 via-gray-700 to-zinc-900 text-white">
        <div class="container mx-auto px-6 py-4 flex items-center justify-between">
          <RouterLink to="/" class="flex items-center space-x-3">
            <img
              src="https://picsum.photos/48/48?random=1"
              alt="Kevin Wardrobe Logo"
              class="w-12 h-12 rounded-full border-2 border-gray-300 shadow-md animate-subtle-bounce"
            />
            <span class="text-2xl font-serif font-bold tracking-wider uppercase">Kevin Wardrobe</span>
          </RouterLink>

          <button
            class="md:hidden text-white focus:outline-none"
            @click="toggleMenu"
            aria-label="Toggle navigation"
          >
            <svg class="w-8 h-8 animate-spin-slow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path v-if="!menuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
              <path v-else stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>

          <div :class="{ 'hidden': !menuOpen, 'block': menuOpen }" class="md:flex md:items-center space-y-4 md:space-y-0 md:space-x-8 mt-4 md:mt-0">
            <RouterLink to="/" class="block text-lg font-serif hover:text-gray-300 transition-colors" @click="closeMenu">Home</RouterLink>
            <RouterLink to="/dashboard" class="block text-lg font-serif hover:text-gray-300 transition-colors" @click="closeMenu">Dashboard</RouterLink>
            <span class="block text-lg font-serif text-gray-300 cursor-pointer hover:text-white transition-colors" @click="closeMenu">Login</span>
            <span class="block text-lg font-serif text-gray-300 cursor-pointer hover:text-white transition-colors" @click="closeMenu">Register</span>
            <span class="block text-lg font-serif text-gray-300 cursor-pointer hover:text-white transition-colors" @click="closeMenu">Logout</span>
            <button @click="toggleTheme" class="p-2 rounded-full bg-gray-200 text-gray-800 hover:bg-gray-300 transition-colors animate-spin-slow" :class="{ 'bg-gray-700 text-white': isDarkMode }">
              <svg v-if="isDarkMode" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" />
              </svg>
              <svg v-else class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 2a8 8 0 100 16 8 8 0 000-16zm0 14a6 6 0 110-12 6 6 0 010 12z" clip-rule="evenodd" />
              </svg>
            </button>
          </div>
        </div>
      </nav>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-6 py-12 flex-grow">
      <!-- Search and Category Dropdown -->
      <div class="flex flex-col md:flex-row gap-6 mb-12">
        <div class="relative flex-grow">
          <input
            v-model="searchQuery"
            type="text"
            placeholder="Search your wardrobe..."
            class="w-full p-4 rounded-md border border-gray-300 bg-white/80 dark:bg-gray-800/80 dark:border-gray-700 text-gray-900 dark:text-white shadow-sm focus:outline-none focus:ring-2 focus:ring-amber-600 animate-fade-in"
          />
          <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
          </svg>
        </div>
        <div class="relative">
          <select
            class="w-full md:w-64 p-4 rounded-md border border-gray-300 bg-white/80 dark:bg-gray-800/80 dark:border-gray-700 text-gray-900 dark:text-white shadow-sm focus:outline-none focus:ring-2 focus:ring-amber-600 appearance-none animate-fade-in"
            disabled
          >
            <option>All Categories</option>
            <option>Tops - Red Tee, Navy Blazer</option>
            <option>Bottoms - Blue Slim Jeans, Black Shorts</option>
            <option>Shoes - White Sneakers, Brown Loafers</option>
            <option>Accessories - Green Fedora, Yellow Sundress, Silver Watch</option>
          </select>
          <svg class="absolute right-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
          </svg>
        </div>
      </div>

      <!-- Wardrobe Preview (Dashboard) -->
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
        <div v-for="item in filteredItems" :key="item.id" class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg hover:shadow-xl transition-all animate-slide-up">
          <img :src="item.imageUrl" :alt="item.name" class="w-full h-48 object-cover rounded-md mb-4" />
          <h3 class="text-xl font-serif font-semibold">{{ item.name }}</h3>
          <p class="text-sm" :class="{ 'text-gray-400': isDarkMode, 'text-gray-600': !isDarkMode }">{{ item.category }}</p>
          <div class="mt-4 flex space-x-4">
            <button class="text-amber-600 hover:text-amber-800 text-sm font-serif">Edit</button>
            <button class="text-red-600 hover:text-red-800 text-sm font-serif">Delete</button>
          </div>
        </div>
      </div>

      <!-- Add Clothing Button and Form -->
      <div class="flex justify-center mb-12">
        <button @click="toggleAddForm" class="bg-gradient-to-r from-amber-600 to-amber-800 text-white px-8 py-3 rounded-md font-serif font-semibold hover:from-amber-700 hover:to-amber-900 transition-colors animate-subtle-wiggle">
          + Add Clothing
        </button>
      </div>

      <!-- Add Item Form (Popup Style) -->
      <div v-if="showAddForm" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 animate-fade-in">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg w-full max-w-md">
          <h3 class="text-xl font-serif font-semibold mb-4">Add New Item</h3>
          <input
            v-model="newItemName"
            type="text"
            placeholder="Item Name"
            class="w-full p-3 mb-4 rounded-md border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-amber-600"
          />
          <div class="flex space-x-4">
            <button @click="addItem" class="bg-amber-600 text-white px-4 py-2 rounded-md font-serif hover:bg-amber-700 transition-colors">Add</button>
            <button @click="toggleAddForm" class="bg-gray-300 text-gray-900 px-4 py-2 rounded-md font-serif hover:bg-gray-400 transition-colors">Cancel</button>
          </div>
        </div>
      </div>

      <!-- Router View for Dynamic Content -->
      <RouterView />
    </main>

    <!-- Footer -->
    <footer class="bg-gradient-to-r from-zinc-900 to-gray-800 text-white text-center py-6">
      <p class="font-serif text-sm tracking-wide">© 2025 Kevin Wardrobe Management. All rights reserved.</p>
    </footer>
  </div>
</template>

<style scoped>
.transition-colors {
  transition: color 0.2s ease, background-color 0.2s ease;
}

.transition-all {
  transition: all 0.3s ease;
}

/* Animations */
.animate-subtle-bounce {
  animation: subtleBounce 3s infinite;
}

.animate-subtle-wiggle {
  animation: subtleWiggle 2s infinite;
}

.animate-fade-in {
  animation: fadeIn 1s ease-in;
}

.animate-slide-up {
  animation: slideUp 0.8s ease-out;
}

.animate-spin-slow {
  animation: spin 10s linear infinite;
}

@keyframes subtleBounce {
  0%, 100% { transform: translateY(0); }
  50% { transform: translateY(-5px); }
}

@keyframes subtleWiggle {
  0%, 100% { transform: rotate(-1deg); }
  50% { transform: rotate(1deg); }
}

@keyframes fadeIn {
  from { opacity: 0; }
  to { opacity: 1; }
}

@keyframes slideUp {
  from { transform: translateY(30px); opacity: 0; }
  to { transform: translateY(0); opacity: 1; }
}

@keyframes spin {
  from { transform: rotate(0deg); }
  to { transform: rotate(360deg); }
}

/* Louis Vuitton-inspired Styling */
.font-serif {
  font-family: 'Times New Roman', Times, serif;
}

.shadow-md:hover {
  transform: scale(1.02);
}

@media (max-width: 768px) {
  .md\:flex {
    display: none;
  }
  .block {
    display: block;
  }
  .space-y-4 {
    padding-bottom: 1rem;
  }
}
</style>