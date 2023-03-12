<template>
  <div class="container">
    <footer class="footer fixed-footer">
      <div class="center">
        <div id="social-test">
          <ul class="social mr-5">
            <li><i class="fa fa-facebook" aria-hidden="true"></i></li>
            <li><i class="fa fa-twitter" aria-hidden="true"></i></li>
            <li><i class="fa fa-instagram" aria-hidden="true"></i></li>
            <li><i class="fa fa-vimeo" aria-hidden="true"></i></li>
            <li><i class="fa fa-behance" aria-hidden="true"></i></li>
            <li><i class="fa fa-dribbble" aria-hidden="true"></i></li>
            <li><i class="fa fa-github" aria-hidden="true"></i></li>
            <li><i class="fa fa-pied-piper" aria-hidden="true"></i></li>
          </ul>
        </div>
        <img class="logo" :src="logo" alt="logo" />
      </div>
    </footer>
  </div>
</template>

<script setup>
const logo = require("@/assets/images/GB.png");
</script>
<style lang="scss">
.logo {
  width: 120px;
  height: 50px;
}

.fixed-footer {
  position: fixed;
  bottom: 0;
  left: 0;
}

.footer {
  padding: 25px 0;
  width: 100%;
  -webkit-backdrop-filter: blur(15px);
  backdrop-filter: blur(15px);
  background: transparent;
  box-shadow: 1px 1px 10px 0px rgb(34 60 80 / 5%);
  &__title {
    color: #fff;
    font-family: Futura, "Trebuchet MS", Arial, sans-serif;
    font-weight: 100;
  }
}

.center {
  display: flex;
  justify-content: center;
}

#social-test {
  display: table-cell;
  vertical-align: middle;
  text-align: center;
  font-size: 30px;

  .social {
    padding-left: 0px;
    display: flex;
    justify-content: center;
  }
  li {
    color: rgba(167, 146, 129, 0.6);
    list-style-type: none;
    display: table-cell;
    width: 50px;
    height: 50px;
    border: 1px solid rgba(167, 146, 129, 0.4);
    cursor: pointer;
    margin-left: 10px;
    transition: ease 0.3s;
    &:hover {
      color: rgba(167, 146, 129, 1);
      border: 1px solid rgba(167, 146, 129, 1);
    }
  }
}

.social:hover > li {
  opacity: 0.5;
}

.social:hover > li:hover {
  opacity: 1;
}
</style>
