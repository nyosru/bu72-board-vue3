<template>
    <div>
        <small v-if="1 == 2">
            autor_id {{ autor_id }}
            <br />
            writer_id {{ writer_id }}
            <br />
            now_chat_user {{ now_chat_user }}
            <br />
            writerInChat {{ writerInChat }}
            <br />
        </small>

        <div v-if="autor_id == writer_id" class="list_chat_links_user">
            чат c:
            <span v-for="u in writerInChat" :key="u.id" class="chat_link_user">
                <a
                    href="#"
                    v-if="u.writer_id != u.autor_id"
                    class="xbtn xbtn-sm xbtn-ligth xm-2 xmr-2 xp-1"
                    :class="
                        now_chat_user == u.writer_id ? 'active' : ''
                    "
                    xxclick="now_chat_user = u.writer_id"
                    @click.prevent="setChatNow(u.writer_id)"
                >
                    {{ u.writer_name }}
                    <!-- {{ u.writer_ss }} {{ u.writer_id }} -->
                </a>
            </span>
        </div>

        <template v-if="now_chat_user > 0">
            <div
                id="chat_div"
                class="chat"
                style="height: 250px; overflow: auto; border: 1px solid green"
            >
                <div
                    v-for="m in MessageChannel"
                    :key="m.text"
                    :class="
                        m.writer_id == writer_id
                            ? 'string-autor'
                            : 'string-guest'
                    "
                >
                    <!-- <small> u#{{ m.writer_id }} </small> -->
                    <small class="chat-date">
                        {{ showDate(m.created_at) }}
                    </small>
                    <small>
                        {{ getNameUser(m.writer_id ?? m.to_user_id) }}
                    </small>

                    <br />
                    {{ m.msg }}
                </div>
                <div>
                    <br />
                </div>
            </div>

            <form
                @submit.prevent="
                    send({
                        msg: text,
                        room_id: room_id,
                        writer_id: writer_id,
                        to_user_id:
                            writer_id == now_chat_user
                                ? autor_id
                                : now_chat_user,
                        autor_id: autor_id,
                    })
                "
            >
                <input
                    type="text"
                    class="form-controller"
                    v-model="text"
                    required
                />
                <button type="submit">отправить</button>
            </form>
        </template>

        <!-- <br />
        <br />
        <button @click="show1 = !show1">показать тех записки</button>
        <div v-if="show1">
            <br />
            <small> writer_id: {{ writer_id }}</small>
            <br />
            <small> MessageChannel: {{ MessageChannel }} </small>
        </div> -->
    </div>
</template>

<script>
import {
    //   // ref,
    watchEffect,
    onMounted,
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

import { useRoute } from "vue-router";
import Chat from "./Chat.ts";
import Dater from "./../modules/Dater.ts";

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
            text: "",
            show1: false,
            //       showItemOpis: false,
        };
    },

    // const getUserRepositories = async () => {
    //     repositories = await fetchUserRepositories(props.user)
    //   }

    //   components: {},

    setup(props) {
        const route = useRoute();

        // const { getItem, item } = VitrinItems();
        // const route = useRoute();

        const {
            goToRoom,
            re,
            re1,
            orders,
            MessageChannel,
            writerInChat,
            getNameUser,
            now_chat_user,
        } = Chat();

        const { showDate } = Dater();

        // watchEffect(() => {
        // //   // this.scrollToTop( this.$refs.chat , MessageChannel);
        //   if (MessageChannel.value && MessageChannel.value.length) {
        // //     const chat = $refs.chat;
        // //     setTimeout(() => {
        // //       chat.scrollTop = chat.scrollHeight;
        // //     });
        //   }
        // });

        watchEffect(() => {
            if (
                now_chat_user.value != props.writer_id &&
                props.autor_id != props.writer_id
            ) {
                now_chat_user.value = props.writer_id;
            }
        });

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

        const {
            // getChatUsers,
            // getChatList,
            setChatNow,
            chat_list,
        } = Chat();

        // onMounted(() => {
        //     //   getChatList(route.params.itemId, props.writer_id );
        //     getChatList(props.room_id, props.writer_id);
        // });

        // onMounted(() => {
        //     getChatUsers(props.room_id, props.writer_id);
        // });

        // watchEffect(() => {
        //     // getChatUsers(props.room_id, props.writer_id);
        //     // this.setChatNow(props.writer_id);
        //     setChatNow(now_chat_user.value);
        // });

        goToRoom(props.room_id);

        if (props.writer_id != props.autor_id) {
            setChatNow(props.room_id, props.writer_id);
        }

        return {
            route,
            getNameUser,
            showDate,
            now_chat_user,
            writerInChat,
            chat_list,
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

        setChatNow(to_user = "") {
            console.log("setChatNow", this.autor_id, to_user ?? "x");
            console.log("route room", this.route.params.itemId);
            this.now_chat_user = to_user;

            const {
                // sendMessage,
                MessageChannel,
                goToRoom,
                getRoomHistory,
            } = Chat();
            MessageChannel.value = {};
            goToRoom(this.route.params.itemId, to_user);
            getRoomHistory(this.route.params.itemId, to_user);
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

<style lang="scss" scope>

.list_chat_links_user {
    line-height: 26px;
    .chat_link_user {
        cursor: pointer;
        margin-right: 5px;
        display: inline-block;
        a {
            display: inline-block;
            padding: 2px 5px;
            word-break: break-all;
            background-color: rgba(0,0,255,0.1);
            border-radius: 2px;
            text-decoration: none;
        }
        a.active:HOVER,
        a.active{
            background-color: rgba(0,0,255,0.5);
            color: white;
        }
        a:HOVER{
            background-color: rgba(0,0,255,0.2);
        }
    }
}

.chat {
    .chat-date {
        background-color: rgba(0, 0, 255, 0.2);
        padding: 2px 4px;
        margin-right: 3px;
        border-radius: 3px;
    }

    .string-autor {
        margin-bottom: 1px;
    }
    .string-guest {
        padding-left: 20px;
        background-color: rgba(0, 0, 250, 0.05);
        margin-bottom: 1px;
    }
}
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
