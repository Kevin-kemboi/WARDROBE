<template>
  <header class="header">
    <nav>
      <h1>Wardrobe Management</h1>
      <ul>
        <li><router-link to="/">Home</router-link></li>
        <li><router-link to="/clothing">Clothing Items</router-link></li>
        <li><router-link to="/add">Add Items</router-link></li>
      </ul>
    </nav>
  </header>
</template>

<script setup></script>

<style scoped>
.header {
  background: #333;
  color: white;
  padding: 1rem;
}
nav {
  display: flex;
  justify-content: space-between;
  align-items: center;
}
ul {
  list-style: none;
  display: flex;
  gap: 1rem;
}
ul li a {
  color: white;
  text-decoration: none;
}
</style>
