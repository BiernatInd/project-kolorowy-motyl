import { createRouter, createWebHistory } from 'vue-router'
import StronaGlowna from '../podstrony/strona-glowna.vue'
import NaszaOferta from '../podstrony/nasza-oferta.vue'
import Portfolio from '../podstrony/portfolio.vue'
import ONaszejFirmie from '../podstrony/o-naszej-firmie.vue'
import StrefaKlienta from '../podstrony/strefa-klienta.vue'
import RezerwacjeSlub from '../podstrony/rezerwacje-slub.vue'
import RezerwacjeImprez from '../podstrony/rezerwacje-imprez.vue'
import RezerwacjeBiznesowe from '../podstrony/rezerwacje-biznesowe.vue'
import Kontakt from '../podstrony/kontakt.vue'
import Blog from '../podstrony/blog.vue'
import Artykul from '../podstrony/artykul.vue'
import PolitykaPrywatnosci from '../podstrony/polityka-prywatnosci.vue'
import GaleriaUzytkownika from '../podstrony/galeria-uzytkownika.vue'
import Rejestracja from '../system-autoryzacji/rejestracja.vue'
import Logowanie from '../system-autoryzacji/logowanie.vue'
import OdzyskiwanieHasla from '../system-autoryzacji/odzyskiwanie-hasla.vue'
import ResetowanieHasla from '../system-autoryzacji/resetowanie-hasla.vue'
import ListaRezerwacjeSlubow from '../panel-administratora/lista-rezerwacje-slubow.vue'
import ListaRezerwacjeImprez from '../panel-administratora/lista-rezerwacje-imprez.vue'
import ListaRezerwacjeBiznesowe from '../panel-administratora/lista-rezerwacje-biznesowe.vue'
import ListaUzytkownikow from '../panel-administratora/lista-uzytkownikow.vue'
import ListaZdjec from '../panel-administratora/lista-zdjec.vue'
import ListaWpisow from '../panel-administratora/lista-wpisow.vue'
import DodawanieUzytkownikow from '../panel-administratora/dodawanie-uzytkownikow.vue'
import DodawanieZdjec from '../panel-administratora/dodawanie-zdjec.vue'
import DodawanieWpisow from '../panel-administratora/dodawanie-wpisow.vue'
import DodawanieTresciWpisow from '../panel-administratora/dodawanie-tresci-wpisow.vue'
import EdytowanieWpisow from '../panel-administratora/edytowanie-wpisow.vue'
import InformacjeRezerwacjeSlubow from '../panel-administratora/informacje-rezerwacje-slubow.vue'
import InformacjeRezerwacjeImprez from '../panel-administratora/informacje-rezerwacje-imprez.vue'
import InformacjeRezerwacjeBiznesowe from '../panel-administratora/informacje-rezerwacje-biznesowe.vue'
import Axios from 'axios'
import Cookies from '../components/cookies.vue'

const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: '/cookies',
            component: Cookies,
            name: "cookies",
        },
        {
            path: '/',
            component: StronaGlowna,
            name: "strona-glowna",
            meta: {
                title: "Fotografia Kolorowy Motyl - Tworzymy niezapomniane chwile",
                description: "Zapraszamy na naszą stronę główną, gdzie znajdziesz niezwykłe zdjęcia i usługi fotograficzne. Pozwól nam uwiecznić Twoje ważne momenty.",
            },
        },
        {
            path: '/nasza-oferta',
            component: NaszaOferta,
            name: "nasza-oferta",
            meta: {
                title: "Nasza oferta - Fotografia Kolorowy Motyl",
                description: "Zapoznaj się z naszą szeroką ofertą usług fotograficznych. Oferujemy sesje zdjęciowe na miarę Twoich potrzeb.",
            },
        },
        {
            path: '/portfolio',
            component: Portfolio,
            name: "portfolio",
            meta: {
                title: "Portfolio - Fotografia Kolorowy Motyl",
                description: "Przeglądaj nasze imponujące portfolio, aby zobaczyć nasze wcześniejsze prace. Zdjęcia, które mówią same za siebie.",
            },
        },
        {
            path: '/o-naszej-firmie',
            component: ONaszejFirmie,
            name: "o-naszej-firmie",
            meta: {
                title: "O naszej firmie - Fotografia Kolorowy Motyl",
                description: "Dowiedz się więcej o naszej firmie i naszej pasji do fotografii. Poznaj naszą historię i naszą załogę",
            },
        },
        {
            path: '/strefa-klienta',
            component: StrefaKlienta,
            name: "strefa-klienta",
            meta: {
                title: "Strefa klienta - Fotografia Kolorowy Motyl",
                description: "Zaloguj się do naszej strefy klienta, aby zobaczyć i pobrać swoje zdjęcia, które są w naszej galerii.",
            },
        },
        {
            path: '/rezerwacje-slub',
            component: RezerwacjeSlub,
            name: "rezerwacje-slub",
            meta: {
                title: "Rezerwacje ślub - Fotografia Kolorowy Motyl",
                description: "Zarezerwuj nasze usługi fotograficzne na Twój wielki dzień. Uchwycimy każdy niezapomniany moment.",
            },
        },
        {
            path: '/rezerwacje-imprez',
            component: RezerwacjeImprez,
            name: "rezerwacje-imprez",
            meta: {
                title: "Rezerwacje imprez - Fotografia Kolorowy Motyl",
                description: "Planujesz imprezę? Zarezerwuj naszego fotografa, aby uchwycić radość i emocje Twoich gości.",
            },
        },
        {
            path: '/rezerwacje-biznesowe',
            component: RezerwacjeBiznesowe,
            name: "rezerwacje-biznesowe",
            meta: {
                title: "Rezerwacje biznesowe - Fotografia Kolorowy Motyl",
                description: "Zapewniamy usługi fotograficzne dla Twojej firmy. Zarezerwuj nas na eventy, konferencje i więcej.",
            },
        },
        {
            path: '/kontakt',
            component: Kontakt,
            name: "kontakt",
            meta: {
                title: "Kontakt - Fotografia Kolorowy Motyl",
                description: "Skontaktuj się z nami, aby omówić swoje potrzeby fotograficzne. Jesteśmy tu, aby Ci pomóc.",
            },
        },
        {
            path: '/blog',
            component: Blog,
            name: "blog",
            meta: {
                title: "Blog - Fotografia Kolorowy Motyl",
                description: "Czytaj naszego bloga, aby dowiedzieć się o najnowszych trendach w fotografii i ciekawych sesjach zdjęciowych.",
            },
        },
        {
            path: '/artykul/:nazwa',
            component: Artykul,
            name: "artykul",
            meta: {
                title: "",
                description: "",
            },
        },
        {
            path: '/polityka-prywatnosci',
            component: PolitykaPrywatnosci,
            name: "polityka-prywatnosci",
            meta: {
                title: "Polityka prywatności - Fotografia Kolorowy Motyl",
                description: "Zapoznaj się z naszą polityką prywatności, aby dowiedzieć się, jak dbamy o Twoje dane osobowe.",
            },
        },
        {
            path: '/galeria-uzytkownika/:userId',
            component: GaleriaUzytkownika,
            name: "galeria-uzytkownika",
            meta: {
                title: "Galeria użytkownika - Fotografia Kolorowy Motyl",
                description: "Odkryj galerię użytkownika, gdzie nasi klienci udostępniają swoje niezapomniane chwile.",
            },
        },
        {
            path: '/rejestracja',
            component: Rejestracja,
            name: "rejestracja",
            meta: {
                title: "Rejestracja - Fotografia Kolorowy Motyl",
                description: "Zarejestruj się, aby uzyskać dostęp do naszych ekskluzywnych ofert i usług.",
            },
        },
        {
            path: '/logowanie',
            component: Logowanie,
            name: "logowanie",
            meta: {
                title: "Logowanie - Fotografia Kolorowy Motyl",
                description: "Zaloguj się na swoje konto, aby zarządzać swoimi rezerwacjami i galerią zdjęć.",
            },
        },
        {
            path: '/odzyskiwanie-hasla',
            component: OdzyskiwanieHasla,
            name: "odzyskiwanie-hasla",
            meta: {
                title: "Odzyskiwanie hasła - Fotografia Kolorowy Motyl",
                description: "Zapomniałeś hasła? Skorzystaj z naszej opcji odzyskiwania hasła, aby odzyskać dostęp do swojego konta.",
            },
        },
        {
            path: '/resetowanie-hasla/:token',
            component: ResetowanieHasla,
            name: "resetowanie-hasla",
            meta: {
                title: "Resetowanie hasła - Fotografia Kolorowy Motyl",
                description: "Zresetuj swoje hasło, aby zabezpieczyć swoje konto. Procedura resetowania hasła jest prosta i bezpieczna.",
            },
        },
        {
            path: '/lista-rezerwacje-slubow',
            component: ListaRezerwacjeSlubow,
            name: "lista-rezerwacje-slubow",
            meta: {
                title: "#",
                description: "#",
                content: 'noindex, nofollow',
            },
        },
        {
            path: '/lista-rezerwacje-imprez',
            component: ListaRezerwacjeImprez,
            name: "lista-rezerwacje-imprez",
            meta: {
                title: "#",
                description: "#",
                content: 'noindex, nofollow',
            },
        },
        {
            path: '/lista-rezerwacje-biznesowe',
            component: ListaRezerwacjeBiznesowe,
            name: "lista-rezerwacje-biznesowe",
            meta: {
                title: "#",
                description: "#",
                content: 'noindex, nofollow',
            },
        },
        {
            path: '/lista-uzytkownikow',
            component: ListaUzytkownikow,
            name: "lista-uzytkownikow",
            meta: {
                title: "#",
                description: "#",
                content: 'noindex, nofollow',
            },
        },
        {
            path: '/lista-zdjec',
            component: ListaZdjec,
            name: "lista-zdjec",
            meta: {
                title: "#",
                description: "#",
                content: 'noindex, nofollow',
            },
        },
        {
            path: '/lista-wpisow',
            component: ListaWpisow,
            name: "lista-wpisow",
            meta: {
                title: "#",
                description: "#",
                content: 'noindex, nofollow',
            },
        },
        {
            path: '/dodawanie-uzytkownikow',
            component: DodawanieUzytkownikow,
            name: "dodawanie-uzytkownikow",
            meta: {
                title: "#",
                description: "#",
                content: 'noindex, nofollow',
            },
        },
        {
            path: '/dodawanie-zdjec',
            component: DodawanieZdjec,
            name: "dodawanie-zdjec",
            meta: {
                title: "#",
                description: "#",
                content: 'noindex, nofollow',
            },
        },
        {
            path: '/dodawanie-wpisow',
            component: DodawanieWpisow,
            name: "dodawanie-wpisow",
            meta: {
                title: "#",
                description: "#",
                content: 'noindex, nofollow',
            },
        },
        {
            path: '/dodawanie-tresci-wpisow/:nazwa',
            component: DodawanieTresciWpisow,
            name: 'dodawanie-tresci-wpisow',
            meta: {
                title: "",
                description: "",
                content: 'noindex, nofollow',
            }
        },
        {
            path: '/edytowanie-wpisow/:nazwa',
            component: EdytowanieWpisow,
            name: 'EdytowanieWpisow',
            meta: {
                title: "",
                description: "",
                content: 'noindex, nofollow',
            }
        },
        {
            path: '/informacje-rezerwacje-slubow/:id',
            component: InformacjeRezerwacjeSlubow,
            name: "informacje-rezerwacje-slubow",
            meta: {
                title: "#",
                description: "#",
                content: 'noindex, nofollow',
            },
        },
        {
            path: '/informacje-rezerwacje-imprez/:id',
            component: InformacjeRezerwacjeImprez,
            name: "informacje-rezerwacje-imprez",
            meta: {
                title: "#",
                description: "#",
                content: 'noindex, nofollow',
            },
        },
        {
            path: '/informacje-rezerwacje-biznesowe/:id',
            component: InformacjeRezerwacjeBiznesowe,
            name: "informacje-rezerwacje-biznesowe",
            meta: {
                title: "#",
                description: "#",
                content: 'noindex, nofollow',
            },
        },
    ]
})

router.beforeEach(async (to, from, next) => {
    if (to.name === 'artykul') {
        const articleName = to.params.nazwa;
        console.log('Article Name:', articleName); // Dodaj ten log

        try {
            const response = await Axios.get(`http://46.41.148.115/api/pobierz-meta/${articleName}`);
            const article = response.data.article;
            console.log('API Response:', article); // Dodaj ten log

            if (article.meta_title) {
                document.title = article.meta_title;
            }

            if (article.meta_description) {
                const descriptionMetaTag = document.querySelector('meta[name="description"]');
                if (descriptionMetaTag) {
                    descriptionMetaTag.setAttribute('content', article.meta_description);
                }
            }
        } catch (error) {
            console.error('Error:', error); // Dodaj ten log
            next({ name: '404' });
            return;
        }
    } else {
        const meta = to.meta;

        if (meta.title) {
            document.title = meta.title;
        }

        if (meta.description) {
            const descriptionMetaTag = document.querySelector('meta[name="description"]');
            if (descriptionMetaTag) {
                descriptionMetaTag.setAttribute('content', meta.description);
            }
        }
    }

    next();
});

router.afterEach(() => {
    // Usuń klasę "active" z ciała strony po zmianie podstrony
    document.body.classList.remove("active");
});

export default router