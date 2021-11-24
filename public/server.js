// "use strict";

// const express = require("express");
// const io = require("socket.io");

// class Server {
//     constructor() {
//         this.port = 4008;
//         this.app = express();
//         this.server = this.app.listen(this.port, () => {
//             console.log(`server running http://bu72.ru:${this.port}`);
//         });
//         this.io = io(this.server);
//     }
// }

// new Server();
// Header set Access - Control - Allow - Origin "test.php-cat.com"

console.log(`Server started on /public`);

//server.js

const express = require("express");
const app = express();

// app.use(function (req, res, next) {
//     res.header("Access-Control-Allow-Origin", "*");
//     res.header(
//         "Access-Control-Allow-Headers",
//         "Origin, X-Requested-With, Content-Type, Accept"
//     );
//     res.header(
//         "Access-Control-Allow-Methods",
//         "GET"
//     );
//     next();
// });

// app.use(function (req, res, next) {
// //     // res.header("Access-Control-Allow-Origin", "test.php"); // update to match the domain you will make the request from
//     res.header("Access-Control-Allow-Origin", "*"); // update to match the domain you will make the request from
//     res.header(
//         "Access-Control-Allow-Headers",
//         "Origin, X-Requested-With, Content-Type, Accept"
//     );
//     next();
// });

// const port = 4000;
const port = 4008;

// const port = 6001;

const server = app.listen(`${port}`, function () {
    console.log(`Server started on port ${port}`);
});

// const helmet = require("helmet");
// app.use(helmet.referrerPolicy({ policy: "strict-origin-when-cross-origin" }));

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
        // что то непонятное ... нужно или нет 211123
        // credentials: true,
    },
});

// io.set("origins", "*:*");

// var fetch = require("node-fetch");

async function getUserInChat(socket, room) {
    console.log("getUserInChat( room ) {", room);

    let return_data = "";

    var http = require("http");

    // An object of options to indicate where to post to
    var post_options = {
        host: "bu72.ru",
        port: "80",
        // path: "/api-chat/get",
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
        // return_data = res;
        // console.log('res', res);
        res.on("data", function (chunk) {
            // console.log(7);
            console.log("77 Response: " + chunk);
            // console.log(7);
            // return chunk.res;

            let ee = JSON.parse(chunk);

            socket.broadcast.to(room).emit("list-users-chat", ee.res);
            socket.emit("list-users-chat", ee.res);

            // console.log(7);
            // console.log("77 финиш отправки в сокет");
            // console.log(7);
            // console.log(7);
        });
    });

    // console.log(777777, return_data, 888);
    // console.log(777777, 999);
    // return return_data;
}

// function getValue() {
//     // return {
//     //     user_id: 77,
//     //     count: Math.floor(Math.random() * (50 - 5 + 1)) + 5
//     // };

//     return [
//         {
//             id: 111126,
//             type: "take_off",
//             timestamp: 1634627878,
//             productName: "Кальций d3, 137г",
//             productCount: -1,
//             sessionId: "6822d3db-a766-499f-b6ca-b9d6382c94b0",
//         },
//         {
//             id: 111127,
//             type: "put_on",
//             timestamp: 1634627917,
//             productName: "Кальций d3, 137г",
//             productCount: 1,
//             sessionId: "6822d3db-a766-499f-b6ca-b9d6382c94b0",
//         },
//     ];
// }

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

    // setInterval(() => {
    //     socket.broadcast.emit("newdata", getValue());
    // }, 60 * 1000);

    // входим в комнату
    socket.on("joinroom", async function (data) {
        console.log("joinroom", data);
        await socket.join(data);

        // когда подключаемся к комнате, загружаем список участников чата (видно только автору обьявления)
        getUserInChat(socket, data);
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

    socket.on("send_msg", (arg) => {

        console.log("send_msg", arg.msg); // world

        if (!arg.msg.msg || !arg.msg.msg.length) {
            return false;
        }

            var http = require("http");

var querystring = require("querystring");

            // Build the post string from an object

            var post_data = querystring.stringify(
                arg.msg
                // {
                // compilation_level: "ADVANCED_OPTIMIZATIONS",
                // output_format: "json",
                // output_info: "compiled_code",
                // warning_level: "QUIET",
                // // js_code: codestring,
                // }
            );

            console.log("post_data", post_data);

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
                    console.log("Response: " + chunk);
                    console.log(7);
                    console.log(7);
                    let re = JSON.parse(chunk);
                    console.log("Response2: " + re.res.created_at);
                    console.log(7);
                    console.log(7);
                    socket.broadcast
                        .to(arg.msg.room_id)
                        // .emit("new-msg", arg);
                        .emit("new-msg", re.res);
                    // socket.emit("new-msg", arg);
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
