<template>
  <AdminHeader />
  <AdminSidebar />
  <div class="home">
    <div class="home-left">
      <form class="home-form" @submit.prevent="dodajTresc">
        <div class="home-form-content">
          <h2>Dodawanie treści wpisu</h2>
          <div class="input-flex-2">
            <input type="text" v-model="naglowek" placeholder="Wprowadź nagłówek" required>
          </div>
          <div class="input-flex-2">
            <textarea type="text" v-model="tresc_artykulu" placeholder="Dodawanie paragrafu"></textarea>
          </div>
          <div class="home-buttons">
            <button type="submit" class="home-btn">Dodaj treść</button>
          </div>
        </div>
      </form>
    </div>
    <div class="home-right">
      <div class="home-content">
        <h3>Aktualne treści wpisu</h3>
        <div v-for="wpis in wpisy" :key="wpis.id">
          <h4>{{ wpis.naglowek }}</h4>
          <p>{{ wpis.tresc_artykulu }}</p>
        </div>
      </div>
    </div>
  </div>
  <AdminLoginSidebar />
  <MainFooter />
</template>

<script>
import AdminHeader from '../components/admin-header.vue'
import AdminSidebar from '../components/admin-sidebar.vue'
import AdminLoginSidebar from '../components/admin-login-sidebar.vue'
import MainFooter from '../components/main-footer.vue'
import axios from 'axios'
import router from '../router/router'

export default {
  components: {
    AdminHeader,
    AdminSidebar,
    AdminLoginSidebar,
    MainFooter,
  },
  data() {
    return {
      isMenuActive: false,
      naglowek: '',
      tresc_artykulu: '',
      nazwa: '',
      numer_naglowka: '',
      wpisy: [],
    }
  },
  
  methods: {
    dodajTresc() {
      const data = {
        naglowek: this.naglowek,
        tresc_artykulu: this.tresc_artykulu,
        nazwa: this.nazwa, // Przekaz nazwę do danych formularza
        numer_naglowka: this.numer_naglowka,
      };
      
      axios.post('http://46.41.148.115/api/dodawanie-tresci-wpisow', data)
      .then(response => {
        console.log('Tresc została dodana:', response.data);
        // Wyczyść pola formularza lub zrób inne odpowiednie akcje
        this.naglowek = '';
        this.tresc_artykulu = '';
        this.numer_naglowka = '';

        this.pobierzAktualneDane();

        window.alert("Dodano treść do wpisu.");
      })
      .catch(error => {
        console.error('Błąd podczas dodawania tresci:', error);
      });
    },
    pobierzAktualneDane() {
  // Tutaj możesz użyć Axios, aby pobrać dane z API
  axios.get(`http://46.41.148.115/api/pobierz-dane/${this.nazwa}`)
    .then(response => {
      this.wpisy = response.data; // Przypisz dane do właściwości wpisy
    })
    .catch(error => {
      console.error('Błąd podczas pobierania danych:', error);
    });
}, 


},
beforeRouteEnter(to, from, next) {
    const userRole = localStorage.getItem('userRole');
    if (userRole === 'admin') {
      next(vm => {
        vm.nazwa = to.params.nazwa;
        vm.pobierzAktualneDane();
      });
    } else {
      next('/logowanie');
    }
  },
  beforeRouteUpdate(to, from, next) {
    const userRole = localStorage.getItem('userRole');
    if (userRole === 'admin') {
      this.nazwa = to.params.nazwa;
      this.pobierzAktualneDane();
      next();
    } else {
      next('/logowanie');
    }
  },
  created() {

    // Odczytaj nazwę z adresu URL (przy użyciu Vue Router)
    // this.checkUserRole();
    this.nazwa = this.$route.params.nazwa;
  
    // Pobierz aktualne dane z bazy przy ładowaniu komponentu
    this.pobierzAktualneDane();
  }
}
</script>
  
  <style lang="scss" scoped>
  .home {
    width: 90%;
    margin-left: auto;
    margin-right: auto;
    padding-top: 4rem;
    padding-bottom: 4rem;
    display: flex;  
    justify-content: space-between;
    .home-left {
      width: 48%;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      .home-form:nth-child(1) {
        margin-bottom: 2rem;
      }
      .home-form {
      box-shadow: 2px 2px 10px 2px var(--grey);
      border-radius: 15px;
      .home-form-content {
        width: 95%;
        margin-left: auto;
        margin-right: auto;
        padding-top: 1rem;
        padding-bottom: 1rem;
        h1, h2 {
          font-size: 20px;
          margin-bottom: 1rem;
          font-weight: 600;
        }
        .input-flex {
          display: flex;
          justify-content: space-between;
          input {
            width: 48%;
            padding: 0.4rem;
            font-size: 14px;
            border: none;
            border-radius: 25px;
            border-bottom: 1px solid var(--black);
            margin-bottom: 1rem;
          }
        }
        .input-flex-2 {
          display: flex;
          justify-content: space-between;
          input {
            width: 100%;
            padding: 0.4rem;
            font-size: 14px;
            border: none;
            border-radius: 25px;
            border-bottom: 1px solid var(--pink);
            margin-bottom: 1rem;
          }
          textarea {
            width: 100%;
            height: 160px;
            border-radius: 25px;
            padding: 0.4rem;
            font-size: 14px;
            border: none;
            border-bottom: 1px solid var(--pink);
            margin-bottom: 1rem;
          }
        }
        .home-buttons {
          .home-btn {
            padding: 0.2rem 2rem;
            border-radius: 15px;
            border: 1px solid var(--pink);
            background-color: var(--transparent);
            color: var(--pink);
            font-size: 14px;
            transition: 0.5s;
            cursor: pointer;
            &:hover {
              background-color: var(--pink);
              color: var(--white);
            }
          }
        }
      }
    }
    }
    .home-right {
      width: 48%;
      height: 545px;
      box-shadow: 2px 2px 10px 2px var(--grey);
      border-radius: 15px;
      overflow-y: scroll;
      background-color: var(--white);
      .home-content {
        width: 95%;
        margin-left: auto;
        margin-right: auto;
        padding-top: 1rem;
        h3 {
          font-size: 20px;
          margin-bottom: 1rem;
          font-weight: 600;
        }
        h4 {
          font-size: 16px;
          font-weight: 700;
          margin-bottom: 1rem;
        }
        p {
          font-size: 14px;
          font-weight: 500;
          margin-bottom: 1rem;
        }
      }
    }
  }
  
  @media screen and (max-width: 1200px) {
    .home {
      flex-direction: column;
      padding-top: 2rem;
      padding-bottom: 2rem;
      .home-left {
        width: 100%;
        margin-bottom: 2rem;
      }
      .home-right {
        width: 100%;
      }
    }
  }
  
  @media screen and (max-width: 768px) {
    .home {
      .home-left {
        .home-form {
          .home-form-content {
            .input-flex {
              display: flex;
              flex-direction: column;
              input {
                width: 100%;
              }
            }
          }
        }
      }
    }
  }
  </style>