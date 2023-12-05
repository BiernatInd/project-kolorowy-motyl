<template>
    <div class="slide-menu" :class="{ active: menuActive }">
        <div class="slide-menu-content">
            <div class="slide-menu-left">
                <div class="slide-menu-link">
                    <router-link to="/">Strona główna</router-link>
                </div>
                <div class="slide-menu-link">
                    <router-link to="/nasza-oferta">Nasza oferta</router-link>
                </div>
                <div class="slide-menu-link">
                    <router-link to="/portfolio">Portfolio</router-link>
                </div>
                <div class="slide-menu-link">
                    <router-link to="/o-naszej-firmie">O naszej firmie</router-link>
                </div>
                <div class="slide-menu-link">
                    <router-link to="/strefa-klienta">Strefa klienta</router-link>
                </div>
                <div class="slide-menu-link">
                    <router-link to="/rezerwacje-slub">Zarezerwuj sesję</router-link>
                </div>
                <div class="slide-menu-link">
                    <router-link to="/kontakt">Kontakt</router-link>
                </div>
            </div>
            <div class="slide-menu-right">
                <div class="slide-menu-link">
                    <router-link to="/blog">Artykuły</router-link>
                </div>
                <div class="slide-menu-link">
                    <router-link to="/logowanie">Logowanie</router-link>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
      props: {
        menuActive: Boolean,
      },
    };
    </script>

<style lang="scss" scoped>

    .slide-menu.active {
        left: 50%;
    }
    .slide-menu {
        max-width: 1920px;
        width: 100%;
        height: 100%;
        position: absolute;
        display: flex;
        justify-content: center;
        align-items: center;
        top: 0;
        left: -100%; 
        transform: translateX(-50%); 
        transition: 0.5s;
        z-index: 998;
        background-color: var(--white);
        background-image: url('../assets/logo.svg');
        background-repeat: no-repeat;
        background-position-y: 3%;
        background-position-x: 95%;
        box-shadow: var(--shadow);
        .slide-menu-content {
            width: 95%;
            height: 80%;
            margin-left: auto;
            margin-right: auto;
            display: flex;
            padding-top: 1rem;
            position: fixed;
            bottom: 0;
            .slide-menu-left {
                width: 50%;
                .slide-menu-link {
                    width: 95%;
                    padding-top: 1rem;
                    padding-bottom: 1rem;
                    border-bottom: 1px solid var(--pink);
                    border-top: 1px solid var(--pink);
                    margin-bottom: 2rem;
                    transition: 0.5s;
                    &:hover {
                        border-bottom: 1px solid var(--blue);
                        border-top: 1px solid var(--blue);
                        a {
                            color: var(--blue);
                        }
                    }
                    a {
                        font-size: 32px;
                        text-transform: uppercase;
                        color: var(--pink);
                        text-decoration: none;
                        font-weight: 600;
                        transition: 0.5s;
                    }
                }
            }
            .slide-menu-right {
                width: 50%;
                .slide-menu-link {
                    width: 95%;
                    padding-top: 1rem;
                    padding-bottom: 1rem;
                    border-bottom: 1px solid var(--pink);
                    border-top: 1px solid var(--pink);
                    margin-bottom: 2rem;
                    transition: 0.5s;
                    &:hover {
                        border-bottom: 1px solid var(--blue);
                        border-top: 1px solid var(--blue);
                        a {
                            color: var(--blue);
                        }
                    }
                    a {
                        font-size: 32px;
                        text-transform: uppercase;
                        color: var(--pink);
                        text-decoration: none;
                        font-weight: 600;
                        transition: 0.5s;
                    }
                }
            }
        }
    }

    @media screen and (max-width: 1600px) {
        .slide-menu {
            width: 100%;
            margin-left: 0;
            .slide-menu-content {
                width: 85%;
                .slide-menu-left {
                    .slide-menu-link {
                        a {
                            font-size: 32px;
                        }
                    }
                }
                .slide-menu-right {
                    .slide-menu-link {
                        a {
                            font-size: 32px;
                        }
                    }
                }
            }
        }
    }

    @media screen and (max-width: 1200px) {
        .slide-menu {
            width: 100%;
            margin-left: 0;
            background-image: none;
            padding-top: 80px;
            height: 100%;
            position: fixed;
            overflow: scroll;
            .slide-menu-content {
                height: 100%;
                flex-direction: column;
                position: static;
                margin-top: 5rem;
                .slide-menu-left {
                    width: 100%;
                    padding-top: 0;
                    padding-bottom: 0;
                    .slide-menu-link {
                        width: 100%;
                        a {
                            font-size: 20px;
                        }
                    } 
                }
                .slide-menu-right {
                    width: 100%;
                    padding-top: 0;
                    padding-bottom: 0;
                    .slide-menu-link {
                        width: 100%;
                        a {
                            font-size: 20px;
                        }
                    } 
                }
            }
        }
    }

    @media screen and (max-width: 320px) {
        .slide-menu {
            .slide-menu-content {
                .slide-menu-left {
                    .slide-menu-link {
                        margin-bottom: 1rem;
                        a {
                            font-size: 16px;
                        }
                    }    
                }
                .slide-menu-right {
                    .slide-menu-link {
                        margin-bottom: 1rem;
                        a {
                            font-size: 16px;
                        }
                    }
                }
            }
        }
    }
</style>