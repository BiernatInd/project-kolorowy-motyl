<template>
    <footer class="footer">
        <div class="footer-content">
            <div class="footer-left">
                <router-link to="/polityka-prywatnosci"><a href="#">Polityka prywatności</a></router-link>
            </div>
            <div class="footer-mid">
                <p href="#">Copyright © 2023 by <a href="https://vibewebs.com">VibeWebs.</a> Wszelkie prawa zastrzeżone.</p>
            </div>
            <div class="footer-right">
                <font-awesome-icon class="icon" :icon="['fab', 'facebook']" />
                <font-awesome-icon class="icon" :icon="['fab', 'instagram']" />
            </div>
        </div>
    </footer>
</template>

<script>
export default {

};
</script>

<style lang="scss" scoped>
    .footer {
        border-top: 1px solid var(--pink);
        padding-top: 1rem;
        padding-bottom: 1rem;
        .footer-content {
            width: 95%;
            margin-left: auto;
            margin-right: auto;
            display: flex;
            justify-content: space-between;
            .footer-left {
                a {
                    font-size: 16px;
                    color: var(--black);
                    text-decoration: none;
                    transition: 0.5s;
                    &:hover {
                        color: var(--pink);
                    }
                }
            }
            .footer-mid {
                p {
                    font-size: 16px;
                    color: var(--black);
                    text-decoration: none;
                    a {
                        color: var(--black);
                        text-decoration: none;
                        transition: 0.5s;
                        &:hover {
                        color: var(--pink);
                        }
                    }
                }
            }
            .footer-right {
                .icon {
                    font-size: 20px;
                    color: var(--black);
                    transition: 0.5s;
                    cursor: pointer;
                    &:hover {
                        color: var(--pink);
                        transform: rotate(360deg);
                    }
                }
                .icon:nth-child(1) {
                    margin-right: 1rem;
                }
                .icon:nth-child(2) {
                    margin-right: 1rem
                }
            }
        }
    }

    @media screen and (max-width: 1024px) {
        .footer {
            .footer-content {
                flex-direction: column;
                .footer-left {
                    text-align: center;
                    padding-bottom: 1rem;
                }
                .footer-mid {
                    text-align: center;
                    padding-bottom: 1rem;
                }
                .footer-right {
                    display: flex;
                    justify-content: center;
                }
            }
        }
    }
</style>