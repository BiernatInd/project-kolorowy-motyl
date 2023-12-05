<template>
    <MainHeader @menuToggled="handleMenuToggle" />
    <SlideMenu :menuActive="isMenuActive" />
    <div class="home">
      <div class="home-content">
        <div class="home-left">
          <h1>Jesteśmy dumni, że już od <span>8 lat tworzymy niezapomniane wspomnienia</span> w formie pięknych zdjęć.</h1>
          <p>Nasza firma fotograficzna <span>specjalizuje się</span> w różnorodnych <span>sesjach zdjęciowych, w tym sesjach ślubnych, rodzinnych, portretowych i wielu innych.</span> To właśnie my jesteśmy <span>Twoim niezawodnym partnerem</span> w dziedzinie fotografii.</p>
          <p><span>Nasza pasja</span> do fotografii jest naszym napędem, który pozwala nam uchwycić <span>chwile, emocje i piękno</span> w każdym ujęciu. <span>Niezależnie od tego, czy organizujesz ślub,</span> chcesz uwiecznić ważne wydarzenie rodzinne, czy po prostu <span>pragniesz zachować piękne portrety,</span> jesteśmy tutaj, by pomóc Ci to osiągnąć.</p>
        </div>
        <div class="home-right">
          <img src="../assets/3.png" alt="">
        </div>
      </div>
    </div>
    <MainFooter />
  </template>
  
  <script>
  
  import MainHeader from '../components/main-header.vue'
  import MainFooter from '../components/main-footer.vue'
  import SlideMenu from '../components/slide-menu.vue'
  
  export default {
    components: {
      MainHeader,
      MainFooter,
      SlideMenu,
    },
    data() {
      return {
        isMenuActive: false,
      };
    },
    methods: {
      handleMenuToggle(menuActive) {
        this.isMenuActive = menuActive;
      },
  }
  }
  </script>
  
  <style lang="scss" scoped>
  .home {
    margin-bottom: 2rem;
    .home-content {
      margin-top: 1rem;
      width: 90%;
      margin-left: auto;
      margin-right: auto;
      display: flex;
      align-items: center;
      justify-content: space-between;
      .home-left {
        width: 55%;
        h1 {
          font-size: 36px;
          font-weight: 400;
          margin-bottom: 2rem;
          span:nth-child(1) {
            color: var(--pink);
          }
          span:nth-child(2) {
            color: var(--blue);
          }
          span:nth-child(3) {
            color: var(--pink);
          }
        }
  
        p {
          margin-bottom: 2rem;
          font-size: 24px;
          font-weight: 400;
          span:nth-child(1) {
            color: var(--blue);
          }
          span:nth-child(2) {
            color: var(--pink);
          }
          span:nth-child(3) {
            color: var(--blue);
          }
          span:nth-child(4) {
            color: var(--pink);
          }
        }
      }
      .home-right {
        width: 25%;
        img {
          display: block;
          width: 100%;
        }
      }
    }
  }
  
  @media screen and (max-width: 1600px) {
    .home {
      margin-top: 3.125rem;
    }
  }
  
  @media screen and (max-width: 1200px) {
    .home {
      .home-content {
        flex-direction: column;
        .home-left {
          display: flex;
          flex-direction: column;
          width: 100%;
          h1 {
            font-size: 32px;
          }
          p {
            font-size: 24px;
          }
        }
      }
    }
  }
  
  @media screen and (max-width: 768px) {
    .home {
      margin-top: 1rem;
      .home-content {
        width: 95%;
        .home-left {
          h1 {
            font-size: 24px;
            margin-bottom: 1rem;
          }
          p {
            font-size: 16px;
            margin-bottom: 1rem;
          }
        }
        .home-right {
          width: 60%;
        }
      }
    }
  }
  </style>