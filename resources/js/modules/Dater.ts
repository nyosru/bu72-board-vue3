// import {
//     ref,
//     //     // computed
// } from 'vue'

// import axios from "axios";

// const user_id = ref(0)

import dayjs from 'dayjs'


const showDate = ( date = '' , type = 'day' ) => {

    if (type == 'day') {
        if (dayjs().format('DD') == dayjs(date).format('DD')) {
            return dayjs(date).format('HH:mm')
        }else{
            return dayjs(date).format('MM-DD HH:mm')
        }
    }

};


export default function Dater() {
    return {
        showDate,
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

