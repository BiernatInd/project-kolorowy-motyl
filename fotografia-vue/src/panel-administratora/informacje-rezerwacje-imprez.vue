<template>
  <div>
    <AdminHeader />
    <AdminSidebar />
    <div class="home">
      <div class="home-content">
        <div class="home-columns">
          <div class="home-left">
            <p>Imię: {{ rezerwacja.imie }}</p>
            <p>Nazwisko: {{ rezerwacja.nazwisko }}</p>
            <p>E-mail: {{ rezerwacja.email }}</p>
            <p>Numer telefonu: {{ rezerwacja.numer_telefonu }}</p>
            <p>Data wydarzenia: {{ rezerwacja.data_rezerwacji }}</p>
            <p>Miejsce ślubu: {{ rezerwacja.miejsce_wydarzenia }}</p>
            <p>Sesja w plenerze: {{ formattedSessionInPlenerze }}</p>
          </div>
          <div class="home-right">
            <p>Sesja w innym dniu: {{ formattedSessionZRodzina }}</p>
            <p>Dodatkowe informacje od klienta: {{ rezerwacja.dodatkowe_informacje }}</p>
          </div>
        </div>
      </div>
    </div>
    <AdminLoginSidebar />
    <MainFooter />
  </div>
</template>

<script>
import AdminHeader from '../components/admin-header.vue'
import AdminSidebar from '../components/admin-sidebar.vue'
import AdminLoginSidebar from '../components/admin-login-sidebar.vue'
import MainFooter from '../components/main-footer.vue'
import router from '../router/router'
import axios from 'axios'

export default {
  computed: {
    formattedSessionInPlenerze() {
      return this.rezerwacja.sesja_w_plenerze ? 'Tak' : 'Nie';
    },
    formattedSessionZRodzina() {
      return this.rezerwacja.sesja_z_rodzina ? 'Tak' : 'Nie';
    },
  },
  components: {
    AdminHeader,
    AdminSidebar,
    AdminLoginSidebar,
    MainFooter,
  },
  data() {
    return {
      isMenuActive: false,
      rezerwacja: {
        imie: "",
        nazwisko: "",
        email: "",
        numer_telefonu: "",
        data_rezerwacji:"",
        miejsce_wydarzenia: "",
        sesja_w_plenerze: "",
        sesja_z_rodzina: "",
        dodatkowe_informacje: ""
      }
    }
  },
  methods: {
    handleMenuToggle(menuActive) {
      this.isMenuActive = menuActive;
    },
    checkUserRole() {
      // Sprawdź, czy użytkownik jest zalogowany na podstawie localStorage
      console.log('localStorage.isLoggedIn:', localStorage.getItem('isLoggedIn'));
      if (localStorage.getItem('isLoggedIn') === 'true') {
        // Użytkownik jest zalogowany, ustaw isLoggedIn na true
        this.isLoggedIn = true;
        console.log('user jest zalogowany');
    
        // Pobierz i wyświetl rolę użytkownika z localStorage
        this.userRole = localStorage.getItem('userRole');
        console.log('Rola użytkownika:', this.userRole);
    
        // Sprawdź, czy this.rezerwacja jest zdefiniowane
        if (this.rezerwacja && this.rezerwacja.id) {
          // Tutaj możesz dodać logikę przekierowania w zależności od roli użytkownika
          if (this.userRole === 'admin') {
            // Przekieruj na stronę dla admina
            router.push('/informacje-rezerwacje-imprez/' + this.rezerwacja.id);
          } else {
            // Przekieruj na inną stronę, np. '/'
            router.push('/');
          }
        } else {
        }
      } else {
        // Użytkownik nie jest zalogowany, przekieruj na stronę logowania
        router.push('/logowanie');
      }
    },
    fetchRezerwacjaData() {
      // Odczytaj rezerwacjaId z parametrów URL
      const rezerwacjaId = this.$route.params.id;
    
      // Wykonaj zapytanie do API lub innej usługi, aby pobrać dane rezerwacji na podstawie rezerwacjaId
      axios.get(`http://46.41.148.115/api/informacje-rezerwacje-imprez/${rezerwacjaId}`)
        .then(response => {
          // Zaktualizuj dane rezerwacji w komponencie na podstawie odpowiedzi z API
          this.rezerwacja = response.data;
        })
        .catch(error => {
          console.error('Błąd pobierania danych rezerwacji:', error);
        });
    },
  },
  created() {
    this.checkUserRole();
    this.fetchRezerwacjaData();
  },
}
</script>
  
  <style lang="scss" scoped>
  .home {
    width: 90%;
    margin-left: auto;
    margin-right: auto;
    padding-top: 4rem;
    padding-bottom: 4rem;
    .home-content {
        padding-top: 1rem;
        border-radius: 25px;
        box-shadow: var(--shadow);
        .home-columns {
            width: 98%;
            margin-left: auto;
            margin-right: auto;
            display: flex;
            .home-left {
                width: 50%;
                p {
                    font-size: 16px;
                    margin-bottom: 1rem;
                }
            }
            .home-right {
                width: 50%;
                p {
                    font-size: 16px;
                    margin-bottom: 1rem;
                }
            }
        }
    }
  }

  @media screen and (max-width: 1200px) {
    .home {
        .home-content {
            .home-columns {
                width: 95%;
                flex-direction: column;
                .home-left {
                    width: 100%;
                }
                .home-right {
                    width: 100%;
                }
            }
        }
    }
  }

  @media screen and (max-width: 320px) {
    .home {
        .home-content {
            .home-columns {
                .home-left {
                    p {
                        font-size: 14px;
                    }
                }
                .home-right {
                    p {
                        font-size: 14px;
                    }
                }
            }
        }
    }
  }

  </style>