<template>
    <MainHeader @menuToggled="handleMenuToggle" />
    <SlideMenu :menuActive="isMenuActive" />
    <div class="home">
        <div class="home-content">
            <div class="offer">
                <h1>Witaj <span>{{ userName }},</span> poniżej znajdziesz wszystkie <span>twoje zdjęcia</span> dostępne w naszej galerii.</h1>
            </div>
            <div class="offer-box-container" v-for="(photoGroup, index) in photoGroups" :key="index">
      <div class="offer-box" v-for="photoUrl in photoGroup" :key="photoUrl">
        <img :src="photoUrl" alt="Zdjęcie użytkownika">
      </div>
    </div>
            <div class="offer-buttons">
              <button class="offer-btn" @click="handleDownloadAllPhotos">Pobierz wszystkie zdjęcia</button>
            </div>
        </div>
    </div>
    <MainFooter />
  </template>
  
  <script>
  import MainHeader from '../components/main-header.vue'
  import MainFooter from '../components/main-footer.vue'
  import SlideMenu from '../components/slide-menu.vue'
  import router from '../router/router'
  import axios from 'axios';
  import JSZip from 'jszip';
  
  export default {
    computed: {
    // Podziel zdjęcia na grupy po 3
    photoGroups() {
      const groups = [];
      for (let i = 0; i < this.photoUrls.length; i += 3) {
        groups.push(this.photoUrls.slice(i, i + 3));
      }
      return groups;
    },
  },
    components: {
      MainHeader,
      MainFooter,
      SlideMenu,
    },
    data() {
      return {
        isMenuActive: false,
        userId: '',
        userName: '',
        photoUrls: [],
      };
    },
    methods: {
      handleMenuToggle(menuActive) {
        this.isMenuActive = menuActive;
      },
      
      handleDownloadAllPhotos() {
    // Pobierz userId z localStorage
    const userId = localStorage.getItem('userId');

    // Sprawdź, czy userId jest dostępne i prawidłowe
    if (!userId) {
      console.error('Brak dostępnego userId.');
      return;
    }

    // Wywołaj akcję API do pobierania archiwum ZIP
    console.log('Pobieranie zdjęć rozpoczęte.');
    axios.get(`http://46.41.148.115/api/pobieranie-zdjec-zip/${userId}`, { responseType: 'blob' })
      .then((response) => {
        const blobUrl = URL.createObjectURL(response.data);
        const a = document.createElement('a');
        a.href = blobUrl;
        a.download = `${this.userName}_photos.zip`;
        a.click();
        URL.revokeObjectURL(blobUrl);
        console.log('Pobieranie zdjęć zakończone sukcesem.');
      })
      .catch((error) => {
        console.error('Błąd podczas pobierania archiwum ZIP', error);
      });
    },

    },
    created() {
    const isLoggedIn = localStorage.getItem('isLoggedIn') === 'true';
    const userRole = localStorage.getItem('userRole');
    const userId = localStorage.getItem('userId');

    if (isLoggedIn) {
      if (userRole === 'admin' || (userRole === 'user' && userId === this.$route.params.userId)) {
        // Użytkownik jest zalogowany jako 'admin' lub jako 'user' i ma dostęp do tej strony

        // Pobierz dane użytkownika z API
        axios.get(`http://46.41.148.115/api/user/${userId}`)
          .then(response => {
            console.log('API response:', response.data);
            this.userName = response.data.name;

            // Pobierz zdjęcia użytkownika z API
            axios.get(`http://46.41.148.115/api/pobieranie-zdjec/${userId}`)
              .then(photoResponse => {
                console.log('Zdjęcia użytkownika:', photoResponse.data);
                this.photoUrls = photoResponse.data;
              })
              .catch(error => {
                console.error('Błąd podczas pobierania zdjęć użytkownika', error);
              });
          })
          .catch(error => {
            console.error('Błąd podczas pobierania danych użytkownika', error);
          });
      } else {
        // Użytkownik nie ma dostępu, przekieruj na odpowiednią stronę
        router.push('/galeria-uzytkownika/' + userId);
      }
    } else {
      // Użytkownik nie jest zalogowany, przekieruj na stronę logowania
      router.push('/logowanie');
    }
  },
  };
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
              color: var(--blue);
            }
            span:nth-child(2) {
              color: var(--pink);
            }
            span:nth-child(3) {
              color: var(--pink);
            }
          }
        }
        .offer-box-container {
            display: flex;
            justify-content: space-between;
            margin-bottom: 2rem;
            .offer-box {
                width: 30%;
                img {
                    display: block;
                    width: 100%;
                }
            }
        }
        .offer-buttons {
            display: flex;
            justify-content: center;
            margin-bottom: 2rem;
            .offer-btn {
                padding: 0.4rem 2rem;
                font-size: 16px;
                background-color: var(--white);
                color: var(--pink);
                border: 1px solid var(--pink);
                border-radius: 25px;
                cursor: pointer;
                transition: 0.5s;
                &:hover {
                    background-color: var(--pink);
                    color: var(--white);
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
          .offer-box-container {
            flex-direction: column;
            margin-bottom: 0;
            .offer-box {
                width: 80%;
                margin-left: auto;
                margin-right: auto;
                margin-bottom: 2rem;
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
          .offer-buttons {
            .offer-btn {
                font-size: 14px;
            }
          }
        }
      }
    }
  </style>