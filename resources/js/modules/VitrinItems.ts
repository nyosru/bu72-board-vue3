import {
    ref,
    //     // computed
} from 'vue'

import axios from "axios";


const items = ref('{}')
const item = ref('{}')

const itemsFiltered = ref('{}')

const loading = ref(true);

const filtr = ref({
    sell: false,
    buy: false,
    free: false,
    arenda: false,
    arenda_search: false,
});


const getItems = async (cat = 0) => {

    // console.log("commis ts", "getData__showNowPay (idata irefund)");

    loading.value = true;

    await axios
        .get(
            '/api/items/' + cat
        )
        .then((response) => {

            items.value = response.data.datain ?? {};

            // idata_now.value = response.data.idata.BOOM;
            // irefund_now.value = response.data.idata.REFUND;
            // deductions_now.value = response.data.idata.deductions ?? {};
            // bonuses_now.value = response.data.idata.bonuses ?? {};

            // if (type == 'comisFee') {
            //     const { filtrComisToTimeType__now } = ComisFee();
            //     filtrComisToTimeType__now(type2, type3);
            // }

            loading.value = false;

        })
        .catch((error) => {
            console.log(error);
        });

    // console.log('getCatalogs', r );

};


const getItem = async (item_id = 0) => {

    // console.log("commis ts", "getData__showNowPay (idata irefund)");
    await axios
        .get(
            '/api/item/' + item_id
        )
        .then((response) => {
            item.value = response.data.datain ?? {};
        })
        .catch((error) => {
            console.log(error);
        });

    // console.log('getCatalogs', r );

};

export default function VitrinItems() {
    return {
        loading,
        filtr,
        getItems,
        items,
        getItem,
        item,
    }
}

