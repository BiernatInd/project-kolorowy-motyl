<template>
  <AdminHeader />
  <AdminSidebar />
  <div class="home">
    <table>
      <thead>
        <tr>
          <th>Numer</th>
          <th>Nazwa wpisu</th>
          <th>Data dodania wpisu</th>
          <th>Dodaj treść</th>
          <th>Edytowanie</th>
          <th>Usuwanie</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="wpis in wpisy" :key="wpis.id">
          <td data-label="Numer">{{ wpis.id }}</td>
          <td data-label="Nazwa wpisu">{{ wpis.nazwa }}</td>
          <td data-label="Data dodania wpisu">{{ formatDataDodania(wpis.created_at) }}</td>
          <td data-label="Dodawanie treści">
            <router-link :to="'/dodawanie-tresci-wpisow/' + wpis.nazwa">Dodaj treść</router-link>
          </td>
          <td data-label="Edytowanie">
            <router-link :to="'/edytowanie-wpisow/' + wpis.nazwa">Edytuj wpis</router-link>
          </td>
          <td data-label="Usuwanie">
            <a @click="confirmDeleteWpis(wpis.nazwa)" href="#">Usuń wpis</a>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
  <AdminLoginSidebar />
  <MainFooter />
</template>

<script>
import axios from 'axios';
import AdminHeader from '../components/admin-header.vue'
import AdminSidebar from '../components/admin-sidebar.vue'
import AdminLoginSidebar from '../components/admin-login-sidebar.vue'
import MainFooter from '../components/main-footer.vue'

export default {
   components: {
    AdminHeader,
    AdminSidebar,
    AdminLoginSidebar,
    MainFooter,
  },
  data() {
    return {
      wpisy: [],
    };
  },
  mounted() {
    this.fetchWpisy();
    this.checkUserRole();
  },
  methods: {
    fetchWpisy() {
      axios.get('http://46.41.148.115/api/pobierz-wpisy')
        .then(response => {
          this.wpisy = response.data;
        })
        .catch(error => {
          console.error('Błąd podczas pobierania wpisów: ', error);
        });
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
   confirmDeleteWpis(wpisId) {
      if (confirm('Czy na pewno chcesz usunąć ten wpis i jego treści?')) {
        this.deleteWpis(wpisId);
      }
    },

    deleteWpis(nazwaWpisu) {
      axios.delete(`http://46.41.148.115/api/usun-wpis/${nazwaWpisu}`)
        .then(response => {
          if (response.data.message === 'Wpisy i związane z nimi treści wpisów zostały usunięte') {
            // Pomyślnie usunięto wpis, odśwież listę wpisów
            this.fetchWpisy();
          }
        })
        .catch(error => {
          console.error('Błąd podczas usuwania wpisu: ', error);
        });
    },
    checkUserRole() {
  const userRole = localStorage.getItem('userRole');
  if (userRole === 'admin') {
    this.$router.push('/lista-wpisow');
  } else {
    this.$router.push('/logowanie');
  }
}

  },
};
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