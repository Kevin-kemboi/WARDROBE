<template>
  <form @submit.prevent="login">
    <input v-model="email" type="email" placeholder="Email" required />
    <input v-model="password" type="password" placeholder="Password" required />
    <button type="submit">Login</button>
  </form>
</template>

<script setup>
import { ref } from 'vue'
import { useAuthStore } from '@/stores/auth.js'
const email = ref('')
const password = ref('')
const authStore = useAuthStore()

const login = async () => {
  await authStore.login({ email: email.value, password: password.value })
}
</script>
