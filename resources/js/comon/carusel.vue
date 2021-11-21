<template>
  <div class="carusel">
    <div class="big" :style="'background-image:url(' + img_show + ')'"></div>
    <div class="prew">
      <span v-for="e in 10" :key="e">
        <!-- {{ e }} {{ i['img' + e] ?? 'x' }}<br/> -->
        <img
          v-if="i['img' + e] && i['img' + e].length"
          :src="i['img' + e]"
          @mouseover="setImgShow(i['img' + e])"
        />
        <!-- {{ imgs }} -->
      </span>
    </div>
  </div>
</template>

<script>
import { ref, watchEffect } from "vue";

// import UpcomingBookingCallsInformer from "../components/UpcomingBookingCallsInformerComponent.vue";
// import BoomsInformer from "../components/BoomsInformerGridComponent.vue";
// // import Booms2Informer from "./../components/BoomsInformerGrid2Component.vue";
// import Booms3Informer from "../components/BoomsInformerGrid3Component.vue";
// import NotesModal from "../components/NotesModalComponent.vue";
// import ModalTransferCloser from "../common/ModalTransferToCloserComponent.vue";
// import IndexOptionsComponent from "../components/IndexOptionsComponent.vue";
// import fdd from './../modules/VitrinItems.ts'
// import VitrinItems from "./../modules/VitrinItems.ts";

// import { useRoute } from "vue-router";

export default {
  props: {
    //   imgs: { type: Object },
    i: { type: Object },
  },

  //   data() {
  //     return {
  //       showItemOpis: false,
  //     };
  //   },

  // const getUserRepositories = async () => {
  //     repositories = await fetchUserRepositories(props.user)
  //   }

  //   components: {},

  setup(props) {
    // const { getItem, item } = VitrinItems();
    // const route = useRoute();

    // watchEffect(() => {
    //   if (route.params.itemId > 0) {
    //     item.value = {};
    //     window.scrollTo(0, 0);
    //     //   items.value = {};
    //     //   getComis(route.params.closerId);
    //     getItem(route.params.itemId);
    //   }
    // });

    const img_show = ref("");

    watchEffect(() => {
      img_show.value = props.i[props.i.img_first] ?? "";
    });

    return {
      //   i: item,
      img_show,
    };
  },

  methods: {
    setImgShow(img) {
      if (this.img_show != img) {
        this.img_show = img;
      }
    },
    // postTo(cat, item_id) {
    //   //   console.log('click')
    //   this.$router.push({ name: "item_show", params: { catId: cat, itemId: item_id } });
    // },
  },
};
</script>

<style lang="scss">
.carusel {
  .big {
    text-align: center;
    height: 300px;
    background-position: center center;
    background-size: contain;
    background-repeat: no-repeat;
  }

  .prew {
    text-align: center;
    img {
      max-width: 60px;
      max-height: 60px;
      margin: 5px;
      display: inline-block;
    }
  }
}
</style>
