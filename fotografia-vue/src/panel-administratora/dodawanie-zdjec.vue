<template>
    <AdminHeader />
    <AdminSidebar />
    <div class="home">
      <div class="home-left">
        <form class="home-form" @submit.prevent="handleFileUpload">
      <div class="home-form-content">
        <h1>Dodawanie zdjęć</h1>
        <div class="input-flex">
          <input type="text" placeholder="Wprowadź nazwę użytkownika" v-model="userName" required>
          <input type="file" @change="handleFileChange" ref="fileInput" multiple required>
        </div>
        <div class="home-buttons">
          <button class="home-btn" type="submit">Dodaj zdjęcia</button>
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
        userName: '',
        selectedFiles: null,
      }
    },
    methods: {
      handleMenuToggle(menuActive) {
        this.isMenuActive = menuActive;
      },
      handleFileChange(event) {
      this.selectedFiles = event.target.files;
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
        router.push('/dodawanie-zdjec');
      } else {
        // Przekieruj na inną stronę, np. '/'
        router.push('/');
      }
    } else {
      // Użytkownik nie jest zalogowany, przekieruj na stronę logowania
      router.push('/logowanie');
    }
  },
  async handleFileUpload() {
      if (!this.userName) {
        alert('Wprowadź nazwę użytkownika.');
        return;
      }

      if (!this.selectedFiles || this.selectedFiles.length === 0) {
        alert('Wybierz pliki do przesłania.');
        return;
      }

      const formData = new FormData();
      formData.append('userName', this.userName);

      for (let i = 0; i < this.selectedFiles.length; i++) {
        formData.append('files[]', this.selectedFiles[i]);
      }

      try {
        const response = await axios.get(`http://46.41.148.115/api/sprawdzanie-uzytkownika?userName=${this.userName}`);
        if (response.data.exists) {
          const uploadResponse = await axios.post('http://46.41.148.115/api/dodawanie-zdjec', formData, {
            headers: {
              'Content-Type': 'multipart/form-data',
            },
          });
          alert('Zdjęcia zostały dodane.', uploadResponse.data);
        } else {
          alert('Użytkownik o podanej nazwie nie istnieje.');
        }
      } catch (error) {
        console.error('Błąd:', error);
        alert('Wystąpił błąd podczas przesyłania zdjęć.');
      }
    },
},
    created() {
  this.checkUserRole(); 
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