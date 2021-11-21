<template>
  <div class="item" :class="i.status_order">
    <span @click="postTo(i.cat_id, i.id)">
      <div
        class="image"
        :style="
          'background-image: url( ' +
          (i[i.img_first] && i[i.img_first].length ? i[i.img_first] : '') +
          ') '
        "
      >
        <span class="status">
          {{ i.status_order == "sell" ? "Продаю" : "" }}
          {{ i.status_order == "buy" ? "Хочу купить" : "" }}
          {{ i.status_order == "free" ? "Отдам бесплатно" : "" }}
          {{ i.status_order == "arenda" ? "Сдаю в аренду" : "" }}
          {{ i.status_order == "arenda_search" ? "Хочу взять в аренду" : "" }}
        </span>
      </div>

      <!-- <img v-if="i[i.img_first] && i[i.img_first].length" :scr="i[i.img_first]" />
    <img v-else-if="i.img1 && i.img1.length" :src="i.img1" />
    <img v-else-if="i.img2 && i.img2.length" :src="i.img2" /> -->
      <!-- i.img1 {{ i.img1 }} -->

      <!-- <h3 @click="showItemOpis = !showItemOpis">{{ i.id }} {{ i.name }}</h3> -->
      <h3>{{ i.id }} {{ i.name }}</h3>
      <p>
        <!-- status_order: {{ i.status_order }} -->
        <!-- <br /> -->
        Price: {{ i.price }}
      </p>

      <!-- <div v-if="showItemOpis">
        {{ i }}
      </div> -->
    </span>
  </div>
</template>

<script>
// import UpcomingBookingCallsInformer from "../components/UpcomingBookingCallsInformerComponent.vue";
// import BoomsInformer from "../components/BoomsInformerGridComponent.vue";
// // import Booms2Informer from "./../components/BoomsInformerGrid2Component.vue";
// import Booms3Informer from "../components/BoomsInformerGrid3Component.vue";
// import NotesModal from "../components/NotesModalComponent.vue";
// import ModalTransferCloser from "../common/ModalTransferToCloserComponent.vue";
// import IndexOptionsComponent from "../components/IndexOptionsComponent.vue";

// import fdd from './../modules/VitrinItems.ts'
// import VitrinItems from "./../modules/VitrinItems.ts";

export default {
  props: {
    i: { type: Object },
  },

  data() {
    return {
      showItemOpis: false,
    };
  },

  // const getUserRepositories = async () => {
  //     repositories = await fetchUserRepositories(props.user)
  //   }

  components: {},

  setup(props) {
    // const { items } = VitrinItems();

    return {
      //   items,
    };
  },

  methods: {
    postTo(cat, item) {
      //   console.log('click')
      this.$router.push({ name: "item_show", params: { catId: cat, itemId: item } });
    },
  },
};
</script>

<style lang="scss">
$color-sell: green;
$color-buy: yellow;
$color-free: orange;
$color-arenda: purple;
$color-arenda_search: magenta;

.item {
  min-height: 320px;

  width: 19%;
  margin-right: 1%;

  min-width: 200px;
  max-width: 300px;
  float: left;

  > span {
    display: inline-block;
    width: 100%;
    cursor: pointer;
  }
  //   span:hover {
  //     background-color: rgba(0, 0, 0, 0.1);
  //   }

  .image {
    background-color: #efefef;
    // border: 1px solid green;
    width: 100%;
    height: 150px;
    background-position: center center;
    background-size: cover;

    .status {
      position: relative;
      top: 5px;
      left: 0;
      text-decoration: none;
      //   margin-top: 5px;
      //   margin-left: 5px;
      // margin-top: 5px;
      // margin-left: -1px;
      padding: 1px 5px 3px 5px;
      font-size: 0.7rem;
      border-top-right-radius: 5px;
      border-bottom-right-radius: 5px;
    //   box-shadow: 2px 0px 2px rgba(255,255,255,0.5), 0px 2px 2px rgba(255,255,255,0.5), 0px -2px 2px rgba(255,255,255,0.5);
    //   border: 1px solid black;

    }
  }
}

.item.sell {
  .image {
    border-left: 3px solid $color-sell;
    .status {
      background-color: $color-sell;
      color: white;
    }
  }
}
.item.buy {
  .image {
    border-left: 3px solid $color-buy;
    .status {
      background-color: $color-buy;
      color: black;
    }
  }
}
.item.free {
  .image {
    border-left: 3px solid $color-free;
    .status {
      background-color: $color-free;
      color: black;
    }
  }
}
.item.arenda {
  .image {
    border-left: 3px solid $color-arenda;
    .status {
      background-color: $color-arenda;
      color: white;
    }
  }
}
.item.arenda_search {
  .image {
    border-left: 3px solid $color-arenda_search;
    .status {
      background-color: $color-arenda_search;
      color: black;
    }
  }
}
</style>
