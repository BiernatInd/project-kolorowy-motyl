<template>
    <header class="header">
      <nav class="nav">
        <div class="nav-logo">
          <img src="../assets/logo.png" alt="">
        </div>
        <div class="nav-menu">
          <div class="wrapper-menu" @click="toggleActive">
            <div class="line-menu half start"></div>
            <div class="line-menu"></div>
            <div class="line-menu half end"></div>
          </div>
        </div>
      </nav>
    </header>
  </template>
  
  <script>
  export default {
    methods: {
      toggleActive() {
        const wrapperMenu = document.querySelector(".wrapper-menu");
        wrapperMenu.classList.toggle("active");
        document.body.classList.toggle("active");
  
        this.$emit('menuToggled', wrapperMenu.classList.contains('active'));
      },
    },
  };
  </script>

<style lang="scss" scoped>
  .header {
    padding-top: 3.125rem;
    background-color: var(--white);
    position: relative;
    z-index: 999;
    .nav {
      width: 90%;
      margin-left: auto;
      margin-right: auto;
      display: flex;
      justify-content: space-between;
      align-items: center;
      .nav-menu {
        .wrapper-menu {
          width: 40px;
          height: 40px;
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
          height: 5px;
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
    }
  }

  @media screen and (max-width: 1200px) {
    .header {
        padding-top: 1rem;
    }
  }

  @media screen and (max-width: 768px) {
    .header {
      .nav {
        width: 95%;
      }
    }
  }
</style>