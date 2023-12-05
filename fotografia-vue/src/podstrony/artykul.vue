<template>
  <MainHeader @menuToggled="handleMenuToggle"/>
  <SlideMenu :menuActive="isMenuActive"/>
  <div class="home">
    <div class="home-content">
      <div v-for="(element, index) in articles" :key="element.id">
        <div class="home-heading">
          <component :is="'h' + (index < 6 ? index + 1 : (index - 6) % 5 + 2)">{{ element.naglowek }}</component>
        </div>
        <div class="home-article">
          <p>{{ element.tresc_artykulu }}</p>
        </div>
      </div>
    </div>
  </div>
  <MainFooter />
</template>


<script>
import MainHeader from '../components/main-header.vue'
import SlideMenu from '../components/slide-menu.vue'
import MainFooter from '../components/main-footer.vue'
import axios from 'axios'

export default {
  components: {
    MainHeader,
    SlideMenu,
    MainFooter
  },
  data() {
    return {
      isMenuActive: false,
      articles: []
    }
  },
  mounted() {
    this.pobierzArtykuly();
  },
  methods: {
    handleMenuToggle(menuActive) {
      this.isMenuActive = menuActive;
    },
    pobierzArtykuly() {
      const nazwa = this.$route.params.nazwa; // Pobierz wartość "nazwa" z dynamicznego parametru URL
      // Pobierz dane artykułów za pomocą zapytania Axios
      axios.get(`http://46.41.148.115/api/pobierz-artykul/${nazwa}`)
        .then((response) => {
          this.articles = response.data; // Zakładam, że dane z serwera przychodzą jako tablica obiektów
        })
        .catch((error) => {
          console.error('Błąd pobierania artykułów', error);
        });
    }
  }
}
</script>
  
  <style lang="scss" scoped>
    .home {
      width: 90%;
      margin-left: auto;
      margin-right: auto;
      .home-content {
        padding-top: 2rem;
        h1, h2 {
            font-size: 36px;
            font-weight: 400;
            margin-bottom: 2rem;
        }
        p {
            font-size: 20px;
            margin-bottom: 2rem;
        }
      }
    }

    @media screen and (max-width: 1200px) {
        .home {
            .home-content {
                h1, h2 {
                    font-size: 24px;
                }
            }
        }
    }

    @media screen and (max-width: 768px) {
        .home {
            .home-content {
                padding-top: 1rem;
                h1, h2 {
                    margin-bottom: 1rem;
                }
                p {
                    margin-bottom: 1rem;
                    font-size: 16px
                }
            }
        }
    }

    @media screen and (max-width: 320px) {
        .home {
            .home-content {
                h1, h2 {
                    font-size: 16px;
                }
                p {
                    font-size: 14px;
                }
            }
        }
    }
  </style>