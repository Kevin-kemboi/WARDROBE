<template>
  <div class="container mt-5">
    <h2 class="mb-4 text-center">👕 Wardrobe Collection</h2>

    <!-- Search Bar -->
    <div class="mb-3">
      <input
        v-model="search"
        type="text"
        class="form-control"
        placeholder="Search clothing items..."
      />
    </div>

    <!-- Responsive Table -->
    <div class="table-responsive">
      <table class="table table-bordered table-hover">
        <thead class="table-dark">
          <tr>
            <th scope="col">Image</th>
            <th scope="col">Name</th>
            <th scope="col">Category</th>
            <th scope="col">Color</th>
            <th scope="col">Size</th>
            <th scope="col">Brand</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="item in filteredItems" :key="item.id">
            <td>
              <img
                :src="item.image_url || 'https://via.placeholder.com/50'"
                alt="Clothing"
                class="img-thumbnail"
                width="50"
              />
            </td>
            <td>{{ item.name }}</td>
            <td>{{ item.category }}</td>
            <td>{{ item.color }}</td>
            <td>{{ item.size }}</td>
            <td>{{ item.brand || 'N/A' }}</td>
            <td>
              <button class="btn btn-danger btn-sm" @click="deleteItem(item.id)">🗑 Delete</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'
import axios from 'axios'

const search = ref('')
const items = ref([])

// Fetch clothing items from API
const fetchItems = async () => {
  try {
    const response = await axios.get('/api/clothing-items')
    items.value = response.data
  } catch (error) {
    console.error('Error fetching items:', error)
  }
}

// Delete an item
const deleteItem = async (id) => {
  if (confirm('Are you sure you want to delete this item?')) {
    try {
      await axios.delete(`/api/clothing-items/${id}`)
      items.value = items.value.filter((item) => item.id !== id) // Remove item from UI
      alert('Item deleted successfully')
    } catch (error) {
      console.error('Error deleting item:', error)
      alert('Failed to delete item')
    }
  }
}

// Fetch data when the component is mounted
onMounted(fetchItems)

// Computed property for filtering items
const filteredItems = computed(() =>
  items.value.filter((item) => item.name.toLowerCase().includes(search.value.toLowerCase())),
)
</script>

<style>
/* Custom styling (optional) */
.img-thumbnail {
  border-radius: 5px;
}
</style>
