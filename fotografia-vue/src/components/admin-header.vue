<template>
    <header class="header">
        <nav class="nav">
            <div class="nav-menu">
                <div class="wrapper-menu" @click="toggleSidebar" ref="hamburger">
                    <div class="line-menu half start"></div>
                    <div class="line-menu"></div>
                    <div class="line-menu half end"></div>
                </div>
            </div>
            <div class="nav-user">
                <font-awesome-icon class="icon" :icon="['fa', 'user']" @click="toggleLoginSidebar" />
            </div>
        </nav>
    </header>
</template>

<script>
export default {
  data() {
    return {
      isMenuActive: false,
    };
  },
  methods: {
    toggleSidebar() {
      const sidebarElement = document.querySelector(".sidebar");
      const hamburgerElement = this.$refs.hamburger;
      const loginSidebarElement = document.querySelector(".login-sidebar");

      sidebarElement.classList.toggle("active");
      hamburgerElement.classList.toggle("active");
      loginSidebarElement.classList.remove("active");
    },
    toggleLoginSidebar() {
      const sidebarElement = document.querySelector(".sidebar");
      const loginSidebarElement = document.querySelector(".login-sidebar");
      const hamburgerElement = this.$refs.hamburger;
      const isSidebarActive = sidebarElement.classList.contains("active");
      const isLoginSidebarActive = loginSidebarElement.classList.contains("active");

      if (!isLoginSidebarActive) {
        loginSidebarElement.classList.add("active");

        if (isSidebarActive) {
          sidebarElement.classList.remove("active");
          hamburgerElement.classList.remove("active");
        }
      } else {
        loginSidebarElement.classList.remove("active");
      }
    },
  },
};

</script>

<style lang="scss" scoped>

.header {
    border-bottom: 1px solid var(--grey);
    padding-top: 1rem;
    padding-bottom: 1rem;
    .nav {
        width: 98%;
        margin-left: auto;
        margin-right: auto;
        display: flex;
        justify-content: space-between;
        align-items: center;
        .nav-menu {
            .wrapper-menu {
          width: 30px;
          height: 30px;
          display: flex;
          flex-direction: column;
          justify-content: space-between;
          cursor: pointer;
          transition: transform 330ms ease-out;
        }

        .wrapper-menu.active {
          transform: rotate(-45deg);  
        }

        .line-menu {
          border-radius: 5px;
          width: 100%;
          height: 4px;
        }

        .line-menu:nth-child(1) {
          background-color: var(--pink);
        }
        .line-menu:nth-child(2) {
          background-color: var(--blue);
        }
        .line-menu:nth-child(3) {
          background-color: var(--pink);
        }

        .line-menu.half {
          width: 50%;
        }

        .line-menu.start {
          transition: transform 330ms cubic-bezier(0.54, -0.81, 0.57, 0.57);
          transform-origin: right;
        }

        .active .line-menu.start {
          transform: rotate(-90deg) translateX(3px);
        }

        .line-menu.end {
          align-self: flex-end;
          transition: transform 330ms cubic-bezier(0.54, -0.81, 0.57, 0.57);
          transform-origin: left;
        }

        .active .line-menu.end {
          transform: rotate(-90deg) translateX(-3px);
        }
        }
        .nav-user {
            .icon {
                font-size: 28px;
                cursor: pointer;
                transition: 0.5s;
                margin-right: 1rem;
                color: var(--pink);
                &:hover {
                    color: var(--blue);
                }
            }
        }
    }
}

</style>