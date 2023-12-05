<template>
    <MainHeader @menuToggled="handleMenuToggle" />
    <SlideMenu :menuActive="isMenuActive" />
    <div class="home">
        <div class="home-content">
            <div class="offer">
                <h1>Nasza oferta obejmuje <span>różnorodne usługi fotograficzne,</span> dostosowane do <span>Twoich potrzeb i oczekiwań.</span> Bez względu na okazję, jesteśmy gotowi uwiecznić każdy ważny moment <span>Twojego życia</span></h1>
            </div>
            <div class="offer-box-container">
              <div class="offer-box">
                <div class="offer-box-content">
                  <h2>Reportaż ślubny</h2>
                  <p>Od 10h reportażu (przygotowania/ceremonia/przyjęcie weselne/2-3 mini sesje w dniu ślubu)</p>
                  <p>minimum 450 zdjęć na USB</p>
                  <p>galeria internetowa na hasło (1 rok)</p>
                </div>
              </div>
              <div class="offer-box">
                <div class="offer-box-content">
                  <h2>Reportaż ślubny</h2>
                  <p>Od 10h reportażu (przygotowania/ceremonia/przyjęcie weselne/2-3 mini sesje w dniu ślubu)</p>
                  <p>minimum 450 zdjęć na USB</p>
                  <p>galeria internetowa na hasło (1 rok)</p>
                </div>
              </div>
              <div class="offer-box">
                <div class="offer-box-content">
                  <h2>Reportaż ślubny</h2>
                  <p>Od 10h reportażu (przygotowania/ceremonia/przyjęcie weselne/2-3 mini sesje w dniu ślubu)</p>
                  <p>minimum 450 zdjęć na USB</p>
                  <p>galeria internetowa na hasło (1 rok)</p>
                </div>
              </div>
            </div>
            <div class="offer-box-container">
              <div class="offer-box">
                <div class="offer-box-content">
                  <h3>Nasze studio</h3>
                  <hr>
                  <p>Nasze studio fotograficzne, zlokalizowane na Osiedlu Świętokrzyskim w Kielcach, to idealne miejsce do realizacji różnorodnych zadań fotograficznych. Dysponujemy pełnym wyposażeniem studyjnym, które umożliwia nam tworzenie wysokiej jakości fotografii.</p>
                  <p>Specjalizujemy się w wykonywaniu zdjęć biznesowych, idealnych do wykorzystania na portalach społecznościowych, branżowych, takich jak LinkedIn, Twitter i wiele innych. Nasze fotografie podkreślą profesjonalizm i indywidualność Twojego wizerunku w świecie biznesu.</p>
                </div>
              </div>
              <div class="offer-box">
                <div class="offer-box-content">
                  <h3>Czym się zajmujemy?</h3>
                  <hr>
                  <div class="offer-columns">
                    <div class="offer-left">
                      <p>Zdjęcia ślubne</p>
                      <p>Zdjęcia z wieczoru panieńskiego</p>
                      <p>Zdjęcia indywidualne</p>
                      <p>Zdjęcia z chrzcin</p>
                      <p>Zdjęcia z roczków</p>
                    </div>
                    <div class="offer-right">
                      <p>Zdjęcia z uroczystości rodzinnych</p>
                      <p>Zdjęcia komunijne</p>
                      <p>Zdjęcia rodzinne</p>
                    </div>
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
            padding-top: 1rem;
            .offer-box-content {
              width: 90%;
              margin-left: auto;
              margin-right: auto;
              h2 {
                margin-bottom: 1rem;
                font-weight: 400;
                font-size: 24px;
              }
              p {
                margin-bottom: 1rem;
                font-size: 16px;
              }
            }
          }
        }
        .offer-box-container:nth-child(3) {
          display: flex;
          justify-content: space-around;
          .offer-box {
            width: 40%;
            box-shadow: var(--shadow);
            border-radius: 25px;
            padding-top: 1rem;
            .offer-box-content {
              width: 90%;
              margin-left: auto;
              margin-right: auto;
              h3 {
                font-size: 24px;
                font-weight: 400;
                margin-bottom: 1rem;
              }
              hr {
                color: orange;
                width: 140px;
                height: 4px;
                background-color: var(--black);
                margin-bottom: 1rem;
              }
              .offer-columns {
                display: flex;
                justify-content: space-between;
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
          .offer-box-container:nth-child(3) {
            .offer-box {
              width: 100%;
              .offer-box-content {
                .offer-columns {
                  display: flex;
                  flex-direction: column;
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
          .offer {
            h1 {
              font-size: 16px;
            }
          }
          .offer-box-container {
            .offer-box {
              .offer-box-content {
                h2 {
                  font-size: 16px;
                }
                p {
                  font-size: 12px;
                }
              }
            }
          }
          .offer-box-container:nth-child(3) {
            .offer-box {
              .offer-box-content {
                h3 {
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
  </style>