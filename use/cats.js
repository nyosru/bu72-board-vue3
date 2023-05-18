// //meta title
// useHead({
//     title: 'Data Posts - SantriKoding.com',
// });

const catsData = ref({})
const catsOpen = ref({})

// //init config
const config = useRuntimeConfig()

// //fetch data from API with "useAsyncData"
const catsLoading = async() => {
    const { data: cats } = await useAsyncData('posts', () =>
        $fetch(`${config.public.apiBase}/api/posts`),
    )
}

// //method deletePost
// const deletePost = async (id: number) => {

//     //delete data with API
//     await $fetch(`${config.public.apiBase}/api/posts/${id}`, {

//         //method
//         method: 'DELETE'
//     });

//     //refersh data posts
//     refreshNuxtData('posts');
// }

// const cat1 = ref('')

export default function cats() {
    return {
        catsOpen,
        catsData,
        catsLoading

        // catNow,
        // // goToIndex,
        // // список шагов для хлебных крошек
        // stepCrumb,

        // // конфиг загружаемой инфы
        // // cfg,
        // // данные что загрузил
        // data,

        // // показываем или нет меню
        // showMenu,

        // // отфильтрованный список
        // // data_filtered,
        // // загрузка идёт или нет
        // loading,
        // // какой модуль сейчас загружен
        // // loading_module_now,
        // // ф загрузка данных
        // //  loadData = (module, db_connection = 'out') => {
        // loadData,
        // // показ массива с вложенными каталогами, на входе id родителя
        // catsInner,
        // // тащим все вложенные каталоги в указанный
        // // catsLevelLower(id)
        // catsLevelLower,
        // catsLevelLowerStart,
        // // левое меню
        // leftMenu,
        // //
        // catNow,
    }
}