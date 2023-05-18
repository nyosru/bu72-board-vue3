<template>
  <div class="container mt-5" >

    <div class="row">
      <div class="col-12">
        <breadcrumb-component 
        :cat_id=good.cat_id
        />
        good: {{ good }}
      </div>
    </div>

    <div class="row" v-if="1==2">
      <div class="col-md-12">
        <!-- <breadcrumb-component :links="catNow" /> -->
      </div>
    </div>

    <!-- <div class="row">
      <div class="col-md-12">
        <cat-in-component />
      </div>
    </div> -->

    <div class="row" v-if="1==2">
      <div class="col-md-12">

        <hr />
        good_id: {{ good_id ?? 'x' }}
        <!-- cat/id -->
        <hr />

        good: {{ good }}

        <!-- <nav-cats-component /> -->
        <!-- YE!! {{ cat_id ?? 'x' }} -->
        <!-- <br /> -->
        <!-- goodsLoading {{ goodsLoading ?? 'x' }} -->
        <!-- <br /> -->
        <!-- catNowLoading: {{ catNowLoading }} -->
        <!-- <br /> -->
        <!-- <div class="mh">catNow: {{ catNow ?? 'x' }}</div> -->
        <!-- <div class="mh">goods: {{ goods ?? 'x' }}</div> -->
        <!-- <div class="mh">cat_now: {{ cat_now ?? 'x' }}</div> -->
        <!-- <div class="mh">counter: {{ counter ?? 'x' }}</div> -->
        <!-- <div class="mh">catNow: {{ counter ?? 'x' }}</div> -->
        <br />
        <!-- <div class="mh">goods: {{ goods ?? 'x' }}</div> -->
      </div>
    </div>

    <!-- <div class="row">
      <div class="col-md-12">
        <h2>товары</h2>
      </div>
    </div> -->

  </div>









  <div class="container-fluid mb-5">
    <div class="row">
      <div class="col-8">

        <!-- картинка        <br /> -->

        <div class="text-center">
          <img :src="showImg != '' ? showImg : good.image[0].uri" alt="" border="0" width="400" />
        </div>

        <br />
        <br />

        <span v-for="i in good.image" :key="i" class="m-1">
          <img :src="i.uri" alt="" border="0" width="100" @click="showImg = i.uri" />
        </span>

        <br clear="all" />
        <br clear="all" />


        <ul class="nav nav-tabs">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Описание</a>
          </li>
          <!-- <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
          </li>
          <li class="nav-item">
            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
          </li> -->
        </ul>

        <div class="p-3">{{ good.opis }}</div>
        <!-- <div v-if="tech" ></div> -->


      </div>
      <div class="col-4">
        название
        <br />
        {{ good.name }}
        <br />
        цена
        <br />
        {{ good.price }}
        <br />
        где
        <br />
        кто
        <br />
        написать сообщение
        <br/>
        <textarea></textarea>
        <br/>
        <button>Отправить</button>
        <br />
      </div>
    </div>
  </div>


  <div class="container-fluid mb-5">
    <div class="row">
      <div class="col-8">


      </div>

      <div class="col-4">
        реклама
      </div>

    </div>
  </div>
  <!-- // подготовь табы с описанием товара используя bootstrap5 -->

  <!-- <div class="container-fluid mb-5" v-if="1==2"> -->
  <!-- <div class="row" v-if="goodsLoading"> -->
  <!-- <div class="col-12 text-center">... загружаю ...</div>
      <div class="col-12 col-md-4 col-lg-3 text-center" v-for="o in 20" :key="o">
        <svg width="70%" height="150" viewBox="0 0 5 5" xmlns="http://www.w3.org/2000/svg">
          <rect width="5" height="5" fill="#999999" />
        </svg>
        <br />
        <br />
        <br />
      </div> -->
  <!-- </div> -->

  <!-- <div class="row" v-else> -->
  <!-- <div class="col-12 col-md-4 col-lg-3" v-for="g in goods.data" :key="g.id">
        <img :src="g.image[0].uri" class="iimg" />
        <h3>{{ g.name }}</h3>
        <p>
          type: {{ g.type }}
          <br />
          price: {{ g.price }}
          <br />
          cat-name: {{ g.cat.name }}
        </p>
        <div class="mh">
          {{ g }}
        </div>
        <br />
        <br />
      </div> -->
  <!-- </div> -->
  <!-- </div> -->
</template>

<script setup>
// import { useRoute } from 'vue-router'

const route = useRoute()
const good_id = route.params.id

const config = useRuntimeConfig()

const showImg = ref('')

// // const { data: goods } = await useFetch(
// //   () => `${config.public.apiBase}/api/goodFromCat/` + cat_id,
// //   //, { params: { token: 123 } }
// // )

// // try {

// // console.log(`${config.public.apiBase}/api/cat/` + route.params.id);

// // console.log(config.public.apiBase);
// // console.log(`${config.public.apiBase}/api/cat/` + route.params.id,);

// // const { data: catNow } = await useFetch(
// //   // () => `${config.public.apiBase}/api/cat/` + cat_id,
// //   () => `${config.public.apiBase}/api/cat/` + route.params.id
// // // //   //,
// // // //   //, { params: { token: 123 } }
// // )




const { data: good } = await useAsyncData(
  // const { data: catNow } = await useFetch(
  'good',
  () =>
    $fetch(
      `${config.public.apiBase}/api/good/` + route.params.id,
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






// const { data: catNow } = await useAsyncData(
//   // const { data: catNow } = await useFetch(
//   'cats',
//   () =>
//     $fetch(
//       `${config.public.apiBase}/api/catFromGood/` + route.params.id,
//       // ,
//       // {
//       //   params: {
//       //     page: page.value
//       //   }
//       // }
//     ),
//   {
//     // watch: [page]
//     watch: [route.params.id],
//   },
// )



// const { pending: goodsLoading, data: goods } = await useAsyncData(
//   'goods',
//   () =>
//     $fetch(
//       `${config.public.apiBase}/api/goodFromCat/` + route.params.id,
//       // ,
//       // {
//       //   params: {
//       //     page: page.value
//       //   }
//       // }
//     ),
//   {
//     // watch: [page]
//     watch: [route.params.id],
//   },
// )

// // // // watchEffect(()=>{
// // useState('cat_now', () => catNow)
// // const counter = useState('cat_now', () => catNow)
// // // })

// // } catch (error) {
// // const counter = useState('cat_now', () => { data: [{ id:0,name:'','cat_up_id':null}] } )
// // }
</script>

<style scoped>
.mh {
  max-height: 60px;
  overflow: auto;
  display: block;
  border: 1px solid green;
  padding: 5px;
}

.iimg {
  max-width: 100%;
  max-height: 100px;
  display: block;
}
</style>
