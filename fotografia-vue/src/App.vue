<template>
  <main class="main">
    <router-view></router-view>
  </main>
</template>

<style>
  @import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
</style>

<style lang="scss">
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Montserrat', sans-serif;
}
.body {
  background-color: var(--background);
}

.body.active {
  overflow: hidden;
}

.main {
  max-width: 1920px;
  width: 100%;
  height: 100%;
  margin-inline: auto;
  background-color: var(--white);
}

:root {
  --background: #f5f5f5;
  --white: #fff;
  --black: #000000;
  --grey: #D6D6D6;
  --blue: #2EA9E0;
  --pink: #BE3393;
  --shadow: 0px 0px 10px 0px rgb(190, 51, 147, 0.25);
}

@media screen and (max-width: 1024px) {
  .main {
    height: 100%;
  }
}
</style>
