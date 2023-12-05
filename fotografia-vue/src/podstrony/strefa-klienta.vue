<template>
    <MainHeader @menuToggled="handleMenuToggle" />
    <SlideMenu :menuActive="isMenuActive" />
    <div class="home">
      <div class="home-content">
        <div class="home-left">
          <h1><span>Witaj w Strefie Klienta -</span> prywatnej galerii stworzonej specjalnie dla <span>naszych klientów indywidualnych!</span></h1>
          <p><span>Jesteśmy zaszczyceni,</span> że jesteś częścią <span>naszej wyjątkowej społeczności</span> i chcemy zapewnić Ci niezapomniane <span>doświadczenie artystyczne.</span> </p>
          <p>Strefa Klienta to <span>wirtualne sanktuarium sztuki,</span> w którym możesz odkrywać, cieszyć się i kolekcjonować <span>wyjątkowe dzieła sztuki.</span></p>
          <p>Każde dzieło w <span>Strefie Klienta</span> jest starannie wyselekcjonowane przez nasz zespół kuratorów, którzy <span>dbają o jakość, oryginalność i różnorodność</span> prezentowanych prac.</p>
        </div>
            <div class="home-right">
            <img src="../assets/4.png" alt="">
            </div>
        </div>
        <div class="offer">
            <h1>Witaj na naszej stronie <span>portfolio fotograficznego!</span> Cieszę się, że tu jesteś i mamy przyjemność <span>podzielić się z Tobą</span> naszymi <span>ukończonymi realizacjami!</span></h1>
        </div>
        <div class="offer-box-container">
            <div class="offer-box">
                <div class="offer-box-content">
                    <div class="offer-box-top">
                        <img src="../assets/2.png" alt="">
                    </div>
                    <div class="offer-box-bottom">
                      <router-link to="/logowanie">Zobacz swoją galerię</router-link>
                    </div>
                </div>
            </div>
            <div class="offer-box">
                <div class="offer-box-content">
                    <div class="offer-box-top">
                        <img src="../assets/2.png" alt="">
                    </div>
                    <div class="offer-box-bottom">
                      <router-link to="/logowanie">Zobacz swoją galerię</router-link>
                    </div>
                </div>
            </div>
            <div class="offer-box">
                <div class="offer-box-content">
                    <div class="offer-box-top">
                        <img src="../assets/2.png" alt="">
                    </div>
                    <div class="offer-box-bottom">
                      <router-link to="/logowanie">Zobacz swoją galerię</router-link>
                    </div>
                </div>
            </div>
        </div>
        <div class="offer-box-container">
            <div class="offer-box">
                <div class="offer-box-content">
                    <div class="offer-box-top">
                        <img src="../assets/2.png" alt="">
                    </div>
                    <div class="offer-box-bottom">
                      <router-link to="/logowanie">Zobacz swoją galerię</router-link>
                    </div>
                </div>
            </div>
            <div class="offer-box">
                <div class="offer-box-content">
                    <div class="offer-box-top">
                        <img src="../assets/2.png" alt="">
                    </div>
                    <div class="offer-box-bottom">
                      <router-link to="/logowanie">Zobacz swoją galerię</router-link>
                    </div>
                </div>
            </div>
            <div class="offer-box">
                <div class="offer-box-content">
                    <div class="offer-box-top">
                        <img src="../assets/2.png" alt="">
                    </div>
                    <div class="offer-box-bottom">
                      <router-link to="/logowanie">Zobacz swoją galerię</router-link>
                    </div>
                </div>
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
    margin-top: 2rem;
    width: 90%;
      margin-left: auto;
      margin-right: auto;
    .home-content {
      margin-top: 1rem;
      width: 100%;
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
    .offer {
          margin-top: 2rem;
          margin-bottom: 2rem;
          padding-top: 2rem;
          padding-bottom: 2rem;
          border-radius: 25px;
          box-shadow: var(--shadow);
          h1 {
            width: 1300px;
            text-align: center;
            margin-left: auto;
            margin-right: auto;
            font-weight: 400;
            span:nth-child(1) {
              color: var(--blue);
            }
            span:nth-child(2) {
              color: var(--pink);
            }
            span:nth-child(3) {
              color: var(--pink);
            }
          }
        }
        .offer-box-container {
            display: flex;
            justify-content: space-between;
            margin-bottom: 2rem;
            .offer-box {
                width: 30%;
                box-shadow: var(--shadow);
                border-radius: 25px;
                padding-top: 2rem;
                padding-bottom: 2rem;
                .offer-box-content {
                    width: 90%;
                    margin-left: auto;
                    margin-right: auto;
                    .offer-box-top {
                        img {
                            display: block;
                            width: 100%;
                            margin-bottom: 2rem;
                        }
                    }
                    .offer-box-bottom {
                        display: flex;
                        justify-content: center;
                        a {
                            font-size: 24px;
                            font-weight: 400;
                            color: var(--black);
                            text-underline-offset: 4px;
                        }
                    }
                }
            }
        }
  }
  
  @media screen and (max-width: 1600px) {
    .home {
      margin-top: 3.125rem;
      .home-content {
    }
    .offer {
      h1 {
        width: 90%;
      }
    }
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
      .offer {
            h1 {
              font-size: 24px;
            }
          }
          .offer-box-container {
            flex-direction: column;
            margin-bottom: 0;
            .offer-box {
              margin-left: auto;
              margin-right: auto;
              width: 50%;
              margin-bottom: 2rem;
            }
          }
    }
  }
  
  @media screen and (max-width: 768px) {
    .home {
      margin-top: 1rem;
      margin-bottom: 1rem;
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
      .offer {
        margin-top: 1rem;
                h1 {
                    text-align: left;
                }
            }
          .offer-box-container {
            .offer-box {
              width: 100%;
              .offer-box-content {
                .offer-box-bottom {
                    a {
                        font-size: 20px;
                    }
                }
              }
            }
          }
    }
  }

  @media screen and (max-width: 320px) {
    .home {
        .home-content {
            .home-left {
                h1 {
                    font-size: 16px;
                }
                p {
                    font-size: 14px;
                }
            }
        }
        .offer {
            h1 {
                font-size: 16px;
            }
        }
        .offer-box-container {
            .offer-box {
                .offer-box-content {
                    .offer-box-bottom {
                        a {
                            font-size: 14px;
                        }
                    }
                }
            }
        }
    }
  }
  </style>