<template>
  <div class="nn-ms-1">
    <template v-for="i in da" :key="i.id">
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
    </template>
  </div>
</template>

<script setup>

// import navCatsItemComponent from './navCatsItemComponent.vue'

// import cats from './../use/cats.js'
// import { defineProps } from 'vue'

const props = defineProps({
  cat_up: Number,
  da: Object,
})

// const { catsOpen } = cats()
const catsOpen = ref({})

const nowCatUp = ref('')

// console.log('cat_up', props.cat_up)
if (typeof props.cat_up == 'undefined') {
  nowCatUp.value = null
} else {
  nowCatUp.value = props.cat_up
}

// import { useRoute } from 'vue-router';
// const route = useRoute();
// const id = ref(route.params.id);

// vue3 добавить props используя script setup
// vue3, используя script setup получить переменную из uri
// // import navCatsItemComponent from './navCatsItemComponent.vue'

// // //meta title
// // useHead({
// //     title: 'Data Posts - SantriKoding.com',
// // });

// // //init config
// const config = useRuntimeConfig()

// // // //fetch data from API with "useAsyncData"
// const { data: cats }: any = await useAsyncData('posts', () =>
//   $fetch(`${config.public.apiBase}/api/posts`),
// )

// // //method deletePost
// // const deletePost = async (id: number) => {

// //     //delete data with API
// //     await $fetch(`${config.public.apiBase}/api/posts/${id}`, {

// //         //method
// //         method: 'DELETE'
// //     });

// //     //refersh data posts
// //     refreshNuxtData('posts');
// // }

// const cat1 = ref('')
</script>

<style>
.nn-ms-1 {
  margin-left: 1rem;
}
</style>
