import { defineStore } from 'pinia'
import axios from 'axios'

export const useAuthStore = defineStore('auth', {
  state: () => ({
    user: JSON.parse(localStorage.getItem('user')) || null,
    token: localStorage.getItem('token') || '',
  }),

  actions: {
    async login(credentials) {
      try {
        const response = await axios.post('/api/login', credentials)

        this.token = response.data.token
        this.user = response.data.user

        localStorage.setItem('token', this.token)
        localStorage.setItem('user', JSON.stringify(this.user))

        // Set Authorization header for future requests
        axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`
      } catch (error) {
        console.error('Login failed:', error.response?.data?.message || error.message)
        throw error // Rethrow error for handling in the UI
      }
    },

    logout() {
      this.token = ''
      this.user = null

      localStorage.removeItem('token')
      localStorage.removeItem('user')

      delete axios.defaults.headers.common['Authorization']
    },

    async fetchUser() {
      if (!this.token) return

      try {
        const response = await axios.get('/api/user', {
          headers: { Authorization: `Bearer ${this.token}` },
        })

        this.user = response.data
        localStorage.setItem('user', JSON.stringify(this.user))
      } catch (error) {
        console.error('Failed to fetch user:', error)
        this.logout() // Logout if token is invalid
      }
    },
  },
})
