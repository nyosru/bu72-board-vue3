<template>
  <div class="text-center">
    <!-- filter: {{ filter ?? 'x' }}    <br /> -->
    <!-- type_sell: {{ type_sell ?? 'xx' }}    <br /> -->
    <!-- 11 -->
    <label class="btn btn-light m-2 type-color-sell">
      <input type="checkbox" v-model="type_sell" value="y" />
      Продаю
    </label>

    <label class="btn btn-light m-2 type-color-buy">
      <input type="checkbox" v-model="type_buy" value="y" />
      Ищу купить
    </label>

    <label class="btn btn-light m-2 type-color-renta">
      <input type="checkbox" v-model="type_renta" value="y" />
      Сдаю в аренду
    </label>

    <label class="btn btn-light m-2 type-color-need_renta">
      <input type="checkbox" v-model="type_need_renta" value="y" />
      Ищу взять в аренду
    </label>

    <!-- <template v-for="i in da" :key="i.id">
      <div v-if="i.cat_up_id == nowCatUp">
        <button @click="catsOpen[i.id] = !catsOpen[i.id]">
          {{ i.name }} / {{ i.id }}
        </button>
        <NuxtLink :to="'/cat/'+i.id" >go</NuxtLink>
        <nav-cats-item-component
          :da="da"
          :cat_up="i.id"
          v-if=" nowCatUp == null  || ( typeof(catsOpen[i.id]) != 'undefined' && catsOpen[i.id] )"
        />
      </div>
    </template> -->
  </div>
</template>

<script setup>
const type_sell = ref(false)
const type_buy = ref(false)
const type_renta = ref(false)
const type_need_renta = ref(false)

const props = defineProps({
  filter: Object,
  //   filter: { type: Object , default: { 1 : 2} }
  //   cat_up: Number,
  //   da: Object,
})

// mounted() {
//   this.$nextTick(function () {
//     // Код, который будет запущен только после
//     // отрисовки всех представлений
//   try {
//     props.filter = JSON.parse(localStorage.getItem('filter')) || []
//   } catch (error) {}
//   })
// }

// props.filter = {
//   mounted: (el) => {
//     // сделать что-нибудь с элементом
//     props.filter = JSON.parse(localStorage.getItem('filter')) || []
//   }
// }

const editFilter = (v1 = false, v2 = false, v3 = false, v4 = false) => {
  // if( v1 )
  props.filter.sell = v1
  // if( v2 )
  props.filter.buy = v2
  // if( v3 )
  props.filter.renta = v3
  // if( v4 )
  props.filter.need_renta = v4
  // if (isLocalStorage() /* function to detect if localstorage is supported*/) {
  try {
    localStorage.setItem('filter', JSON.stringify(props.filter))
  } catch (error) {}
  // }

  // const route = useRoute()
  // const router = useRouter()
  // // router.push({
  // // router.replace({
  // router.go({
  // // route.go(  '/cat/'+route.params.id+'?filter=' + JSON.stringify(props.filter) )
  // // router.go({
  // //   // path: "/home" ,
  // //   // params: '?filter=' + JSON.stringify(props.filter),
  //   // path: '/cat/'+route.params.id+'?filter=' + JSON.stringify(props.filter),
  //   path: '/cat/'+route.params.id,
  //   // path: '/cat/'+route.params.id+'?filter=' + JSON.stringify(props.filter),
  //   params: { 'filter' : JSON.stringify(props.filter) },
  // //    '/cat/'+route.params.id+'?filter=' + JSON.stringify(props.filter),
  // })

}

watchEffect(() => {


  editFilter(
    type_sell.value,
    type_buy.value,
    type_renta.value,
    type_need_renta.value,
  )
})

// // import navCatsItemComponent from './navCatsItemComponent.vue'

// // import cats from './../use/cats.js'
// import { defineProps } from 'vue'

// filter.value = {77:33}

// // const { catsOpen } = cats()
// const catsOpen = ref({})

// const nowCatUp = ref('')

// // console.log('cat_up', props.cat_up)
// if (typeof props.cat_up == 'undefined') {
//   nowCatUp.value = null
// } else {
//   nowCatUp.value = props.cat_up
// }

// // import { useRoute } from 'vue-router';
// // const route = useRoute();
// // const id = ref(route.params.id);

// // vue3 добавить props используя script setup
// // vue3, используя script setup получить переменную из uri
// // // import navCatsItemComponent from './navCatsItemComponent.vue'

// // // //meta title
// // // useHead({
// // //     title: 'Data Posts - SantriKoding.com',
// // // });

// // // //init config
// // const config = useRuntimeConfig()

// // // // //fetch data from API with "useAsyncData"
// // const { data: cats }: any = await useAsyncData('posts', () =>
// //   $fetch(`${config.public.apiBase}/api/posts`),
// // )

// // // //method deletePost
// // // const deletePost = async (id: number) => {

// // //     //delete data with API
// // //     await $fetch(`${config.public.apiBase}/api/posts/${id}`, {

// // //         //method
// // //         method: 'DELETE'
// // //     });

// // //     //refersh data posts
// // //     refreshNuxtData('posts');
// // // }

// // const cat1 = ref('')
</script>

<style>
/* .nn-ms-1 {
  margin-left: 1rem;
} */
</style>
