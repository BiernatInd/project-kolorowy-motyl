<template>
  <AdminHeader />
  <AdminSidebar />
  <div class="home">
    <table>
      <thead>
        <tr>
          <th>Imię</th>
          <th>Nazwisko</th>
          <th>E-mail</th>
          <th>Numer telefonu</th>
          <th>Informacje</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(rezerwacja, index) in rezerwacjeImprez" :key="index">
          <td data-label="Imię">{{ rezerwacja.imie }}</td>
          <td data-label="Nazwisko">{{ rezerwacja.nazwisko }}</td>
          <td data-label="E-mail">{{ rezerwacja.email }}</td>
          <td data-label="Numer telefonu">{{ rezerwacja.numer_telefonu }}</td>
          <td data-label="Informacje">
            <router-link :to="'/informacje-rezerwacje-imprez/' + rezerwacja.id">Więcej</router-link>
          </td>
        </tr>
      </tbody>
    </table>
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
      rezerwacjeImprez: [],
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

    // Tutaj możesz dodać logikę przekierowania w zależności od roli użytkownika
    if (this.userRole === 'admin') {
      // Przekieruj na stronę dla admina
      router.push('/lista-rezerwacje-imprez');
    } else {
      // Przekieruj na inną stronę, np. '/'
      router.push('/');
    }
  } else {
    // Użytkownik nie jest zalogowany, przekieruj na stronę logowania
    router.push('/logowanie');
  }
},
fetchRezerwacjeImprez() {
    axios.get('http://46.41.148.115/api/rezerwacje-imprez-dane') // Tu podaj ścieżkę do API w Laravel
      .then(response => {
        this.rezerwacjeImprez = response.data; // Zaktualizuj dane w komponencie
      })
      .catch(error => {
        console.error('Błąd pobierania danych:', error);
      });
  },
},
  created() {
this.checkUserRole(); 
this.fetchRezerwacjeImprez();
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
    }
         table {
              width: 100%;
              border-collapse: collapse;
              box-shadow: var(--shadow);
              border-radius: 15px;
          }
          
          th, td {
              padding: 12px;
              text-align: left;
          }
          td {
            border-top: 1px solid var(--grey);
          }
          th {
            font-size: 16px;
            font-weight: 600;
          }
          td {
            font-size: 16px;
            font-weight: 400;
            white-space: normal;
            a {
              color: var(--black);
              text-underline-offset: 4px;
            }
          }
  
          @media (max-width: 768px) {
              table, thead, tbody, th, td, tr {
                  display: block;
                  border: none;
              }
  
              thead tr {
                  position: absolute;
                  top: -9999px;
                  left: -9999px;
              }
  
              tr {
                  margin-bottom: 15px;
              }
              
              td {
                  position: relative;
                  padding-left: 50%;
                  font-size: 12px;
                  text-align: right;
              }
              td:nth-child(2) {
                border-top: 1px solid var(--grey);
              }
              td:nth-child(3) {
                border-top: 1px solid var(--grey);
              }
              td:nth-child(4) {
                border-top: 1px solid var(--grey);
              }
              td:nth-child(5) {
                border-top: 1px solid var(--grey);
              }
              td::before {
                  content: attr(data-label);
                  position: absolute;
                  left: 0;
                  width: 50%;
                  padding-left: 15px;
                  font-weight: bold;
                  text-align: left;
              }
          }
  </style>