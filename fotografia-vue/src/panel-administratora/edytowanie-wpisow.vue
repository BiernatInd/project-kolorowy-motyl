<template>
  <AdminHeader />
  <AdminSidebar />
  <div class="home">
    <div class="home-left">
      <form class="home-form" @submit.prevent="edytujNaglowek">
        <div class="home-form-content">
          <h1>Edytowanie nagłówka</h1>
          <div class="input-flex">
            <input type="number" v-model="numerNaglowka" placeholder="Wprowadź numer nagłówka" required>
            <input type="text" v-model="nowyNaglowek" placeholder="Wprowadź nowy nagłówek" required>
          </div>
          <div class="home-buttons">
            <button type="submit" class="home-btn">Edytuj</button>
          </div>
        </div>
      </form>
      <form class="home-form" @submit.prevent="edytujParagraf">
        <div class="home-form-content">
          <h1>Edytowanie paragrafu</h1>
          <div class="input-flex-2">
            <input type="number" v-model="numerParagrafu" placeholder="Wprowadź numer paragrafu" required>
          </div>
          <div class="input-flex-2">
            <textarea v-model="nowyParagraf" placeholder="Wprowadź nowy paragraf"></textarea>
          </div>
          <div class="home-buttons">
            <button type="submit" class="home-btn">Edytuj</button>
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
import router from '../router/router'
import axios from 'axios'

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
      numerNaglowka: '', // Add this line
      nowyNaglowek: '', // Add this line
      numerParagrafu: '', // Add this line
      nowyParagraf: '',
      wpisy: [],
    }
  },
  methods: {
    pobierzAktualneDane() {
axios.get(`http://46.41.148.115/api/pobierz-dane/${this.nazwa}`)
  .then(response => {
    this.wpisy = response.data; // Assign data to the 'wpisy' property
    console.log(this.wpisy);
  })
  .catch(error => {
    console.error('Error while fetching data:', error);
  });
},
edytujNaglowek() {
      axios.post('http://46.41.148.115/api/edytuj-naglowek', {
        numerNaglowka: this.numerNaglowka,
        nowyNaglowek: this.nowyNaglowek,
      })
      .then(response => {
        // Aktualizuj dane na stronie
        this.pobierzAktualneDane();

        window.alert("Edytowano nagłówek.");
      })
      .catch(error => {
        console.error('Błąd podczas edycji nagłówka:', error);
      });
    },
  
    edytujParagraf() {
      axios.post('http://46.41.148.115/api/edytuj-paragraf', {
        numerParagrafu: this.numerParagrafu,
        nowyParagraf: this.nowyParagraf,
      })
      .then(response => {
        // Aktualizuj dane na stronie
        this.pobierzAktualneDane();

        window.alert("Edytowano paragraf.");
      })
      .catch(error => {
        console.error('Błąd podczas edycji paragrafu:', error);
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
    this.nazwa = this.$route.params.nazwa;
  // Odczytaj nazwę z adresu URL (przy użyciu Vue Router)
  // Pobierz aktualne dane z bazy przy ładowaniu komponentu
  this.pobierzAktualneDane();
  // this.checkUserRole();
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