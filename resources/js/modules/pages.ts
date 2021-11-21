import {
    ref,
    watchEffect
    // reactive,
    // toRefs,
    // readonly,
    // computed
} from 'vue'

const now_page = ref(1);
const onPage = ref(21);
const kolvo = ref(0);

// const setPage = (e) => {
//     console.log('modules - pages - setPage', e);
//     now_page.value = e;
// }

const limitStart = ref(0);
const limitEnd = ref(0);


let prewPage = 0;

watchEffect(() => {

    if (now_page.value != prewPage) {

        console.log( 'prewPage' , prewPage , now_page.value );
        prewPage = now_page.value;

        if (now_page.value == 1) {
            limitStart.value = 0;
            limitEnd.value = onPage.value - 1;
        } else {
            limitStart.value = (now_page.value - 1) * onPage.value;
            limitEnd.value = limitStart.value + onPage.value - 1;
        }

    }

})

export default function pages() {
    return {
        // setPage,
        now_page,
        onPage,
        kolvo,
        limitStart,
        limitEnd,
    };
}
