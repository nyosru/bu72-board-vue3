import {
    ref,
    //     // computed
} from 'vue'

import axios from "axios";


const catalogs = ref([])
const cat1 = ref('')
const cat1list = ref({})
const cat2 = ref('')
const cat2list = ref({})
const cat3 = ref('')
const cat3list = ref({})
const cat4 = ref('')
const cat4list = ref({})
const cat5 = ref('')
const cat5list = ref({})
const cat6 = ref('')
const cat6list = ref({})
const cat7 = ref('')
const cat7list = ref({})

const selected_cat_id = ref('')


const getCatalogs = async () => {

    // console.log("commis ts", "getData__showNowPay (idata irefund)");
    await axios
        .get(
            "/api/catalogs"
        )
        .then((response) => {
            catalogs.value = response.data.datain ?? [];
        })
        .catch((error) => {
            console.log(error);
        });

};


const clearCats = (nomStart) => {
    let e2 = 9;
    for (let e = nomStart; e <= 7; e++) {
        eval('cat' + e + 'list.value = {};');
        e2 = e - 1;
        eval('cat' + e + '.value = \'\';');
    }
};


const filtrCatsShow = () => {

    console.log('start filtrCatsShow',
        // 'cat10', eval('cat1.value'),
        'cat1', cat1.value,
        'cat2', cat2.value,
        'cat3', cat3.value,
        'cat4', cat4.value,
        'cat5', cat5.value,
        'cat6', cat6.value,
        'cat7', cat7.value,
    );

    if (catalogs.value && catalogs.value.length > 1) {

        selected_cat_id.value = '';

        // console.log('catalogs.value', catalogs.value);
        cat1list.value = catalogs.value.filter(function (item) { return !item.cat_id_up; });
        if (cat1.value) {
            cat2list.value = catalogs.value.filter(function (item) { return item.cat_id_up == cat1.value; });
            if (cat2list.value && !cat2list.value.length) { selected_cat_id.value = cat1.value; }
        }
        // else {
        //     clearCats(2);
        //     // cat2list.value = {};
        //     // cat3list.value = {};
        //     // cat4list.value = {};
        //     // cat5list.value = {};
        //     // cat6list.value = {};
        //     // cat7list.value = {};
        // }
        if (cat2.value) {
            cat3list.value = catalogs.value.filter(function (item) { return item.cat_id_up == cat2.value; });
            if (cat3list.value && !cat3list.value.length) { selected_cat_id.value = cat2.value; }
        }
        // else {
        //     cat3list.value = {};
        //     cat4list.value = {};
        //     cat5list.value = {};
        //     cat6list.value = {};
        //     cat7list.value = {};
        // }
        if (cat3.value) {
            cat4list.value = catalogs.value.filter(function (item) { return item.cat_id_up == cat3.value; });
            if (cat4list.value && !cat4list.value.length) { selected_cat_id.value = cat3.value; }
        }
        // else {
        //     cat4list.value = {};
        //     cat5list.value = {};
        //     cat6list.value = {};
        //     cat7list.value = {};
        // }
        if (cat4.value) {
            cat5list.value = catalogs.value.filter(function (item) { return item.cat_id_up == cat4.value; });
            if (cat5list.value && !cat5list.value.length) { selected_cat_id.value = cat4.value; }
        }
        // else {
        //     cat5list.value = {};
        //     cat6list.value = {};
        //     cat7list.value = {};
        // }
        if (cat5.value) {
            cat6list.value = catalogs.value.filter(function (item) { return item.cat_id_up == cat5.value; });
            if (cat6list.value && !cat6list.value.length) { selected_cat_id.value = cat5.value; }
        }
        // else {
        //     cat6list.value = {};
        //     cat7list.value = {};
        // }
        if (cat6.value) {
            cat7list.value = catalogs.value.filter(function (item) { return item.cat_id_up == cat6.value; });
            if (cat7list.value && !cat7list.value.length) { selected_cat_id.value = cat6.value; }
        }
        // else {
        //     cat7list.value = {};
        // }
    }
};


export default function Catalogs() {
    return {
        selected_cat_id,

        filtrCatsShow,
        getCatalogs,
        catalogs,
        clearCats,

        cat1,
        cat1list,
        cat2,
        cat2list,
        cat3,
        cat3list,
        cat4,
        cat4list,
        cat5,
        cat5list,
        cat6,
        cat6list,
        cat7,
        cat7list,


    }
}









// import ComisFee from './ComisFee.ts'

// const idata = ref('{}')
// const irefund = ref('{}')
// const idata_now = ref('{}')
// const irefund_now = ref('{}')
// const loading = ref(true)
// const deductions = ref({})
// const deductions_now = ref({})
// const bonuses = ref({})
// const bonuses_now = ref({})


// const getData = async (type = '', type2 = '', type3 = '') => {

//     // console.log("commis ts", "getData (idata irefund)");


//     if (loading.value === true) {
//         // loading.value = false;
//         await axios
//             .get(
//                 "/closer/api/comission/get_data_table"
//             )
//             .then((response) => {

//                 idata.value = response.data.idata.BOOM ?? {};
//                 irefund.value = response.data.idata.REFUND ?? {};
//                 deductions.value = response.data.idata.deductions ?? {};
//                 bonuses.value = response.data.idata.bonuses ?? {};

//                 if (type == 'comisFee') {
//                     const { filtrComisToTimeType } = ComisFee();
//                     filtrComisToTimeType(type2, type3);
//                 }

//                 loading.value = false;
//             })
//             .catch((error) => {
//                 console.log(error);
//             });

//     }
// };

// const getData__showNowPay = async (type = '', type2 = '', type3 = '') => {

//     // console.log("commis ts", "getData__showNowPay (idata irefund)");
//     await axios
//         .get(
//             "/closer/api/comission/get_data_table"
//         )
//         .then((response) => {
//             idata_now.value = response.data.idata.BOOM;
//             irefund_now.value = response.data.idata.REFUND;
//             deductions_now.value = response.data.idata.deductions ?? {};
//             bonuses_now.value = response.data.idata.bonuses ?? {};

//             if (type == 'comisFee') {
//                 const { filtrComisToTimeType__now } = ComisFee();
//                 filtrComisToTimeType__now(type2, type3);
//             }

//             loading.value = false;
//         })
//         .catch((error) => {
//             console.log(error);
//         });
// };

// const reset = () => {
//     idata.value = {};
//     irefund.value = {};
//     deductions.value = {};
//     bonuses.value = {};
//     loading.value = true;
// };

// export default function Catalogs() {
//     return {

//         // idata,
//         // irefund,

//         // idata_now,
//         // irefund_now,
//         // loading,

//         // // manualRefunds,
//         // // manualRefunds_now,
//         // deductions,
//         // deductions_now,

//         // bonuses,
//         // bonuses_now,

//         // reset,
//         // getData,
//         // getData__showNowPay,

//     }
// }

