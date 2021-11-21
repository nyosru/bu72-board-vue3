<template>
  <div>
    <div id="chat_div" style="height: 250px; overflow: auto; border: 1px solid green">
      <div v-for="m in MessageChannel" :key="m.text">
        user #{{ m.writer_id }} user #{{ m.to_user_id }} ( rooom #{{ m.room_id }} ) >
        {{ m.msg }}
        <!-- {{ m.user }} | {{ m.text }} -->
      </div>
      <div>
          <br/>
          <br/>
      </div>
    </div>

    <input type="text" class="form-controller" v-model="text" />
    <button @click="send({ msg: text, room_id: room_id, writer_id: writer_id , to_user_id: to_user_id })">
      отправить
    </button>

    <br />
    <br />

    <button @click="show1 = !show1">показать тех записки</button>
    <div v-if="show1">
      <br />
      <small> writer_id: {{ writer_id }}</small>
      <br />
      <small> MessageChannel: {{ MessageChannel }} </small>
    </div>
  </div>
</template>

<script>

import {
//   // ref,
  watchEffect,
} from "vue";

// import UpcomingBookingCallsInformer from "../components/UpcomingBookingCallsInformerComponent.vue";
// import BoomsInformer from "../components/BoomsInformerGridComponent.vue";
// // import Booms2Informer from "./../components/BoomsInformerGrid2Component.vue";
// import Booms3Informer from "../components/BoomsInformerGrid3Component.vue";
// import NotesModal from "../components/NotesModalComponent.vue";
// import ModalTransferCloser from "../common/ModalTransferToCloserComponent.vue";
// import IndexOptionsComponent from "../components/IndexOptionsComponent.vue";
// import fdd from './../modules/VitrinItems.ts'
import User from "./../modules/User.ts";

// import { useRoute } from "vue-router";

import Chat from "./Chat.ts";

export default {

  props: {
    room_id: { type: Number },
    autor_id: { type: Number },
    writer_id: { type: Number },
    to_user_id: { type: Number },
    //   imgs: { type: Object },
    // i: { type: Object },
  },

  data() {
    return {
      show1: false,
      //       showItemOpis: false,
    };
  },

  // const getUserRepositories = async () => {
  //     repositories = await fetchUserRepositories(props.user)
  //   }

  //   components: {},

  setup(props) {

    // const { getItem, item } = VitrinItems();
    // const route = useRoute();

    const { goToRoom, re, re1, orders, MessageChannel } = Chat();

    // watchEffect(() => {
    // //   // this.scrollToTop( this.$refs.chat , MessageChannel);
    //   if (MessageChannel.value && MessageChannel.value.length) {
    // //     const chat = $refs.chat;
    // //     setTimeout(() => {
    // //       chat.scrollTop = chat.scrollHeight;
    // //     });
    //   }
    // });

    // watchEffect(() => {
    //   if (route.params.itemId > 0) {
    //     item.value = {};
    //     window.scrollTo(0, 0);
    //     //   items.value = {};
    //     //   getComis(route.params.closerId);
    //     getItem(route.params.itemId);
    //   }
    // });
    // const img_show = ref("");
    // watchEffect(() => {
    //   img_show.value = props.i[props.i.img_first] ?? "";
    // });
    // const { user_id } = User();

    goToRoom(props.room_id);

    return {
      MessageChannel,
      re,
      re1,
      orders,
    };

  },

  methods: {

    // scrollToTop(div, data) {
    //   console.log("scrolToTop", div);
    //   const div = this.$refs.chat
    //   //   console.log(this.showArr)
    //   setTimeout(() => {
    //     div.scrollTop = div.scrollHeight;
    //   });
    // },

    // send(autor_id, to_autor_id, msg) {
    send(msg) {
      const {
        sendMessage,
        //   MessageChannel
        goToRoom,
      } = Chat();
      //   MessageChannel.value.push(333);
      goToRoom(msg.room_id);
      sendMessage(msg);
    },

    // setImgShow(img) {
    //   if (this.img_show != img) {
    //     this.img_show = img;
    //   }
    // },
    // postTo(cat, item_id) {
    //   //   console.log('click')
    //   this.$router.push({ name: "item_show", params: { catId: cat, itemId: item_id } });
    // },
  },
};
</script>

<style lang="scss">
// .carusel {
//   .big {
//     text-align: center;
//     height: 300px;
//     background-position: center center;
//     background-size: contain;
//     background-repeat: no-repeat;
//   }

//   .prew {
//     text-align: center;
//     img {
//       max-width: 60px;
//       max-height: 60px;
//       margin: 5px;
//       display: inline-block;
//     }
//   }
// }
</style>
