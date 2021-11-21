<template>
  <div>
    <menu-list />
  </div>
</template>

<script>
import { onMounted } from "vue";

// import TmClosers from "./../modules/TmClosers.ts";
import Catalogs from "./../modules/Catalogs.ts";

import MenuList from "./menuList.vue";

export default {
  // props: ["user"],

  components: {
    MenuList,
  },

  setup() {
    const { getCatalogs, catalogs } = Catalogs();

    onMounted(() => {
      getCatalogs();
    });

    return {
      //   closer_now,
      catalogs,
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

<style></style>
