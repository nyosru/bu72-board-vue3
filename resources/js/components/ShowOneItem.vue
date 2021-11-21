<template>
  <div class="container-fluid big-item" :class="i.status_order">
    <div class="row">
      <div class="col-12 col-md-6">
        <div>
          <!-- <img :src="i[i.img_first]" /> -->
          <carusel :i="i" />
        </div>
        <div>
          {{ i.opis ?? "" }}
        </div>

        <br />
        <br />
        <small>
          тех записки
          <br />
          <!-- {{ i }} -->
          user_id {{ user_id }}
          <br />
          i.autor_id {{ i.autor_id }}
          <br />
          room {{ i.id }}
          <br />
        </small>
      </div>
      <div class="col-12 col-md-6">
        <h1>{{ i.name }}</h1>
        <br />
        <span class="status">
          {{ i.status_order == "sell" ? "Продаю" : "" }}
          {{ i.status_order == "buy" ? "Ищу, хочу купить" : "" }}
          {{ i.status_order == "free" ? "Отдам бесплатно" : "" }}
          {{ i.status_order == "arenda" ? "Сдаю в аренду" : "" }}
          {{ i.status_order == "arenda_search" ? "Хочу взять в аренду" : "" }}
        </span>
        <br />
        <br />
        <p v-if="i.status_order != 'free'">Цена: {{ i.price }} р</p>

        <p class="alert alert-warning">
          сейчас чат работает только на http перейдите по ссылке
          <a href="http://bu72.ru">http://bu72.ru</a>
        </p>

        список чатов

        <div v-for="u in chat_list" :key="u.id">
          {{ u }}
        </div>

        <super-chat
          v-if="
            i.id && i.id > 0 && i.autor_id && i.autor_id > 0 && user_id && user_id > 0
          "
          :room_id="i.id"
          :autor_id="i.autor_id"
          :writer_id="user_id"
          :to_user_id="777"
        />

        <div v-else-if="user_id == 0" class="alert alert-warning text-center">
          для&nbsp;обмена сообщениями c&nbsp;автором обьявления, нужно войти
          в&nbsp;личный&nbsp;кабинет (сверху&nbsp;справа выберите соц.&nbsp;сеть)
        </div>
        <div v-else>... загружаем чат ...</div>
      </div>
    </div>

    <div class="row" v-if="1 == 2">
      <div class="col-12 col-md-6">
        <pre>
          item {{ i }}
        </pre>
      </div>
      <div class="col-12 col-md-6"></div>
    </div>
  </div>
</template>

<script>
import { ref, onMounted, watchEffect } from "vue";

// import UpcomingBookingCallsInformer from "../components/UpcomingBookingCallsInformerComponent.vue";
// import BoomsInformer from "../components/BoomsInformerGridComponent.vue";
// // import Booms2Informer from "./../components/BoomsInformerGrid2Component.vue";
// import Booms3Informer from "../components/BoomsInformerGrid3Component.vue";
// import NotesModal from "../components/NotesModalComponent.vue";
// import ModalTransferCloser from "../common/ModalTransferToCloserComponent.vue";
// import IndexOptionsComponent from "../components/IndexOptionsComponent.vue";
// import fdd from './../modules/VitrinItems.ts'
import VitrinItems from "./../modules/VitrinItems.ts";
import Carusel from "./../comon/carusel.vue";

import User from "./../modules/User.ts";

import { useRoute } from "vue-router";

import SuperChat from "./../comon/chat.vue";
import Chat from "./../comon/Chat.ts";

export default {
  //   props: {
  //     i: { type: Object },
  //   },

  data() {
    return {
      // showItemOpis: false,
      chat_list: [],
    };
  },

  // const getUserRepositories = async () => {
  //     repositories = await fetchUserRepositories(props.user)
  //   }

  components: {
    Carusel,
    SuperChat,
  },

  setup(props) {
    const { getItem, item } = VitrinItems();
    const route = useRoute();

    watchEffect(() => {
      if (route.params.itemId > 0) {
        item.value = {};
        window.scrollTo(0, 0);
        //   items.value = {};
        //   getComis(route.params.closerId);
        getItem(route.params.itemId);
      }
    });

    const {
      // getCatalogs,
      user_id,
    } = User();

    const { getChatUsers , getChatList, chat_list } = Chat();

    onMounted(() => {
      getChatList(route.params.itemId, user_id.value);
    });

    onMounted(() => {
      getChatUsers(route.params.itemId);
    });

    return {
      chat_list,
      user_id,
      i: item,
      //   imgs,
    };
  },

  methods: {
    // getChatList() {

    //     chat_list

    // },

    postTo(cat, item_id) {
      //   console.log('click')
      this.$router.push({ name: "item_show", params: { catId: cat, itemId: item_id } });
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

.big-item {
  .status {
    padding: 1px 10px 5px 10px;
    border-radius: 3px;
  }
}

.big-item.sell {
  .status {
    background-color: $color-sell;
    color: white;
  }
}
.big-item.buy {
  .status {
    background-color: $color-buy;
    color: black;
  }
}
.big-item.free {
  .status {
    background-color: $color-free;
    color: black;
  }
}
.big-item.arenda {
  .status {
    background-color: $color-arenda;
    color: white;
  }
}
.big-item.arenda_search {
  .status {
    background-color: $color-arenda_search;
    color: black;
  }
}
</style>
