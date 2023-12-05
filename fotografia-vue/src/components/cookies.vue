<template>
    <div class="cookie-policy" v-if="!cookieAccepted">
        <div class="cookie-policy-content">
            <p>Strona korzysta z ciasteczek aby świadczyć usługi na najwyższym poziomie. Dalsze korzystanie ze strony oznacza, że zgadzasz się na ich użycie.</p>
            <router-link to="/polityka-prywatnosci"><a href="#">Polityka prywatności</a></router-link>
            <button @click="acceptCookies">Akceptuj</button>
        </div>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        cookieAccepted: false,
        policyVisible: false,
      };
    },
    methods: {
      showPolicy() {
        this.policyVisible = true;
      },
      acceptCookies() {
        this.cookieAccepted = true;
      },
    },
  };
  </script>
  
<style lang="scss" scoped> 
    .cookie-policy {
        position: fixed;
        bottom: 0;
        width: 100%;
        max-width: 1920px;
        background-color: var(--white);
        padding-top: 1rem;
        padding-bottom: 1rem;
        border-top: 1px solid var(--grey);
        .cookie-policy-content {
            width: 95%;
            margin-left: auto;
            margin-right: auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            a {
                color: var(--pink);
                text-underline-offset: 4px;
                transition: 0.5s;
                &:hover {
                    color: var(--blue);
                }
            }
            button {
                padding: 0.2rem 2rem;
                background-color: var(--white);
                color: var(--pink);
                border: 1px solid var(--pink);
                border-radius: 25px;
                transition: 0.5s;
                cursor: pointer;
                &:hover {
                    background-color: var(--pink);
                    color: var(--white);
                }
            }
        }
    }

    @media screen and (max-width: 1600px) {
        .cookie-policy {
            .cookie-policy-content {
                flex-direction: column;
                p {
                    margin-bottom: 1rem;
                    text-align: center;
                }
                a {
                    margin-bottom: 1rem;
                }
            }
        }
    }
</style>