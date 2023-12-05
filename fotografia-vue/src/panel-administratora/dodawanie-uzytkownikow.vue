<template>
    <AdminHeader />
    <AdminSidebar />
    <div class="home">
      <div class="home-left">
        <form class="home-form" @submit.prevent="register">
          <div class="home-form-content">
            <h1>Dodawanie użytkowników</h1>
            <div class="input-flex">
              <input type="text" v-model="name" placeholder="Wprowadź nazwę użytkownika" required>
              <input type="email" v-model="email" placeholder="Wprowadź E-mail" required>
            </div>
            <div class="input-flex">
              <input type="password" v-model="password" placeholder="Wprowadź hasło" required>
              <input type="password" v-model="password_confirmation" placeholder="Powtórz hasło" required>
            </div>
            <div class="home-buttons">
              <button class="home-btn">Dodaj użytkownika</button>
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
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
        csrf: '',
        passwordError: '',
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
        router.push('/dodawanie-uzytkownikow');
      } else {
        // Przekieruj na inną stronę, np. '/'
        router.push('/');
      }
    } else {
      // Użytkownik nie jest zalogowany, przekieruj na stronę logowania
      router.push('/logowanie');
    }
  },
  async fetchCSRFToken() {
  try {
    const response = await axios.get('http://46.41.148.115/api/csrf-token');
    this.csrf = response.data.csrf_token;
  } catch (error) {
    window.alert('Błąd pobierania tokenu CSRF');
  }
},
async register() {
  await this.fetchCSRFToken();
  this.passwordError = '';

  const passwordPattern = /^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
  if (!passwordPattern.test(this.password)) {
    this.passwordError = alert('Hasło musi mieć co najmniej 8 znaków, co najmniej jedną dużą literę, co najmniej jedną cyfrę i co najmniej jeden znak specjalny.');
    return;
  }

  if (this.password !== this.password_confirmation) {
    this.passwordError = alert('Hasła do siebie nie pasują.');
    return;
  }

  try {
    const response = await axios.post('http://46.41.148.115/api/register', {
      email: this.email,
      name: this.name,
      password: this.password,
      password_confirmation: this.password_confirmation,
    },
    {
      headers: {
        'X-CSRF-TOKEN': this.csrf
      },
    });
    alert("Użytkownik został dodany.")
  } catch (error) {
    if (error.response && error.response.status === 422 && error.response.data.errors.email) {
      alert('Użytkownik o tym adresie e-mail już istnieje.');
    } else {
      alert("Wystąpił błąd podczas rejestracji. Skontaktuj się z pomocą techniczną.");
    }
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