<template>
  <div>
    <div style="text-align: center">
      <div class="btn-group btn-group-sm" role="group" aria-label="...">
        <button class="btn btn-light" disabled>Фильтр обьявлений:</button>
        <button
          class="btn"
          :class="filtr['sell'] ? 'btn-info' : 'btn-light'"
          @click="
            filtr['sell'] = !filtr['sell'];
            now_page = 1;
          "
        >
          Продаётся
        </button>
        <button
          class="btn"
          :class="filtr['buy'] ? 'btn-info' : 'btn-light'"
          @click="
            filtr['buy'] = !filtr['buy'];
            now_page = 1;
          "
        >
          Хотят купить
        </button>
        <button
          class="btn"
          :class="filtr['free'] ? 'btn-info' : 'btn-light'"
          @click="
            filtr['free'] = !filtr['free'];
            now_page = 1;
          "
        >
          Бесплатно
        </button>
        <button
          class="btn"
          :class="filtr['arenda'] ? 'btn-info' : 'btn-light'"
          @click="
            filtr['arenda'] = !filtr['arenda'];
            now_page = 1;
          "
        >
          Сдача в аренду
        </button>
        <button
          class="btn"
          :class="filtr['arenda_search'] ? 'btn-info' : 'btn-light'"
          @click="
            filtr['arenda_search'] = !filtr['arenda_search'];
            now_page = 1;
          "
        >
          Ищут аренду
        </button>
      </div>
    </div>

    <div v-if="loadingItems" style="padding: 10%;">.. загружаю предложения ..</div>
    <template v-else-if="show && show.length" >
      <br />
      <linkPages :itemsKolvo="show1.length ?? 0" />
      <br />
      <item v-for="i in show" :key="i.id" :i="i" />
      <br clear="all" />
      <br />
      <linkPages :itemsKolvo="show1.length ?? 0" />
      <br />
      <br />
    </template>
    <div v-else style="padding: 10%;">ещё нет предложений, <router-link class="nav-link" xclass="xnav-link xpx-3" :to="{ name: 'add-item' }">добавте первое!</router-link></div>
  </div>
</template>

<script>
import {
  // onMounted
  watchEffect,
  ref,
} from "vue";

import Item from "./ShowItemsItem.vue";
// import fdd from './../modules/VitrinItems.ts'
import VitrinItems from "./../modules/VitrinItems.ts";
// import AddItemForm from "./AddItem.vue";

import pages from "./../modules/pages.ts";
import linkPages from "./../comand/PagesComponent.vue";

export default {
  data() {
    return {
      showItemOpis: false,
      show_now_page: 1,
      //   on_page: 20,
    };
  },

  // const getUserRepositories = async () => {
  //     repositories = await fetchUserRepositories(props.user)
  //   }

  components: {
    Item,
    // Pages,
    // AddItemForm,
    linkPages,
  },

  setup(props) {
    const { items, loading: loadingItems, filtr } = VitrinItems();
    const { now_page } = pages();

    const show1 = ref([]);
    const show = ref([]);

    watchEffect(() => {
      //   console.log("2222");
      if (items.value && items.value.length > 0) {
        // console.log("2222", 111111);

        show1.value = items.value.filter(function (n) {
          if (
            !filtr.value.sell &&
            !filtr.value.buy &&
            !filtr.value.free &&
            !filtr.value.arenda &&
            !filtr.value.arenda_search
          )
            return true;

          //   console.log("n", n);
          //   console.log("n.status_order", n.status_order);
          if (
            (filtr.value.sell == true && n.status_order == "sell") ||
            (filtr.value.buy == true && n.status_order == "buy") ||
            (filtr.value.free == true && n.status_order == "free") ||
            (filtr.value.arenda == true && n.status_order == "arenda") ||
            (filtr.value.arenda_search == true && n.status_order == "arenda_search")
          ) {
            return true;
          }
          return false;
        });
      } else {
        show1.value = {};
      }
    });

    watchEffect(() => {
      console.log(33333);
      if (show1.value && show1.value.length) {
        console.log(33333, 11111);
        const { limitStart, limitEnd } = pages();
        show.value = show1.value.slice(limitStart.value, limitEnd.value);
        // console.log("watchEffect", limitStart.value, limitEnd.value);
      } else {
        show.value = {};
      }
    });

    return {
      loadingItems,
      now_page,
      show1,
      items,
      filtr,
      show,
      //   show_now_page,
      //   now_page,
    };
  },

  methods: {
    // editFiltr(pole) {
    //   this.filtr.value[pole] = true;
    // else { this.filtr[pole]  = false; }
    // this.filtr[pole] = this.filtr[pole] ? !this.filtr[pole] : false;
    // },
    pagesAction(setPage) {
      //   console.log("mod items ", "method", "pagesAction", setPage);
      console.log("mod items кликнули новая страница " + setPage);
      this.now_page = setPage;
    },
    // actionClick() {
    //   console.log("actionClick");
    // },
  },
};
</script>

<style lang="scss"></style>
