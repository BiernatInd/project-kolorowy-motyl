<template>
    <MainHeader @menuToggled="handleMenuToggle" />
    <SlideMenu :menuActive="isMenuActive" />
    <div class="home">
        <div class="home-content">
            <div class="offer">
                <h1>Zarezerwuj <span>swój termin</span> sesji zdjęciowej</h1>
            </div>
            <div class="reservation-container">
                <div class="reservation-columns">
                    <div class="reservation-left">
                        <div class="reservation-left-content">
                            <p>Wybierz rodzaj usługi!</p>
                            <div class="reservation-buttons">
                                <router-link to="/rezerwacje-slub"><button class="reservation-btn">Ślub</button></router-link>
                                <router-link to="/rezerwacje-imprez"><button class="reservation-btn">Urodziny / Chrzciny / Roczek / Komunia</button></router-link>
                                <router-link to="/rezerwacje-biznesowe"><button class="reservation-btn active">Sesje indywidualne / Biznesowe / Inne</button></router-link>
                            </div>
                        </div>
                    </div>
                    <form class="reservation-right" @submit="sendForm">
                        <div class="reservation-right-content">
                            <p>Zarezerwuj swoją sesję!</p>
                            <div class="input-flex">
                                <input type="text" v-model="formData.imie" placeholder="Wprowadź imię" required/>
                                <input type="text" v-model="formData.nazwisko" placeholder="Wprowadź nazwisko" required>
                            </div>
                            <div class="input-flex">
                                <input type="email" v-model="formData.email" placeholder="Wprowadź E-mail" required>
                                <input type="number" v-model="formData.numerTelefonu" placeholder="Wprowadź numer telefonu" required>
                            </div>
                            <div class="input-flex">
                                <input type="date" id="dateInput" v-model="formData.dataRezerwacji" placeholder="Wprowadź datę" required :min="getCurrentDate()" @focus="blockSpecificDate"/>
                                <input type="text" v-model="formData.miejsceWydarzenia" placeholder="Wprowadź miejsce wydarzenia" required>
                            </div>
                            <div class="checkbox-flex">
                                <div class="checkbox-left">
                                    <div class="checkbox-text">
                                        <p>Sesja w plenerze</p>
                                    </div>
                                    <div class="checkbox-content">
                                        <input type="radio" name="sesja_w_plenerze" value="true" v-model="formData.sesjaWPlenerze" />
                                        <p>Tak</p>
                                        <input type="radio" name="sesja_w_plenerze" value="false" v-model="formData.sesjaWPlenerze" />
                                        <p>Nie</p>
                                    </div>
                                </div>
                            </div>
                            <div class="input-full-width">
                                <textarea v-model="formData.dodatkoweInformacje" placeholder="Dodatkowe informacje od klienta"></textarea>
                            </div>
                            <div class="reservation-buttons">
                                <button type="submit" class="reservation-btn">Wyślij wiadomość</button>
                                <button class="reservation-btn" type="reset">Zresetuj</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
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
          imie: '',
          nazwisko: '',
          email: '',
          numerTelefonu: '',
          dataRezerwacji: '',
          miejsceWydarzenia: '',
          sesjaWPlenerze: '',
          dodatkoweInformacje: '',
          isDateBlocked: false, 
        },
        reservedDates: [],
      }
    },
    methods: {
      handleMenuToggle(menuActive) {
        this.isMenuActive = menuActive;
      },
      async sendForm(event) {
        event.preventDefault();
        const reservationData = {
          imie: this.formData.imie,
          nazwisko: this.formData.nazwisko,
          email: this.formData.email,
          numer_telefonu: this.formData.numerTelefonu,
          data_rezerwacji: this.formData.dataRezerwacji,
          miejsce_wydarzenia: this.formData.miejsceWydarzenia,
          sesja_w_plenerze: this.formData.sesjaWPlenerze === "true",
          dodatkowe_informacje: this.formData.dodatkoweInformacje,
        };
  
        // Dodaj console.log do monitorowania danych
        console.log('Dane do wysłania:', reservationData);
  
        try {
          const response = await axios.post('http://46.41.148.115/api/rezerwacje-biznesowe', reservationData);
          console.log('Odpowiedź z serwera:', response.data);
        } catch (error) {
          console.error('Wystąpił błąd podczas wysyłania danych:', error);
        }
      },
      //Daty które nie istnieją
      getCurrentDate() {
        const today = new Date();
        const year = today.getFullYear();
        const month = (today.getMonth() + 1).toString().padStart(2, '0');
        const day = today.getDate().toString().padStart(2, '0');
        return `${year}-${month}-${day}`;
      },
      //Pobieranie daty z bazy danych
      async fetchDataFromAPI() {
        try {
          const response = await axios.get('http://46.41.148.115/api/kalendarz-biznesowy');
          this.reservedDates = response.data;
          console.log('Dane zostały pobrane z API:', this.reservedDates);
        } catch (error) {
          console.error('Wystąpił błąd podczas pobierania danych z API:', error);
        }
      },
      //Zablokowanie daty z bazy danych
      blockSpecificDate() {
      const dateInput = document.getElementById('dateInput');
      dateInput.addEventListener('input', () => {
        const selectedDate = new Date(dateInput.value);
        const isReserved = this.reservedDates.includes(dateInput.value);

        if (isReserved) {
          alert('Data już jest zarezerwowana, proszę wybrać inną.');
          dateInput.value = ''; // Wyczyść wartość, jeśli data jest zarezerwowana
          this.formData.isDateBlocked = true; // Ustaw flagę na true
        }
      });
    },
    },
    //Walidacja daty
    watch: {
    // Obserwujemy zmiany w innych polach, aby zablokować datę, jeśli flaga isDateBlocked jest true
    'formData.imie': function () {
      if (this.formData.isDateBlocked) {
        this.formData.dataRezerwacji = '';
      }
    },
    'formData.nazwisko': function () {
      if (this.formData.isDateBlocked) {
        this.formData.dataRezerwacji = '';
      }
    },
    'formData.email': function () {
      if (this.formData.isDateBlocked) {
        this.formData.dataRezerwacji = '';
      }
    },
    'formData.numerTelefonu': function () {
      if (this.formData.isDateBlocked) {
        this.formData.dataRezerwacji = '';
      }
    },
  },
  //Wywołanie danych z bazy
    created() {
      this.fetchDataFromAPI();
    },
  };
  </script>
  
  <style lang="scss" scoped>
    .home {
      width: 90%;
      margin-left: auto;
      margin-right: auto;
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
      .reservation-container {
        margin-bottom: 2rem;
        .reservation-columns {
            display: flex;
            justify-content: space-between;
            .reservation-left {
                width: 25%;
                box-shadow: var(--shadow);
                border-radius: 25px;
                height: 200px;
                .reservation-left-content {
                    width: 90%;
                    margin-left: auto;
                    margin-right: auto;
                    padding-top: 1rem;
                    padding-bottom: 1rem;
                    p {
                        font-size: 24px;
                        margin-bottom: 1rem;
                    }
                    .reservation-buttons {
                        display: flex;
                        flex-direction: column;
                            .reservation-btn {
                                width: 100%;
                                margin-bottom: 1rem;
                                padding: 0.3rem;
                                border-radius: 25px;
                                background-color: var(--white);
                                color: var(--pink);
                                border: 1px solid var(--pink);
                                cursor: pointer;
                                font-size: 16px;
                                font-weight: 400;
                                transition: 0.5s;
                                &:hover {
                                    background-color: var(--white);
                                    color: var(--pink);
                                }
                            }
                            .reservation-btn.active {
                                background-color: var(--pink);
                                color: var(--white);
                            }
                    }
                }
            }
            .reservation-right {
                box-shadow: var(--shadow);
                width: 73%;
                border-radius: 25px;
                display: flex;
                align-items: center;
                .reservation-right-content {
                    width: 95%;
                    margin-left: auto;
                    margin-right: auto;
                    p {
                        padding-top: 1rem;
                        font-size: 24px;
                        margin-bottom: 1rem;
                    }
                    .input-flex {
                        display: flex;
                        justify-content: space-between;
                        margin-bottom: 1rem;
                        input {
                            width: 48%;
                            border: none;
                            border-bottom: 1px solid var(--pink);
                            border-radius: 25px;
                            padding: 0.6rem;
                            font-size: 16px;
                        }
                    }
                    .input-full-width {
                        margin-bottom: 1rem;
                        input {
                            width: 100%;
                            border: none;
                            border-bottom: 1px solid var(--pink);
                            border-radius: 25px;
                            padding: 0.6rem;
                            font-size: 16px;
                        }
                    }
                    .checkbox-flex {
                        display: flex;
                        flex-direction: column;
                        .checkbox-left {
                            width: 60%;
                            display: flex;
                            justify-content: space-between;
                            .checkbox-text {
                                p {
                                    font-size: 20px;
                                }
                            }
                            .checkbox-content {
                                display: flex;
                                align-items: center;
                                p {
                                    margin-right: 1rem;
                                    margin-left: 1rem;
                                    font-size: 20px;   
                                }
                                input {
                                    width: 15px;
                                    cursor: pointer;
                                }
                            }
                        }
                        .checkbox-right {
                            width: 50%;
                            .checkbox {
                                display: flex;
                                p {
                                    margin-left: 1rem;
                                    margin-right: 1rem;
                                    font-size: 20px;
                                }
                                input {
                                    width: 15px;
                                    cursor: pointer;
                                }
                            }
                        }
                    }
                    .input-full-width {
                        margin-top: 1rem;
                        textarea {
                            width: 100%;
                            height: 200px;
                            border: none;
                            border-bottom: 1px solid var(--pink);
                            border-radius: 25px;
                            padding: 0.6rem;
                            font-size: 16px;
                            resize: none;
                        }
                    }
                    .reservation-buttons {
                        margin-top: 1rem;
                        margin-bottom: 1rem;
                        .reservation-btn {
                            padding: 0.2rem 2rem;
                            font-size: 16px;
                            background-color: var(--white);
                            border: 1px solid var(--pink);
                            border-radius: 25px;
                            color: var(--pink);
                            margin-right: 1rem;
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

    @media screen and (max-width: 1700px) {
        .home {
            .home-content {
                .reservation-container {
                    .reservation-columns {
                        .reservation-left {
                            height: 100%;
                            .reservation-buttons {
                                .reservation-btn {
                                    width: 100%;
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    @media screen and (max-width: 1400px) {
        .home {
            .home-content {
                .reservation-container {
                    .reservation-columns {
                        flex-direction: column;
                        .reservation-left {
                            width: 100%;
                            margin-left: auto;
                            margin-right: auto;
                            margin-bottom: 2rem;
                        }
                        .reservation-right {
                            width: 100%;
                            margin-left: auto;
                            margin-right: auto;
                            .reservation-right-content {
                                .input-flex {
                                    flex-direction: column;
                                    margin-bottom: 0;
                                    input {
                                        width: 100%;
                                        margin-bottom: 1rem;
                                    }
                                }
                                .checkbox-flex {
                                    .checkbox-left {
                                        .checkbox-text {
                                            p {
                                                font-size: 16px;
                                            }
                                        }
                                        .checkbox-content {
                                            p {
                                                font-size: 16px;
                                            }
                                        }
                                    }
                                 }
                                .input-full-width {
                                    margin-top: 0;
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
            }
        }
    }

    @media screen and (max-width: 768px) {
        .home {
            .home-content {
                .offer {
                    h1 {
                        text-align: left;
                        font-size: 24px;
                    }
                }
                .reservation-container {
                    margin-bottom: 2rem;
                    .reservation-columns {
                        .reservation-right {
                            .checkbox-flex {
                                .checkbox-left {
                                    width: 100%;
                                    flex-direction: column;
                                    .checkbox-text {
                                        width: 100%;
                                    }
                                    .checkbox-content {
                                        width: 100%;
                                    }
                                }
                            }
                            .reservation-buttons {
                                display: flex;
                                flex-direction: column;
                                .reservation-btn:nth-child(1) {
                                    margin-bottom: 1rem;
                                    width: 80%;
                                }
                                .reservation-btn:nth-child(2) {
                                    width: 60%;
                                }
                            }
                        }
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
          .reservation-container {
            .reservation-columns {
                .reservation-left {
                    p {
                        font-size: 16px;
                    }
                    .reservation-buttons {
                        .reservation-btn {
                            font-size: 14px!important;
                        }
                    }
                }
                .reservation-right {
                    .reservation-right-content {
                        p {
                            font-size: 16px;
                        }
                        .input-flex {
                            input {
                                font-size: 14px;
                            }
                        }
                        .checkbox-flex {
                            .checkbox-left {
                                .checkbox-text {
                                    p {
                                        font-size: 14px;
                                    }
                                }
                                .checkbox-content {
                                    p {
                                        font-size: 14px;
                                    }
                                }
                            }
                        }
                        .input-full-width {
                            textarea {
                                font-size: 14px;
                            }
                        }
                        .reservation-buttons {
                            .reservation-btn:nth-child(1) {
                                width: 100%;
                            }
                            .reservation-btn:nth-child(2) {
                                width: 80%;
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