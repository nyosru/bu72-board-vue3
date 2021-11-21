import vue from "vue";
import { createApp } from "vue";
import App from "./app.vue";

import SideMenu from "./app/SideMenuComponent.vue";

import PageIndex from "./pages/IndexComponent.vue";
import PageVitrin from "./pages/VitrinComponent.vue";
import PageItem from "./pages/ItemComponent.vue";
import PageAddItem from "./components/AddItem.vue";

// import PageCommission from "./pages/CommissionComponent.vue";

// import ComissionPage1 from "./components/commission/Page1Component.vue";
// import CommissionUpMenu from "./components/commission/CommissionMenuComponent.vue";
// import ComissionTableData from "./components/commission/TableComponent.vue";

// import CommissionFeeUp from "./pages/CommissionFeeUpComponent.vue";
// import CommissionFee from "./pages/CommissionFeeComponent.vue";

// import InfoTmoffer from "./components/tmoffer-info/BodyComponent.vue";

// const About1 = { template: "<h2>About Page1</h2>" };
// const About2 = { template: "<h2>About Page2</h2>" };
// const comission = { template: "<h2>comission About Page2</h2>" };
// const opportunities = { template: "<h2> opportunities About Page2</h2>" };
// const calls = { template: "<h2> calls About Page2</h2>" };
const NotFound = { template: "<h2>Page Not Found</h2>" };

// const BlankString = { template: "<p>string</p>" };

// function ulogin_start(params) {
//     console.log("ulogin_start", params);
// }


// import BlockCommissFee from "./components/commission-fee/BodyComponent.vue";

import { createRouter, createWebHistory } from "vue-router";

const routes = [
    {
        path: "/",
        name: "closer-index2",
        // component: PageIndex,
        components: {
            leftMenu: SideMenu,
            // pHeader: null,
            // center: PageVitrin,
            center: PageIndex,
        },
    },

    {
        path: "/add",
        name: "add-item",
        // component: PageIndex,
        components: {
            leftMenu: SideMenu,
            // pHeader: null,
            center: PageAddItem,
        },
    },

    {
        path: "/c/:catId/:itemId",
        name: "item_show",
        // component: PageIndex,
        components: {
            leftMenu: SideMenu,
            // pHeader: null,
            center: PageItem,
        },
    },

    {
        path: "/c/:catId",
        name: "cat_show",
        // component: PageIndex,
        components: {
            leftMenu: SideMenu,
            // pHeader: null,
            center: PageVitrin,
        },
        // children: [
        //     //item_show', params: { catId: i.cat_id, itemId: i.id } }" tag="span">
        //     {
        //         path: ":itemId",
        //         name: "item_show",
        //         // component: PageIndex,
        //         components: {
        //             leftMenu: SideMenu,
        //             // pHeader: null,
        //             center: PageItem,
        //         },
        //     },
        // ],
    },

    // {
    //     path: "/closer",
    //     name: "closer-index",
    //     // component: PageIndex,
    //     components: {
    //         leftMenu: SideMenu,
    //         // pHeader: null,
    //         pBody: PageIndex,
    //     },
    // },

    // {
    //     path: "/closer/comission-fee",
    //     name: "closer-comission-fee",
    //     // component: PageCommission,
    //     components: {
    //         leftMenu: SideMenu,
    //         // pBody: PageCommission,
    //         pHeader: CommissionFeeUp,
    //         pBody: CommissionFee,
    //         // pBody1: BlockCommissFee,
    //         pBodyIn: InfoTmoffer,
    //     },
    //     // children: [
    //     //     {
    //     //         path: "/closer/comission-fee",
    //     //         components: {
    //     //             pBodyIn: InfoTmoffer,
    //     //         },
    //     //     },
    //     // ],
    //     // children: [
    //     //     {
    //     //         path: "/closer/comission-fee/info/:tmoffer_id",
    //     //         name: "ccf-info-tmoffer",
    //     //         // component: PageCommission,
    //     //         components: {
    //     //             leftMenu: SideMenu,
    //     //             pHeader: CommissionFeeUp,
    //     //             pBody: CommissionFee,
    //     //             pBodyIn: InfoTmoffer,
    //     //             // pBody1: BlockCommissFee,
    //     //         },
    //     //     },
    //     // ],
    // },

    // {
    //     path: "/closer/comission",
    //     name: "closer-comission",
    //     // component: PageCommission,
    //     components: {
    //         leftMenu: SideMenu,
    //         // pBody: PageCommission,
    //         pHeader: CommissionUpMenu,
    //         pBody: ComissionTableData,
    //     },
    //     // children: [
    //     //     {
    //     //         path: "page1",
    //     //         name: "closer-comission-page1",
    //     //         //   component: UserEmailsSubscriptions
    //     //         components: {
    //     //             pBody: ComissionPage1,
    //     //         },
    //     //     },
    //     //     // ,
    //     //     // {
    //     //     //     path: 'profile',
    //     //     //   components: {
    //     //     //       default: UserProfile,
    //     //     //     helper: UserProfilePreview
    //     //     //   }
    //     //     // }
    //     // ],
    // },

    // {
    //     path: "/closer/comission/page1",
    //     name: "closer-comission-page1",
    //     // component: PageCommission,
    //     components: {
    //         leftMenu: SideMenu,
    //         // pBody: PageCommission,
    //         pHeader: CommissionUpMenu,
    //         pBody: ComissionPage1,
    //     },
    //     // children: [
    //     //     {
    //     //         path: "page1",
    //     //         name: "closer-comission-page1",
    //     //         //   component: UserEmailsSubscriptions
    //     //         components: {
    //     //             pBody: ComissionPage1,
    //     //         },
    //     //     },
    //     //     // ,
    //     //     // {
    //     //     //     path: 'profile',
    //     //     //   components: {
    //     //     //       default: UserProfile,
    //     //     //     helper: UserProfilePreview
    //     //     //   }
    //     //     // }
    //     // ],
    // },

    // // {
    // //     path: "/closer/routers",
    // //     name: "closer-routes",
    // //     //   component: Home
    // //     // component: () => import(/* webpackChunkName: "about" */ './views/About.vue')
    // //     component: About1,
    // // },
    // // {
    // //     path: "/closer/routers/list",
    // //     name: "closer-routes-list",
    // //     // route level code-splitting
    // //     // this generates a separate chunk (about.[hash].js) for this route
    // //     // which is lazy-loaded when the route is visited.
    // //     //   component: () => import(/* webpackChunkName: "about" */ './views/AboutList.vue')
    // //     component: About2,
    // // },

    // // {
    // //     path: "/closer/comission",
    // //     name: "comission",
    // //     //   component: Home
    // //     // component: () => import(/* webpackChunkName: "about" */ './views/About.vue')
    // //     component: comission,
    // // },

    // // {
    // //     path: "/closer/opportunities",
    // //     name: "opportunities",
    // //     //   component: Home
    // //     // component: () => import(/* webpackChunkName: "about" */ './views/About.vue')
    // //     component: opportunities,
    // // },

    // // {
    // //     path: "/closer/calls",
    // //     name: "calls",
    // //     //   component: Home
    // //     // component: () => import(/* webpackChunkName: "about" */ './views/About.vue')
    // //     component: calls,
    // // },

    // // {
    // //     path: "comission",
    // //     name: "comission",
    // //     //   component: Home
    // //     // component: () => import(/* webpackChunkName: "about" */ './views/About.vue')
    // //     component: comission,
    // // },

    { path: "/:pathMatch(.*)*", component: NotFound },
];

const routers = createRouter({
    history: createWebHistory(process.env.BASE_URL),
    mode: "history",
    linkActiveClass: "active",
    linkExactActiveClass: "exact-active",
    routes,
});

const app = createApp(App);
app.use(routers);
app.mount("#app");
