<template>
  <div class="good0">
    <!-- g.image: {{ g.image }} -->
    <!-- image: {{ image }} -->
    <!-- <br/> -->
    <!-- {{ g['image'][0].uri ?? 'x' }} -->
    <!-- <br /> -->
    <!-- propCat: {{ propCat ?? 'x' }}    <br /> -->
    <!-- nameCat: {{ propCat != g.cat_id ? g.cat.name : 'x' }}    <br /> -->
    <NuxtLink class="otherCatLink" v-if="propCat != 0 && propCat != g.cat_id" :to="'/cat/' + g.cat_id">
      {{ g.cat.name }}
    </NuxtLink>
    <NuxtLink :to="'/good/' + g.id">
      <div class="good-img0" :style="
        'background-image:url(' + image +
        // '/noPhoto.png' +
        ');'
      ">
        <!-- g.image[0].uri : {{ g.image[0]['uri'] ?? 'x' }} -->
        <div class="good-img" :style="'background-image:url(' + image + ');'">
          <div class="type" :class="'type-color-' + g.type">
            <span v-if="g.type == 'sell'">Продаю</span>
            <!-- <span v-if="g.type == 'sell_need'" ></span> -->
            <span v-else-if="g.type == 'buy'">Ищу купить</span>
            <span v-else-if="g.type == 'renta'">Аренда</span>
            <span v-else-if="g.type == 'need_renta'">Ищу аренду</span>
          </div>
          <!-- <img v-if="g.image.lenght > 0" :src="g.image[0].uri" class="iimg" /> -->
          <!-- <img v-else src="/noPhoto.png" class="iimg" /> -->
        </div>
      </div>
    </NuxtLink>
    <h3>{{ g.name }}</h3>
    <p>{{ showPrice(g.price) }}</p>
    <button @click="s1 = !s1">show/hide</button>
    <div v-if="s1">
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
    </div>
  </div>
</template>

<script setup>

const showPrice = (price) => {
  const formattedPrice = price.toLocaleString('ru-RU') + ' ₽';
  return formattedPrice;
}

const s1 = ref(false)
// import { useRoute } from 'vue-router'

// const route = useRoute()
// const cat_id = route.params.id

// const config = useRuntimeConfig()

// const { pending, data: catIn } = await useAsyncData(
//   // const { pending, data: catIn } = await useData(
//   // const { pending, data: catIn } = await useFetch(
//   // const { data: catNow } = await useFetch(
//   'catsIn',
//   () =>
//     $fetch(
//       `${config.public.apiBase}/api/cat-in/` + route.params.id,
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

// // import { defineProps } from 'vue'

const props = defineProps({
  propCat: {
    // type: Number,
    type: String,
    // required: true,
    default: 0,
  },
  g: {
    type: Object,
    // //     required: true,
  },
})

let image = '/noPhoto.png'
try {
  image = props.g.image[0].uri
} catch (error) {
  // const image = ''
}


// // useState('cat_now')
// // let links = useState('cat_now')
// // watch(() => links = useState('cat_now') )

// // watch(() => cat_now,
// //   (newValue, oldValue) => console.log('tes'),
// //   { deep: true }
// // )

// // const links = useCatnow()

// // console.log(77,links);

// // console.log( 'typeof' , typeof(links.data) )

// // if( typeof(links.data) === 'undefined' ){
// //   links = { data: {
// //     c1_id: false , c1_name: false ,
// //     c2_id: false , c2_name: false ,
// //     c3_id: false , c3_name: false ,
// //     c4_id: false , c4_name: false ,
// //     c5_id: false , c5_name: false
// //   } }
// // }
</script>

<style scoped>
.good0 {
  border-radius: 10px 10px 0 0;
  overflow: hidden;
}

.good0 .type {
  min-height: 20px;
}

.good0 .type>span {
  font-size: 20%;
  transition: 0.5s all;
}

.good0:hover .type>span {
  font-size: 100%;
  xdisplay: inline-block;
}

.iimg {
  max-width: 100%;
  max-height: 100px;
  display: block;
}

.good-img0 {
  xheight: 10vh;
  /* min-height: 150px; */
  background-position: center center;
  background-size: cover;

  /* background-repeat: no-repeat; */
  /* -webkit-filter: blur(5px);
  -moz-filter: blur(5px);
  -o-filter: blur(5px);
  -ms-filter: blur(5px);
  filter: blur(5px); */
}

.good-img {
  xheight: 10vh;
  min-height: 150px;
  background-position: center center;
  background-size: contain;
  background-repeat: no-repeat;
  /* -webkit-filter: blur(10px);
  -moz-filter: blur(10px);
  -o-filter: blur(10px);
  -ms-filter: blur(10px);
  filter: blur(10px); */
}

.good-img>div {
  display: inline-block;
  xfloat: left;
  top: 0;
  left: 0;
  position: relative;
  border: 1px solid green;
}

.good-img>.type {
  padding: 0px 10px 2px 10px;
  border: none;
  border-radius: 0 0 5px 0;
}

.mh {
  font-size: 12px;
  max-height: 100px;
  overflow: auto;
  display: block;
  border: 1px solid green;
  padding: 5px;
}

.otherCatLink {
  background-color: rgba(255, 255, 255, 0.7);
  text-align: center;
  display: block;
}
</style>
