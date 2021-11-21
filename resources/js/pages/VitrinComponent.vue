<template>
  <!-- <div>vitrincomp</div> -->
  <div>
    <div style="padding-left: 20px; margin-left: 20px; border-left: 2px solid green">
      <show-items />
    </div>
    <!-- items {{ items }} -->
  </div>
</template>

<script>
import { watchEffect } from "vue";

// import UpcomingBookingCallsInformer from "../components/UpcomingBookingCallsInformerComponent.vue";
// import BoomsInformer from "../components/BoomsInformerGridComponent.vue";

// // import Booms2Informer from "./../components/BoomsInformerGrid2Component.vue";
// import Booms3Informer from "../components/BoomsInformerGrid3Component.vue";

// import NotesModal from "../components/NotesModalComponent.vue";
// import ModalTransferCloser from "../common/ModalTransferToCloserComponent.vue";

// import IndexOptionsComponent from "../components/IndexOptionsComponent.vue";

import ShowItems from "./../components/ShowItemsComponent.vue";
import VitrinItems from "./../modules/VitrinItems.ts";

import { useRoute } from "vue-router";

export default {
  // const getUserRepositories = async () => {
  //     repositories = await fetchUserRepositories(props.user)
  //   }

  components: {
    ShowItems,
  },

  setup(props) {

    const { getItems, items } = VitrinItems();
    const route = useRoute();

    watchEffect(() => {
      window.scrollTo(0, 0);
      items.value = {};
      //   getComis(route.params.closerId);
      getItems(route.params.catId ?? "");
    });

    return {
      items,
    };
  },
};
</script>

<style></style>
