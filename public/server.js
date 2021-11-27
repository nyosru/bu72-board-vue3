// console.log(`Server started on /public`);

//server.js

const express = require("express");
const app = express();

const port = 4008;

const server = app.listen(`${port}`, function () {
    console.log(`Server started on /public on port ${port}`);
});

const whitelist = [
    "https://bu72.ru:4008",
    "http://bu72.ru:4008",
    "https://bu72.ru",
    "http://bu72.ru",
    "https://dev.bu72.ru",
    "http://dev.bu72.ru",
    "http://xn--72-9kc6e.xn--p1ai",
    "https://xn--72-9kc6e.xn--p1ai",
    "http://бу72.рф",
    "https://бу72.рф",
];

const io = require("socket.io")(server, {
    // origins: "*:*",
    // cors: true,
    cors: {
        // origin: "*",
        // origin: "https://bu72.ru:4008",
        // origin: [
        // "http://bu72.ru",
        // "http://xn--72-9kc6e.xn--p1ai",
        // ],

        origin: function (origin, callback) {
            if (whitelist.indexOf(origin) > -1) {
                callback(null, true);
            } else {
                callback(null, false);
            }
        },
        methods: ["GET", "POST", "OPTIONS"],
    },
});

async function getRoomHistory(socket, room, user) {
    console.log("a f getRoomHistory", room, user);

    let return_data = "";
    var http = require("http");

    var req_options = {
        host: "bu72.ru",
        port: "80",
        path: "/api-chat/history/" + room + "/" + user,
        //        // method: "GET",
        agent: false,
        //        // headers: {
        //        //     "Content-Type": "application/x-www-form-urlencoded",
        //        //     "Content-Length": Buffer.byteLength(post_data),
        //        // },
    };

    //    // Set up the request
    await http.get(req_options, (res) => {
        res.setEncoding("utf8");
        res.on("data", function (chunk) {

            let ee = JSON.parse(chunk);
            socket.broadcast.to(room).emit("chat-history", ee.res);
            socket.emit("chat-history", ee.res);

        });
    });
}

async function getUserInChat(socket, room) {
    console.log("getUserInChat( room ) ", room);

    let return_data = "";

    var http = require("http");

    // An object of options to indicate where to post to
    var post_options = {
        host: "bu72.ru",
        port: "80",
        path: "/api-chat/list_users/" + room,
        // method: "GET",
        agent: false,
        // headers: {
        //     "Content-Type": "application/x-www-form-urlencoded",
        //     "Content-Length": Buffer.byteLength(post_data),
        // },
    };

    // Set up the request
    await http.get(post_options, (res) => {
        res.setEncoding("utf8");
        res.on("data", function (chunk) {

            let ee = JSON.parse(chunk);

            socket.broadcast.to(room).emit("list-users-chat", ee.res);
            socket.emit("list-users-chat", ee.res);

        });
    });

}

setInterval(() => {
    console.log(11);
}, 60 * 1000);

let res1 = "";

io.on("connection", (socket) => {
    console.log("A user connected");

    //Whenever someone disconnects this piece of code executed
    io.on("disconnect", function () {
        console.log("A user disconnected");
    });

    // входим в комнату
    socket.on("joinroom", async function (data) {
        // console.log(7);
        // console.log(7);
        console.log("joinroom", data);
        // console.log(7);

        let ee = data.room + (data.user ? "-" + data.user : "");

        await socket.join(ee);

        // когда подключаемся к комнате, загружаем список участников чата (видно только автору обьявления)
        if (data.user == "") {
            getUserInChat(socket, ee);
        }
    });

    socket.on("creat-room", (arg) => {
        console.log("creat - room", arg); // world
        // console.log(arg.test); // world
        // socket.broadcast.emit("newdata", arg.test );
        // socket.broadcast.emit("new-msg", arg.test );

        // const userId = fetchUserId(io);
        // io.join(userId);
        // and then later  io.to(userId).emit("hi");
        // console.log("userId", userId); // world
    });

    socket.on("getRoomHistory", (arg) => {
        console.log("socet on get_history", arg); // world
        getRoomHistory(socket, arg.room, arg.user);
    });

    socket.on("send_msg", (arg) => {
        console.log("send_msg", arg.msg); // world

        if (!arg.msg.msg || !arg.msg.msg.length) {
            return false;
        }

        var http = require("http");
        var querystring = require("querystring");

        // Build the post string from an object

        var post_data = querystring.stringify(arg.msg);

        // console.log("post_data", post_data);

        // An object of options to indicate where to post to
        var post_options = {
            host: "bu72.ru",
            port: "80",
            path: "/api-chat/add_msg",
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded",
                "Content-Length": Buffer.byteLength(post_data),
            },
        };

        // Set up the request
        var post_req = http.request(post_options, function (res) {
            res.setEncoding("utf8");
            res.on("data", function (chunk) {
                let re = JSON.parse(chunk);
                let now_room =
                    arg.msg.room_id +
                    "-" +
                    (arg.msg.writer_id != arg.msg.autor_id
                        ? arg.msg.writer_id
                        : arg.msg.to_user_id);
                console.log("send_msg", "now_room", now_room);
                console.log("send_msg re", re, arg.msg);

                socket.join(now_room);

                socket.broadcast.to(now_room).emit("new-msg", re.res);
                socket.emit("new-msg", re.res);
            });
        });

        // post the data
        post_req.write(post_data);
        post_req.end();

        console.log("старт отправки в сокет", arg.msg.room_id);

        // console.log('eee',arg);
        // io.socket.to(arg.room_id).emit("new-msg", arg);
        // io.to(arg.msg.room_id).emit("new-msg", arg);
        // socket.to(arg.msg.room_id).emit("new-msg", arg);
        // socket.emit("new-msg", arg);

        // socket.to(arg.room_id).emit("new-msg", arg);
        // io.socket.emit("new-msg", arg);
        // socket.broadcast.to(arg.msg.room_id).emit("new-msg", arg);

        console.log("финиш отправки в сокет");

        // console.log(arg.test); // world
        // socket.broadcast.emit("newdata", arg.test );

        // var todo = {
        //     userId: 123,
        //     title: "loren impsum doloris",
        //     completed: false,
        // };

        // // fetch("https://jsonplaceholder.typicode.com/todos", {
        // fetch("http://bu72.ru/api1", {
        //     method: "POST",
        //     body: JSON.stringify(todo),
        //     headers: { "Content-Type": "application/json" },
        // })
        //     .then((res) => {
        //         console.log(111 , res );
        //         return res.json()
        //     })
        //     .then((json) => {
        //         console.log(222 , json );
        //         return console.log(json)
        //     }) ;
    });

    io.on("mm", (data) => {
        console.log("data", data, data1 ?? "x", data2 ?? "x");
        // this.messages.push({
        //     message: data.message,
        //     type: 1,
        //     user: data.user,
        // });
    });

    io.on("chat-message", (data) => {
        console.log("data", data, data1 ?? "x", data2 ?? "x");
        // this.messages.push({
        //     message: data.message,
        //     type: 1,
        //     user: data.user,
        // });
    });

    io.on("chat-message2", (data) => {
        console.log("data2", data, data1 ?? "x", data2 ?? "x");
        // this.messages.push({
        //     message: data.message,
        //     type: 1,
        //     user: data.user,
        // });
    });

    // io.emit("chat-message2", (data) => {
    //     console.log("data2", data, data1 ?? "x", data2 ?? "x");
    //     // this.messages.push({
    //     //     message: data.message,
    //     //     type: 1,
    //     //     user: data.user,
    //     // });
    // });
});
