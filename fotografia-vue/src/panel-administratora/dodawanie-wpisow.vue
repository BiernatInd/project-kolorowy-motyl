<template>
  <AdminHeader />
  <AdminSidebar />
  <div class="home">
    <div class="home-left">
      <form class="home-form" @submit.prevent="dodajWpis">
        <div class="home-form-content">
          <h1>Dodawanie wpisu</h1>
          <div class="input-flex">
            <input type="text" v-model="metaTitle" placeholder="Wprowadź Meta Mag Title" required>
            <input type="text" v-model="metaDescription" placeholder="Wprowadź Meta Mag Description" required>
          </div>
          <div class="input-flex">
            <input type="text" v-model="nazwa" placeholder="Wprowadź nazwę artykułu" required>
          </div>
          <div class="home-buttons">
            <button class="home-btn">Dodaj wpis</button>
          </div>
        </div>
      </form>
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
      metaTitle: '', // Inicjalizuj puste pola danych
      metaDescription: '', // Inicjalizuj puste pola danych
      nazwa: '',
    }
  },
  methods: {
    dodajWpis() {
      // Pobierz dane z modelu Vue
      const data = {
        nazwa: this.nazwa,
        metaTitle: this.metaTitle,
        metaDescription: this.metaDescription,
      };

      // Wyślij żądanie POST używając Axios
      axios.post('http://46.41.148.115/api/dodawanie-wpisow', data)
        .then(response => {
          // Obsłuż odpowiedź po dodaniu wpisu, np. wyświetl komunikat sukcesu
          console.log('Wpis został dodany:', response.data);
          
          // Tutaj przekierowujemy użytkownika na inną stronę po dodaniu wpisu
          router.push('/dodawanie-tresci-wpisow/' + this.nazwa);

          // Wyczyszczenie formularza można wykonać po przekierowaniu
          this.nazwa = '';
          this.metaTitle = '';
          this.metaDescription = '';

          window.alert("Dodano wpis.");
        })
        .catch(error => {
          // Obsłuż błąd, np. wyświetl komunikat o niepowodzeniu
          console.error('Błąd podczas dodawania wpisu:', error);
        });
    },
checkUserRole() {
  const userRole = localStorage.getItem('userRole');
  if (userRole === 'admin') {
    this.$router.push('/dodawanie-wpisow');
  } else {
    this.$router.push('/logowanie');
  }
}
  },
  created() {
    this.checkUserRole();
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
      margin-left: auto;
      margin-right: auto;
      flex-direction: column;
      justify-content: space-between;
      .home-form:nth-child(1) {
        margin-bottom: 2rem;
      }
      .home-form {
      box-shadow: var(--shadow);
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
            border-bottom: 1px solid var(--pink);
            margin-bottom: 1rem;
          }
        }
        .input-flex-2 {
          display: flex;
          justify-content: space-between;
          input {
            width: 100%;
            height: 30px;
            font-size: 14px;
            border: none;
            border-bottom: 1px solid var(--black);
            margin-bottom: 1rem;
          }
          textarea {
            width: 100%;
            height: 160px;
            font-size: 14px;
            border: none;
            border-bottom: 1px solid var(--black);
            margin-bottom: 1rem;
          }
        }
        .home-buttons {
          .home-btn {
            padding: 0.2rem 2rem;
            border-radius: 15px;
            border: 1px solid var(--pink);
            background-color: var(--transparent);
            font-size: 14px;
            transition: 0.5s;
            cursor: pointer;
            color: var(--pink);
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
  
  @media screen and (max-width: 1200px) {
    .home {
      flex-direction: column;
      padding-top: 2rem;
      padding-bottom: 2rem;
      .home-left {
        width: 100%;
        margin-bottom: 2rem;
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