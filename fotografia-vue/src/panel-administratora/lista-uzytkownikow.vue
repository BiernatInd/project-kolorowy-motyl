<template>
    <AdminHeader />
    <AdminSidebar />
    <div class="home">
      <table>
        <thead>
          <tr>
            <th>Nazwa użytkownika</th>
            <th>E-mail</th>
            <th>Usuwanie</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="user in users" :key="user.id">
            <td data-label="Nazwa użytkownika">{{ user.name }}</td>
            <td data-label="E-mail">{{ user.email }}</td>
            <td data-label="Usuwanie">
              <a @click="confirmDeleteUser(user.id)">Usuń</a>
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
        users: [], 
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
        router.push('/lista-uzytkownikow');
      } else {
        // Przekieruj na inną stronę, np. '/'
        router.push('/');
      }
    } else {
      // Użytkownik nie jest zalogowany, przekieruj na stronę logowania
      router.push('/logowanie');
    }
  },
  getUsers() {
        // Wykonaj żądanie GET do API, które zwraca listę użytkowników
        axios.get('http://46.41.148.115/api/uzytkownicy')
          .then((response) => {
            // Zaktualizuj dane użytkowników
            this.users = response.data;
          })
          .catch((error) => {
            console.error('Błąd podczas pobierania danych:', error);
          });
      },
      deleteUser(userId) {
        // Wysyłaj żądanie do API, aby usunąć użytkownika na podstawie userId
        axios.delete(`http://46.41.148.115/api/uzytkownicy/${userId}`)
          .then(() => {
            alert('Użytkownik został usunięty')
            // Po usunięciu użytkownika, zaktualizuj listę użytkowników
            this.getUsers();
          })
          .catch((error) => {
            console.error('Błąd podczas usuwania użytkownika:', error);
          });
      },
      confirmDeleteUser(userId) {
      const confirmed = window.confirm('Czy na pewno chcesz usunąć tego użytkownika?');

      if (confirmed) {
        this.deleteUser(userId);
      }
    },
    },
    created() {
  this.checkUserRole(); 
  this.getUsers(); 
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
              text-decoration: underline;
              text-underline-offset: 4px;
              cursor: pointer;
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