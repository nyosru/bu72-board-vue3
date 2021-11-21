import {
    ref,
    //     // computed
    watchEffect,
} from 'vue'

import axios from "axios";

import io from "socket.io-client";

console.log(333, location.protocol + '//' + location.host);

var socket = io.connect(location.protocol + '//' + location.host + ':4008');
// var socket = io.connect("http://test.php-cat.com:4000", { transports : ['websocket'] });

const orders = ref({})

// const addItems = (data) => {
//     orders.value.push(data);
// };

const re1 = ref([])
const re = ref([])

const n_room_id = ref(0)
const to_user_id = ref(0)

// const sendMessage = ( autor_id, to_autor_id, msg ) => {
const sendMessage = (msg, room_id, writer_id, to_user_id = '') => {

    console.log('send_msg', msg, room_id, writer_id, to_user_id);
    socket.emit("send_msg", { msg: msg, room_id: room_id, writer_id: writer_id, to_user_id: to_user_id });
    console.log('send_msg отправлен');

    //     // socket.on('connect', function () {

    //         // Выводим сообщение подключение
    //         // text.innerHTML = "Подключение прошло успешно<br>"
    //         // Отслеживание сообщения от сервера со заголовком 'hello'

    //         // socket.emmit('mm', function (data = 2 ) {
    //         //     // Выводим сообщение от сервера
    //         //     console.log("Сервер: " + data ?? 1 + "<br>");
    //         // });

    //     // });

    //     console.log(777);
    //     // socket.emit('mm', { text: 22 });

    // try {

    //     socket.emit('mm', {
    //         data: '111 '
    //         // message: this.newMessage,
    //         // user: this.username
    //         // autor_id, to_autor_id, msg
    //     });

    // } catch (error) {
    //     console.log('error', error);

    // }
    //     // socket.on('chat-message', {
    //     //     data2: data
    //     //     // message: this.newMessage,
    //     //     // user: this.username
    //     //     // autor_id, to_autor_id, msg
    //     // });

    // socket.on("newdata", (fetchedData) => {
    //     console.log('fetchedData', fetchedData);

    //     //     // this.fillData(fetchedData);

    //     //     console.log("fetchedData", fetchedData);
    //     //     // re.value = fetchedData;
    //     //     // re1.value = fetchedData;
    //     //     creatList(fetchedData);

    //     //     // this.creatList(fetchedData)
    //     //     //   this.addItem(fetchedData);
    //     //     // this.orders.push(fetchedData);
    //     //     // const { addItem } = Orders();
    //     //     // addItem(fetchedData);

    // });


}



const creatList = (data) => {

    //     //orders.value.push(data);
    console.log('creatList', data);

    if (data && data.length) {
        //         // console.log(222);

        re.value = [];

        let ar = [];

        //         // let cart = [];
        let element = {};
        let aa = {};

        data.forEach(el => {

            if (ar[el.productName]) { } else {

                ar[el.productName] = true;

                aa = data.filter(function (n) {
                    return n.productName == el.productName;
                }).reduce(function (sum, current) {
                    return sum + parseFloat(current.productCount);
                }, 0);
                ;


                element = new Object;
                element['ar'] = el;
                element['name'] = el.productName;
                element['kolvo'] = aa;
                //             // // cart.push({ element: element });

                re.value.push(element);

            }

            //             if ( ar[el.productName] ) {
            //                 ar[el.productName] += parseInt(el.productCount);
            //                 // console.log('444', ar[el.productName]);
            //             }
            //             else {
            //                 ar[el.productName] = parseInt(el.productCount);
            //                 // console.log('444 22', ar[el.productName]);
            //             }

        });

        console.log(555, re.value);

        // //         ar.forEach(function (item, i, arr) {
        // //             // alert(i + ": " + item + " (массив:" + arr + ")");
        // //             console.log(222, item, i, arr);

        // //         });

        //         // ar.forEach(el => {
        //         //     var element = {},
        //         //         cart = [];
        //         //     element.id = id;
        //         //     element.quantity = quantity;
        //         //     cart.push({ element: element });
        //         // }

        //         re.push(ar);

        //         console.log('res',re.value);
    }

};

const MessageChannel = ref([]);

socket.on("new-msg", (fetchedData) => {

    // if (fetchedData.msg.room_id == n_room_id) {
    console.log('получили', fetchedData.msg);
    MessageChannel.value.push(fetchedData.msg);

    const objDiv = document.getElementById("chat_div");
    objDiv.scrollTop = objDiv.scrollHeight;

    // } else {
    //     console.log('получили другая комната', fetchedData.msg);
    // }

});


socket.on("newdata", (fetchedData) => {

    // this.fillData(fetchedData);

    console.log("fetchedData", fetchedData);
    // creatList(fetchedData);

    // re.value = fetchedData;
    // re1.value = fetchedData;

    // this.creatList(fetchedData)
    //   this.addItem(fetchedData);
    // this.orders.push(fetchedData);
    // const { addItem } = Orders();
    // addItem(fetchedData);

});

socket.on("chat-message2", (fetchedData) => {
    // this.fillData(fetchedData);
    console.log("chat-message2");
    // creatList(fetchedData);
    // re.value = fetchedData;
    // re1.value = fetchedData;

    // this.creatList(fetchedData)
    //   this.addItem(fetchedData);
    // this.orders.push(fetchedData);
    // const { addItem } = Orders();
    // addItem(fetchedData);

});

const getChatList = async (room_id, writer_id) => {

    console.log('getChatList', room_id, writer_id);

    await axios
        .get(
            "/api-chat/" + room_id + "/" + writer_id
        )
        .then((response) => {

            console.log('getChatList res', response.data);

            // idata.value = response.data.idata.BOOM ?? {};
            // irefund.value = response.data.idata.REFUND ?? {};
            // deductions.value = response.data.idata.deductions ?? {};
            // bonuses.value = response.data.idata.bonuses ?? {};

            // if (type == 'comisFee') {
            //     const { filtrComisToTimeType } = ComisFee();
            //     filtrComisToTimeType(type2, type3);
            // }

            // loading.value = false;
        })
        .catch((error) => {
            console.log(error);
        });

}


const getChatUsers = async (room_id) => {

    console.log('getChatUsers', room_id );

    await axios
        .get(
            "/api-chat/list_users/" + room_id
        )
        .then((response) => {

            console.log('getChatUsers res', response.data);

            // idata.value = response.data.idata.BOOM ?? {};
            // irefund.value = response.data.idata.REFUND ?? {};
            // deductions.value = response.data.idata.deductions ?? {};
            // bonuses.value = response.data.idata.bonuses ?? {};

            // if (type == 'comisFee') {
            //     const { filtrComisToTimeType } = ComisFee();
            //     filtrComisToTimeType(type2, type3);
            // }

            // loading.value = false;
        })
        .catch((error) => {
            console.log(error);
        });

}

const goToRoom = (room_id) => {

    n_room_id.value = room_id;

    // socket.of("/")adapter.on('creat-room', (room_id) => { }
    // socket.of("/").adapter.on("create-room", (room_id) => { console.log(`room ${room_id} was created`); });
    // socket.emit("creat-room", { room: room_id });

    socket.emit('joinroom', room_id);
    // MessageChannel.value = [];
}

// watchEffect(() => {
//     creatList(re1.value)
// });

export default function Chat() {
    return {
        getChatUsers,
        to_user_id,
        getChatList,
        re,
        re1,
        orders,
        sendMessage,
        // addItems,
        MessageChannel,
        goToRoom,
    }
}
