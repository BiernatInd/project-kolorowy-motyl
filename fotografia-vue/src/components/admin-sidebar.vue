<template>
    <div class="sidebar">
        <div class="sidebar-content">
            <div class="sidebar-link">
                <router-link to="/lista-rezerwacje-slubow">Rezerwacje ślubów</router-link>
            </div>
            <div class="sidebar-link">
                <router-link to="/lista-rezerwacje-imprez">Rezerwacje imprez</router-link>
            </div>
            <div class="sidebar-link">
                <router-link to="/lista-rezerwacje-biznesowe">Rezerwacje biznesowe</router-link>
            </div>
            <div class="sidebar-link">
                <router-link to="/lista-uzytkownikow">Lista uzytkownikow</router-link>
            </div>
            <div class="sidebar-link">
                <router-link to="/lista-zdjec">Lista zdjęć</router-link>
            </div>
            <div class="sidebar-link">
                <router-link to="/lista-wpisow">Lista wpisów</router-link>
            </div>
            <div class="sidebar-link">
                <router-link to="/dodawanie-uzytkownikow">Dodawanie uzytkownikow</router-link>
            </div>
            <div class="sidebar-link">
                <router-link to="/dodawanie-zdjec">Dodawanie zdjęć</router-link>
            </div>
            <div class="sidebar-link">
                <router-link to="/dodawanie-wpisow">Dodawanie wpisów</router-link>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    
};
</script>

<style lang="scss" scoped>
    .sidebar.active {
        left: 0;
    }
    .sidebar {
        width: 15%;
        position: fixed;
        height: 100%;
        background-color: var(--white);
        border-right: 1px solid var(--grey);
        left: -100%;
        transition: 0.5s;
        z-index: 999;
        .sidebar-content {
            cursor: pointer;
            .sidebar-link {
                padding-top: 1rem;
                padding-bottom: 1rem;
                border-bottom: 1px solid var(--grey);
                display: flex;
                align-items: center;
                a {
                    font-size: 16px;
                    color: var(--black);
                    text-decoration: none;
                    margin-left: 1rem;
                }
            }
        }
    }

    @media screen and (max-width: 1024px) {
        .sidebar {
            width: 50%;
        }
    }

    @media screen and (max-width: 468px) {
        .sidebar {
            width: 80%;
        }
    }
</style>