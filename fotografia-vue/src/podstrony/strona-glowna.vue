<template>
  <MainHeader @menuToggled="handleMenuToggle" />
  <SlideMenu :menuActive="isMenuActive" />
  <div class="home">
    <div class="home-content">
      <div class="home-left">
        <h1>Jesteśmy <span>profesjonalną</span> firmą fotograficzną, specjalizujemy się w <span>uchwyceniu</span> najpiękniejszych <span>chwil i emocji.</span></h1>
        <p>Na naszej ekskluzywnej stronie, <span>sztuka wizualna</span> spotyka się z <span>profesjonalizmem.</span> Nasza galeria zdjęć jest <span>chroniona hasłem,</span> co gwarantuje <span>prywatność i ekskluzywność</span> dla naszych odwiedzających.</p>
        <p>Oferujemy również możliwość <span>rezerwacji sesji fotograficznych,</span> abyś mógł uwiecznić <span>swoje piękne chwile</span> z profesjonalnym fotografem. To miejsce, w którym <span>Twoje wizje</span> stają się <span>rzeczywistością.</span></p>
        <div class="home-buttons">
          <router-link to="/logowanie"><button class="home-btn">Przejdź do galerii</button></router-link>
          <router-link to="/rezerwacje-slub"><button class="home-btn">Zarezerwuj termin</button></router-link>
        </div>
      </div>
      <div class="home-right">
        <img src="../assets/1.png" alt="">
      </div>
    </div>
  </div>
  <Cookies />
  <MainFooter />
</template>

<script>

import MainHeader from '../components/main-header.vue'
import MainFooter from '../components/main-footer.vue'
import SlideMenu from '../components/slide-menu.vue'
import Cookies from '../components/cookies.vue'

export default {
  components: {
    MainHeader,
    MainFooter,
    SlideMenu,
    Cookies,
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
},
created() {
    // Sprawdź, czy użytkownik jest zalogowany na podstawie localStorage
    console.log('localStorage.isLoggedIn:', localStorage.getItem('isLoggedIn'));
    if (localStorage.getItem('isLoggedIn') === 'true') {
      // Użytkownik jest zalogowany, ustaw isLoggedIn na true
      this.isLoggedIn = true;
      console.log('user jest zalogowany');

      // Pobierz i wyświetl rolę użytkownika z localStorage
      const userRole = localStorage.getItem('userRole');
      console.log('Rola użytkownika:', userRole);
    } else {
      console.log('user nie jest zalogowany');
    }
  }
}
</script>

<style lang="scss" scoped>
.home {
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
          color: var(--pink);
        }
        span:nth-child(2) {
          color: var(--blue);
        }
        span:nth-child(3) {
          color: var(--blue);
        }
        span:nth-child(4) {
          color: var(--pink);
        }
      }
      .home-buttons {
        .home-btn:nth-child(1) {
          padding: 0.2rem 2rem;
          border-radius: 25px;
          border: 1px solid var(--pink);
          background-color: var(--white);
          font-size: 20px;
          color: var(--pink);
          margin-right: 2rem;
          transition: 0.5s;
          cursor: pointer;
          &:hover {
            background-color: var(--pink);
            color: var(--white);
          }
        }
        .home-btn:nth-child(2) {
          padding: 0.2rem 2rem;
          border-radius: 25px;
          border: 1px solid var(--pink);
          background-color: var(--white);
          font-size: 20px;
          color: var(--pink);
          transition: 0.5s;
          cursor: pointer;
          &:hover {
            background-color: var(--pink);
            color: var(--white);
          }
        }
      }
    }
    .home-right {
      width: 30%;
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
        .home-buttons {
          margin-bottom: 2rem;
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
        .home-buttons {
          margin-bottom: 1rem;
          .home-btn:nth-child(1) {
            font-size: 16px;
            margin-bottom: 1rem;
          }
          .home-btn:nth-child(2) {
            font-size: 16px;
          }
        }
      }
      .home-right {
        width: 60%;
      }
    }
  }
}
</style>