<template>
    <MainHeader @menuToggled="handleMenuToggle" />
    <SlideMenu :menuActive="isMenuActive" />
    <div class="home">
        <div class="home-content">
            <div class="offer">
                <h1><span>Formularz kontaktowy - </span> Napisz do nas!</h1>
            </div>
            <form class="contact" @submit.prevent="sendEmail">
                <div class="contact-columns">
                    <div class="contact-left">
                        <div class="contact-left-content">
                            <h2>Informacje</h2>
                            <p>Nazwa firmy:</p>
                            <p>Adres:</p>
                            <p>NIP:</p>
                            <p>Regon:</p>
                            <p>Kontakt telefoniczny:</p>
                            <p>E-mail:</p>
                        </div>
                    </div>
                    <div class="contact-right">
                        <div class="contact-right-content">
                            <h2>Skontaktuj się z nami!</h2>
                            <div class="input-flex">
                              <input type="text" v-model="formData.name" placeholder="Imię" required>
                              <input type="text" v-model="formData.surname" placeholder="Nazwisko" required>
                            </div>
                            <div class="input-flex">
                              <input type="email" v-model="formData.email" placeholder="E-mail" required>
                              <input type="number" v-model="formData.phone" placeholder="Numer telefonu" required>
                            </div>
                            <div class="input-full-width">
                              <textarea v-model="formData.message" placeholder="Wiadomość i inne ważne informacje"></textarea>
                            </div>
                            <div class="contact-buttons">
                              <button type="submit" class="contact-btn">Wyślij wiadomość</button>
                              <button type="reset" class="contact-btn">Zresetuj</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <MainFooter />
  </template>
  
  <script>
  
  import MainHeader from '../components/main-header.vue'
  import MainFooter from '../components/main-footer.vue'
  import SlideMenu from '../components/slide-menu.vue'
  import axios from 'axios'
  
  export default {
    components: {
      MainHeader,
      MainFooter,
      SlideMenu,
    },
    data() {
      return {
        isMenuActive: false,
        formData: {
        name: '',
        surname: '',
        email: '',
        phone: '',
        message: ''
      }
      };
    },
    methods: {
      handleMenuToggle(menuActive) {
        this.isMenuActive = menuActive;
      },
      sendEmail() {
  axios.post('http://46.41.148.115/api/wyslij-formularz', this.formData)
    .then(response => {
      alert("Wiadomość została wysłana. Wkrótce się z tobą skontaktujemy!");
    })
    .catch(error => {
      console.error(error);
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
        .offer {
          margin-top: 2rem;
          margin-bottom: 2rem;
          padding-top: 2rem;
          padding-bottom: 2rem;
          border-radius: 25px;
          box-shadow: var(--shadow);
          h1 {
            width: 1300px;
            text-align: center;
            margin-left: auto;
            margin-right: auto;
            font-weight: 400;
            span:nth-child(1) {
              color: var(--pink);
            }
          }
        }
        .contact {
            width: 1200px;
            margin-left: auto;
            margin-right: auto;
            border-radius: 25px;
            box-shadow: var(--shadow);
            margin-bottom: 2rem;
            .contact-columns {
                display: flex;
                .contact-left {
                    width: 50%;
                    border-right: 1px solid var(--pink);
                    background: url('../assets/logo2.png');
                    background-repeat: no-repeat;
                    background-position: center;
                    .contact-left-content {
                        width: 90%;
                        padding-top: 1rem;
                        margin-left: auto;
                        margin-right: auto;
                        h2 {
                            font-size: 24px;
                            font-weight: 400;
                            margin-bottom: 1rem;
                        }
                        p {
                            font-size: 16px;
                            margin-bottom: 1rem;
                        }
                    }
                }
                .contact-right {
                    width: 50%;
                    .contact-right-content {
                        width: 90%;
                        margin-left: auto;
                        margin-right: auto;
                        h2 {
                            padding-top: 1rem;
                            font-size: 24px;
                            font-weight: 400;
                            margin-bottom: 1rem;
                        }
                        .input-flex {
                            display: flex;
                            justify-content: space-between;
                            margin-bottom: 1rem;
                            input {
                                width: 48%;
                                padding: 0.6rem;
                                border-radius: 25px;
                                border: none;
                                border-bottom: 1px solid var(--pink);
                                font-size: 16px;
                            }
                        }
                        .input-full-width {
                            margin-bottom: 1rem;
                            textarea {
                                width: 100%;
                                height: 200px;
                                border-radius: 25px;
                                padding: 0.6rem;
                                border: none;
                                border-bottom: 1px solid var(--pink);
                                font-size: 16px;
                            }
                        }
                        .contact-buttons {
                            margin-bottom: 1rem;
                            .contact-btn:nth-child(1) {
                                padding: 0.2rem 2rem;
                                background-color: var(--white);
                                color: var(--pink);
                                font-size: 16px;
                                border-radius: 25px;
                                border: 1px solid var(--pink);
                                margin-right: 1rem;
                                transition: 0.5s;
                                cursor: pointer;
                                &:hover {
                                    background-color: var(--pink);
                                    color: var(--white);
                                }
                            }
                            .contact-btn:nth-child(2) {
                                padding: 0.2rem 2rem;
                                background-color: var(--white);
                                color: var(--pink);
                                font-size: 16px;
                                border-radius: 25px;
                                border: 1px solid var(--pink);
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
        }
      }
    }

    @media screen and (max-width: 1600px) {
      .home {
        .home-content {
          .offer {
            h1 {
              width: 90%;
            }
          }
          .contact {
            width: 80%;
          }
        }
      }
    }

    @media screen and (max-width: 1200px) {
      .home {
        .home-content {
          .offer {
            h1 {
              font-size: 24px;
            }
          }
          .contact {
            width: 100%;
            .contact-columns {
                flex-direction: column;
                .contact-left {
                    width: 100%;
                    background: none;
                    border-right: none;
                    border-bottom: 1px solid var(--pink);
                    .contact-left-content {
                        width: 95%;
                    }
                }
                .contact-right {
                    width: 100%;
                    .contact-right-content {
                        width: 95%;
                        .input-flex {
                            flex-direction: column;
                            margin-bottom: 0;
                            input {
                                width: 100%;
                                margin-bottom: 1rem;
                            }
                        }
                    }
                    .contact-buttons {
                        display: flex;
                        flex-direction: column;
                        .contact-btn:nth-child(1) {
                            width: 80%;
                            margin-bottom: 1rem;
                        }
                        .contact-btn:nth-child(2) {
                            width: 60%;
                        }
                    }
                }
            }
          }
        }
      }
    }

    @media screen and (max-width: 768px) {
      .home {
        .home-content {
          .offer {
                h1 {
                    text-align: left;
                }
            }
        }
      }
    }

    @media screen and (max-width: 320px) {
      .home {
        .home-content {
          .offer {
            h1 {
              font-size: 16px;
            }
          }
          .contact {
            .contact-columns {
                .contact-left {
                    .contact-left-content {
                        h2 {
                            font-size: 16px;
                        }
                        p {
                            font-size: 14px;
                        }
                    }
                }
                .contact-right {
                    .contact-right-content {
                        h2 {
                            font-size: 16px;
                        }
                        .input-flex {
                            input {
                                font-size: 14px;
                            }
                        }
                        .input-full-width {
                            textarea {
                                font-size: 14px;
                            }
                        }
                        .contact-buttons {
                            .contact-btn:nth-child(1) {
                                width: 90%;
                                font-size: 14px;
                            }
                            .contact-btn:nth-child(2) {
                                font-size: 14px;
                            }
                        }
                    }
                }
            }
          }
        }
      }
    }
  </style>