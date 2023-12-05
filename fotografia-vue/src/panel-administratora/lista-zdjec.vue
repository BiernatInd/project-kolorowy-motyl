<template>
    <AdminHeader />
    <AdminSidebar />
    <div class="home">
      <table>
        <thead>
          <tr>
            <th>Id zdjęcia</th>
            <th>Nazwa użytkownika</th>
            <th>Nazwa zdjęcia</th>
            <th>Ścieżka zdjęcia</th>
            <th>Usuwanie</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="zdjecie in zdjecia" :key="zdjecie.id">
            <td data-label="Id zdjęcia">{{ zdjecie.id }}</td>
            <td data-label="Nazwa użytkownika">{{ zdjecie.nazwa_uzytkownika }}</td>
            <td data-label="Nazwa zdjęcia">{{ zdjecie.nazwa_zdjecia }}</td>
            <td data-label="ścieżka zdjęcia">{{ zdjecie.sciezka_zdjecia }}</td>
            <td data-label="Usuwanie">
              <a href="#" @click="usunZdjecie(zdjecie.id, zdjecie.sciezka_zdjecia)">Usuń</a>
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
        zdjecia: [],
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
        router.push('/lista-zdjec');
      } else {
        // Przekieruj na inną stronę, np. '/'
        router.push('/');
      }
    } else {
      // Użytkownik nie jest zalogowany, przekieruj na stronę logowania
      router.push('/logowanie');
    }
  },
  usunZdjecie(zdjecieId, sciezkaZdjecia) {
    axios.post('http://46.41.148.115/api/usun-zdjecie', { zdjecie_id: zdjecieId })
      .then(response => {
        // Zdjęcie zostało usunięte z bazy i z serwera
        console.log(response.data.message);

        // Teraz możesz zaktualizować widok, aby usunąć zdjęcie z tabeli
        const index = this.zdjecia.findIndex(zdjecie => zdjecie.id === zdjecieId);
        if (index !== -1) {
          this.zdjecia.splice(index, 1);
        }
      })
      .catch(error => {
        console.error(error);
        // Obsłuż błędy, jeśli wystąpią
      });
  },

    },
    created() {
  this.checkUserRole(); 
  axios.get('http://46.41.148.115/api/lista-zdjec').then(response => {
       this.zdjecia = response.data
   })
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