<template>
  <div>
    <transition>
      <div class="container mb-4" v-if="!pending && catIn.data.length > 0">
        <div class="row">

          <!-- <div class="col-12 text-center">
            <h3>Внутренние каталоги</h3>
          </div> -->

          <div class="col-12 text-center">
            <span v-for="link in catIn.data" :key="link.id" class="me-3" >
              <!-- {{ link }} -->
              <NuxtLink :to="'/cat/' + link.id" @click="catIn.data = {}" >
                <span class=nobr >{{ link.name }}</span>
              </NuxtLink>
              <span style="font-size:small" >&nbsp; </span>
            </span>
          </div>

        </div>
      </div>
    </transition>
  </div>
</template>

<script setup>
import { useRoute } from 'vue-router'

const route = useRoute()
const cat_id = route.params.id

const config = useRuntimeConfig()

// const replace = (str) => str.replace(' ','&nbsp;')

const { pending, data: catIn } = await useAsyncData(
  // const { pending, data: catIn } = await useData(
  // const { pending, data: catIn } = await useFetch(
  // const { data: catNow } = await useFetch(
  'catsIn',
  () =>
    $fetch(
      `${config.public.apiBase}/api/cat-in/` + route.params.id,
      // ,
      // {
      //   params: {
      //     page: page.value
      //   }
      // }
    ),
  {
    // watch: [page]
    watch: [route.params.id],
  },
)

</script>

<style>
.nobr { white-space: pre; }
</style>