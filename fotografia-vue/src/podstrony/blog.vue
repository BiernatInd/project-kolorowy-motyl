<template>
  <MainHeader @menuToggled="handleMenuToggle" />
  <SlideMenu :menuActive="isMenuActive" />
  <div class="home">
      <div class="home-content">
          <div class="offer">
              <h1>Nasza oferta obejmuje <span>różnorodne usługi fotograficzne,</span> dostosowane do <span>Twoich potrzeb i oczekiwań.</span> Bez względu na okazję, jesteśmy gotowi uwiecznić każdy ważny moment <span>Twojego życia</span></h1>
          </div>
          <template v-for="(article, index) in articles" :key="article.custom_id">
              <!-- Wyświetl tylko artykuły o nieparzystym indeksie -->
              <template v-if="index % 2 === 0">
                  <div class="offer-box-container">
                      <div class="offer-box">
                          <div class="offer-box-content">
                              <h2>{{ article.naglowek }}</h2>
                              <p>{{ article.tresc_artykulu }}</p>
                              <p>{{ formatDataDodania(article.created_at) }}</p>
                              <p>Administrator</p>
                              <router-link :to="'/artykul/' + article.nazwa"><button class="offer-btn">Zobacz artykuł</button></router-link>

                          </div>
                      </div>
                      <template v-if="articles[index + 1]">
                          <div class="offer-box">
                              <div class="offer-box-content">
                                  <h2>{{ articles[index + 1].naglowek }}</h2>
                                  <p>{{ articles[index + 1].tresc_artykulu }}</p>
                                  <p>{{ formatDataDodania(articles[index + 1].created_at) }}</p>
                                  <p>Administrator</p>
                                  <router-link :to="'/artykul/' + articles[index + 1].nazwa"><button class="offer-btn">Zobacz artykuł</button></router-link>
                              </div>
                          </div>
                      </template>
                  </div>
              </template>
          </template>
      </div>
  </div>
  <MainFooter />
</template>

<script>
import MainHeader from '../components/main-header.vue'
import MainFooter from '../components/main-footer.vue'
import SlideMenu from '../components/slide-menu.vue'
import axios from 'axios';

export default {
  components: {
    MainHeader,
    MainFooter,
    SlideMenu,
  },
  data() {
    return {
      isMenuActive: false,
      articles: [],
    };
  },
  mounted() {
    axios.get('http://46.41.148.115/api/lista-artykulow')
      .then(response => {
        this.articles = response.data;
      })
      .catch(error => {
        console.error('Błąd pobierania danych artykułów: ' + error);
      });
  },
  methods: {
    handleMenuToggle(menuActive) {
      this.isMenuActive = menuActive;
    },
    formatDataDodania(data) {
    const date = new Date(data);
    const day = date.getDate();
    const month = date.getMonth() + 1;
    const year = date.getFullYear();

    // Funkcja pomocnicza, aby dodać zero przed cyframi < 10
    const pad = (num) => (num < 10 ? '0' : '') + num;

    return `${pad(day)}.${pad(month)}.${year}`;
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
                width: 45%;
                box-shadow: var(--shadow);
                border-radius: 25px;
                .offer-box-content {
                    width: 95%;
                    margin-left: auto;
                    margin-right: auto;
                    padding-top: 1rem;
                    h2 {
                        font-size: 24px;
                        font-weight: 400;
                        margin-bottom: 1rem;
                    }
                    p {
                        font-size: 16px;
                        margin-bottom: 1rem;
                    }
                    .offer-btn {
                        margin-bottom: 1rem;
                        padding: 0.2rem 2rem;
                        font-size: 16px;
                        border-radius: 25px;
                        background-color: var(--white);
                        border: 1px solid var(--pink);
                        color: var(--pink);
                        cursor: pointer;
                        transition: 0.5s;
                        &:hover {
                            background-color: var(--pink);
                            color: var(--white);
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
            margin-bottom: 1rem;
            .offer-box {
                width: 50%;
                margin-left: auto;
                margin-right: auto;
                margin-bottom: 2rem;
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
                    h2 {
                        font-size: 16px;
                    }
                    p {
                        font-size: 14px;
                    }
                    .offer-btn {
                        font-size: 14px;
                    }
                }                    
            }
          }
        }
      }
    }
  </style>