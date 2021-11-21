<template>
  <div class="item" :class="i.status_order">
    <span @click="postTo(i.cat_id, i.id)">
      <div
        class="image"
        :style="
          'background-image: url( ' +
          (i.img1 && i.img1.length ? i.img1 : '') +
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

      <h3>{{ i.id }} {{ i.name }}</h3>
      <p>
        Цена: {{ i.price }}
      </p>

      <!-- <div v-if="showItemOpis">
          {{ i }}
      </div> -->
    </span>
  </div>
</template>

<script>

export default {
  props: {
    i: { type: Object },
  },

  data() {
    return {
      showItemOpis: false,
    };
  },

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
