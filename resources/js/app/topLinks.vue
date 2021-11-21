<template>
  <ul class="nav nav-pills">
    <li class="nav-item" v-if="user_id > 0">
      <router-link class="nav-link" xclass="xnav-link xpx-3" :to="{ name: 'add-item' }">
        Добавить обьявление
      </router-link>
    </li>

    <!-- userId: { type: Number, default: 0 }, -->
    <!-- userName: { type: String, default: "" }, -->
    <!-- userAvatar: { type: String, default: "" }, -->

    <!-- <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">Dropdown</a>
    <ul class="dropdown-menu">
      <li><a class="dropdown-item" href="#">Action</a></li>
      <li><a class="dropdown-item" href="#">Another action</a></li>
      <li><a class="dropdown-item" href="#">Something else here</a></li>
      <li><hr class="dropdown-divider"></li>
      <li><a class="dropdown-item" href="#">Separated link</a></li>
    </ul>
  </li> -->

    <li class="nav-item xdropdown" v-if="user_id > 0">
      <a
        чid="navbarDropdown"
        class="nav-link чdropdown-toggle"
        xhref="#"
        xrole="button"
        xdata-toggle="dropdown"
        xaria-haspopup="true"
        xaria-expanded="false"
        xv-pre
      >
        <img :src="userAvatar" class="avatar" />
        {{ userName }}
      </a>
    </li>

    <li class="nav-item xdropdown" v-if="user_id > 0">
      <!-- <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown"> -->
      <a class="nav-link" href="/logout"> Выйти </a>
      <!-- </div> -->
    </li>

    <li class="nav-item text-nowrap" v-else>
      <!-- <menu-list cat_up="" /> -->

      <!-- Войти в ЛК
        <div id="uLogin" style="display: inline;"
            data-ulogin="display=panel;theme=classic;fields=nickname,photo,first_name,last_name;providers=vkontakte,odnoklassniki,mailru,facebook;hidden=other;callback=ulogin_start;redirect_uri=;xxredirect_uri=https%3A%2F%2F@php echo $_SERVER['HTTP_HOST']; @endphp%2Fulogin;mobilebuttons=0;">
        </div> -->

      Войти в ЛК
      <div
        id="uLogin"
        style="display: inline"
        :data-ulogin="
          'display=panel;theme=classic;fields=nickname,photo,first_name,last_name;' +
          'providers=vkontakte,odnoklassniki,mailru,facebook;hidden=other;' +
          'redirect_uri=https%3A%2F%2F' +
          domain +
          '%2Fulogin1;mobilebuttons=0;'
        "
      ></div>
    </li>
  </ul>
</template>

<script>
// import { onMounted } from "vue";

// // import TmClosers from "./../modules/TmClosers.ts";
// import Catalogs from "./../modules/Catalogs.ts";

// import MenuList from "./menuList.vue";
// import { useRoute } from "vue-router";

import User from "./../modules/User.ts";

export default {
  props: {
    domain: { type: String },
    userIdN: { type: Number, default: 0 },
    userName: { type: String, default: "" },
    userAvatar: { type: String, default: "" },
  },

  //   components: {
  //     MenuList,
  //   },

  setup(props) {
    // const { getCatalogs, catalogs } = Catalogs();

    //   const route = useRoute();
    //   const module = route.params.module;
    // console.log("route", route ); // outputs 'yay'

    // onMounted(() => {
    //   getCatalogs();
    // });

    // const userId = parseFloat(props.userIdN);

    const {
      // getCatalogs,
      user_id,
    } = User();

    if (props.userIdN > 0) {
      user_id.value = props.userIdN;
    }

    return {
      user_id: user_id.value,
      //   closer_now,
      //   catalogs,
    };
  },

  computed: {
    // access_now() {
    //     const { closer_now } = TmClosers();
    //     return ( closer_now.value.access && closer_now.value.access.length && closer_now.value.access && closer_now.value.access == 'admin' ) ? true : false ;
    // }
  },
};
</script>

<style>
.avatar {
  max-height: 32px;
  max-width: 32px;
}
</style>
