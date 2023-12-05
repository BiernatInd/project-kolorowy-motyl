<template>
    <MainHeader @menuToggled="handleMenuToggle" />
    <SlideMenu :menuActive="isMenuActive" />
    <div class="home">
        <div class="home-content">
           <form class="auth-form" @submit.prevent="recoverPassword">
                <div class="auth-form-content">
                    <h1>Odzyskiwanie hasła</h1>
                    <div class="auth-input">
                        <input type="email" v-model="email" placeholder="Wprowadź E-mail">
                    </div>
                    <div class="auth-buttons">
                        <button type="submit" class="auth-btn">Odzyskaj hasło</button>
                    </div>
                </div>
           </form>
        </div>
    </div>
    <MainFooter />
  </template>
  
  <script>
  import MainHeader from '../components/main-header.vue'
  import SlideMenu from '../components/slide-menu.vue'
  import MainFooter from '../components/main-footer.vue'
  import axios from 'axios';
  
  export default {
    components: {
      MainHeader,
      SlideMenu,
      MainFooter
    },
    data() {
      return {
        isMenuActive: false,
        email: '',
      }
    },
    methods: {
      handleMenuToggle(menuActive) {
        this.isMenuActive = menuActive;
      },
      recoverPassword() {
        axios.post('http://46.41.148.115/api/recover-password', { email: this.email })
        .then(response => {
          alert('Wiadomość z linkiem resetującym hasło została wysłana na podany adres E-mail.'); 
        })
        .catch(error => {
          alert('Wiadmość nie została wysłana. Spróbuj ponownie!'); 
        });
      }
    }
  }
  </script>
  
  <style lang="scss" scoped>
    .home {
      width: 90%;
      margin-left: auto;
      margin-right: auto;
      .home-content {
        padding-top: 2rem;
        padding-bottom: 2rem;
        .auth-form {
            width: 500px;
            margin-left: auto;
            margin-right: auto;
            border-radius: 25px;
            box-shadow: var(--shadow);
            .auth-form-content {
                width: 90%;
                margin-left: auto;
                margin-right: auto;
                h1 {
                    padding-top: 2rem;
                    font-size: 24px;
                    font-weight: 400;
                    margin-bottom: 2rem;
                }
                .auth-input {
                    input {
                        width: 100%;
                        padding: 0.4rem;
                        border-radius: 25px;
                        border: none;
                        border-bottom: 1px solid var(--pink);
                        font-size: 16px;
                        margin-bottom: 2rem;
                    }
                }
            }
            .auth-buttons {
                display: flex;
                flex-direction: column;
                .auth-btn {
                    padding: 0.4rem;
                    background-color: var(--white);
                    border: 1px solid var(--pink);
                    color: var(--pink);
                    border-radius: 25px;
                    font-size: 16px;
                    margin-bottom: 2rem;
                    cursor: pointer;
                    transition: 0.5s;
                    &:hover {
                        background-color: var(--pink);
                        color: var(--white);
                    }
                }
                a {
                    color: var(--black);
                    font-size: 16px;
                    text-underline-offset: 4px;
                    margin-bottom: 2rem;
                }
            }
        }
      }
    }

    @media screen and (max-width: 768px) {
        .home {
            .home-content {
                .auth-form {
                    width: 100%;
                }
            }
        }
    }

    @media screen and (max-width: 320px) {
        .home {
            .home-content {
                .auth-form {
                    width: 100%;
                    .auth-form-content {
                        h1 {
                            padding-top: 1rem;
                            font-size: 16px;
                            margin-bottom: 1rem;
                        }
                        .auth-input {
                            input {
                                margin-bottom: 1rem;
                                font-size: 14px;
                            }
                        }
                        .auth-buttons {
                            .auth-btn {
                                font-size: 14px;
                                margin-bottom: 1rem;
                            }
                            a {
                                font-size: 14px;
                                margin-bottom: 1rem;
                            }
                        }
                    }
                }
            }
        }
    }


  </style>