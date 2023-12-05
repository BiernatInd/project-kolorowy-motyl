<template>
    <MainHeader @menuToggled="handleMenuToggle" />
    <SlideMenu :menuActive="isMenuActive" />
    <div class="home">
        <div class="home-content">
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
                            <h2>Prywatna sesja Pani Kingi</h2>
                            <p>Dziś mieliśmy przyjemność gościć Panią Kingę na wyjątkowej, prywatnej sesji fotograficznej! To był dzień pełen magii, podczas którego wspólnie odkrywaliśmy piękno i indywidualność Pani Kingi.</p>
                        </div>
                    </div>
                </div>
                <div class="offer-box">
                    <div class="offer-box-content">
                        <div class="offer-box-top">
                            <img src="../assets/2.png" alt="">
                        </div>
                        <div class="offer-box-bottom">
                            <h2>Prywatna sesja Pani Kingi</h2>
                            <p>Dziś mieliśmy przyjemność gościć Panią Kingę na wyjątkowej, prywatnej sesji fotograficznej! To był dzień pełen magii, podczas którego wspólnie odkrywaliśmy piękno i indywidualność Pani Kingi.</p>
                        </div>
                    </div>
                </div>
                <div class="offer-box">
                    <div class="offer-box-content">
                        <div class="offer-box-top">
                            <img src="../assets/2.png" alt="">
                        </div>
                        <div class="offer-box-bottom">
                            <h2>Prywatna sesja Pani Kingi</h2>
                            <p>Dziś mieliśmy przyjemność gościć Panią Kingę na wyjątkowej, prywatnej sesji fotograficznej! To był dzień pełen magii, podczas którego wspólnie odkrywaliśmy piękno i indywidualność Pani Kingi.</p>
                        </div>
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
      width: 90%;
      margin-left: auto;
      margin-right: auto;
      .home-content {
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
                            margin-bottom: 1rem;
                        }
                    }
                    .offer-box-bottom {
                        h2 {
                            font-size: 24px;
                            font-weight: 400;
                            margin-bottom: 1rem;
                        }
                        p {
                            font-size: 16px;
                        }
                    }
                }
            }
        }
      }
    }

    @media screen and (max-width: 1600px) {
      .home {
        .home-content {
          .offer {
            h1 {
              width: 90%;
            }
          }
        }
      }
    }
    
    @media screen and (max-width: 1200px) {
      .home {
        .home-content {
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
          .offer-box-container:nth-child(3) {
            .offer-box {
              width: 50%;
            }
          }
        }
      }
    }

    @media screen and (max-width: 768px) {
      .home {
        .home-content {
            .offer {
                h1 {
                    text-align: left;
                }
            }
          .offer-box-container {
            .offer-box {
              width: 100%;
            }
          }
        }
      }
    }

    @media screen and (max-width: 320px) {
      .home {
        .home-content {
          .offer {
            h1 {
              font-size: 16px;
            }
          }
          .offer-box-container {
            .offer-box {
              .offer-box-content {
                .offer-box-bottom {
                    h2 {
                        font-size: 16px;
                    }
                    p {
                      font-size: 12px;
                    }

                }
              }
            }
          }
        }
      }
    }

  </style>