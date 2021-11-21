<template>
  <div>
    <!-- cat_up |{{ cat_up }}| -->
    <!-- <div style="max-height:100px; overflow: auto;" > -->
    <!-- catalogs {{ catalogs }} -->
    <!-- </div> -->

    <!-- {{ this.$route.params.catId }} -->

    <div v-for="c1 in catalogs" :key="c1.id" class="menu">
      <template v-if="c1.cat_id_up == cat_up || (cat_up == '' && c1.cat_id_up === null)">
        <!-- <a href="#">{{ c1.name }}</a> -->

        <router-link :to="{ name: 'cat_show', params: { catId: c1.id ?? 0 } }" :class=" this.$route.params.catId == c1.id ? 'active' : '' " >
          {{ c1.name }}
        </router-link>

        <div style="padding-left: 10px">
          <menu-list :cat_up="c1.id ?? 0" />
        </div>

      </template>
    </div>
  </div>
</template>

<script>
import Catalogs from "./../modules/Catalogs.ts";

// import MenuList from "./menuList.vue";

export default {
  name: "menuList",

  props: {
    cat_up: { type: Number, default: 0 },
  },

  setup() {
    const {
      // getCatalogs,
      catalogs,
    } = Catalogs();

    // onMounted(() => {
    //   getCatalogs();
    // });

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

<style lang="scss">
.menu {
  a {
    display: block;
    padding: 5px 10px;
  }
  a.active {
    background-color: lightblue;
  }
}
</style>
