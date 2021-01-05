<template>

<b-navbar toggleable="lg" type="dark" class="py-0 main-gray">
  <b-container fluid>

      <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

      <b-collapse id="nav-collapse" is-nav>

        <b-navbar-nav>

          <li class="nav-item">
            <router-link :to="{ 'name' : 'home' }" class="nav-link">Home</router-link>
          </li>

          <li class="nav-item">
            <router-link :to="{ 'name' : 'admin.employees' }" class="nav-link">Employees</router-link>
          </li>

          <li class="nav-item">
            <router-link :to="{ 'name' : 'login' }" class="nav-link">Login</router-link>
          </li>

        </b-navbar-nav>

      </b-collapse>
      
  </b-container>
</b-navbar>


</template>

<script>
  export default {

  }
</script>