<script>
// import Vue from 'vue';
// import moment from 'moment';
// Vue.prototype.$moment = moment;

import { ref } from "vue";

import axios from "axios";

// import ScreenMobile from "./modules/ScreenMobile.ts";

import TopLinks from "./app/topLinks.vue";


// {{-- button show/hide config page --}}
// import ConfigButtonComponent from "./components/ConfigButtonComponent.vue";
// body config page
// import ConfigComponent from "./components/ConfigComponent.vue";

// import BoomsInformerV3 from "./components/BoomsInformerComponent.vue";
// const Home2 = { template: '<h2>Home Page</h2>' }

// import TodoItem from "./TodoItem.vue"
// let nextTodoId = 1;

// import ShowPayNowPeriod from "./blocks/ShowPayNowPeriodComponent.vue";

// const createTodo = (text) => ({
//     text,
//     id: nextTodoId++,
// });

// const router = new VueRouter({
//   routes
// })

// function ulogin_start(params) {
//     console.log( 'ulogin_start', params);
// }

export default {
  setup(props) {
    // console.log("222222222");

    let token = document.head.querySelector('meta[name="csrf-token"]');

    if (token) {
      axios.defaults.headers.common["X-CSRF-TOKEN"] = token.content;
    } else {
      console.error(
        "CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token"
      );
    }

    // const { thisMobile } = ScreenMobile();

    // Vue.onMounted(() => console.log("Mounted from setup!"));
    return {
      //   thisMobile,
    };
  },

  data() {
    const showWarning = ref(true);

    return {
      showWarning,
      //   preloader: true,
      //   show_menu: true,
      // show_iframe_div: false,
      // show_iframe_div: true,
      // message: "js2 route!",
      // now: new Date()
      // now: "da da da 1 ",
    };
  },

  // computed(){
  //     console.log('2222');
  // }

  // mounted(){

  //     console.log(222);
  //     this.preloader = false;

  // },

  // methods: {
  //     hidePreloader(e) {
  //         console.log(333);
  //         this.preloader = false;
  //     },
  // },

  components: {
    TopLinks,
    // ShowPayNowPeriod,
    // BoomsInformerV3,
    // Home2
    // SideMenu,
    // {{-- button show/hide config page --}}
    // ConfigButtonComponent,
    // body config page
    // ConfigComponent
  },

  // router
  // async created() {

  //     const index_var = await axios
  //         .get("/closer/api/get_index")
  //         .catch((error) => {
  //             console.log(error);
  //             // this.errored = true;
  //         })
  //         .finally(() => {
  //             // this.loading = false;
  //         });

  //     // this.content_show = this.content = booms.data;
  //     // console.log("content", this.content);
  // },
};
</script>

<style lang="scss">
.nobr {
  white-space: nowrap;
}

.text-refund-manual {
  color: orangered;
}
.text-refund {
  color: maroon;
}
.text-bonus {
  color: #20b620;
}
</style>
