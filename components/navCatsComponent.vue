<template>
  <div class="container mt-5 mb-5">

    111222
    
    <div class="row">
      <div class="col-md-12">
        <div style="max-height: 70px; overflow: auto; border: 1px solid green; padding: 5px;">
          data: {{ cats ?? 'x' }}
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        nav-cats-item-component
        <br />
        <nav-cats-item-component :da="cats.data" />
      </div>
    </div>

    <div class="row" v-if="false">
      <div class="col-md-12">
        <select v-model="cat1">
          <option value="">
            Выберите каталог
          </option>
          <template v-for="cat in cats.data" :key="cat.id">
            <!-- <op v-if="cat.cat_up_id == null" > -->
            <option v-if="cat.cat_up_id == null" :value="cat.id">
              cat: {{ cat }}
            </option>
          </template>
        </select>
        cat1: {{ cat1 }}
      </div>
    </div>

  </div>
</template>

<script setup>

// import navCatsItemComponent from './navCatsItemComponent.vue'

// //meta title
// useHead({
//     title: 'Data Posts - SantriKoding.com',
// });

// //init config
const config = useRuntimeConfig()

// const cats = ref({})

// // //fetch data from API with "useAsyncData"
const { data: cats } = await useAsyncData('posts', () =>
  $fetch(`${config.public.apiBase}/api/posts`),
)

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

const cat1 = ref('')
</script>
