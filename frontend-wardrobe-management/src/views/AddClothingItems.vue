<template>
  <div class="container mt-5">
    <div class="card shadow-lg p-4">
      <h2 class="mb-4 text-center">Add Clothing Item</h2>

      <form @submit.prevent="submitForm" enctype="multipart/form-data">
        <!-- Name -->
        <div class="mb-3">
          <label for="name" class="form-label">Name:</label>
          <input type="text" id="name" class="form-control" v-model="form.name" required />
        </div>

        <!-- Category -->
        <div class="mb-3">
          <label for="category" class="form-label">Category:</label>
          <select id="category" class="form-control" v-model="form.category" required>
            <option disabled value="">Select Category</option>
            <option value="top">Top</option>
            <option value="bottom">Bottom</option>
            <option value="shoes">Shoes</option>
          </select>
        </div>

        <!-- Image Upload -->
        <div class="mb-3">
          <label for="image" class="form-label">Image:</label>
          <input
            type="file"
            id="image"
            class="form-control"
            @change="handleFileUpload"
            accept="image/*"
          />
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary w-100">Submit</button>
      </form>
    </div>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  data() {
    return {
      form: {
        name: '',
        category: '',
        image: null,
      },
    }
  },
  methods: {
    handleFileUpload(event) {
      this.form.image = event.target.files[0]
    },
    async submitForm() {
      try {
        const formData = new FormData()
        formData.append('name', this.form.name)
        formData.append('category', this.form.category)
        if (this.form.image) {
          formData.append('image', this.form.image)
        }

        const response = await axios.post('/api/clothing-items', formData, {
          headers: { 'Content-Type': 'multipart/form-data' },
        })

        alert(response.data.message)
      } catch (error) {
        console.error('Error submitting form:', error)
        alert('Failed to add item. Please try again.')
      }
    },
  },
}
</script>

<style scoped>
.card {
  max-width: 500px;
  margin: auto;
  border-radius: 12px;
}
</style>
