<template>
    <div class="login-sidebar">
        <div class="login-sidebar-content">
            <div class="login-sidebar-link">
                <a href="#" @click="logout">Wyloguj się</a>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    methods: {
        logout() {
      // Usuń informacje o zalogowaniu z localStorage
      localStorage.removeItem('isLoggedIn');
      localStorage.removeItem('userRole');

      // Ustaw stan zalogowania na false
      this.isLoggedIn = false;

      // Tutaj możesz dodać przekierowanie na stronę logowania
      // Przykład przekierowania do strony głównej:
      this.$router.push({ path: '/' }); // Zakładając, że używasz Vue Router
    }
  }
};
</script>

<style lang="scss" scoped>
    .login-sidebar.active {
        right: 0%;
    }
    .login-sidebar {
        width: 15%;
        position: fixed;
        height: 100%;
        background-color: var(--white);
        border-left: 1px solid var(--grey);
        right: -100%;
        transition: 0.5s;
        top: 62px;
        z-index: 999;
        .login-sidebar-content {
            cursor: pointer;
            .login-sidebar-link {
                padding-top: 1rem;
                padding-bottom: 1rem;
                border-bottom: 1px solid var(--grey);
                a {
                    font-size: 16px;
                    color: var(--black);
                    text-decoration: none;
                    margin-left: 1rem;
                }
            }
        }
    }

    @media screen and (max-width: 1024px) {
        .login-sidebar {
            width: 50%;
        }
    }

    @media screen and (max-width: 468px) {
        .login-sidebar {
            width: 80%;
        }
    }
</style>